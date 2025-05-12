<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\WebUser;


class AuthController extends Controller
{
    // Mostrar el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Registrar al usuario
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:webusers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = WebUser::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('webusers')->login($user); // Usamos el guard personalizado

        return redirect()->route('dashboard');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = WebUser::where('email', $request->email)->first();

        if (!$user) {
            // Usuario no encontrado
            return back()->withErrors(['email' => 'El usuario no está registrado.']);
        }

        if (!Hash::check($request->password, $user->password)) {
            // Contraseña incorrecta
            return back()->withErrors(['password' => 'La contraseña es incorrecta.']);
        }

        // Autenticación manual usando el guard 'webusers'
        Auth::guard('webusers')->login($user);

        Log::info('Usuario autenticado: ' . $user->email);

        return redirect()->intended('dashboard');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
