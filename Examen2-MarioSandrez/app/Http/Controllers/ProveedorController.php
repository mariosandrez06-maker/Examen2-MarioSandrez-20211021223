<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::orderByDesc('id')->paginate(10);
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'rtn' => ['required', 'digits:14', 'unique:proveedores,rtn'],
            'empresa' => ['required', 'string', 'max:255'],
            'contacto' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'regex:/^[2389][0-9]{7}$/'],
            'categoria' => ['required', 'in:Fármacos,Material Quirúrgico,Equipos'],
            'limite_credito' => ['required', 'numeric', 'min:0'],
            'dias_credito' => ['required', 'integer', 'in:15,30,45,60'],
            'estado' => ['required', 'in:Activo,Inactivo'],
            'fecha_registro' => ['required', 'date'],
        ], [
            'rtn.digits' => 'El RTN debe contener exactamente 14 dígitos numéricos.',
            'telefono.regex' => 'El teléfono debe tener 8 dígitos e iniciar con 2, 3, 8 o 9.',
        ]);

        Proveedor::create($datos);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor registrado exitosamente.');
    }

    public function edit(Proveedor $proveedore)
    {
        $proveedor = $proveedore;
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $datos = $request->validate([
            'rtn' => ['required', 'digits:14', Rule::unique('proveedores', 'rtn')->ignore($proveedore->id)],
            'empresa' => ['required', 'string', 'max:255'],
            'contacto' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'regex:/^[2389][0-9]{7}$/'],
            'categoria' => ['required', 'in:Fármacos,Material Quirúrgico,Equipos'],
            'limite_credito' => ['required', 'numeric', 'min:0'],
            'dias_credito' => ['required', 'integer', 'in:15,30,45,60'],
            'estado' => ['required', 'in:Activo,Inactivo'],
            'fecha_registro' => ['required', 'date'],
        ]);

        $proveedore->update($datos);

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado.');
    }
}