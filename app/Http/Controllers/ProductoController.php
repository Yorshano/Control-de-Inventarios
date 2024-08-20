<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tipo;
use Illuminate\Http\Request;
use Twilio\Rest\Client;


class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = Producto::with(['tipo.caracterizacion']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('codigo_barras', 'like', '%' . $search . '%')
                  ->orWhere('nombre', 'like', '%' . $search . '%');
            });
        }

        $productos = $query->get();

        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $tipos = Tipo::all();
        return view('productos.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo_barras' => 'required|unique:productos,codigo_barras',
            'nombre' => 'required',
            'stock_minimo' => 'required|integer',
            'stock_maximo' => 'required|integer',
            'tipo_id' => 'required|exists:tipos,id',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        $tipos = Tipo::all();
        return view('productos.edit', compact('producto', 'tipos'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'codigo_barras' => 'required|unique:productos,codigo_barras,' . $producto->id,
            'nombre' => 'required',
            'stock_minimo' => 'required|integer',
            'stock_maximo' => 'required|integer',
            'tipo_id' => 'required|exists:tipos,id',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

    public function getStock($id)
    {
        $producto = Producto::find($id);
        return response()->json(['stock_maximo' => $producto->stock_maximo]);
    }
}
