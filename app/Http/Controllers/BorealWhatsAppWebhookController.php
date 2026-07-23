<?php

namespace App\Http\Controllers;

use App\Models\BorealWhatsAppMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BorealWhatsAppWebhookController extends Controller
{
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
            }

            return response('EVENT_RECEIVED', 200);
        }

        return response('Bad Request', 400);
    }
}
