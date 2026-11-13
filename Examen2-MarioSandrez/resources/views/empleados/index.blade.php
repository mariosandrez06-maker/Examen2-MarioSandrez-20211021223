@extends('layouts.plantilla')
@section('titulo', 'Personal y Regentes Farmacéuticos')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Plantilla de Personal y Regentes Farmacéuticos</h1>
    <a href="{{ route('empleados.create') }}" class="btn btn-primary">
        <i class="fas fa-user-plus me-1"></i> Nuevo Colaborador
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card">
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>DNI (13 dígitos)</th>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Cargo</th>
                    <th>Salario Mensual</th>
                    <th>Fecha Ingreso</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($empleados as $emp)
                <tr>
                    <td><strong>{{ $emp->identidad }}</strong></td>
                    <td>{{ $emp->nombre }} {{ $emp->apellido }}</td>
                    <td>{{ $emp->correo }}</td>
                    <td>
                        @php
                            $badgeCargo = match($emp->cargo) {
                                'Regente Farmacéutico' => 'bg-primary',
                                'Jefe de Bodega' => 'bg-dark',
                                'Asistente de Farmacia' => 'bg-info text-dark',
                                'Despachador' => 'bg-warning text-dark',
                                default => 'bg-secondary',
                            };
                        @endphp
                        <span class="badge {{ $badgeCargo }}">{{ $emp->cargo }}</span>
                    </td>
                    <td><strong>L. {{ number_format($emp->salario, 2) }}</strong></td>
                    <td>{{ \Carbon\Carbon::parse($emp->fecha_ingreso)->format('d/m/Y') }}</td>
                    <td>
                        @if($emp->estado === 'Activo')
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('empleados.edit', $emp) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('empleados.destroy', $emp) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Está seguro de eliminar a {{ $emp->nombre }} {{ $emp->apellido }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" class="text-center text-muted">No hay colaboradores registrados en nómina.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $empleados->links() }}
    </div>
</div>
@endsection