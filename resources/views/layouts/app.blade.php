<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>GreenPoints — @yield('title','Panel')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --gp-sidebar-bg : #0f2318;
            --gp-sidebar-w  : 64px;
            --gp-topbar-h   : 56px;
            --gp-green      : #1B8A3E;
            --gp-green-light: #22a84e;
            --gp-accent     : #4ade80;
            --gp-bg         : #111c15;
            --gp-card       : #1a2d1f;
            --gp-card2      : #1f3626;
            --gp-border     : #2a4030;
            --gp-text       : #e8f5e9;
            --gp-muted      : #7aaa88;
            --gp-radius     : 12px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background: var(--gp-bg); color: var(--gp-text); display: flex; min-height: 100vh; }

        /* ── Sidebar ── */
        .gp-sidebar {
            width: var(--gp-sidebar-w);
            background: var(--gp-sidebar-bg);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 16px 0;
            position: fixed;
            top: 0; left: 0;
            height: 100vh;
            border-right: 1px solid var(--gp-border);
            z-index: 100;
        }

        .gp-sidebar .logo {
            font-size: 1.4rem;
            margin-bottom: 28px;
        }

        .gp-sidebar a {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            color: var(--gp-muted);
            text-decoration: none;
            margin-bottom: 6px;
            font-size: 1.2rem;
            transition: background .18s, color .18s;
            position: relative;
        }

        .gp-sidebar a:hover,
        .gp-sidebar a.active {
            background: var(--gp-green);
            color: #fff;
        }

        /* Tooltip label */
        .gp-sidebar a::after {
            content: attr(data-label);
            position: absolute;
            left: 58px;
            background: #0f2318;
            color: #fff;
            font-size: .75rem;
            padding: 4px 10px;
            border-radius: 6px;
            white-space: nowrap;
            pointer-events: none;
            opacity: 0;
            transition: opacity .15s;
            border: 1px solid var(--gp-border);
        }
        .gp-sidebar a:hover::after { opacity: 1; }

        .gp-sidebar .logout-btn {
            margin-top: auto;
        }

        /* ── Main ── */
        .gp-main {
            margin-left: var(--gp-sidebar-w);
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* ── Topbar ── */
        .gp-topbar {
            background: var(--gp-sidebar-bg);
            border-bottom: 1px solid var(--gp-border);
            height: var(--gp-topbar-h);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        .gp-topbar .page-title { font-weight: 600; font-size: 1rem; color: var(--gp-text); }

        .gp-topbar .user-badge {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: .88rem;
            color: var(--gp-muted);
        }

        .gp-topbar .pts-badge {
            background: var(--gp-green);
            color: #fff;
            border-radius: 20px;
            padding: 3px 12px;
            font-size: .8rem;
            font-weight: 700;
        }

        /* ── Content ── */
        .gp-content {
            padding: 24px;
            flex: 1;
        }

        /* ── Cards ── */
        .gp-card {
            background: var(--gp-card);
            border: 1px solid var(--gp-border);
            border-radius: var(--gp-radius);
            padding: 20px;
        }

        .gp-card-title {
            font-size: .82rem;
            font-weight: 600;
            letter-spacing: .05em;
            text-transform: uppercase;
            color: var(--gp-muted);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 7px;
        }

        /* ── Stat box ── */
        .gp-stat-val { font-size: 2rem; font-weight: 800; color: var(--gp-accent); line-height: 1; }
        .gp-stat-lbl { font-size: .78rem; color: var(--gp-muted); margin-top: 3px; }

        /* ── Buttons ── */
        .btn-gp {
            background: var(--gp-green);
            color: #fff !important;
            border: none;
            border-radius: 8px;
            padding: 8px 18px;
            font-weight: 600;
            font-size: .9rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: background .18s;
        }
        .btn-gp:hover { background: var(--gp-green-light); }

        .btn-gp-ghost {
            background: transparent;
            border: 1px solid var(--gp-border);
            color: var(--gp-muted) !important;
            border-radius: 8px;
            padding: 7px 16px;
            font-size: .88rem;
            text-decoration: none;
            display: inline-block;
            transition: border-color .18s, color .18s;
        }
        .btn-gp-ghost:hover { border-color: var(--gp-green); color: var(--gp-accent) !important; }

        /* ── Forms ── */
        .form-control, .form-select {
            background: var(--gp-bg) !important;
            border: 1px solid var(--gp-border) !important;
            color: var(--gp-text) !important;
            border-radius: 8px;
        }
        .form-control::placeholder { color: var(--gp-muted) !important; }
        .form-control:focus, .form-select:focus {
            border-color: var(--gp-green) !important;
            box-shadow: 0 0 0 .2rem rgba(27,138,62,.25) !important;
        }
        .form-label { color: var(--gp-muted); font-size: .85rem; font-weight: 500; }

        /* ── Table ── */
        .gp-table { width: 100%; border-collapse: collapse; font-size: .9rem; }
        .gp-table th { color: var(--gp-muted); font-size: .75rem; text-transform: uppercase; letter-spacing: .05em; padding: 10px 14px; border-bottom: 1px solid var(--gp-border); font-weight: 600; }
        .gp-table td { padding: 12px 14px; border-bottom: 1px solid var(--gp-border); color: var(--gp-text); }
        .gp-table tr:last-child td { border-bottom: none; }
        .gp-table tr:hover td { background: var(--gp-card2); }

        /* ── Badges ── */
        .badge-activo        { background: rgba(74,222,128,.15); color: #4ade80; border-radius: 20px; padding: 3px 10px; font-size: .75rem; font-weight: 600; }
        .badge-mantenimiento { background: rgba(251,191,36,.15);  color: #fbbf24; border-radius: 20px; padding: 3px 10px; font-size: .75rem; font-weight: 600; }
        .badge-inactivo      { background: rgba(248,113,113,.15); color: #f87171; border-radius: 20px; padding: 3px 10px; font-size: .75rem; font-weight: 600; }

        /* ── Alerts ── */
        .gp-alert {
            background: rgba(74,222,128,.1);
            border: 1px solid rgba(74,222,128,.3);
            color: #4ade80;
            border-radius: 10px;
            padding: 11px 16px;
            margin-bottom: 18px;
            font-size: .9rem;
            display: flex;
            align-items: center;
            gap: 9px;
        }
        .gp-alert-error {
            background: rgba(248,113,113,.1);
            border-color: rgba(248,113,113,.3);
            color: #f87171;
        }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--gp-bg); }
        ::-webkit-scrollbar-thumb { background: var(--gp-border); border-radius: 3px; }
    </style>
    @stack('styles')
</head>
<body>

{{-- ── SIDEBAR ── --}}
<nav class="gp-sidebar">
    <div class="logo">♻️</div>

    <a href="{{ route('dashboard') }}"       data-label="Dashboard"    class="{{ request()->routeIs('dashboard')         ? 'active' : '' }}"><i class="bi bi-house-door-fill"></i></a>
    <a href="{{ route('reciclaje.index') }}" data-label="Mis reciclajes" class="{{ request()->routeIs('reciclaje.*')     ? 'active' : '' }}"><i class="bi bi-recycle"></i></a>
    <a href="{{ route('premios.index') }}"   data-label="Premios"       class="{{ request()->routeIs('premios.*')        ? 'active' : '' }}"><i class="bi bi-gift-fill"></i></a>
    <a href="{{ route('dispositivos.index') }}" data-label="Dispositivos" class="{{ request()->routeIs('dispositivos.*') ? 'active' : '' }}"><i class="bi bi-cpu-fill"></i></a>

    <form method="POST" action="{{ route('logout') }}" class="logout-btn">
        @csrf
        <button type="submit" style="background:none;border:none;width:44px;height:44px;border-radius:10px;color:var(--gp-muted);font-size:1.2rem;cursor:pointer;display:flex;align-items:center;justify-content:center;" title="Cerrar sesión">
            <i class="bi bi-box-arrow-right"></i>
        </button>
    </form>
</nav>

{{-- ── MAIN ── --}}
<div class="gp-main">

    {{-- Topbar --}}
    <header class="gp-topbar">
        <span class="page-title">@yield('title', 'Panel')</span>
        <div class="user-badge">
            <span>{{ Auth::user()->nombre }}</span>
            <span class="pts-badge">{{ Auth::user()->puntos }} pts</span>
        </div>
    </header>

    <div class="gp-content">

        {{-- Alerts --}}
        @if(session('success'))
            <div class="gp-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="gp-alert gp-alert-error"><i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
