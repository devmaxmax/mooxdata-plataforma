<?php

namespace App\Http\Controllers;

use App\Models\Burra\BurraOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WhatsAppWebhookController extends Controller
{

    private $llm;

    public function __construct(\App\Services\llm\Deepseek $llm)
    {
        $this->llm = $llm;
    }

    public function handleWebhook(Request $request)
    {
        Log::info("Webhook hit: " . $request->method() . " - " . $request->fullUrl());
        Log::info("Payload: " . json_encode($request->all()));
        // ---------------------------------------------------------
        // FASE 1: VERIFICACIÓN (GET)
        // ---------------------------------------------------------
        if ($request->isMethod('get')) {
            $verifyToken = 'mooxdata_secure_token'; 
            $mode = $request->query('hub_mode');
            $token = $request->query('hub_verify_token');
            $challenge = $request->query('hub_challenge');

            if ($mode === 'subscribe' && $token === $verifyToken) {
                return response((string) $challenge, 200)->header('Content-Type', 'text/plain');
            }
            return response('Forbidden', 403);
        }

        // ---------------------------------------------------------
        // FASE 2: RECEPCIÓN DE MENSAJES (POST)
        // ---------------------------------------------------------
        if ($request->isMethod('post')) {
            $payload = $request->json()->all();

            $entry = $payload['entry'][0]['changes'][0]['value']['messages'][0] ?? null;

            if (!$entry) {
                Log::error('Payload inválido', ['payload' => $payload]);
                return response('EVENT_RECEIVED', 200);
            }

            $userPhone = $entry['from']; 
            $wpId = $entry['id'];
            $msgType = $entry['type'] ?? 'text'; // text, image, document, etc.

            // 0. Limpieza: Eliminar pedidos pendientes de pago expirados (> 30 min)
            BurraOrder::where('customer_phone', $userPhone)
                ->where('status', 'pending_payment')
                ->where('created_at', '<', Carbon::now()->subMinutes(30))
                ->delete();

            // 1. Verificar si hay un pedido activo esperando pago o revisión
            $activeOrder = BurraOrder::where('customer_phone', $userPhone)
                ->whereIn('status', ['pending_payment', 'payment_review'])
                ->latest()
                ->first();

            if ($activeOrder) {
                // Caso A: Esperando comprobante
                if ($activeOrder->status === 'pending_payment') {
                    if ($msgType === 'image' || $msgType === 'document') {
                        $mediaId = $msgType === 'image' ? ($entry['image']['id'] ?? null) : ($entry['document']['id'] ?? null);
                        
                        if ($mediaId) {
                            $path = $this->downloadAndSaveMedia($mediaId, $msgType);
                            if ($path) {
                                $activeOrder->update([
                                    'payment_receipt' => $path,
                                    'status' => 'payment_review'
                                ]);
                                $this->sendWhatsAppMessage($userPhone, "✅ Comprobante recibido correctamente.\n⏳ Un operador verificará el pago y confirmará tu pedido en breve.");
                            } else {
                                $this->sendWhatsAppMessage($userPhone, "⚠️ Hubo un problema descargando tu comprobante. Por favor intentá enviarlo de nuevo.");
                            }
                        }
                    } else {
                        // Si escribe texto pregúntando algo, igual recordamos el pago
                        $this->sendWhatsAppMessage($userPhone, "🧾 Estamos esperando el comprobante de pago (imagen o PDF) para procesar tu pedido.\nSi pasaron 30 minutos, el pedido se cancelará automáticamente.");
                    }
                    return response('EVENT_RECEIVED', 200);
                }

                // Caso B: En revisión (Usuario escribe de nuevo)
                if ($activeOrder->status === 'payment_review') {
                     // Solo respondemos si es algo relevante o pasaron X horas, para no floodear.
                     // Por ahora respuesta safe:
                     if ($msgType === 'text') {
                        $this->sendWhatsAppMessage($userPhone, "⏳ Tu pedido sigue en revisión por un operador. Te avisaremos apenas se confirme.");
                     }
                     return response('EVENT_RECEIVED', 200);
                }
            
                // Si llegamos acá con activeOrder, retorno
                return response('EVENT_RECEIVED', 200);
            }


            // 2. Flujo Normal de Chat (Toma de Pedido)
            // Solo procesamos TEXTO para el bot de IA
            $userMessage = $entry['text']['body'] ?? '';
            if ($msgType !== 'text') {
                $this->sendWhatsAppMessage($userPhone, "🤖 Soy un bot, por ahora solo entiendo texto para tomar tu pedido (o comprobantes si ya pediste).");
                return response('EVENT_RECEIVED', 200);
            }

            // Guardar Mensaje Entrante
            \App\Models\Burra\BurraWhatsAppMessage::create([
                'phone_number' => $userPhone,
                'message' => $userMessage,
                'type' => 'incoming',
                'wp_id' => $wpId,
                'status' => 'received'
            ]);

            // Verificar Horario
            $now = Carbon::now('America/Argentina/Buenos_Aires');
            $startTime = $now->copy()->setTime(20, 0, 0);
            $endTime = $now->copy()->setTime(23, 50, 0);

            if (!$now->between($startTime, $endTime)) {
                 // Fuera de horario
                 return response('EVENT_RECEIVED', 200);
            }

            // Verificar Suspensión Manual
            if (Cache::has('burra_bot_suspended_' . $userPhone)) {
                return response('EVENT_RECEIVED', 200);
            }

            // 4. Lógica del Bot con IA
            $products = \App\Models\Burra\BurraProduct::where('is_active', true)->get();
            $menuText = $products->map(function($p) {
                return "- {$p->name} ($ {$p->price})";
            })->implode("\n");

            $systemPrompt = "Eres 'BurroBot', el camarero virtual de Burra Comida Mexicana.
            TU OBJETIVO: Tomar el pedido del cliente amablemente.
            
            MENÚ DISPONIBLE:
            {$menuText}

            REGLAS:
            1. Sé amable y breve (estilo WhatsApp).
            2. OBLIGATORIO: Debes pedir 'Nombre y Apellido' y 'Dirección exacta'. No confirmes el pedido sin estos datos.
            3. Identifica: Productos exactos, Cantidad, Forma de pago (Efectivo/Transferencia).
            4. Si falta info, pregúntala.
            5. SI EL PEDIDO ESTÁ LISTO PARA CONFIRMAR:
               Muestra el resumen al usuario y pregúntale si confirma.
            
            6. SI EL USUARIO DICE 'SI' o 'CONFIRMO' (luego de ver el resumen):
               Tu respuesta DEBE SER UNICAMENTE un JSON con este formato:
               
               {
                 \"order_confirmed\": true,
                 \"customer_name\": \"Nombre del Cliente\",
                 \"address\": \"Dirección Completa\",
                 \"payment_method\": \"Transferencia (o Efectivo)\",
                 \"items\": [
                    {\"name\": \"Nombre exacto producto\", \"quantity\": 1, \"price\": 1000}
                 ]
               }

            7. Si NO está confirmado, responde normalmente como texto al usuario.
            ";

            // Historial
            $history = \App\Models\Burra\BurraWhatsAppMessage::where('phone_number', $userPhone)
                ->orderBy('created_at', 'desc')
                ->take(6)
                ->get()
                ->reverse()
                ->map(function($m) {
                    return ['role' => $m->type === 'incoming' ? 'user' : 'assistant', 'content' => $m->message];
                })->toArray();
            
            // Call LLM
            $fakedRequest = new Request(['messages' => $history]);
            $response = $this->llm->chat(['role' => 'system', 'content' => $systemPrompt], $fakedRequest);
            $botReply = $response->getData()->reply;

            // Procesar Respuesta
            $orderData = json_decode($botReply, true);

            if ($orderData && isset($orderData['order_confirmed']) && $orderData['order_confirmed'] === true) {
                // Crear Pedido
                $total = 0;
                foreach ($orderData['items'] as $item) {
                    $total += ($item['price'] * $item['quantity']);
                }

                $order = \App\Models\Burra\BurraOrder::create([
                    'table_number' => 'WHATSAPP',
                    'status' => 'pending_payment', // Estado inicial esperando pago
                    'total' => $total,
                    'customer_name' => $orderData['customer_name'] ?? 'Whatsapp User',
                    'customer_address' => $orderData['address'] ?? 'Retiro en local',
                    'customer_phone' => $userPhone,
                    'customer_note' => 'Pedido automático por Bot',
                    'payment_method' => $orderData['payment_method'] ?? 'Efectivo'
                ]);

                foreach ($orderData['items'] as $item) {
                    \App\Models\Burra\BurraOrderItem::create([
                        'order_id' => $order->id,
                        'product_name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price']
                    ]);
                }

                // Mensaje Final con Instrucciones de Pago
                $finalMsg = "📝 *Pedido Registrado #{$order->id}*\n\n";
                $finalMsg .= "👤 *Nombre:* {$orderData['customer_name']}\n";
                $finalMsg .= "📍 *Dirección:* {$orderData['address']}\n";
                $finalMsg .= "💰 *Total:* $$total\n\n";
                $finalMsg .= "Para confirmar, por favor realizá el pago a:\n";
                $finalMsg .= "🏦 *Alias:* burra.comidamexicana\n";
                $finalMsg .= "💳 *CVU:* 0000003100019529993791\n";
                $finalMsg .= "👤 *Titular:* Maria Laura Escalada\n\n";
                $finalMsg .= "⚠️ *IMPORTANTE:* Tenés 30 minutos para enviar el comprobante (foto o PDF) por este medio. Si no, el pedido se cancelará automáticamente.";

                $this->sendWhatsAppMessage($userPhone, $finalMsg);
                $this->storeOutgoing($userPhone, $finalMsg);

            } else {
                // Respuesta normal de chat
                $this->sendWhatsAppMessage($userPhone, $botReply);
                $this->storeOutgoing($userPhone, $botReply);
            }

            return response('EVENT_RECEIVED', 200);
        }
    }

    private function downloadAndSaveMedia($mediaId, $type)
    {
        $token = env('META_WHATSAPP_TOKEN');
        
        // 1. Get URL
        $response = Http::withToken($token)->get("https://graph.facebook.com/v21.0/{$mediaId}");
        
        if ($response->failed()) {
            Log::error('Error getting media url: ' . $response->body());
            return null;
        }

        $mediaUrl = $response->json()['url'] ?? null;
        if (!$mediaUrl) return null;

        // 2. Download Binary
        $fileResponse = Http::withToken($token)->get($mediaUrl);
        if ($fileResponse->failed()) {
            Log::error('Error downloading media binary');
            return null;
        }

        $content = $fileResponse->body();
        $ext = $type === 'image' ? 'jpg' : 'pdf'; // Simplification, ideally use mime type
        $filename = 'payment_' . time() . '_' . uniqid() . '.' . $ext;
        
        // Ensure folder exists
        $path = public_path('burra/payments');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        file_put_contents($path . '/' . $filename, $content);
        
        return 'burra/payments/' . $filename;
    }

    private function storeOutgoing($phone, $msg) {
        \App\Models\Burra\BurraWhatsAppMessage::create([
            'phone_number' => $phone,
            'message' => $msg,
            'type' => 'outgoing',
            'status' => 'sent'
        ]);
    }

    private function sendWhatsAppMessage($to, $messageBody)
    {
        $token = env('META_WHATSAPP_TOKEN');
        $phoneId = env('META_PHONE_ID');
        $version = 'v21.0'; 
        
        $url = "https://graph.facebook.com/{$version}/{$phoneId}/messages";

        try {
            Http::withToken($token)->post($url, [
                'messaging_product' => 'whatsapp',
                'to' => $to,
                'type' => 'text',
                'text' => ['body' => $messageBody]
            ]);
        } catch (\Exception $e) {
            Log::error('Excepción enviando WhatsApp: ' . $e->getMessage());
        }
    }
}