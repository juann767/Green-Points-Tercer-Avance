@extends('layouts.app')
@section('title','Dispositivos')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 style="color:var(--gp-text);font-weight:700;margin:0;">Puntos ecológicos</h4>
        <p style="color:var(--gp-muted);font-size:.85rem;margin:4px 0 0;">Dispositivos de reciclaje registrados en la plataforma.</p>
    </div>
    <a href="{{ route('dispositivos.create') }}" class="btn-gp">
        <i class="bi bi-plus-circle me-1"></i> Registrar dispositivo
    </a>
</div>

<div class="row g-3">
    @forelse($dispositivos as $d)
        <div class="col-md-6 col-lg-4">
            <div class="gp-card h-100">
                <div class="d-flex align-items-start justify-content-between mb-2">
                    <div style="font-size:1.3rem;">♻️</div>
                    <span class="badge-{{ $d->estado }}">{{ ucfirst($d->estado) }}</span>
                </div>
                <div style="font-weight:700;font-size:.95rem;margin-bottom:4px;">{{ $d->nombre }}</div>
                <div style="font-size:.82rem;color:var(--gp-muted);margin-bottom:6px;">
                    <i class="bi bi-geo-alt me-1"></i>{{ $d->ubicacion }}
                </div>
                @if($d->descripcion)
                    <div style="font-size:.8rem;color:var(--gp-muted);margin-bottom:12px;">{{ $d->descripcion }}</div>
                @endif

                <div class="d-flex gap-2 mt-auto">
                    <a href="{{ route('dispositivos.edit', $d->id) }}" class="btn-gp-ghost" style="font-size:.8rem;padding:5px 12px;">
                        <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form method="POST" action="{{ route('dispositivos.destroy', $d->id) }}"
                          onsubmit="return confirm('¿Eliminar este dispositivo?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="background:rgba(248,113,113,.1);border:1px solid rgba(248,113,113,.25);color:#f87171;border-radius:8px;padding:5px 12px;font-size:.8rem;cursor:pointer;">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="gp-card text-center py-4" style="color:var(--gp-muted);">
                No hay dispositivos registrados.
                <a href="{{ route('dispositivos.create') }}" style="color:#4ade80;">Registra el primero.</a>
            </div>
        </div>
    @endforelse
</div>

@endsection
