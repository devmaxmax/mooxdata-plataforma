<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BurraController;
use App\Http\Controllers\WhatsAppWebhookController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// Route::post('/burra/chat', [BurraController::class, 'getChat'])->middleware('auth:sanctum', 'ability:chat:access');
Route::match(['get', 'post'], '/burra/chat', [WhatsAppWebhookController::class, 'handleWebhook']);
Route::get('/test-db', [WhatsAppWebhookController::class, 'testDb']);

