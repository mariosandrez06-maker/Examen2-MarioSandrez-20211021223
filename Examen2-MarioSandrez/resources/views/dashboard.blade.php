@extends('layouts.plantilla')

@section('titulo', 'Dashboard Gerencial')

@section('contenido')
    <h1 class="mb-4">DISFARMA Honduras</h1>

    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white h-100 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-white-50 text-uppercase fw-bold">Medicamentos en Catálogo</div>
                        <div class="display-6 fw-bold">{{ $totalMedicamentos }}</div>
                    </div>
                    <i class="fas fa-capsules fa-3x text-white-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('medicamentos.index') }}">Ver catálogo</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white h-100 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-white-50 text-uppercase fw-bold">Proveedores Activos</div>
                        <div class="display-6 fw-bold">{{ $proveedoresActivos }}</div>
                    </div>
                    <i class="fas fa-truck-medical fa-3x text-white-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="{{ route('proveedores.index') }}">Gestionar proveedores</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-dark h-100 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-dark-50 text-uppercase fw-bold">Empleados en Nómina</div>
                        <div class="display-6 fw-bold">{{ $totalEmpleados }}</div>
                    </div>
                    <i class="fas fa-user-md fa-3x opacity-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-dark stretched-link" href="{{ route('empleados.index') }}">Ver personal</a>
                    <div class="small text-dark"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card bg-dark text-white h-100 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small text-white-50 text-uppercase fw-bold">Valor Total Inventario</div>
                        <div class="h3 fw-bold mb-0">L. {{ number_format($valorInventario, 2) }}</div>
                    </div>
                    <i class="fas fa-coins fa-3x text-white-50"></i>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="small text-white-50">Suma (inventario &times; precio)</span>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Operación Centralizada - DISFARMA Honduras</h5>
            <p class="card-text text-muted mb-0">
                Bienvenido, <strong>{{ Auth::user()->name }}</strong>. Desde este panel puede supervisar en tiempo real el inventario farmacéutico, la red de laboratorios mayoristas y la plantilla de regentes y personal operativo.
            </p>
        </div>
    </div>
@endsection