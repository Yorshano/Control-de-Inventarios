<?php

namespace App\Http\Controllers;

use App\Models\Caracterizacion;
use Illuminate\Http\Request;

class CaracterizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $caracterizacions = Caracterizacion::all();
        return view('caracterizacions.index', compact('caracterizacions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('caracterizacions.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Caracterizacion::create($validatedData);

        return redirect()->route('caracterizacions.index')->with('success', 'Caracterización creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Caracterizacion $caracterizacion)
    {
        return view('caracterizacions.show', compact('caracterizacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Caracterizacion $caracterizacion)
    {
        return view('caracterizacions.edit', compact('caracterizacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Caracterizacion $caracterizacion)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $caracterizacion->update($validatedData);

        return redirect()->route('caracterizacions.index')->with('success', 'Caracterización actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Caracterizacion $caracterizacion)
    {
        $caracterizacion->delete();

        return redirect()->route('caracterizacions.index')->with('success', 'Caracterización eliminada correctamente.');
    }
}
