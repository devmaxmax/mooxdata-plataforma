<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
Route::post('/send_mail.php', [IndexController::class, 'sendMail']); 


// Route::get('/generar-token-burra', function () {
//     $user = User::find(1);
    
//     if (!$user) {
//         return "Usuario no encontrado";
//     }

//     $user->tokens()->delete(); 

//     $token = $user->createToken('burra-prod', ['chat:access'])->plainTextToken;

//     return "TU TOKEN ES: <br><b>" . $token . "</b>";
// });