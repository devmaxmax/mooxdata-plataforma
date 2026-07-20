<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\LogBot;
use App\Models\RagData;

class BorealController extends Controller
{
    public function showLogin()
    {
        if (session('boreal_logged_in')) {
            return redirect()->route('boreal.dashboard');
        }
        return view('boreal.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $throttleKey = 'login.boreal.'.$request->ip();
        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 5)) {
            $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
            return back()->withErrors(['login' => 'Demasiados intentos. Por favor, intenta de nuevo en ' . $seconds . ' segundos.']);
        }

        $user = \App\Models\User::where('name', $request->username)
                    ->orWhere('email', $request->username)
                    ->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            \Illuminate\Support\Facades\RateLimiter::clear($throttleKey);
            
            // Regenerate session to prevent Session Fixation
            $request->session()->regenerate();
            
            session([
                'boreal_logged_in' => true,
                'boreal_user_id' => $user->id
            ]);
            return redirect()->route('boreal.dashboard');
        }

        \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 60);

        return back()->withErrors(['login' => 'Credenciales incorrectas']);
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('boreal.login');
    }

    public function dashboard(Request $request)
    {
        if (!session('boreal_logged_in')) {
            return redirect()->route('boreal.login');
        }

        $loggedUser = \App\Models\User::find(session('boreal_user_id'));
        $messages = Message::orderBy('created_at', 'desc')->get();
        $logs = LogBot::orderBy('created_at', 'desc')->get();
        
        $ragQuery = RagData::orderBy('created_at', 'desc');
        if ($request->has('search_rag') && $request->search_rag != '') {
            $ragQuery->where('topic', 'like', '%' . $request->search_rag . '%');
        }
        $ragData = $ragQuery->paginate(10)->appends($request->query());

        return view('boreal.dashboard', compact('messages', 'logs', 'loggedUser', 'ragData'));
    }

    public function changePassword(Request $request)
    {
        if (!session('boreal_logged_in')) {
            return redirect()->route('boreal.login');
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ], [
            'new_password.confirmed' => 'Las nuevas contraseñas no coinciden.',
            'new_password.min' => 'La nueva contraseña debe tener al menos 6 caracteres.',
        ]);

        $user = \App\Models\User::find(session('boreal_user_id'));

        if (!$user || !\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->with('password_error', 'La contraseña actual es incorrecta.');
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return back()->with('password_success', '¡Contraseña actualizada correctamente!');
    }

    public function deleteMessage($id)
    {
        if (!session('boreal_logged_in')) {
            return redirect()->route('boreal.login');
        }

        $message = \App\Models\Message::findOrFail($id);
        $message->delete();

        return back()->with('message_success', 'Mensaje eliminado correctamente.');
    }

    public function storeRagData(Request $request)
    {
        if (!session('boreal_logged_in')) return redirect()->route('boreal.login');

        $request->validate([
            'topic' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        RagData::create([
            'topic' => $request->topic,
            'content' => $request->content,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return back()->with('message_success', 'Registro creado correctamente.');
    }

    public function updateRagData(Request $request, $id)
    {
        if (!session('boreal_logged_in')) return redirect()->route('boreal.login');

        $request->validate([
            'topic' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $rag = RagData::findOrFail($id);
        $rag->update([
            'topic' => $request->topic,
            'content' => $request->content,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return back()->with('message_success', 'Registro actualizado correctamente.');
    }

    public function destroyRagData($id)
    {
        if (!session('boreal_logged_in')) return redirect()->route('boreal.login');

        $rag = RagData::findOrFail($id);
        $rag->delete();

        return back()->with('message_success', 'Registro eliminado correctamente.');
    }
}
