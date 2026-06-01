<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReciclajeController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\AdminController;

// ── Pública ──────────────────────────────────────────
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ── Autenticación ────────────────────────────────────
Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthController::class, 'register']);
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout');

// ── Rutas de usuario autenticado ─────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Reciclaje (CRUD)
    Route::get('/reciclaje',             [ReciclajeController::class, 'index'])->name('reciclaje.index');
    Route::get('/reciclaje/crear',       [ReciclajeController::class, 'create'])->name('reciclaje.create');
    Route::post('/reciclaje',            [ReciclajeController::class, 'store'])->name('reciclaje.store');
    Route::delete('/reciclaje/{id}',     [ReciclajeController::class, 'destroy'])->name('reciclaje.destroy');

    // Premios y canjes
    Route::get('/premios',               [PremioController::class, 'index'])->name('premios.index');
    Route::post('/premios/{id}/canjear', [PremioController::class, 'canjear'])->name('premios.canjear');

    // Dispositivos (CRUD)
    Route::get('/dispositivos',                [DispositivoController::class, 'index'])->name('dispositivos.index');
    Route::get('/dispositivos/crear',          [DispositivoController::class, 'create'])->name('dispositivos.create');
    Route::post('/dispositivos',               [DispositivoController::class, 'store'])->name('dispositivos.store');
    Route::get('/dispositivos/{id}/editar',    [DispositivoController::class, 'edit'])->name('dispositivos.edit');
    Route::put('/dispositivos/{id}',           [DispositivoController::class, 'update'])->name('dispositivos.update');
    Route::delete('/dispositivos/{id}',        [DispositivoController::class, 'destroy'])->name('dispositivos.destroy');

    // Perfil de usuario
    Route::get('/perfil',              [PerfilController::class, 'show'])->name('perfil.show');
    Route::get('/perfil/editar',       [PerfilController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil',              [PerfilController::class, 'update'])->name('perfil.update');
    Route::put('/perfil/password',     [PerfilController::class, 'cambiarPassword'])->name('perfil.password');

    // ── Panel de Administración (solo admin) ──────────
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/',                        [AdminController::class, 'index'])->name('index');
        Route::get('/usuarios',                [AdminController::class, 'usuarios'])->name('usuarios');

        // Premios admin
        Route::get('/premios',                 [AdminController::class, 'premios'])->name('premios');
        Route::get('/premios/crear',           [AdminController::class, 'premioCreate'])->name('premios.create');
        Route::post('/premios',                [AdminController::class, 'premioStore'])->name('premios.store');
        Route::get('/premios/{id}/editar',     [AdminController::class, 'premioEdit'])->name('premios.edit');
        Route::put('/premios/{id}',            [AdminController::class, 'premioUpdate'])->name('premios.update');
        Route::delete('/premios/{id}',         [AdminController::class, 'premioDestroy'])->name('premios.destroy');

        // Acciones ecológicas admin
        Route::get('/acciones',                [AdminController::class, 'acciones'])->name('acciones');
        Route::get('/acciones/crear',          [AdminController::class, 'accionCreate'])->name('acciones.create');
        Route::post('/acciones',               [AdminController::class, 'accionStore'])->name('acciones.store');
        Route::get('/acciones/{id}/editar',    [AdminController::class, 'accionEdit'])->name('acciones.edit');
        Route::put('/acciones/{id}',           [AdminController::class, 'accionUpdate'])->name('acciones.update');
        Route::delete('/acciones/{id}',        [AdminController::class, 'accionDestroy'])->name('acciones.destroy');
    });

});
