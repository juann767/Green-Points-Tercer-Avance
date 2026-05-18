@extends('layouts.app')
@section('title', 'Mi Perfil')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold" style="color:var(--gp-green-dark);">
        <i class="bi bi-person-circle me-2"></i>Mi Perfil
    </h3>
</div>

<div class="row g-3">
    <div class="col-md-5">
        <div class="gp-card text-center">
            <div style="font-size:4rem;margin-bottom:12px;">👤</div>
            <h5 class="fw-bold mb-1">{{ $user->name }}</h5>
            <p style="color:var(--gp-muted);font-size:.88rem;">{{ $user->email }}</p>
            <p style="color:var(--gp-muted);font-size:.8rem;">
                Miembro desde {{ $user->created_at->format('d/m/Y') }}
            </p>
            <a href="{{ route('perfil.edit') }}" class="btn btn-gp btn-sm mt-2">
                <i class="bi bi-pencil me-1"></i> Editar perfil
            </a>
        </div>
    </div>

    <div class="col-md-7">
        <div class="gp-card">
            <h6 class="fw-bold mb-3" style="color:var(--gp-green-dark);">Estadísticas</h6>

            <div class="row g-2">
                <div class="col-6">
                    <div class="p-3 rounded-3 text-center" style="background:#e8f5e9;border:1px solid var(--gp-border);">
                        <div style="font-size:1.8rem;font-weight:800;color:var(--gp-green);">{{ $puntosTotal }}</div>
                        <div style="font-size:.78rem;color:var(--gp-muted);">Puntos ganados</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-3 text-center" style="background:#e8f5e9;border:1px solid var(--gp-border);">
                        <div style="font-size:1.8rem;font-weight:800;color:var(--gp-green);">{{ $puntosDisponibles }}</div>
                        <div style="font-size:.78rem;color:var(--gp-muted);">Puntos disponibles</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-3 text-center" style="background:#e8f5e9;border:1px solid var(--gp-border);">
                        <div style="font-size:1.8rem;font-weight:800;color:var(--gp-green);">{{ $totalReciclajes }}</div>
                        <div style="font-size:.78rem;color:var(--gp-muted);">Reciclajes</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-3 rounded-3 text-center" style="background:#fff8e1;border:1px dashed #ffc107;">
                        <div style="font-size:1.8rem;font-weight:800;color:#f9a825;">?</div>
                        <div style="font-size:.78rem;color:var(--gp-muted);">Nivel (pendiente)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
