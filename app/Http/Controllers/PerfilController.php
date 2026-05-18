<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reciclaje;
use App\Models\Canje;

class PerfilController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        $puntosTotal       = Reciclaje::where('user_id', $user->id)->sum('puntos');
        $puntosGastados    = Canje::where('user_id', $user->id)->sum('puntos_usados');
        $puntosDisponibles = $puntosTotal - $puntosGastados;
        $totalReciclajes   = Reciclaje::where('user_id', $user->id)->count();

        return view('perfil.show', compact('user', 'puntosTotal', 'puntosDisponibles', 'totalReciclajes'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('perfil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
        ]);

        $user->update($validated);

        return redirect()->route('perfil.show')->with('success', 'Perfil actualizado correctamente.');
    }

    public function configuracion()
    {
        // TODO: Implementar ConfigNotificaciones (equivalente a ConfigNotificaciones de Django)
        return view('perfil.configuracion');
    }
}
