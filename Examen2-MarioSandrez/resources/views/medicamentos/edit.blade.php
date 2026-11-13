@extends('layouts.plantilla')
@section('titulo', 'Editar Medicamento')

@section('contenido')
<h1 class="h3 mb-3">Editar Medicamento: {{ $medicamento->nombre }}</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('medicamentos.update', $medicamento) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Código SKU *</label>
                    <input type="text" name="codigo" class="form-control @error('codigo') is-invalid @enderror" value="{{ old('codigo', $medicamento->codigo) }}" required>
                    @error('codigo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-8">
                    <label class="form-label">Nombre del Medicamento *</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $medicamento->nombre) }}" required>
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Categoría *</label>
                    <select name="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
                        @foreach(['Antibióticos', 'Analgésicos', 'Sueros', 'Material Quirúrgico', 'Vitaminas'] as $cat)
                            <option value="{{ $cat }}" {{ old('categoria', $medicamento->categoria) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('categoria')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Laboratorio *</label>
                    <input type="text" name="laboratorio" class="form-control @error('laboratorio') is-invalid @enderror" value="{{ old('laboratorio', $medicamento->laboratorio) }}" required>
                    @error('laboratorio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Número de Lote *</label>
                    <input type="text" name="numero_lote" class="form-control @error('numero_lote') is-invalid @enderror" value="{{ old('numero_lote', $medicamento->numero_lote) }}" required>
                    @error('numero_lote')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Precio Venta (L.) *</label>
                    <input type="number" step="0.01" name="precio" class="form-control @error('precio') is-invalid @enderror" value="{{ old('precio', $medicamento->precio) }}" required>
                    @error('precio')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Costo Compra (L.) *</label>
                    <input type="number" step="0.01" name="costo" class="form-control @error('costo') is-invalid @enderror" value="{{ old('costo', $medicamento->costo) }}" required>
                    @error('costo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Inventario (Unidades) *</label>
                    <input type="number" name="inventario" class="form-control @error('inventario') is-invalid @enderror" value="{{ old('inventario', $medicamento->inventario) }}" required>
                    @error('inventario')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha de Registro *</label>
                    <input type="date" name="fecha_registro" class="form-control @error('fecha_registro') is-invalid @enderror" value="{{ old('fecha_registro', $medicamento->fecha_registro) }}" required>
                    @error('fecha_registro')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha de Vencimiento *</label>
                    <input type="date" name="fecha_vencimiento" class="form-control @error('fecha_vencimiento') is-invalid @enderror" value="{{ old('fecha_vencimiento', $medicamento->fecha_vencimiento) }}" required>
                    @error('fecha_vencimiento')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Actualizar Fotografía (Opcional)</label>
                    <input type="file" name="imagen" accept=".jpg,.jpeg,.png,.webp" class="form-control @error('imagen') is-invalid @enderror">
                    @error('imagen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Actualizar Medicamento</button>
                <a href="{{ route('medicamentos.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection