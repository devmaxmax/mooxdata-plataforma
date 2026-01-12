<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class IndexController extends Controller
{
    public function index()
    {
        return view('layouts.index');
    }

    public function sendMail(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        // Mail::to('nicolas@mooxdata.xyz')->send(new ContactMail($data));

        return response()->json([
            'status' => 'success',
            'message' => 'Mensaje enviado correctamente. En la mayor brevedad posible nos pondremos en contacto contigo.',
        ]);
    }

    public function getChat(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
            'messages.*.role' => 'required|string',
            'messages.*.content' => 'required|string',
        ]);

        // 1. Obtener contexto de la base de datos
        $ragData = \App\Models\RagData::where('is_active', true)->get();
        
        $context = "Información Oficial de MooxData:\n";
        foreach ($ragData as $item) {
            $context .= "- [{$item->topic}]: {$item->content}\n";
        }

        // 2. Crear el Prompt del Sistema
        $systemMessage = [
            'role' => 'system',
            'content' => "Usa la siguiente información para responder a las consultas del usuario. \n\nCONTEXTO:\n$context\n\nINSTRUCCIONES:\n- Responde SOLO basándote en el contexto proporcionado.\n- Si la respuesta no está en el contexto, indica amablemente que no tienes esa información y sugiere contactar a: gabriela@mooxdata.xyz.\n- Sé profesional, conciso y amable con no mas de 150 caracteres."
        ];

        // 3. Preparar historial (Sistema + Usuario)
        $messages = array_merge([$systemMessage], $request->messages);

        try {
            $response = Http::withToken(env('DEEPSEEK_API_KEY'))
                ->withOptions([
                    'timeout' => 60,
                ])
                ->post('https://api.deepseek.com/chat/completions', [
                    'model' => 'deepseek-chat',
                    'messages' => $messages,
                    'stream' => false,
                    'temperature' => 0.1,
                    'max_tokens' => 150,
                    'top_p' => 0.9,
                ]);

            if ($response->failed()) {
                Log::error('LLM Api Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);

                return response()->json([
                    'error' => 'Error al obtener la respuesta del LLM',
                ], 500);
            }

            $data = $response->json();
            $reply = $data['choices'][0]['message']['content'] ?? 'Lo siento, no pude procesar tu solicitud.';

            Log::info('LLM Api Response', [
                'user-input' => $messages,
                'ia-reply' => $reply,
            ]);

            return response()->json([
                'reply' => $reply,
                'usage' => $data['usage'] ?? null,
            ]);

        } catch (\Exception $e) {
            Log::error('LLM Api Exception', [
                'message' => $e->getMessage(),
            ]);

            return response()->json([
                'error' => 'Error interno del servidor al conectar con LLM',
            ], 500);
        }
    }
}
