<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\RegistroAccion;
use App\Models\Canje;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalRegistros = RegistroAccion::where('user_id', $user->id)->count();
        $totalCanjes    = Canje::where('user_id', $user->id)->count();

        // Últimos 5 reciclajes del usuario
        $ultimosRegistros = RegistroAccion::where('user_id', $user->id)
            ->with('accion')
            ->orderByDesc('fecha')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'user',
            'totalRegistros',
            'totalCanjes',
            'ultimosRegistros',
        ));
    }
}
