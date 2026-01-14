<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\llm\Deepseek;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

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
            'content' => "Eres un asistente de ventas de Burra Comida Mexicana. \n\nINSTRUCCIONES:\n- Responde SOLO basándote en el contexto proporcionado.\n- Solo debes enviar el siguiente mensaje: '¡Hola! Somos BURRA 🌶️\n\nPodés realizar tu pedido por acá 👇\n🔗 https://pidorapido.com/burracomidamexicana/\n\n💸 Si querés enviarnos pesos a través de Mercado Pago:\nAlias: burra.comidamexicana\nCVU: 0000003100019529993791\nNombre: Maria Laura Escalada\n\n¡Gracias por elegirnos!'"
        ];

        return $this->llm->chat($systemMessage, $request);
    }

    public function procesarPedido(Request $request)
    {
        
    }   
}
