<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RagData;
use App\Services\llm\Deepseek;
use App\Http\Requests\ChatRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\ContactMail;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'g-recaptcha-response' => 'required',
        ], [
            'name.required' => 'El nombre de tu empresa es obligatorio.',
            'email.required' => 'Tu correo electrónico es obligatorio.',
            'email.email' => 'Debes ingresar un correo electrónico válido.',
            'message.required' => 'El mensaje con tu desafío es obligatorio.',
            'g-recaptcha-response.required' => 'Por favor, verifica que no eres un robot (reCAPTCHA).',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first()
            ], 400);
        }

        // Verificar el reCAPTCHA con Google
        $recaptchaSecret = env('RECAPTCHA_SECRET_KEY');
        if ($recaptchaSecret) {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $recaptchaSecret,
                'response' => $request->input('g-recaptcha-response'),
            ]);

            if (!$response->json('success')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Verificación reCAPTCHA fallida. Por favor, intenta de nuevo.'
                ], 400);
            }
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];

        // Se envía el correo
        $toAddress = env('MAIL_FROM_ADDRESS', 'hablemos@mooxdata.xyz');
        Mail::to($toAddress)->send(new ContactMail($data));

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

    public function panelDemoWhatsapp()
    {
        return view('layouts.demo.panel-atencion-whatsapp');
    }
}
