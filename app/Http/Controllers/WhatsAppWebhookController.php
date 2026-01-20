<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WhatsAppWebhookController extends Controller
{
    public function handleWebhook(Request $request)
    {
        // ---------------------------------------------------------
        // FASE 1: VERIFICACIÓN (GET) - Configuración inicial con Meta
        // ---------------------------------------------------------
        if ($request->isMethod('get')) {
            $verifyToken = 'mooxdata_secure_token'; 
            
            // Usamos ->query() para asegurar que leemos de la URL
            $mode = $request->query('hub_mode');
            $token = $request->query('hub_verify_token');
            $challenge = $request->query('hub_challenge');

            if ($mode === 'subscribe' && $token === $verifyToken) {
                // Respondemos texto plano y convertimos a string por seguridad
                return response((string) $challenge, 200)->header('Content-Type', 'text/plain');
            }
            
            return response('Forbidden', 403);
        }

        // ---------------------------------------------------------
        // FASE 2: RECEPCIÓN DE MENSAJES (POST) - Cuando te escriben
        // ---------------------------------------------------------
        if ($request->isMethod('post')) { // <--- AQUÍ ESTABA EL ERROR (DECÍA 'get')
            
            // 1. Extraemos el mensaje
            // Usamos input con seguridad para no fallar si la estructura cambia
            $entry = $request->input('entry.0.changes.0.value.messages.0');
            
            // Si no hay mensaje (es un estado de "visto", "entregado", etc.), retornamos 200 y salimos.
            if (!$entry) {
                return response('EVENT_RECEIVED', 200);
            }

            // El ID del cliente en WhatsApp es su número de teléfono
            $userPhone = $entry['from']; 

            // -----------------------------------------------------
            // 2. TU LÓGICA DE HORARIOS
            // -----------------------------------------------------
            $now = Carbon::now('America/Argentina/Buenos_Aires');
            $startTime = $now->copy()->setTime(20, 0, 0);
            $endTime = $now->copy()->setTime(23, 50, 0);

            // Si NO es horario de atención, ignoramos y terminamos
            if (!$now->between($startTime, $endTime)) {
                 return response('EVENT_RECEIVED', 200);
            }

            // -----------------------------------------------------
            // 3. TU LÓGICA DE CACHÉ (Anti-Spam)
            // -----------------------------------------------------
            $cacheKey = 'burra_last_chat_' . $userPhone;

            if (Cache::has($cacheKey)) {
                return response('EVENT_RECEIVED', 200);
            }

            // Guardamos que ya respondimos (bloqueo por 12 horas)
            Cache::put($cacheKey, $now->toDateTimeString(), now()->addHours(12));

            // -----------------------------------------------------
            // 4. ENVÍO DIRECTO (SIN LLM)
            // -----------------------------------------------------
            $mensajeFijo = "¡Hola! Somos BURRA 🌶️\n\nPodés realizar tu pedido por acá 👇\n🔗 https://pidorapido.com/burracomidamexicana/\n\n💸 Si querés enviarnos pesos a través de Mercado Pago:\nAlias: burra.comidamexicana\nCVU: 0000003100019529993791\nNombre: Maria Laura Escalada\n\n¡Gracias por elegirnos!";

            $this->sendWhatsAppMessage($userPhone, $mensajeFijo);

            return response('EVENT_RECEIVED', 200);
        }
    }

    /**
     * Función auxiliar para enviar el mensaje a la API de Meta
     */
    private function sendWhatsAppMessage($to, $messageBody)
    {
        $token = env('META_WHATSAPP_TOKEN');
        $phoneId = env('META_PHONE_ID');
        $version = 'v21.0'; 
        
        $url = "https://graph.facebook.com/{$version}/{$phoneId}/messages";

        try {
            $response = Http::withToken($token)->post($url, [
                'messaging_product' => 'whatsapp',
                'to' => $to,
                'type' => 'text',
                'text' => [
                    'body' => $messageBody
                ]
            ]);

            if ($response->failed()) {
                Log::error('Meta API Error: ' . $response->body());
            }
        } catch (\Exception $e) {
            Log::error('Excepción enviando WhatsApp: ' . $e->getMessage());
        }
    }
}