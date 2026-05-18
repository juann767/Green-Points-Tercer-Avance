@extends('layouts.app')
@section('title','Editar Dispositivo')

@section('content')

<div class="mb-4">
    <h4 style="color:var(--gp-text);font-weight:700;margin:0;">Editar dispositivo</h4>
    <p style="color:var(--gp-muted);font-size:.85rem;margin:4px 0 0;">Modifica la información del punto ecológico.</p>
</div>

<div class="gp-card" style="max-width:540px;">
    <form method="POST" action="{{ route('dispositivos.update', $dispositivo->id) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre del dispositivo *</label>
            <input type="text" name="nombre" class="form-control"
                   value="{{ old('nombre', $dispositivo->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ubicación *</label>
            <input type="text" name="ubicacion" class="form-control"
                   value="{{ old('ubicacion', $dispositivo->ubicacion) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="2">{{ old('descripcion', $dispositivo->descripcion) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="form-label">Estado *</label>
            <select name="estado" class="form-select" required>
                <option value="activo"        {{ old('estado', $dispositivo->estado) === 'activo'        ? 'selected' : '' }}>✅ Activo</option>
                <option value="mantenimiento" {{ old('estado', $dispositivo->estado) === 'mantenimiento' ? 'selected' : '' }}>⚙️ En mantenimiento</option>
                <option value="inactivo"      {{ old('estado', $dispositivo->estado) === 'inactivo'      ? 'selected' : '' }}>❌ Inactivo</option>
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn-gp">
                <i class="bi bi-save me-1"></i> Guardar cambios
            </button>
            <a href="{{ route('dispositivos.index') }}" class="btn-gp-ghost">Cancelar</a>
        </div>
    </form>
</div>

@endsection
