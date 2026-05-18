@extends('layouts.app')
@section('title','Registrar Dispositivo')

@section('content')

<div class="mb-4">
    <h4 style="color:var(--gp-text);font-weight:700;margin:0;">Registrar nuevo dispositivo</h4>
    <p style="color:var(--gp-muted);font-size:.85rem;margin:4px 0 0;">Agrega un nuevo punto ecológico a la plataforma.</p>
</div>

<div class="gp-card" style="max-width:540px;">
    <form method="POST" action="{{ route('dispositivos.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre del dispositivo *</label>
            <input type="text" name="nombre" class="form-control"
                   value="{{ old('nombre') }}" placeholder="Ej. Punto Verde — UES Central" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ubicación *</label>
            <input type="text" name="ubicacion" class="form-control"
                   value="{{ old('ubicacion') }}" placeholder="Ej. Blvd. Los Héroes, San Salvador" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción <span style="opacity:.6;">opcional</span></label>
            <textarea name="descripcion" class="form-control" rows="2"
                      placeholder="Materiales que acepta, horario, etc.">{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label">Estado *</label>
            <select name="estado" class="form-select" required>
                <option value="activo"        {{ old('estado') === 'activo'        ? 'selected' : '' }}>✅ Activo</option>
                <option value="mantenimiento" {{ old('estado') === 'mantenimiento' ? 'selected' : '' }}>⚙️ En mantenimiento</option>
                <option value="inactivo"      {{ old('estado') === 'inactivo'      ? 'selected' : '' }}>❌ Inactivo</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn-gp">
                <i class="bi bi-check2-circle me-1"></i> Guardar dispositivo
            </button>
            <a href="{{ route('dispositivos.index') }}" class="btn-gp-ghost">Cancelar</a>
        </div>
    </form>
</div>

@endsection
