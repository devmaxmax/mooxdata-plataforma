<?php

namespace App\Http\Controllers;

use App\Models\BorealWhatsAppMessage;
use App\Models\RagData;
use App\Services\llm\Deepseek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class BorealWhatsAppWebhookController extends Controller
{
    private $llm;

    public function __construct(Deepseek $llm)
    {
        $this->llm = $llm;
    }

    public function handleWebhook(Request $request)
    {
        Log::info("Boreal Webhook hit: " . $request->method() . " - " . $request->fullUrl());
        Log::info("Payload: " . json_encode($request->all()));

        // ---------------------------------------------------------
        // FASE 1: VERIFICACIÓN DE META (GET)
        // ---------------------------------------------------------
        if ($request->isMethod('get')) {
            $verifyToken = env('BOREAL_META_VERIFY_TOKEN', 'boreal_secure_token');

            $mode = $request->query('hub_mode') ?? $request->query('hub.mode');
            $token = $request->query('hub_verify_token') ?? $request->query('hub.verify_token');
            $challenge = $request->query('hub_challenge') ?? $request->query('hub.challenge');

            if ($mode === 'subscribe' && $token === $verifyToken) {
                Log::info("Boreal Webhook verificado con éxito.");
                return response((string) $challenge, 200)->header('Content-Type', 'text/plain');
            }

            Log::warning("Boreal Webhook verificación fallida: Token incorrecto.");
            return response('Forbidden', 403);
        }

        // ---------------------------------------------------------
        // FASE 2: RECEPCIÓN DE MENSAJES (POST)
        // ---------------------------------------------------------
        if ($request->isMethod('post')) {
            $payload = $request->json()->all();

            $changeValue = $payload['entry'][0]['changes'][0]['value'] ?? [];

            // Si es un cambio de estado (sent, delivered, read), no es un mensaje nuevo. Lo ignoramos con 200 OK.
            if (isset($changeValue['statuses'])) {
                return response('EVENT_RECEIVED', 200);
            }

            $entry = $changeValue['messages'][0] ?? null;

            if (!$entry) {
                Log::info('Payload de Boreal no contiene mensaje directo: ' . json_encode($payload));
                return response('EVENT_RECEIVED', 200);
            }

            $userPhone = $entry['from'];
            $wpId = $entry['id'] ?? null;
            $msgType = $entry['type'] ?? 'text';

            // Extraer el texto del mensaje
            $userMessage = '';
            if ($msgType === 'text') {
                $userMessage = $entry['text']['body'] ?? '';
            } elseif ($msgType === 'image') {
                $userMessage = '[Imagen recibida]';
            } elseif ($msgType === 'document') {
                $userMessage = '[Documento recibido]';
            } elseif ($msgType === 'audio' || $msgType === 'voice') {
                $userMessage = '[Audio recibido]';
            } else {
                $userMessage = '[' . ucfirst($msgType) . ' recibido]';
            }

            if (!empty($userMessage)) {
                BorealWhatsAppMessage::create([
                    'phone_number' => $userPhone,
                    'message' => $userMessage,
                    'type' => 'incoming',
                    'wp_id' => $wpId,
                    'status' => 'received'
                ]);

                // Check suspension
                if (Cache::has("boreal_bot_suspended_{$userPhone}")) {
                    Log::info("Boreal bot is suspended for user {$userPhone}. Skipping LLM reply.");
                    return response('EVENT_RECEIVED', 200);
                }

                try {
                    // Fetch RagData
                    $ragData = RagData::where('is_active', 1)->get();
                    $ragContext = "";
                    foreach ($ragData as $rag) {
                        $ragContext .= "Tema: {$rag->topic}\nContenido: {$rag->content}\n\n";
                    }

                    $systemPrompt = "Eres un Asistente Virtual amable y profesional. Responde de forma clara y concisa.\n"
                        . "Utiliza EXCLUSIVAMENTE la siguiente información para responder a las consultas del usuario:\n\n"
                        . "{$ragContext}\n\n"
                        . "Si la información solicitada no se encuentra en el contexto anterior, responde cordialmente que no tienes esa información y que pronto un humano se pondrá en contacto.";

                    // Historial
                    $history = BorealWhatsAppMessage::where('phone_number', $userPhone)
                        ->orderBy('created_at', 'desc')
                        ->take(6)
                        ->get()
                        ->reverse()
                        ->map(function($m) {
                            return ['role' => $m->type === 'incoming' ? 'user' : 'assistant', 'content' => $m->message];
                        })->toArray();

                    $fakedRequest = new Request(['messages' => $history]);
                    $response = $this->llm->chat(['role' => 'system', 'content' => $systemPrompt], $fakedRequest);
                    $botReply = $response->getData()->reply;

                    $this->sendWhatsAppMessage($userPhone, $botReply);
                    $this->storeOutgoing($userPhone, $botReply);
                } catch (\Exception $e) {
                    Log::error("Boreal LLM Error: " . $e->getMessage());
                }
            }

            return response('EVENT_RECEIVED', 200);
        }

        return response('Bad Request', 400);
    }

    private function storeOutgoing($phone, $msg) {
        BorealWhatsAppMessage::create([
            'phone_number' => $phone,
            'message' => $msg,
            'type' => 'outgoing',
            'status' => 'sent'
        ]);
    }

    private function sendWhatsAppMessage($to, $messageBody)
    {
        $token = env('BOREAL_META_WHATSAPP_TOKEN', env('META_WHATSAPP_TOKEN'));
        $phoneId = env('BOREAL_META_PHONE_ID', env('META_PHONE_ID'));
        $version = 'v21.0'; 
        
        $url = "https://graph.facebook.com/{$version}/{$phoneId}/messages";

        try {
            $response = Http::withToken($token)->post($url, [
                'messaging_product' => 'whatsapp',
                'to' => $to,
                'type' => 'text',
                'text' => ['body' => $messageBody]
            ]);

            Log::info("Boreal Meta API Response: " . $response->status() . " - " . $response->body());

            if ($response->failed()) {
                Log::error('Error enviando mensaje a Meta (Boreal): ' . $response->body());
                $this->storeOutgoing($to, "SYSTEM ERROR (Not Sent to user): " . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Excepción enviando WhatsApp Boreal: ' . $e->getMessage());
        }
    }
}
