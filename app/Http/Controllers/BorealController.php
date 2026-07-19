<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\LogBot;

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

        if ($request->username === 'nicolas' && $request->password === 'defaul') {
            session(['boreal_logged_in' => true]);
            return redirect()->route('boreal.dashboard');
        }

        return back()->withErrors(['login' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        session()->forget('boreal_logged_in');
        return redirect()->route('boreal.login');
    }

    public function dashboard()
    {
        if (!session('boreal_logged_in')) {
            return redirect()->route('boreal.login');
        }

        $messages = Message::orderBy('created_at', 'desc')->get();
        $logs = LogBot::orderBy('created_at', 'desc')->get();

        return view('boreal.dashboard', compact('messages', 'logs'));
    }
}
