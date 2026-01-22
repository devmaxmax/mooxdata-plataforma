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

        $clientId = $request->header('X-Guest-ID') ?? $request->ip();
        $cacheKey = 'burra_last_chat_' . $clientId;

        if (Cache::has($cacheKey)) {
            return response()->json([
                'reply' => '',
            ]);
        }

        Cache::put($cacheKey, $now->toDateTimeString(), now()->addHours(12));

        $systemMessage = [
            'role' => 'system',
            'content' => "Eres un asistente de ventas de Burra Comida Mexicana. \n\nINSTRUCCIONES:\n- Responde SOLO basándote en el contexto proporcionado.\n- Solo debes enviar el siguiente mensaje: '¡Hola! Somos BURRA 🌶️\n\nPodés realizar tu pedido por acá 👇\n🔗 https://mooxdata.xyz/app/burracomidamexicana/\n\n💸 Si querés enviarnos pesos a través de Mercado Pago:\nAlias: burra.comidamexicana\nCVU: 0000003100019529993791\nNombre: Maria Laura Escalada\n\n¡Gracias por elegirnos!'"
        ];

        return $this->llm->chat($systemMessage, $request);
    }

    public function procesarPedido(Request $request)
    {
        
    }  
    
    /*******Administracion de web ************/

    public function index()
    {
        return view('layouts.burra.index');
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
        $orders = BurraOrder::with('items')->where('status', '!=', 'completed')->latest()->get();
        return view('layouts.burra.dashboard', compact('products', 'categories', 'orders'));
    }

    public function getOrders()
    {
        $orders = BurraOrder::with('items')->where('status', '!=', 'completed')->latest()->get();
        return response()->json($orders);
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = BurraOrder::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return response()->json(['success' => true]);
    }

    public function storeProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
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
        ]);

        BurraCategory::create($validated);

        return redirect()->route('burra.dashboard')
            ->with('success', 'Categoría creada correctamente')
            ->with('view', 'categorias');
    }

    public function updateCategory(Request $request, $id)
    {
        $category = \App\Models\Burra\BurraCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update($validated);

        return redirect()->route('burra.dashboard')
            ->with('success', 'Categoría actualizada correctamente')
            ->with('view', 'categorias');
    }

    public function destroyCategory($id)
    {
        $category = \App\Models\Burra\BurraCategory::findOrFail($id);

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

    public function logout(Request $request)
    {
        Auth::guard('burra_admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('burra.login');
    }
}
