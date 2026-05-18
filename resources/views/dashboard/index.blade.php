@extends('layouts.app')
@section('title','Dashboard')

@section('content')

{{-- Stats rápidas --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="gp-card">
            <div class="gp-card-title"><i class="bi bi-star-fill"></i> Puntos acumulados</div>
            <div class="gp-stat-val">{{ $user->puntos }}</div>
            <div class="gp-stat-lbl">pts totales</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="gp-card">
            <div class="gp-card-title"><i class="bi bi-recycle"></i> Registros</div>
            <div class="gp-stat-val">{{ $totalRegistros }}</div>
            <div class="gp-stat-lbl">acciones realizadas</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="gp-card">
            <div class="gp-card-title"><i class="bi bi-gift"></i> Canjes</div>
            <div class="gp-stat-val">{{ $totalCanjes }}</div>
            <div class="gp-stat-lbl">premios canjeados</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="gp-card">
            <div class="gp-card-title"><i class="bi bi-person"></i> Nivel</div>
            <div class="gp-stat-val" style="font-size:1.2rem;padding-top:4px;">
                @if($user->puntos >= 500) 🌳 Sembrador
                @elseif($user->puntos >= 200) 🌿 Guardabosques
                @else 🌱 Principiante
                @endif
            </div>
            <div class="gp-stat-lbl">rango actual</div>
        </div>
    </div>
</div>

<div class="row g-3">
    {{-- Últimos reciclajes --}}
    <div class="col-md-7">
        <div class="gp-card">
            <div class="gp-card-title"><i class="bi bi-clock-history"></i> Últimas acciones registradas</div>

            @forelse($ultimosRegistros as $r)
                <div class="d-flex align-items-center justify-content-between py-2"
                     style="border-bottom:1px solid var(--gp-border);">
                    <div>
                        <div style="font-weight:600;font-size:.9rem;">{{ $r->accion->nombre }}</div>
                        <div style="font-size:.78rem;color:var(--gp-muted);">
                            {{ \Carbon\Carbon::parse($r->fecha)->format('d/m/Y') }}
                            @if($r->cantidad_kg) · {{ $r->cantidad_kg }} kg @endif
                            @if($r->dispositivo) · {{ $r->dispositivo->nombre }} @endif
                        </div>
                    </div>
                    <span style="background:rgba(74,222,128,.15);color:#4ade80;border-radius:20px;padding:3px 12px;font-size:.8rem;font-weight:700;">
                        +{{ $r->accion->puntos_otorgados }} pts
                    </span>
                </div>
            @empty
                <p style="color:var(--gp-muted);font-size:.88rem;margin-top:8px;">
                    Aún no has registrado ninguna acción.
                    <a href="{{ route('reciclaje.create') }}" style="color:#4ade80;">¡Comienza aquí!</a>
                </p>
            @endforelse

            <div class="mt-3">
                <a href="{{ route('reciclaje.index') }}" class="btn-gp-ghost">Ver todos →</a>
            </div>
        </div>
    </div>

    {{-- Acciones rápidas --}}
    <div class="col-md-5">
        <div class="gp-card">
            <div class="gp-card-title"><i class="bi bi-lightning-charge-fill"></i> Acciones rápidas</div>
            <div class="d-flex flex-column gap-2 mt-2">
                <a href="{{ route('reciclaje.create') }}" class="btn-gp" style="text-align:center;">
                    <i class="bi bi-plus-circle me-1"></i> Registrar reciclaje
                </a>
                <a href="{{ route('premios.index') }}" class="btn-gp-ghost" style="text-align:center;">
                    <i class="bi bi-gift me-1"></i> Ver premios disponibles
                </a>
                <a href="{{ route('dispositivos.index') }}" class="btn-gp-ghost" style="text-align:center;">
                    <i class="bi bi-cpu me-1"></i> Ver dispositivos
                </a>
            </div>
        </div>

        {{-- Nivel / progreso --}}
        <div class="gp-card mt-3">
            <div class="gp-card-title"><i class="bi bi-bar-chart-fill"></i> Nivel actual</div>
            @php
                $siguiente = $user->puntos < 200 ? 200 : ($user->puntos < 500 ? 500 : 1000);
                $pct = min(100, round($user->puntos / $siguiente * 100));
                $nivelNombre = $user->puntos >= 500 ? 'Sembrador' : ($user->puntos >= 200 ? 'Guardabosques' : 'Principiante');
            @endphp
            <div style="font-size:.95rem;font-weight:600;color:var(--gp-accent);margin-bottom:8px;">{{ $nivelNombre }}</div>
            <div style="background:var(--gp-bg);border-radius:10px;height:8px;overflow:hidden;">
                <div style="background:var(--gp-green);height:100%;width:{{ $pct }}%;border-radius:10px;transition:width .4s;"></div>
            </div>
            <div style="font-size:.75rem;color:var(--gp-muted);margin-top:5px;">
                {{ $user->puntos }} / {{ $siguiente }} pts para el siguiente nivel
            </div>
        </div>
    </div>
</div>

@endsection
