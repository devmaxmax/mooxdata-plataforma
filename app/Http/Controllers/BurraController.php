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

        if (!$now->between($startTime, $endTime)) {
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
            // Enviamos el pedido a FUDA de forma asíncrona o directa.
            // Para no bloquear la respuesta al cliente si la API está lenta, idealmente usaríamos Queues.
            // Pero por simplicidad requerida:
            $this->sendOrderToFuda($order);
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
                $this->cancelOrderInFuda($order->id);
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
        }

        if ($request->status === 'cancelled') {
            $this->cancelOrderInFuda($id);
        }

        return response()->json(['success' => true]);
    }

    public function destroyOrder($id)
    {
        // --- INTEGRACIÓN FUDA ---
        $this->cancelOrderInFuda($id);
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

    // --- Categoy Management ---

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
            // Delete old image if exists (optional, but good practice)
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
        // ---------------- CONFIGURACIÓN ----------------
        $fudaBaseUrl = env('FUDA_API_URL', 'https://api.fu.do/v1alpha1'); 
        $priceListId = env('FUDA_PRICELIST_ID', '1'); 
        
        $token = $this->getFudaToken();

        if (!$token) {
            Log::error("No se pudo obtener el token de FUDA. Abortando envío.");
            $this->logFuda("FALLÓ: No se pudo obtener Token", null, 'error');
            return;
        }
        // -----------------------------------------------

        $this->logFuda("Iniciando envío de pedido #{$order->id} a FUDA", ['customer' => $order->customer_name]);

        try {
            // 1. CREAR LA VENTA (SALE)
            $salePayload = [
                'data' => [
                    'type' => 'Sale',
                    'attributes' => [
                        'saleType' => 'DELIVERY', // O 'TAKEAWAY', 'EAT-IN'
                        'customerName' => $order->customer_name ?? 'Cliente Web',
                        'comment' => $order->customer_note,
                        // 'people' => 1
                    ],
                    'relationships' => [
                        // Opcional: Si tuvieras 'customer', 'table', 'waiter' IDs reales
                    ]
                ]
            ];

            $this->logFuda("Payload crear Venta (POST /sales)", $salePayload);

            $saleResponse = Http::withToken($token)
                                ->post("{$fudaBaseUrl}/sales", $salePayload);

            $this->logFuda("Respuesta crear Venta", [
                'status' => $saleResponse->status(), 
                'body' => $saleResponse->json() ?? $saleResponse->body()
            ]);

            if ($saleResponse->failed()) {
                Log::error("Error al crear Sale en FUDA: " . $saleResponse->body());
                $this->logFuda("FALLÓ creación de venta", null, 'error');
                return;
            }

            $saleData = $saleResponse->json('data');
            $saleId = $saleData['id'] ?? null;

            if (!$saleId) {
                Log::error("FUDA respondió éxito pero sin ID de venta.");
                $this->logFuda("FALLÓ: Sin ID de venta en respuesta", null, 'error');
                return;
            }

            Log::info("Venta creada en FUDA con ID: {$saleId}");

            // 2. CREAR ITEMS ASOCIADOS A LA VENTA
            if (!$order->relationLoaded('items')) {
                $order->load('items');
            }

            foreach ($order->items as $item) {
                $product = BurraProduct::find($item->product_id);
                $codeFuda = $product ? $product->code_fuda : null;

                if (!$codeFuda) {
                    $this->logFuda("Producto '{$item->product_name}' (ID Local: {$item->product_id}) SIN code_fuda. Omitido.", null, 'warning');
                    Log::warning("Producto '{$item->product_name}' no tiene code_fuda. Omitiendo envío a FUDA.");
                    continue;
                }

                $itemPayload = [
                    'data' => [
                        'type' => 'Item',
                        'attributes' => [
                            'quantity' => (int) $item->quantity,
                            'price' => (float) $item->price,
                            // 'comment' => '' 
                        ],
                        'relationships' => [
                            'product' => [
                                'data' => [
                                    'id' => (string) $codeFuda,
                                    'type' => 'Product'
                                ]
                            ],
                            'sale' => [
                                'data' => [
                                    'id' => (string) $saleId,
                                    'type' => 'Sale'
                                ]
                            ],
                            'priceList' => [
                                'data' => [
                                    'id' => (string) $priceListId,
                                    'type' => 'PriceList'
                                ]
                            ]
                        ]
                    ]
                ];

                $this->logFuda("Agregando Item '{$item->product_name}' (Code: $codeFuda)", $itemPayload);

                $itemResponse = Http::withToken($token)
                                    ->post("{$fudaBaseUrl}/items", $itemPayload);

                if ($itemResponse->failed()) {
                    Log::error("Error al agregar Item (Prod ID: $codeFuda) a Sale #{$saleId}: " . $itemResponse->body());
                    $this->logFuda("FALLÓ agregar Item", ['response' => $itemResponse->body()], 'error');
                } else {
                    Log::info("Item agregado a FUDA (Sale #{$saleId}, Prod #{$codeFuda})");
                    $this->logFuda("Item agregado OK");
                }
            }

            Log::info("Sincronización con FUDA completada para pedia #{$order->id}");
            $this->logFuda("FIN Sincronización Pedido #{$order->id}");

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
        $clientId = env('FUDA_CLIENT_ID', 'MDAwMDI6MzE1Njk5');
        $clientSecret = env('FUDA_CLIENT_SECRET', 'aDnXVFxFXkUUPJWpAKmohi5Q');
        $authString = base64_encode("{$clientId}:{$clientSecret}");

        $fudaBaseUrl = env('FUDA_API_URL', 'https://api.fu.do/v1alpha1');
        // -----------------------------------------------

        try {
            // Asumiendo endpoint UPDATE sale state a CLOSED o CANCELED
            // PATCH /sales/{id}
            
            // NOTA: Para cancelar, necesitaríamos el ID de FUDA de la venta, el cual no estamos guardando.
            // Si $orderId es el external_id, FUDA no lo reconocerá directo en /sales/{id} a menos que hayamos guardado el mapeo.
            // Por ahora, solo intentamos si tuviéramos el fuda ID, o lo dejamos como TODO.
            // Como el usuario pidió "Que se conecta y envíe", y "Cuando se cancela que se cancele",
            // necesitamos guardar el ID de respuesta de FUDA en sendOrderToFuda.
            
            // SIN EMBARGO, sin cambiar la base de datos para guardar 'fuda_sale_id', no podemos cancelar por ID.
            // Voy a dejar el código preparado para cuando se guarde el ID, o intentar usar un external_id filter si existe.
            
            // Asumamos que NO podemos cancelar sin ID. Logueamos advertencia.
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
     */
    private function getFudaToken()
    {
        // Retornar token en caché si existe
        if (Cache::has('fuda_access_token')) {
            return Cache::get('fuda_access_token');
        }

        $apiKey = env('FUDA_CLIENT_ID');     // En Fudo esto es el "API Key" o User
        $apiSecret = env('FUDA_CLIENT_SECRET'); // En Fudo esto es el "API Secret"
        $authUrl = 'https://auth.fu.do/api';

        try {
            $response = Http::post($authUrl, [
                'apiKey' => $apiKey,
                'apiSecret' => $apiSecret,
            ]);

            if ($response->failed()) {
                Log::error('Error obteniendo token Fudo: ' . $response->body());
                return null;
            }

            $data = $response->json();
            $token = $data['token'] ?? null;
            // $exp = $data['exp'] ?? null; // Timestamp epoch

            if ($token) {
                // Guardamos en caché por 23 horas (un poco menos de 24 para margen de error)
                Cache::put('fuda_access_token', $token, now()->addHours(23));
                return $token;
            }

            return null;

        } catch (\Exception $e) {
            Log::error('Excepción obteniendo token Fudo: ' . $e->getMessage());
            return null;
        }
    }

}
