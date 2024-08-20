<?php

namespace App\Http\Controllers;

use App\Models\Caracterizacion;
use App\Models\Tipo;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function index()
    {
        $tipos = Tipo::with('caracterizacion')->get();
        return view('tipos.index', compact('tipos'));
    }

    public function create()
    {
        $caracterizaciones = Caracterizacion::all();
        return view('tipos.create', compact('caracterizaciones'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'caracterizacion_id' => 'required|exists:caracterizacions,id'
        ]);

        Tipo::create($validatedData);

        return redirect()->route('tipos.index')->with('success', 'Tipo creado correctamente.');
    }

    public function edit(Tipo $tipo)
    {
        $caracterizaciones = Caracterizacion::all();
        return view('tipos.edit', compact('tipo', 'caracterizaciones'));
    }

    public function update(Request $request, Tipo $tipo)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'caracterizacion_id' => 'required|exists:caracterizacions,id'
        ]);

        $tipo->update($validatedData);

        return redirect()->route('tipos.index')->with('success', 'Tipo actualizado correctamente.');
    }

    public function destroy(Tipo $tipo)
    {
        $tipo->delete();
        return redirect()->route('tipos.index')->with('success', 'Tipo eliminado correctamente.');
    }
}
