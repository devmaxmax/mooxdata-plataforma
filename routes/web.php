<?php

use App\Http\Controllers\BurraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\BurraAssetsController;
use Illuminate\Support\Facades\Artisan;

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
Route::post('/chat', [IndexController::class, 'getChat'])->name('index.getChat')->middleware('throttle:15,1');
Route::post('/send_mail', [IndexController::class, 'sendMail']);
Route::get('/demo/panel-atencion-whatsapp', [IndexController::class, 'panelDemoWhatsapp'])->name('index.panelDemoWhatsapp');

Route::get('/privacidad', function () {
    $text = "Política de Privacidad de Mooxdata\n\n"
          . "El uso de nuestros bots y servicios de integración con WhatsApp está sujeto a las siguientes condiciones de privacidad:\n\n"
          . "1. Recopilación de Datos: Los mensajes enviados a través de WhatsApp hacia nuestros bots son procesados para brindar respuestas automáticas o ser derivados a un operador.\n"
          . "2. Uso de la Información: La información recopilada se utiliza exclusivamente para el funcionamiento del servicio y la atención al cliente. No compartimos datos personales con terceros no autorizados.\n"
          . "3. Responsabilidad: Mooxdata proporciona la infraestructura tecnológica para la comunicación. Sin embargo, no nos hacemos responsables por el mal uso del servicio, contenido inapropiado enviado por los usuarios, ni por acciones que violen los términos de servicio de WhatsApp o leyes aplicables.\n"
          . "4. Seguridad: Implementamos medidas de seguridad para proteger la información de accesos no autorizados.\n\n"
          . "Al interactuar con nuestros bots, aceptas estas condiciones.";

    return response($text, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
});


Route::prefix('boreal')->name('boreal.')->group(function () {
    Route::get('/', [\App\Http\Controllers\BorealController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\BorealController::class, 'login'])->name('login.post');
    Route::post('/logout', [\App\Http\Controllers\BorealController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [\App\Http\Controllers\BorealController::class, 'dashboard'])->name('dashboard');
    Route::post('/change-password', [\App\Http\Controllers\BorealController::class, 'changePassword'])->name('change-password');
    Route::delete('/messages/{id}', [\App\Http\Controllers\BorealController::class, 'deleteMessage'])->name('messages.destroy');
    Route::post('/rag', [\App\Http\Controllers\BorealController::class, 'storeRagData'])->name('rag.store');
    Route::put('/rag/{id}', [\App\Http\Controllers\BorealController::class, 'updateRagData'])->name('rag.update');
    Route::delete('/rag/{id}', [\App\Http\Controllers\BorealController::class, 'destroyRagData'])->name('rag.destroy');

    Route::get('/api/whatsapp/chats', [\App\Http\Controllers\BorealController::class, 'getWhatsAppChats'])->name('whatsapp.chats');
    Route::get('/api/whatsapp/messages/{phone}', [\App\Http\Controllers\BorealController::class, 'getWhatsAppMessages'])->name('whatsapp.messages');
    Route::post('/api/whatsapp/send', [\App\Http\Controllers\BorealController::class, 'sendWhatsAppMessage'])->name('whatsapp.send');
});
// RUTA TEMPORAL PARA LIMPIAR CACHÉ EN SHARED HOSTING
Route::get('/clear-cache', function() {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    return "Caché de configuración, vistas y aplicación eliminada correctamente.";
});

Route::prefix('app/burracomidamexicana')->name('burra.')->group(function () {
    Route::get('/', [BurraController::class, 'index'])->name('index');
    Route::get('/panel', [BurraController::class, 'showLoginForm'])->name('login');
    Route::post('/panel', [BurraController::class, 'panel'])->name('login.panel');
    Route::post('/logout', [BurraController::class, 'logout'])->name('logout');
    Route::get('/politica-de-privacidad', [BurraController::class, 'politicaDePrivacidad'])->name('politica-de-privacidad');
    Route::get('/terms', [BurraController::class, 'terminosDeServicio'])->name('terminos-de-servicio');

    

    Route::middleware('auth:burra_admin')->group(function () {
        Route::get('/panel/dashboard', [BurraController::class, 'dashboard'])->name('dashboard');
        Route::post('/panel/profile', [BurraController::class, 'updateProfile'])->name('profile.update');
        
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
    Route::delete('/panel/api/orders/{id}', [BurraController::class, 'destroyOrder'])->name('orders.destroy');
    Route::get('/panel/api/whatsapp/chats', [BurraController::class, 'getWhatsAppChats'])->name('whatsapp.chats');
    Route::get('/panel/api/whatsapp/messages/{phone}', [BurraController::class, 'getWhatsAppMessages'])->name('whatsapp.messages');
    Route::post('/panel/api/whatsapp/send', [BurraController::class, 'sendWhatsAppMessage'])->name('whatsapp.send');
    Route::post('/panel/api/whatsapp/resume', [BurraController::class, 'resumeBot'])->name('whatsapp.resume');
    Route::get('/panel/api/fudo/products', [BurraController::class, 'getFudoProducts'])->name('fudo.products');
        
        Route::get('assets/{type}/{filename}', [BurraAssetsController::class, 'serve'])
         ->where('type', 'css|js|images|img') // Permitimos css, js e imágenes
         ->name('assets');
    });

    Route::post('/pedido', [BurraController::class, 'procesarPedido'])->name('pedido')->middleware('throttle:15,1');
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