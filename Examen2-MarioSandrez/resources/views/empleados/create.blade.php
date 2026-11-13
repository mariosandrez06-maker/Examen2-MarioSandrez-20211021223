@extends('layouts.plantilla')
@section('titulo', 'Registrar Colaborador')

@section('contenido')
<h1 class="h3 mb-3">Registrar Nuevo Colaborador</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('empleados.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Identidad / DNI (13 dígitos sin guiones) *</label>
                    <input type="text" maxlength="13" name="identidad" class="form-control @error('identidad') is-invalid @enderror" value="{{ old('identidad') }}" placeholder="0801199512345" required>
                    @error('identidad')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Nombre *</label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" required>
                    @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Apellido *</label>
                    <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror" value="{{ old('apellido') }}" required>
                    @error('apellido')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" name="correo" class="form-control @error('correo') is-invalid @enderror" value="{{ old('correo') }}" required>
                    @error('correo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Cargo *</label>
                    <select name="cargo" class="form-select @error('cargo') is-invalid @enderror" required>
                        <option value="">Seleccione un cargo...</option>
                        @foreach(['Regente Farmacéutico', 'Asistente de Farmacia', 'Jefe de Bodega', 'Despachador', 'Cajero'] as $cargo)
                            <option value="{{ $cargo }}" {{ old('cargo') == $cargo ? 'selected' : '' }}>{{ $cargo }}</option>
                        @endforeach
                    </select>
                    @error('cargo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Salario Base Mensual (L.) *</label>
                    <input type="number" step="0.01" name="salario" class="form-control @error('salario') is-invalid @enderror" value="{{ old('salario') }}" required>
                    @error('salario')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Fecha de Ingreso *</label>
                    <input type="date" name="fecha_ingreso" class="form-control @error('fecha_ingreso') is-invalid @enderror" value="{{ old('fecha_ingreso', date('Y-m-d')) }}" required>
                    @error('fecha_ingreso')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label">Estado *</label>
                    <select name="estado" class="form-select @error('estado') is-invalid @enderror" required>
                        <option value="Activo" {{ old('estado') == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado') == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Guardar Colaborador</button>
                <a href="{{ route('empleados.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection