<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReciclajeController;
use App\Http\Controllers\PremioController;
use App\Http\Controllers\DispositivoController;

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

// ── Rutas protegidas ─────────────────────────────────
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Acciones ecológicas / Reciclaje  (CRUD básico)
    Route::get('/reciclaje',             [ReciclajeController::class, 'index'])->name('reciclaje.index');
    Route::get('/reciclaje/crear',       [ReciclajeController::class, 'create'])->name('reciclaje.create');
    Route::post('/reciclaje',            [ReciclajeController::class, 'store'])->name('reciclaje.store');
    Route::delete('/reciclaje/{id}',     [ReciclajeController::class, 'destroy'])->name('reciclaje.destroy');

    // Premios y canjes
    Route::get('/premios',               [PremioController::class, 'index'])->name('premios.index');
    Route::post('/premios/{id}/canjear', [PremioController::class, 'canjear'])->name('premios.canjear');

    // Dispositivos (CRUD básico)
    Route::get('/dispositivos',          [DispositivoController::class, 'index'])->name('dispositivos.index');
    Route::get('/dispositivos/crear',    [DispositivoController::class, 'create'])->name('dispositivos.create');
    Route::post('/dispositivos',         [DispositivoController::class, 'store'])->name('dispositivos.store');
    Route::get('/dispositivos/{id}/editar', [DispositivoController::class, 'edit'])->name('dispositivos.edit');
    Route::put('/dispositivos/{id}',     [DispositivoController::class, 'update'])->name('dispositivos.update');
    Route::delete('/dispositivos/{id}',  [DispositivoController::class, 'destroy'])->name('dispositivos.destroy');

});
