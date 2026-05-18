@extends('layouts.app')
@section('title', 'Editar Perfil')

@section('content')

<div class="mb-4">
    <h3 class="fw-bold" style="color:var(--gp-green-dark);">
        <i class="bi bi-pencil-square me-2"></i>Editar Perfil
    </h3>
</div>

<div class="gp-card" style="max-width:520px;">
    <form method="POST" action="{{ route('perfil.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nombre completo</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name', $user->name) }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-semibold">Correo electrónico</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        {{-- TODO: Teléfono y dirección requieren tabla profiles (perfil extendido) --}}
        <div class="wip-banner">
            <i class="bi bi-tools"></i>
            <span><strong>Pendiente:</strong> Campos de teléfono y dirección requieren crear la tabla <code>profiles</code>.</span>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-gp">
                <i class="bi bi-save me-1"></i> Guardar cambios
            </button>
            <a href="{{ route('perfil.show') }}" class="btn btn-gp-outline">Cancelar</a>
        </div>
    </form>
</div>

@endsection
