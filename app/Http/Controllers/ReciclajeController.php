<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RegistroAccion;
use App\Models\AccionEcologica;
use App\Models\Dispositivo;

class ReciclajeController extends Controller
{
    public function index()
    {
        $registros = RegistroAccion::where('user_id', Auth::id())
            ->with(['accion', 'dispositivo'])
            ->orderByDesc('fecha')
            ->get();

        return view('reciclaje.index', compact('registros'));
    }

    public function create()
    {
        $acciones     = AccionEcologica::all();
        $dispositivos = Dispositivo::where('estado', 'activo')->get();

        return view('reciclaje.create', compact('acciones', 'dispositivos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'accion_id'      => 'required|exists:acciones_ecologicas,id',
            'dispositivo_id' => 'nullable|exists:dispositivos,id',
            'cantidad_kg'    => 'nullable|numeric|min:0',
            'fecha'          => 'required|date',
            'observaciones'  => 'nullable|string|max:500',
        ]);

        $accion = AccionEcologica::findOrFail($validated['accion_id']);

        // Crear el registro
        RegistroAccion::create([
            'user_id'        => Auth::id(),
            'accion_id'      => $validated['accion_id'],
            'dispositivo_id' => $validated['dispositivo_id'] ?? null,
            'cantidad_kg'    => $validated['cantidad_kg'] ?? null,
            'fecha'          => $validated['fecha'],
            'observaciones'  => $validated['observaciones'] ?? null,
        ]);

        // Sumar puntos al usuario
        Auth::user()->increment('puntos', $accion->puntos_otorgados);

        return redirect()->route('reciclaje.index')
            ->with('success', "¡Acción registrada! Ganaste +{$accion->puntos_otorgados} puntos 🌱");
    }

    public function destroy($id)
    {
        $registro = RegistroAccion::where('user_id', Auth::id())->findOrFail($id);

        // Restar los puntos antes de eliminar
        $puntos = $registro->accion->puntos_otorgados;
        Auth::user()->decrement('puntos', $puntos);

        $registro->delete();

        return redirect()->route('reciclaje.index')
            ->with('success', 'Registro eliminado.');
    }
}
