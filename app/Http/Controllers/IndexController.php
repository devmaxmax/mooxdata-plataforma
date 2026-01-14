<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RagData;
use App\Services\llm\Deepseek;
use App\Http\Requests\ChatRequest;

class IndexController extends Controller
{
    public $llm;

    public function __construct(Deepseek $llm)
    {
        $this->llm = $llm;
    }

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

    public function getChat(ChatRequest $request)
    {
        $ragData = RagData::where('is_active', true)->get();
        
        $context = "Información Oficial de MooxData:\n";
        foreach ($ragData as $item) {
            $context .= "- [{$item->topic}]: {$item->content}\n";
        }

        $systemMessage = [
            'role' => 'system',
            'content' => "Usa la siguiente información para responder a las consultas del usuario. \n\nCONTEXTO:\n$context\n\nINSTRUCCIONES:\n- Responde SOLO basándote en el contexto proporcionado.\n- Si la respuesta no está en el contexto, indica amablemente que no tienes esa información y sugiere contactar a: gabriela@mooxdata.xyz.\n- Sé profesional, conciso y amable con no mas de 150 caracteres."
        ];

        return $this->llm->chat($systemMessage, $request);
    }
}
