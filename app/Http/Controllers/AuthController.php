<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Laravel usa 'email' para auth por defecto; nuestro campo es 'email' también ✓
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Correo o contraseña incorrectos.'])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nombre'                => 'required|string|max:100',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'role_id'  => 2, // rol usuario por defecto
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'puntos'   => 0,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', '¡Bienvenido a GreenPoints! 🌱');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
