<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
        ]);

        Proveedor::create($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado exitosamente.');
    }

    public function show(Proveedor $proveedore)
    {
        return view('proveedores.show', compact('proveedore'));
    }

    public function edit(Proveedor $proveedore)
    {
        return view('proveedores.edit', compact('proveedore'));
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
        ]);

        $proveedore->update($request->all());

        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado con éxito.');
    }

    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();

        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
