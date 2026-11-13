<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::orderByDesc('id')->paginate(10);
        return view('empleados.index', compact('empleados'));
    }

    public function create()
    {
        return view('empleados.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'identidad' => ['required', 'digits:13', 'unique:empleados,identidad'],
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:150', 'unique:empleados,correo'],
            'cargo' => ['required', 'in:Regente Farmacéutico,Asistente de Farmacia,Jefe de Bodega,Despachador,Cajero'],
            'salario' => ['required', 'numeric', 'gt:0'],
            'fecha_ingreso' => ['required', 'date'],
            'estado' => ['required', 'in:Activo,Inactivo'],
        ], [
            'identidad.digits' => 'El DNI debe tener exactamente 13 dígitos numéricos sin guiones.',
            'identidad.unique' => 'Este número de DNI ya está registrado.',
            'salario.gt' => 'El salario base mensual debe ser mayor a 0.',
        ]);

        Empleado::create($datos);

        return redirect()->route('empleados.index')->with('success', 'Colaborador registrado en nómina exitosamente.');
    }

    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $datos = $request->validate([
            'identidad' => ['required', 'digits:13', Rule::unique('empleados', 'identidad')->ignore($empleado->id)],
            'nombre' => ['required', 'string', 'max:100'],
            'apellido' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:150', Rule::unique('empleados', 'correo')->ignore($empleado->id)],
            'cargo' => ['required', 'in:Regente Farmacéutico,Asistente de Farmacia,Jefe de Bodega,Despachador,Cajero'],
            'salario' => ['required', 'numeric', 'gt:0'],
            'fecha_ingreso' => ['required', 'date'],
            'estado' => ['required', 'in:Activo,Inactivo'],
        ]);

        $empleado->update($datos);

        return redirect()->route('empleados.index')->with('success', 'Datos del colaborador actualizados correctamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete();
        return redirect()->route('empleados.index')->with('success', 'Colaborador eliminado de la nómina.');
    }
}