<?php

namespace App\Services\llm;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\LogBot;

class Deepseek
{
    private $apiKey;

    public function __construct($apiKey = null)
    {
        $this->apiKey = $apiKey ?? env('DEEPSEEK_API_KEY');
    }

    public function chat(array $systemMessage, $request)
    {
        $messages = array_merge([$systemMessage], $request->input('messages', []));

        try {
            $response = Http::withToken($this->apiKey)
                ->withOptions([
                    'timeout' => 60,
                ])
                ->post('https://api.deepseek.com/chat/completions', [
                    'model' => 'deepseek-chat',
                    'messages' => $messages,
                    'stream' => false,
                    'temperature' => 0.1,
                    'max_tokens' => 350,
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
            $content = $data['choices'][0]['message']['content'] ?? null;
            $reply = !empty($content) ? $content : 'Lo siento, no pude procesar tu solicitud.';

            Log::info('LLM Api Response', [
                'user-input' => $messages,
                'ia-reply' => $reply,
            ]);

            try {
                $lastUserMessage = null;
                $messagesInput = $request->input('messages');
                
                if (is_array($messagesInput)) {
                    $userMessages = array_filter($messagesInput, function($msg) {
                        return isset($msg['role']) && $msg['role'] === 'user';
                    });
                    
                    if (!empty($userMessages)) {
                        $lastUserMessageArray = end($userMessages);
                        $lastUserMessage = $lastUserMessageArray['content'] ?? null;
                    }
                }

                LogBot::create([
                    'user_message' => $lastUserMessage,
                    'bot_response' => $reply,
                    'ip_address' => $request->ip(),
                ]);
            } catch (\Exception $e) {
                Log::error('Error saving bot log', ['error' => $e->getMessage()]);
            }

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