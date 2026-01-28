<?php

use App\Http\Controllers\BurraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BurraAssetsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [IndexController::class, 'index']);
Route::post('/chat', [IndexController::class, 'getChat'])->name('index.getChat');
Route::post('/send_mail', [IndexController::class, 'sendMail']);
Route::get('/demo/panel-atencion-whatsapp', [IndexController::class, 'panelDemoWhatsapp'])->name('index.panelDemoWhatsapp');

Route::prefix('app/burracomidamexicana')->name('burra.')->group(function () {
    Route::get('/', [BurraController::class, 'index'])->name('index');
    Route::get('/panel', [BurraController::class, 'showLoginForm'])->name('login');
    Route::post('/panel', [BurraController::class, 'panel'])->name('login.panel');
    Route::post('/logout', [BurraController::class, 'logout'])->name('logout');

    

    Route::middleware('auth:burra_admin')->group(function () {
        Route::get('/panel/dashboard', [BurraController::class, 'dashboard'])->name('dashboard');
        
        // Rutas de Productos
        Route::post('/panel/products', [BurraController::class, 'storeProduct'])->name('products.store');
        Route::put('/panel/products/{id}', [BurraController::class, 'updateProduct'])->name('products.update');
        Route::post('/panel/products/{id}/toggle-status', [BurraController::class, 'toggleProductStatus'])->name('products.toggle-status');
        Route::delete('/panel/products/{id}', [BurraController::class, 'destroyProduct'])->name('products.destroy');

        // Rutas de Categorías
        Route::post('/panel/categories', [BurraController::class, 'storeCategory'])->name('categories.store');
        Route::put('/panel/categories/{id}', [BurraController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/panel/categories/{id}', [BurraController::class, 'destroyCategory'])->name('categories.destroy');
    Route::get('/panel/api/orders', [BurraController::class, 'getOrders'])->name('orders.api');
    Route::post('/panel/api/orders/{id}/status', [BurraController::class, 'updateOrderStatus'])->name('orders.status');
        
        Route::get('assets/{type}/{filename}', [BurraAssetsController::class, 'serve'])
         ->where('type', 'css|js|images|img') // Permitimos css, js e imágenes
         ->name('assets');
    });

    Route::post('/pedido', [BurraController::class, 'procesarPedido'])->name('pedido');
});

// Route::get('/generar-token-burra', function () {
//     $user = User::find(1);
    
//     if (!$user) {
//         return "Usuario no encontrado";
//     }

//     $user->tokens()->delete(); 

//     $token = $user->createToken('burra-prod', ['chat:access'])->plainTextToken;

//     return "TU TOKEN ES: <br><b>" . $token . "</b>";
// });