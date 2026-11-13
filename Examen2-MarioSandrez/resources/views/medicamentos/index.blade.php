@extends('layouts.plantilla')
@section('titulo', 'Catálogo de Medicamentos')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Catálogo e Inventario de Medicamentos</h1>
    <a href="{{ route('medicamentos.create') }}" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Nuevo Medicamento
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="card mb-4">
    <div class="card-header">
        <form action="{{ route('medicamentos.index') }}" method="GET" class="row g-2">
            <div class="col-md-5">
                <input type="text" name="buscar" class="form-control" placeholder="Buscar por nombre o código SKU..." value="{{ $buscar }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i> Buscar</button>
                @if($buscar)
                    <a href="{{ route('medicamentos.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                @endif
            </div>
        </form>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Foto</th>
                    <th>SKU</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Laboratorio</th>
                    <th>Precio / Costo</th>
                    <th>Existencias</th>
                    <th>Lote / Vence</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($medicamentos as $med)
                <tr>
                    <td class="text-center">
                        @if($med->imagen)
                            <img src="{{ asset($med->imagen) }}" alt="{{ $med->nombre }}" width="50" height="50" class="rounded object-fit-cover">
                        @else
                            <span class="badge bg-secondary">Sin foto</span>
                        @endif
                    </td>
                    <td><strong>{{ $med->codigo }}</strong></td>
                    <td>{{ $med->nombre }}</td>
                    <td>{{ $med->categoria }}</td>
                    <td>{{ $med->laboratorio }}</td>
                    <td>
                        L. {{ number_format($med->precio, 2) }}<br>
                        <small class="text-muted">Costo: L. {{ number_format($med->costo, 2) }}</small>
                    </td>
                    <td>
                        @if($med->inventario > 20)
                            <span class="badge bg-success">{{ $med->inventario }} - Óptimo</span>
                        @elseif($med->inventario >= 10)
                            <span class="badge bg-warning text-dark">{{ $med->inventario }} - Moderado</span>
                        @else
                            <span class="badge bg-danger">{{ $med->inventario }} - ¡Desabastecimiento!</span>
                        @endif
                    </td>
                    <td>
                        Lote: {{ $med->numero_lote }}<br>
                        <small>Vence: {{ $med->fecha_vencimiento }}</small>
                    </td>
                    <td>
                        <a href="{{ route('medicamentos.edit', $med) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('medicamentos.destroy', $med) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('¿Está seguro de eliminar el medicamento {{ $med->nombre }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center text-muted">No hay medicamentos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
        {{ $medicamentos->links() }}
    </div>
</div>
@endsection