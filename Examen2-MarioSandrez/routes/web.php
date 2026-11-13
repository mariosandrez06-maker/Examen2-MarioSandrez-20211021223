<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicamentoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Models\Medicamento;
use App\Models\Proveedor;
use App\Models\Empleado;

Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('login'));
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $totalMedicamentos = Medicamento::count();
        $proveedoresActivos = Proveedor::where('estado', 'Activo')->count();
        $totalEmpleados = Empleado::where('estado', 'Activo')->count();
        $valorInventario = Medicamento::sum(DB::raw('inventario * precio'));

        return view('dashboard', compact(
            'totalMedicamentos',
            'proveedoresActivos',
            'totalEmpleados',
            'valorInventario'
        ));
    })->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('medicamentos', MedicamentoController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('empleados', EmpleadoController::class);
});