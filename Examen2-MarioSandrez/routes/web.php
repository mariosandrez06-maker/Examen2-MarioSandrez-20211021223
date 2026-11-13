<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\ProveedorController;

Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('login'));
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('medicamentos', MedicamentoController::class);
    Route::resource('proveedores', ProveedorController::class);
});