@extends('layouts.plantilla')
@section('titulo', 'Editar Proveedor')

@section('contenido')
<h1 class="h3 mb-3">Editar Proveedor: {{ $proveedor->empresa }}</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('proveedores.update', $proveedor) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">RTN (14 dígitos) *</label>
                    <input type="text" maxlength="14" name="rtn" class="form-control @error('rtn') is-invalid @enderror" value="{{ old('rtn', $proveedor->rtn) }}" required>
                    @error('rtn')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-8">
                    <label class="form-label">Empresa / Razón Social *</label>
                    <input type="text" name="empresa" class="form-control @error('empresa') is-invalid @enderror" value="{{ old('empresa', $proveedor->empresa) }}" required>
                    @error('empresa')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Asesor Comercial (Contacto) *</label>
                    <input type="text" name="contacto" class="form-control @error('contacto') is-invalid @enderror" value="{{ old('contacto', $proveedor->contacto) }}" required>
                    @error('contacto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Teléfono (8 dígitos) *</label>
                    <input type="text" maxlength="8" name="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $proveedor->telefono) }}" required>
                    @error('telefono')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Categoría *</label>
                    <select name="categoria" class="form-select @error('categoria') is-invalid @enderror" required>
                        @foreach(['Fármacos', 'Material Quirúrgico', 'Equipos'] as $cat)
                            <option value="{{ $cat }}" {{ old('categoria', $proveedor->categoria) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    @error('categoria')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Límite de Crédito (L.) *</label>
                    <input type="number" step="0.01" name="limite_credito" class="form-control @error('limite_credito') is-invalid @enderror" value="{{ old('limite_credito', $proveedor->limite_credito) }}" required>
                    @error('limite_credito')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Días de Crédito *</label>
                    <select name="dias_credito" class="form-select @error('dias_credito') is-invalid @enderror" required>
                        @foreach([15, 30, 45, 60] as $dias)
                            <option value="{{ $dias }}" {{ old('dias_credito', $proveedor->dias_credito) == $dias ? 'selected' : '' }}>{{ $dias }} días</option>
                        @endforeach
                    </select>
                    @error('dias_credito')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estado *</label>
                    <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                        <option value="Activo" {{ old('estado', $proveedor->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $proveedor->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">Fecha de Registro *</label>
                    <input type="date" name="fecha_registro" class="form-control @error('fecha_registro') is-invalid @enderror" value="{{ old('fecha_registro', $proveedor->fecha_registro) }}" required>
                    @error('fecha_registro')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
                <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection