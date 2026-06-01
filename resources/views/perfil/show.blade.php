@extends('layouts.app')
@section('title','Mi Perfil')

@section('content')

<div class="mb-4">
    <h4 style="color:var(--gp-text);font-weight:700;margin:0;">Mi perfil</h4>
    <p style="color:var(--gp-muted);font-size:.85rem;margin:4px 0 0;">Información de tu cuenta y estadísticas personales.</p>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="gp-card text-center">
            {{-- Avatar --}}
            <div style="width:80px;height:80px;border-radius:50%;overflow:hidden;margin:0 auto 14px;border:3px solid var(--gp-green);background:var(--gp-bg);display:flex;align-items:center;justify-content:center;">
                @if($user->avatar)
                    <img src="{{ asset('storage/' . $user->avatar) }}" style="width:100%;height:100%;object-fit:cover;" alt="Avatar">
                @else
                    <span style="font-size:1.8rem;font-weight:700;color:var(--gp-accent);">
                        {{ strtoupper(substr($user->nombre, 0, 1)) }}
                    </span>
                @endif
            </div>

            <div style="font-weight:700;font-size:1.05rem;margin-bottom:4px;">{{ $user->nombre }}</div>
            <div style="color:var(--gp-muted);font-size:.83rem;margin-bottom:10px;">{{ $user->email }}</div>
            <span class="badge-{{ $user->role?->nombre ?? 'usuario' }}">
                {{ ucfirst($user->role?->nombre ?? 'usuario') }}
            </span>
            <div style="color:var(--gp-muted);font-size:.76rem;margin-top:12px;">
                Miembro desde {{ $user->created_at->format('d/m/Y') }}
            </div>
            <div class="mt-3">
                <a href="{{ route('perfil.edit') }}" class="btn-gp" style="text-align:center;font-size:.85rem;">
                    <i class="bi bi-pencil me-1"></i> Editar perfil
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="gp-card mb-3">
            <div class="gp-card-title"><i class="bi bi-bar-chart-fill"></i> Mis estadísticas</div>
            @php
                $totalReg    = $user->registrosAcciones()->count();
                $totalCanjes = $user->canjes()->count();
                $siguiente   = $user->puntos < 200 ? 200 : ($user->puntos < 500 ? 500 : 1000);
                $pct         = min(100, round($user->puntos / $siguiente * 100));
                $nivel       = $user->puntos >= 500 ? '🌳 Sembrador' : ($user->puntos >= 200 ? '🌿 Guardabosques' : '🌱 Principiante');
            @endphp
            <div class="row g-2 mb-3">
                <div class="col-4">
                    <div style="background:var(--gp-bg);border-radius:10px;padding:14px;text-align:center;">
                        <div style="font-size:1.6rem;font-weight:800;color:var(--gp-accent);">{{ $user->puntos }}</div>
                        <div style="font-size:.72rem;color:var(--gp-muted);">Puntos</div>
                    </div>
                </div>
                <div class="col-4">
                    <div style="background:var(--gp-bg);border-radius:10px;padding:14px;text-align:center;">
                        <div style="font-size:1.6rem;font-weight:800;color:var(--gp-accent);">{{ $totalReg }}</div>
                        <div style="font-size:.72rem;color:var(--gp-muted);">Reciclajes</div>
                    </div>
                </div>
                <div class="col-4">
                    <div style="background:var(--gp-bg);border-radius:10px;padding:14px;text-align:center;">
                        <div style="font-size:1.6rem;font-weight:800;color:var(--gp-accent);">{{ $totalCanjes }}</div>
                        <div style="font-size:.72rem;color:var(--gp-muted);">Canjes</div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-1">
                <span style="font-size:.85rem;font-weight:600;color:var(--gp-accent);">{{ $nivel }}</span>
                <span style="font-size:.76rem;color:var(--gp-muted);">{{ $user->puntos }} / {{ $siguiente }} pts</span>
            </div>
            <div style="background:var(--gp-bg);border-radius:10px;height:8px;overflow:hidden;">
                <div style="background:var(--gp-green);height:100%;width:{{ $pct }}%;border-radius:10px;"></div>
            </div>
        </div>

        <div class="gp-card">
            <div class="gp-card-title"><i class="bi bi-lock-fill"></i> Cambiar contraseña</div>
            <form method="POST" action="{{ route('perfil.password') }}">
                @csrf @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Contraseña actual</label>
                        <input type="password" name="password_actual"
                               class="form-control @error('password_actual') is-invalid @enderror"
                               placeholder="••••••••" required>
                        @error('password_actual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Nueva contraseña</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Mín. 6 caracteres" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Confirmar</label>
                        <input type="password" name="password_confirmation"
                               class="form-control" placeholder="Repite la contraseña" required>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn-gp" style="font-size:.85rem;padding:7px 16px;">
                        <i class="bi bi-lock me-1"></i> Actualizar contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
