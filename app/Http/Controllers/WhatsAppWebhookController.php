<?php

namespace App\Http\Controllers;

use App\Models\Burra\BurraOrder;
use App\Models\Burra\BurraOrderItem;
use App\Models\Burra\BurraProduct;
use App\Models\Burra\BurraWhatsAppMessage;
use App\Services\llm\Deepseek;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class WhatsAppWebhookController extends Controller
{

    private $llm;

    public function __construct(Deepseek $llm)
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

            // Parche de prueba - hijo de puta
            if ($userPhone == '5493764999618') {
                $userPhone = '54376154999618';
            }

            $wpId = $entry['id'];
            $msgType = $entry['type'] ?? 'text'; // text, image, document, etc.

            // 0. Limpieza: Cancelar pedidos pendientes de pago expirados (> 30 min)
            BurraOrder::where('customer_phone', $userPhone)
                ->where('status', 'pending_payment')
                ->where('created_at', '<', Carbon::now()->subMinutes(30))
                ->update(['status' => 'cancelled']);

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
            BurraWhatsAppMessage::create([
                'phone_number' => $userPhone,
                'message' => $userMessage,
                'type' => 'incoming',
                'wp_id' => $wpId,
                'status' => 'received'
            ]);

            // Verificar Horario
            // $now = Carbon::now('America/Argentina/Buenos_Aires');
            // $startTime = $now->copy()->setTime(20, 0, 0);
            // $endTime = $now->copy()->setTime(23, 50, 0);

            // if (!$now->between($startTime, $endTime)) {
            //      // Fuera de horario
            //      // return response('EVENT_RECEIVED', 200); // DESHABILITADO PARA TESTING
            // }

            // Verificar Suspensión Manual
            if (Cache::has('burra_bot_suspended_' . $userPhone)) {
                return response('EVENT_RECEIVED', 200);
            }

            // 3.5. Detección de Saludo / Menu (ByPass LLM)
            $isGreeting = preg_match('/^(hola|buenas|buen dia|buenos dias|buenas tardes|buenas noches|menu|carta|pedido|pedir|quiero pedir)/i', trim($userMessage));
            $isShort = strlen($userMessage) < 20;

            if ($isGreeting && $isShort) {
                $welcomeMsg = "¡Hola! Somos BURRA 🌶️\n\nPodés realizar tu pedido por acá 👇\n🔗 https://mooxdata.xyz/app/burracomidamexicana/\n\n💸 Si querés enviarnos pesos a través de Mercado Pago:\nAlias: burra.comidamexicana\nCVU: 0000003100019529993791\nNombre: Maria Laura Escalada\n\n¡Gracias por elegirnos!";
                
                $this->sendWhatsAppMessage($userPhone, $welcomeMsg);
                $this->storeOutgoing($userPhone, $welcomeMsg);
                
                return response('EVENT_RECEIVED', 200);
            }

            // 4. Lógica del Bot con IA
            $allProducts = BurraProduct::with('category')->where('is_active', true)->get();
            $grouped = $allProducts->groupBy(function($item) {
                return $item->category ? $item->category->name : 'Varios';
            });

            // A. Detección de Selección de Categoría
            // Verificamos si el mensaje del usuario COINCIDE con alguna categoría
            $userMsgClean = trim(strtolower($userMessage));
            $matchedCategory = null;
            $matchedProducts = null;

            foreach ($grouped as $catName => $items) {
                // Evitamos falsos positivos con palabras cortas como "si", "no", "ok" dentro de nombres de categorías
                // Ejemplo: "si" dentro de "Fusión"
                if (strlen($userMsgClean) < 3) continue;

                if (str_contains(strtolower($catName), $userMsgClean) || str_contains($userMsgClean, strtolower($catName))) {
                    $matchedCategory = $catName;
                    $matchedProducts = $items;
                    break;
                }
            }

            if ($matchedCategory) {
                $categoryMenu = "*{$matchedCategory}*\n";
                foreach ($matchedProducts as $p) {
                    $categoryMenu .= "- {$p->name} ($ {$p->price})\n";
                }
                
                $reply = "¡Excelente elección! Aquí tienes las opciones de *{$matchedCategory}*:\n\n{$categoryMenu}\n✍️ Escríbeme qué te gustaría pedir (ej. 'Quiero 2 Tacos de Pollo').";
                $this->sendWhatsAppMessage($userPhone, $reply);
                $this->storeOutgoing($userPhone, $reply);
                return response('EVENT_RECEIVED', 200);
            }

            // B. Mostrar Lista de Categorías (Si piden Menú o Saludan)
            // Ya tenemos $isGreeting detectado arriba para el primer mensaje, pero aquí reforzamos
            // si el usuario pide "ver menu" o "que tenes" más adelante.
            // Agregamos: comer, hambre, ver, carta
            $isMenuRequest = preg_match('/(menu|carta|que tenes|que tienes|opciones|comida|comer|hambre|ver)/i', $userMsgClean);

            if ($isMenuRequest) {
                $catList = "";
                foreach ($grouped as $catName => $items) {
                    $catList .= "- {$catName}\n";
                }

                $reply = "¡Tenemos un menú bien rico! 🌮\nTe paso las categorías para que elijas:\n\n{$catList}\n👇 Escribí el nombre de una categoría para ver sus platos (ej. 'Entradas').\n\n🌐 O pedí por la web: https://mooxdata.xyz/app/burracomidamexicana/";
                $this->sendWhatsAppMessage($userPhone, $reply);
                $this->storeOutgoing($userPhone, $reply);
                return response('EVENT_RECEIVED', 200);
            }

            // C. Fallback: Prompt del Sistema para recibir pedidos directos
            // Solo damos contexto de productos, NO el menú completo para no saturar tokens ni texto
            // Le damos los nombres de productos para que entienda qué piden.
            $productsContext = $allProducts->map(function($p) { return $p->name . ' ($' . $p->price . ')'; })->implode(", ");
            
            // Check for existing pending orders for context
            $existingOrder = BurraOrder::where('customer_phone', $userPhone)
                ->whereIn('status', ['pending', 'pending_payment', 'payment_review'])
                ->latest()
                ->first();
                
            $orderContext = "";
            if ($existingOrder) {
                $orderContext = "EL USUARIO YA TIENE UN PEDIDO REGISTRADO (#{$existingOrder->id}) CON ESTADO: {$existingOrder->status}. Si te da su nombre, avísale que ya tiene ese pedido en curso.";
            }

            $systemPrompt = "Eres 'BurroBot', camarero de Burra Comida Mexicana.
            TU OBJETIVO: Tomar el pedido.
            
            INSTRUCCIONES CLAVE:
            1. Si el usuario te dicta un pedido, procésalo.
            2. Siempre recuerda que pueden pedir por la web: https://mooxdata.xyz/app/burracomidamexicana/
            3. Si no entiendes qué quieren, ofréceles ver el menú escribiendo 'Menu'.
            4. {$orderContext}

            PRODUCTOS DISPONIBLES (Contexto):
            {$productsContext}

            REGLAS DE TOMA DE PEDIDO:
            1. Pide Nombre, Apellido y Dirección Exacta.
            2. Confirma items y total.
            3. Forma de pago (Efectivo/Transferencia).
            4. Cuando esté todo listo, muestra resumen y pide confirmación (SI/CONFIRMO).
            
            5. CASO FINAL - CONFIRMACIÓN:
            Si el usuario confirma (SI/CONFIRMO), NO preguntes si quiere algo más.
            En su lugar, RESPONDE ÚNICAMENTE con un JSON válido siguiendo este formato exacto:
            
            {
                \"order_confirmed\": true,
                \"customer_name\": \"Nombre completo\",
                \"address\": \"Dirección\",
                \"payment_method\": \"Efectivo\",
                \"items\": [
                    {\"name\": \"Nombre Producto\", \"quantity\": 1, \"price\": 1000}
                ]
            }

            IMPORTANTE: TU RESPUESTA DEBE SER SOLO EL JSON. NO ESCRIBAS NADA MÁS.
            ";

            // Historial
            $history = BurraWhatsAppMessage::where('phone_number', $userPhone)
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
            // Limpiar Markdown si el bot responde con ```json ... ```
            $cleanReply = $botReply;
            if (preg_match('/```json\s*(\{.*\})\s*```/s', $botReply, $matches)) {
                $cleanReply = $matches[1];
            } elseif (preg_match('/```\s*(\{.*\})\s*```/s', $botReply, $matches)) {
                $cleanReply = $matches[1];
            }

            $orderData = json_decode($cleanReply, true);

            if ($orderData && isset($orderData['order_confirmed']) && $orderData['order_confirmed'] === true) {
                // Crear Pedido
                $total = 0;
                foreach ($orderData['items'] as $item) {
                    $total += ($item['price'] * $item['quantity']);
                }

                $order = BurraOrder::create([
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
                    BurraOrderItem::create([
                        'order_id' => $order->id,
                        'product_name' => $item['name'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price']
                    ]);
                }

                // Mensaje Final CON Instrucciones
                $finalMsg = "📝 *Pedido Registrado #{$order->id}*\n\n";
                $finalMsg .= "👤 *Nombre:* {$orderData['customer_name']}\n";
                $finalMsg .= "📍 *Dirección:* {$orderData['address']}\n";
                $finalMsg .= "💰 *Total:* $$total\n\n";
                $finalMsg .= "Para confirmar, por favor realizá el pago a:\n";
                $finalMsg .= "🏦 *Alias:* burra.comidamexicana\n";
                $finalMsg .= "💳 *CVU:* 0000003100019529993791\n";
                $finalMsg .= "👤 *Titular:* Maria Laura Escalada\n\n";
                $finalMsg .= "⚠️ *Esperando confirmación de pago.*\n";
                $finalMsg .= "Enviá el comprobante por acá. Si no, el pedido se cancelará automáticamente en 30 minutos.";

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
        BurraWhatsAppMessage::create([
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
            $response = Http::withToken($token)->post($url, [
                'messaging_product' => 'whatsapp',
                'to' => $to,
                'type' => 'text',
                'text' => ['body' => $messageBody]
            ]);

            Log::info("Meta API Response: " . $response->status() . " - " . $response->body());



            if ($response->failed()) {
                Log::error('Error enviando mensaje a Meta: ' . $response->body());
                // EMERGENCY LOGGING TO DATABASE
                BurraWhatsAppMessage::create([
                    'phone_number' => $to,
                    'message' => "SYSTEM ERROR (Not Sent to user): " . $response->body(),
                    'type' => 'outgoing',
                    'status' => 'failed'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Excepción enviando WhatsApp: ' . $e->getMessage());
        }
    }
    public function testDb() {
        try {
            $msg = \App\Models\Burra\BurraWhatsAppMessage::create([
                'phone_number' => 'TEST-001',
                'message' => 'Test de base de datos exitoso ' . date('Y-m-d H:i:s'),
                'type' => 'outgoing',
                'status' => 'debug'
            ]);
            return response()->json(['success' => true, 'data' => $msg]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}