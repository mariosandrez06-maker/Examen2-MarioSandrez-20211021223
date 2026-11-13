<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class MedicamentoController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('buscar');
        $medicamentos = Medicamento::when($buscar, function ($query, $buscar) {
            $query->where('nombre', 'like', "%{$buscar}%")
                  ->orWhere('codigo', 'like', "%{$buscar}%");
        })->orderByDesc('id')->paginate(10)->withQueryString();

        return view('medicamentos.index', compact('medicamentos', 'buscar'));
    }

    public function create()
    {
        return view('medicamentos.create');
    }

    public function store(Request $request)
    {
        $datos = $request->validate([
            'codigo' => 'required|string|max:50|unique:medicamentos,codigo',
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|in:Antibióticos,Analgésicos,Sueros,Material Quirúrgico,Vitaminas',
            'precio' => 'required|numeric|gt:0',
            'costo' => 'required|numeric|gte:0',
            'inventario' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'laboratorio' => 'required|string|max:255',
            'fecha_vencimiento' => 'required|date',
            'fecha_registro' => 'required|date',
            'numero_lote' => 'required|string|max:100',
        ]);

        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombreArchivo = uniqid('med_') . '.' . $archivo->getClientOriginalExtension();
            $rutaDestino = public_path('uploads/medicamentos');
            if (!File::exists($rutaDestino)) {
                File::makeDirectory($rutaDestino, 0755, true);
            }
            $archivo->move($rutaDestino, $nombreArchivo);
            $datos['imagen'] = 'uploads/medicamentos/' . $nombreArchivo;
        }

        Medicamento::create($datos);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento registrado correctamente.');
    }

    public function edit(Medicamento $medicamento)
    {
        return view('medicamentos.edit', compact('medicamento'));
    }

    public function update(Request $request, Medicamento $medicamento)
    {
        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:50', Rule::unique('medicamentos', 'codigo')->ignore($medicamento->id)],
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|in:Antibióticos,Analgésicos,Sueros,Material Quirúrgico,Vitaminas',
            'precio' => 'required|numeric|gt:0',
            'costo' => 'required|numeric|gte:0',
            'inventario' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'laboratorio' => 'required|string|max:255',
            'fecha_vencimiento' => 'required|date',
            'fecha_registro' => 'required|date',
            'numero_lote' => 'required|string|max:100',
        ]);

        if ($request->hasFile('imagen')) {
            if ($medicamento->imagen && File::exists(public_path($medicamento->imagen))) {
                File::delete(public_path($medicamento->imagen));
            }
            $archivo = $request->file('imagen');
            $nombreArchivo = uniqid('med_') . '.' . $archivo->getClientOriginalExtension();
            $rutaDestino = public_path('uploads/medicamentos');
            if (!File::exists($rutaDestino)) {
                File::makeDirectory($rutaDestino, 0755, true);
            }
            $archivo->move($rutaDestino, $nombreArchivo);
            $datos['imagen'] = 'uploads/medicamentos/' . $nombreArchivo;
        }

        $medicamento->update($datos);

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento actualizado correctamente.');
    }

    public function destroy(Medicamento $medicamento)
    {
        if ($medicamento->imagen && File::exists(public_path($medicamento->imagen))) {
            File::delete(public_path($medicamento->imagen));
        }
        $medicamento->delete();

        return redirect()->route('medicamentos.index')->with('success', 'Medicamento eliminado del catálogo.');
    }
}