<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\llm\Deepseek;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use App\Models\Burra\BurraProduct;
use App\Models\Burra\BurraCategory;
use App\Models\Burra\BurraOrder;
use App\Models\Burra\BurraOrderItem;
use App\Models\Burra\BurraWhatsAppMessage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BurraController extends Controller
{
    private $llm;

    public function __construct(Deepseek $llm)
    {
        $this->llm = $llm;
    }

    public function getChat(Request $request)
    {
        $now = Carbon::now('America/Argentina/Buenos_Aires');
        $startTime = $now->copy()->setTime(20, 0, 0);
        $endTime = $now->copy()->setTime(23, 50, 0);

        // Días permitidos: Domingo(0), Miércoles(3), Jueves(4), Viernes(5), Sábado(6)
        $allowedDays = [0, 3, 4, 5, 6];

        Log::info('ChatBot Time Check', [
            'now' => $now->toDateTimeString(),
            'timezone' => $now->timezoneName,
            'dayOfWeek' => $now->dayOfWeek,
            'startTime' => $startTime->toDateTimeString(),
            'endTime' => $endTime->toDateTimeString(),
            'isAllowedDay' => in_array($now->dayOfWeek, $allowedDays),
            'isBetweenTime' => $now->between($startTime, $endTime)
        ]);

        if (!in_array($now->dayOfWeek, $allowedDays)) {
             Log::info('ChatBot: Blocked by day of week');
             return response()->json([
                'reply' => '',
            ]);
        }

        if (!$now->between($startTime, $endTime)) {
             Log::info('ChatBot: Blocked by time');
             return response()->json([
                'reply' => '',
            ]);
        }

        // $clientId = $request->header('X-Guest-ID') ?? $request->ip();
        // $cacheKey = 'burra_last_chat_' . $clientId;

        // if (Cache::has($cacheKey)) {
        //     return response()->json([
        //         'reply' => '',
        //     ]);
        // }

        // Cache::put($cacheKey, $now->toDateTimeString(), now()->addHours(12));

        $systemMessage = [
            'role' => 'system',
            'content' => "Eres un asistente de ventas de Burra Comida Mexicana. \n\nINSTRUCCIONES:\n- Responde SOLO basándote en el contexto proporcionado.\n- Solo debes enviar el siguiente mensaje: '¡Hola! Somos BURRA 🌶️\n\nPodés realizar tu pedido por acá 👇\n🔗 https://mooxdata.xyz/app/burracomidamexicana/\n\n💸 Si querés enviarnos pesos a través de Mercado Pago:\nAlias: burra.comidamexicana\nCVU: 0000003100019529993791\nNombre: Maria Laura Escalada\n\n¡Gracias por elegirnos!'"
        ];

        return $this->llm->chat($systemMessage, $request);
    }

    public function procesarPedido(Request $request)
    {
        try {
            $validated = $request->validate([
                'pedido.productos' => 'required|array',
                'pedido.preguntas' => 'nullable|array',
            ]);

            $pedidoData = $request->input('pedido');
            $productos = $pedidoData['productos'];
            $preguntas = collect($pedidoData['preguntas'] ?? []);

            $nombre = $preguntas->where('pregunta', 'Nombre y Apellido(*)')->first()['respuesta'] 
                     ?? $preguntas->where('pregunta', 'Nombre*')->first()['respuesta'] 
                     ?? 'Sin Nombre';

            $direccion = $preguntas->where('pregunta', 'Dirección(*)')->first()['respuesta'] 
                        ?? $preguntas->where('pregunta', 'Dirección')->first()['respuesta'] 
                        ?? '';

            $observacion = $preguntas->where('pregunta', '¿Algun dato adicional sobre el pedido o su dirección?:*')->first()['respuesta'] 
                          ?? $preguntas->where('pregunta', 'Piso / Dpto')->first()['respuesta'] 
                          ?? '';
            
            $metodoPago = $preguntas->where('pregunta', 'Forma de pago(*):')->first()['respuesta'] 
                         ?? $preguntas->where('pregunta', '¿Cómo abonás?')->first()['respuesta'] 
                         ?? '';
            $telefono = $pedidoData['whatsapp'] ?? null;

            $total = $pedidoData['precio_final'] ?? 0;

            $order = BurraOrder::create([
                'table_number' => 'WEB',
                'status' => 'pending',
                'total' => $total,
                'customer_name' => $nombre,
                'customer_address' => $direccion,
                'customer_phone' => $telefono,
                'customer_note' => $observacion,
                'payment_method' => $metodoPago
            ]);

            foreach ($productos as $producto) {
                BurraOrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $producto['id'],
                    'product_name' => $producto['nombre'],
                    'quantity' => $producto['cantidad'],
                    'price' => $producto['precio'],
                ]);
            }
            
            // --- INTEGRACIÓN FUDA ---
            // DESACTIVADO: El pedido se enviará a FUDA solo cuando se apruebe desde el dashboard
            // $this->sendOrderToFuda($order);
            // ------------------------

            return response()->json([
                'success' => true,
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating order: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error al guardar el pedido'], 500);
        }
    }  
    
    /*******Administracion de web ************/

    public function index()
    {
        $products = BurraProduct::with('category')->where('is_active', true)->get();
        $categories = BurraCategory::all();

        $productsJson = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'nombre' => $product->name,
                'descripcion' => $product->description,
                'variedad' => null,
                'precio' => $product->price,
                'precio_mostrar' => number_format($product->price, 0, ',', '.'),
                'precioanterior' => '',
                'precioanterior_mostrar' => '0',
                'descuento' => 0,
                'categoria' => $product->category ? $product->category->name : '',
                'subcategoria' => '',
                'categoriaicono' => '',
                'categoriaimagendefondo' => '',
                'ocultar' => '',
                'stock' => '',
                'codigo' => '',
                'minimo' => 1,
                'maximo' => 999999,
                'step' => 1,
                'imagen' => '',
                'imagen_tamano' => 'CHICA',
                'imagenes' => [],
                'tiene_precios_diferentes' => false,
                'se_puede_pedir' => true,
                'variedades' => $product->variable ? json_decode($product->variable) : [],
            ];
        });

        $categoriesJson = $categories->map(function ($category) {
            return [
                'nro' => $category->id,
                'categoria' => $category->name,
                'imagen_fondo' => '',
                'icono' => $category->image,
            ];
        });

        return view('layouts.burra.index', compact('products', 'categories', 'productsJson', 'categoriesJson'));
    }

    public function showLoginForm()
    {
        if (Auth::guard('burra_admin')->check()) {
            return redirect()->route('burra.dashboard');
        }
        return view('layouts.burra.login');
    }

    public function panel(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required'],
            'password' => ['required'],
        ]);
        
        if (Auth::guard('burra_admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('burra.dashboard');
        }

        return back()->withErrors([
            'name' => 'Las credenciales no coinciden.',
        ]);
    }

    public function dashboard()
    {
        $products = BurraProduct::with('category')->get();
        $categories = BurraCategory::all();
        $orders = BurraOrder::with('items')->latest()->get();
        return view('layouts.burra.dashboard', compact('products', 'categories', 'orders'));
    }

    public function getOrders()
    {
        // Mantenimiento: Cancelar pedidos viejos automáticamente cada vez que se consulta
        $this->autoCancelOldOrders();

        $orders = BurraOrder::with('items')->latest()->get();
        return response()->json($orders);
    }

    private function autoCancelOldOrders()
    {
        try {
            $limitTime = Carbon::now()->subMinutes(30);
            
            $orders = BurraOrder::where('status', 'pending')
                        ->where('created_at', '<', $limitTime)
                        ->get();

            foreach ($orders as $order) {
                $order->status = 'cancelled';
                $order->save();
                
                Log::info("Pedido #{$order->id} auto-cancelado por antigüedad (>30 min) desde getOrders.");

                // Intentar cancelar en FUDA
                // $this->cancelOrderInFuda($order->id); // Temporalmente desactivado
            }
        } catch (\Exception $e) {
            // Silencioso para no romper la API de getOrders
            Log::error("Error en autoCancelOldOrders: " . $e->getMessage());
        }
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = BurraOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        if ($request->status === 'completed' && $order->customer_phone) {
            $this->sendMessageToMeta($order->customer_phone, "👨‍🍳🔥 Su pedido se encuentra en la cocina.");
            
            // Enviar pedido a FUDO cuando se aprueba
            $this->sendOrderToFuda($order);
        }

        if ($request->status === 'cancelled') {
            // $this->cancelOrderInFuda($id); // Temporalmente desactivado
        }

        return response()->json(['success' => true]);
    }

    public function destroyOrder($id)
    {
        // --- INTEGRACIÓN FUDA ---
        // $this->cancelOrderInFuda($id); // Temporalmente desactivado
        // ------------------------

        $order = BurraOrder::findOrFail($id);
        $order->delete();
        return response()->json(['success' => true]);
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code_fuda' => 'nullable|numeric',
            'category_id' => 'required|exists:burra_category,id',
            'description' => 'required|string',
            'variable' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        BurraProduct::create($validated);

        return redirect()->route('burra.dashboard')
            ->with('success', 'Producto creado correctamente')
            ->with('view', 'productos');
    }

    public function updateProduct(Request $request, $id)
    {
        $product = BurraProduct::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code_fuda' => 'nullable|numeric',
            'category_id' => 'required|exists:burra_category,id',
            'description' => 'required|string',
            'variable' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product->update($validated);

        return redirect()->route('burra.dashboard')
            ->with('success', 'Producto actualizado correctamente')
            ->with('view', 'productos');
    }

    public function toggleProductStatus($id)
    {
        $product = BurraProduct::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();

        return response()->json([
            'success' => true,
            'is_active' => $product->is_active
        ]);
    }

    public function destroyProduct($id)
    {
        $product = BurraProduct::findOrFail($id);
        $product->delete();

        return redirect()->route('burra.dashboard')
            ->with('success', 'Producto eliminado correctamente')
            ->with('view', 'productos');
    }

    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048', // Max 2MB
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('burra/images'), $filename);
            $validated['image'] = $filename;
        }

        BurraCategory::create($validated);

        return redirect()->route('burra.dashboard')
            ->with('success', 'Categoría creada correctamente')
            ->with('view', 'categorias');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = BurraCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image && file_exists(public_path('burra/images/' . $category->image))) {
                @unlink(public_path('burra/images/' . $category->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('burra/images'), $filename);
            $validated['image'] = $filename;
        }

        $category->update($validated);

        return redirect()->route('burra.dashboard')
            ->with('success', 'Categoría actualizada correctamente')
            ->with('view', 'categorias');
    }

    public function destroyCategory($id)
    {
        $category = BurraCategory::findOrFail($id);

        // Check if category has products
        if ($category->products()->count() > 0) {
            return redirect()->route('burra.dashboard')
                ->withErrors(['error' => 'No se puede eliminar la categoría porque tiene productos asociados.'])
                ->with('view', 'categorias');
        }

        $category->delete();

        return redirect()->route('burra.dashboard')
            ->with('success', 'Categoría eliminada correctamente')
            ->with('view', 'categorias');
    }

    public function getWhatsAppChats()
    {
        // Obtener la última interacción de cada número
        $chats = BurraWhatsAppMessage::select('phone_number')
            ->selectRaw('MAX(created_at) as last_activity')
            ->groupBy('phone_number')
            ->orderByDesc('last_activity')
            ->get();
            
        // Podríamos enriquecer esto con el último mensaje, pero por rendimiento lo cargamos simple
        return response()->json($chats);
    }

    public function getWhatsAppMessages($phone)
    {
        $messages = BurraWhatsAppMessage::where('phone_number', $phone)
            ->orderBy('created_at', 'asc') // Cronológico para el chat
            ->get();
            
        return response()->json($messages);
    }

    public function sendWhatsAppMessage(Request $request) 
    {
        $request->validate([
            'phone' => 'required',
            'message' => 'required'
        ]);

        $phone = $request->phone;
        $message = $request->message;

        // 1. Enviar a Meta (Refactorizado)
        $sent = $this->sendMessageToMeta($phone, $message);

        if (!$sent) {
            return response()->json(['error' => 'Error enviando mensaje a Meta'], 500);
        }

        // 2. Guardar en DB
        BurraWhatsAppMessage::create([
            'phone_number' => $phone,
            'message' => $message,
            'type' => 'outgoing',
            'status' => 'sent_manual'
        ]);

        // 3. SUSPENDER BOT (Intervención Manual) por 24hs
        Cache::put('burra_bot_suspended_' . $phone, true, now()->addHours(24));

        return response()->json(['success' => true]);
    }

    public function resumeBot(Request $request)
    {
        $request->validate(['phone' => 'required']);
        $phone = $request->phone;
        
        Cache::forget('burra_bot_suspended_' . $phone);

        return response()->json(['success' => true]);
    }

    public function logout(Request $request)
    {
        Auth::guard('burra_admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('burra.login');
    }

    public function politicaDePrivacidad()
    {
        return view('layouts.burra.privacidad');
    }

    public function terminosDeServicio()
    {
        return view('layouts.burra.terminos');
    }

    private function sendMessageToMeta($to, $messageBody)
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

            if ($response->failed()) {
                Log::error('Meta API Error: ' . $response->body());
                return false;
            }
            return true;

        } catch (\Exception $e) {
            Log::error('Excepción enviando WhatsApp: ' . $e->getMessage());
            return false;
        }
    }

    // -------------------------------------------------------------------------
    // INTEGRACIÓN FUDA
    // -------------------------------------------------------------------------

    /**
     * Envía el pedido a la API de FUDA.
     *
     * @param  \App\Models\Burra\BurraOrder  $order
     * @return void
     */
    private function logFuda($message, $data = null, $level = 'info')
    {
        $logEntry = "[" . Carbon::now()->toDateTimeString() . "] " . strtoupper($level) . ": {$message}";
        if ($data) {
            $logEntry .= "\nData: " . json_encode($data, JSON_PRETTY_PRINT);
        }
        $logEntry .= "\n--------------------------------------------------\n";
        
        // Escribir en un archivo dedicado
        try {
            file_put_contents(storage_path('logs/fuda_debug.log'), $logEntry, FILE_APPEND);
        } catch (\Exception $e) {
            Log::error("No se pudo escribir en fuda_debug.log: " . $e->getMessage());
        }
    }

    private function sendOrderToFuda(BurraOrder $order)
    {
        //---------------- CONFIGURACIÓN ----------------
        $fudaBaseUrl = env('FUDA_API_URL'); 
        
        $token = $this->getFudaToken();

        if (!$token) {
            Log::error("No se pudo obtener el token de FUDA. Abortando envío.");
            $this->logFuda("FALLÓ: No se pudo obtener Token", null, 'error');
            return;
        }
        // -----------------------------------------------

        $this->logFuda("Iniciando envío de pedido #{$order->id} a FUDA Integrations API", ['customer' => $order->customer_name]);

        try {
            // Cargar items del pedido
            if (!$order->relationLoaded('items')) {
                $order->load('items');
            }

            // Construir array de items
            $items = [];
            foreach ($order->items as $item) {
                $product = BurraProduct::find($item->product_id);
                $codeFuda = $product ? $product->code_fuda : null;

                if (!$codeFuda) {
                    $this->logFuda("Producto '{$item->product_name}' (ID Local: {$item->product_id}) SIN code_fuda. Omitido.", null, 'warning');
                    Log::warning("Producto '{$item->product_name}' no tiene code_fuda. Omitiendo envío a FUDA.");
                    continue;
                }

                // Añadir item según formato FUDA Integrations API
                $items[] = [
                    'comment' => $item->comment ?? '',
                    'quantity' => (int) $item->quantity,
                    'price' => (float) $item->price,
                    'product' => [
                        'id' => (int) $codeFuda
                    ],
                    'subitems' => [] // Vacío por ahora, puede extenderse si hay modificadores
                ];
            }

            // Si no hay items válidos, no enviamos
            if (empty($items)) {
                $this->logFuda("Pedido #{$order->id} no tiene items con code_fuda válido. No se envía a FUDA.", null, 'warning');
                return;
            }

            // Mapear método de pago a ID (ajustar según IDs reales de FUDA)
            $paymentMethodMap = [
                'efectivo' => 1,
                'transferencia' => 2,
                'billetera' => 3,
                'tarjeta' => 4,
            ];
            
            $paymentMethodId = $paymentMethodMap[strtolower($order->payment_method)] ?? 1;

            // Construir payload según documentación de FUDA Integrations API
            $payload = [
                'order' => [
                    'comment' => $order->customer_note ?? '',
                    'customer' => [
                        'email' => 'cliente@burra.com', // Podríamos pedirlo en el formulario
                        'phone' => $order->customer_phone ?? 'N/A',
                        'name' => $order->customer_name ?? 'Cliente Web'
                    ],
                    'discounts' => [],
                    'externalId' => (string) $order->id, // ID local del pedido
                    'items' => $items,
                    'payment' => [
                        'paymentMethod' => [
                            'id' => $paymentMethodId
                        ],
                        'total' => (float) $order->total
                    ],
                    'shippingCost' => 0,
                    'type' => 'delivery', // O 'pickup', 'dine-in'
                    'typeOptions' => [
                        'expectedTime' => Carbon::now()->addMinutes(45)->toIso8601String(),
                        'address' => $order->customer_address ?? 'Sin dirección'
                    ]
                ]
            ];

            $this->logFuda("Payload crear Pedido (POST /orders)", $payload);

            // Enviar a FUDO con header de autorización custom
            $response = Http::withHeaders([
                    'Fudo-External-App-Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ])
                ->post("{$fudaBaseUrl}/orders", $payload);

            $this->logFuda("Respuesta de FUDA", [
                'status' => $response->status(), 
                'body' => $response->json() ?? $response->body()
            ]);

            if ($response->failed()) {
                Log::error("Error al crear Order en FUDA: " . $response->body());
                $this->logFuda("FALLÓ creación de pedido en FUDA", ['response' => $response->body()], 'error');
                return;
            }

            $responseData = $response->json();
            Log::info("Pedido #{$order->id} enviado exitosamente a FUDA", $responseData);
            $this->logFuda("ÉXITO: Pedido enviado a FUDA", $responseData);

        } catch (\Exception $e) {
            Log::error("Excepción al enviar pedido #{$order->id} a FUDA: " . $e->getMessage());
            $this->logFuda("EXCEPCIÓN CRÍTICA", ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 'error');
        }
    }

    /**
     * Cancela el pedido en FUDA.
     *
     * @param  int  $orderId
     * @return void
     */
    private function cancelOrderInFuda($orderId)
    {
        // ---------------- CONFIGURACIÓN ----------------
        // @TODO: Reemplazar con las credenciales reales
        $clientId = env('FUDA_CLIENT_ID');
        $clientSecret = env('FUDA_CLIENT_SECRET');
        // -----------------------------------------------

        try {

            Log::warning("Cancelación en FUDA pendiente: Se requiere guardar el ID de FUDA en la base de datos local para poder cancelar la venta #{$orderId}.");

            /*
            $url = "{$fudaBaseUrl}/sales/{$fudaSaleId}";
            $response = Http::withToken($fudaToken)
                            ->patch($url, [
                                'data' => [
                                    'type' => 'Sale',
                                    'id' => $fudaSaleId,
                                    'attributes' => [
                                        'saleState' => 'CANCELED' // Verificar enum correcto
                                    ]
                                ]
                            ]);
            */

        } catch (\Exception $e) {
            Log::error("Excepción al cancelar pedido #{$orderId} en FUDA: " . $e->getMessage());
        }
    }



    /**
     * Obtiene el token de acceso de Fudo, usando caché para respetar la expiración.
     * HARDCODEADO TEMPORALMENTE PARA TESTING
     */
    private function getFudaToken()
    {
        // Retornar token en caché si existe
        if (Cache::has('fuda_access_token')) {
            Log::info('[FUDO AUTH] Token obtenido desde caché');
            return Cache::get('fuda_access_token');
        }

        $clientId = env('FUDA_CLIENT_ID');
        $clientSecret = env('FUDA_CLIENT_SECRET');
        $authUrl = env('FUDA_API_URL');

        Log::info('[FUDO AUTH] Obteniendo nuevo token de FUDO', [
            'url' => $authUrl,
            'clientId' => $clientId
        ]);

        try {
            $response = Http::post($authUrl, [
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
            ]);

            Log::info('[FUDO AUTH] Respuesta auth', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->failed()) {
                Log::error('[FUDO AUTH] Error obteniendo token Fudo: ' . $response->body());
                return null;
            }

            $data = $response->json();
            $token = $data['token'] ?? null;

            if ($token) {
                Log::info('[FUDO AUTH] Token obtenido exitosamente, guardando en caché por 23 horas');
                // Guardamos en caché por 23 horas (un poco menos de 24 para margen de error)
                Cache::put('fuda_access_token', $token, now()->addHours(23));
                return $token;
            }

            Log::error('[FUDO AUTH] Respuesta exitosa pero sin token en la data');
            return null;

        } catch (\Exception $e) {
            Log::error('[FUDO AUTH] Excepción obteniendo token Fudo: ' . $e->getMessage());
            return null;
        }
    }

}
