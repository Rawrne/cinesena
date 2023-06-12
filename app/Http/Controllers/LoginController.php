<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            //El usuario está logado
            return redirect()->back();
        }
        else
        {
            //El usuario no está logado
            return view('pages.login');
        }
    }

    public function login(Request $request)
    {
        if(Auth::check())
        {
            //El usuario está logado
            return redirect()->back();
        }
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
         
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
         
            return redirect()->intended(route('home'));
        }
         
        return back()->withErrors([
            'email' => 'Email o contraseña incorrecto',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home');
    }

}
