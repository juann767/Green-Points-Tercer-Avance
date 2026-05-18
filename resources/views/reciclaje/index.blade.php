@extends('layouts.app')
@section('title','Mis Reciclajes')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h4 style="color:var(--gp-text);font-weight:700;margin:0;">Mis acciones ecológicas</h4>
        <p style="color:var(--gp-muted);font-size:.85rem;margin:4px 0 0;">Historial de todas tus acciones registradas.</p>
    </div>
    <a href="{{ route('reciclaje.create') }}" class="btn-gp">
        <i class="bi bi-plus-circle me-1"></i> Nueva acción
    </a>
</div>

<div class="gp-card">
    @if($registros->isEmpty())
        <p style="color:var(--gp-muted);text-align:center;padding:32px 0;">
            No has registrado ninguna acción aún.
            <a href="{{ route('reciclaje.create') }}" style="color:#4ade80;">¡Registra tu primera acción!</a>
        </p>
    @else
        <table class="gp-table">
            <thead>
                <tr>
                    <th>Acción ecológica</th>
                    <th>Dispositivo</th>
                    <th>Cantidad (kg)</th>
                    <th>Fecha</th>
                    <th>Puntos</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $r)
                    <tr>
                        <td style="font-weight:600;">{{ $r->accion->nombre }}</td>
                        <td style="color:var(--gp-muted);font-size:.85rem;">{{ $r->dispositivo?->nombre ?? '—' }}</td>
                        <td style="color:var(--gp-muted);">{{ $r->cantidad_kg ?? '—' }}</td>
                        <td style="color:var(--gp-muted);font-size:.85rem;">{{ \Carbon\Carbon::parse($r->fecha)->format('d/m/Y') }}</td>
                        <td>
                            <span style="color:#4ade80;font-weight:700;">+{{ $r->accion->puntos_otorgados }}</span>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('reciclaje.destroy', $r->id) }}"
                                  onsubmit="return confirm('¿Eliminar este registro?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="background:none;border:none;color:#f87171;cursor:pointer;font-size:.85rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

@endsection
