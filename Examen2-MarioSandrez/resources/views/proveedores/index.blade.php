@extends('layouts.plantilla')
@section('titulo', 'Proveedores Mayoristas')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Red de Laboratorios y Proveedores Mayoristas</h1>
    <a href="{{ route('proveedores.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Nuevo Proveedor
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
                    <th>RTN</th>
                    <th>Empresa / Razón Social</th>
                    <th>Asesor Contacto</th>
                    <th>Teléfono</th>
                    <th>Categoría</th>
                    <th>Límite Crédito</th>
                    <th>Plazo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proveedores as $prov)
                <tr>
                    <td><strong>{{ $prov->rtn }}</strong></td>
                    <td>{{ $prov->empresa }}</td>
                    <td>{{ $prov->contacto }}</td>
                    <td>{{ $prov->telefono }}</td>
                    <td>{{ $prov->categoria }}</td>
                    <td>L. {{ number_format($prov->limite_credito, 2) }}</td>
                    <td><span class="badge bg-info text-dark">{{ $prov->dias_credito }} días</span></td>
                    <td>
                        @if($prov->estado === 'Activo')
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-secondary">Inactivo</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('proveedores.edit', $prov) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('proveedores.destroy', $prov) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Eliminar al proveedor {{ $prov->empresa }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted">No hay proveedores registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $proveedores->links() }}
    </div>
</div>
@endsection