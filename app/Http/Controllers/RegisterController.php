<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
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
            return view('pages.registration');
        }
    }

    public function register(Request $request)
    {
        if(Auth::check())
        {
            //El usuario está logado
            return redirect()->back();
        }
        else
        {
            //El usuario no está logado
            if($request->has(['user', 'email', 'password']))
            {
                $check = DB::table('users')->where('name', trim($request->user))->count(); // Comprobamos si el alias ya existe
                if($check)
                {
                    return back()->withErrors([
                        'user' => 'El nombre de usuario ya está en uso',
                    ])->withInput();
                }

                $check = DB::table('users')->where('email', trim($request->email))->count(); // Comprobamos si el email ya existe
                if($check)
                {
                    return back()->withErrors([
                        'email' => 'La dirección de email ya está en uso',
                    ])->withInput();
                }

                $check = ($request->password[0] ?? false) != ($request->password[1] ?? false); // Comprobamos si la contraseña no coincide
                if($check)
                {
                    return back()->withErrors([
                        'password' => 'La contraseña no coincide',
                    ])->withInput();
                }

                $check = !$request->has('check'); // Comprobamos si no ha marcado los Términos y Condiciones
                if($check)
                {
                    return back()->withErrors([
                        'check' => 'Debes aceptar los Términos y Condiciones',
                    ])->withInput();
                }

                // Insertamos al usuario
                User::create([
                    'name' => trim($request->user),
                    'email' => trim($request->email),
                    'password' => Hash::make($request->password[0]),
                ]);

                return redirect()->route('login');
            }
            else
            {
                // Si hay algún campo que no esté relleno... 
                return back()->withErrors([
                    'required' => 'Hay que rellenar todos los campos',
                ])->withInput();
            }
        }
    }
}
