<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Salida;
use Illuminate\Http\Request;

class SalidaController extends Controller
{
    public function index()
    {
        $salidas = Salida::with('producto')->get();
        return view('salidas.index', compact('salidas'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('salidas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'producto_id' => 'required',
            'cantidad' => [
                'required',
                'integer',
                'min:1',
                // Validación personalizada para verificar el stock mínimo del producto
                function ($attribute, $value, $fail) use ($request) {
                    $producto = Producto::findOrFail($request->producto_id);
                    if ($producto->stock - $value < $producto->stockMin) {
                        $fail("La cantidad no puede reducir el stock por debajo del stock mínimo del producto ({$producto->stockMin}).");
                    }
                },
            ],
            'fecha' => 'required|date',
            'descripcion' => 'nullable|string',
        ]);

        // Actualizar el stock del producto
        $producto = Producto::findOrFail($request->producto_id);
        $producto->stock -= $request->cantidad; // Restar la cantidad ingresada al stock actual
        $producto->save();

        // Creación de la nueva salida
        Salida::create($validatedData);

        // Redireccionar con mensaje de éxito
        return redirect()->route('salidas.index')->with('success', 'Salida registrada correctamente.');
    }

    public function show(Salida $salida)
    {
        return view('salidas.show', compact('salida'));
    }

    public function edit($id)
    {
        $salida = Salida::findOrFail($id);
        $productos = Producto::all();
        return view('salidas.edit', compact('salida', 'productos'));
    }

    public function update(Request $request, $id)
    {
        $salida = Salida::findOrFail($id);

        $request->validate([
            'producto_id' => 'required|exists:productos,Id',
            'cantidad' => [
                'required',
                'integer',
                'min:1',
                function ($attribute, $value, $fail) use ($request, $salida) {
                    $producto = Producto::findOrFail($request->producto_id);
                    $cantidad_actual = $salida->cantidad;
                    $stock_total = $producto->stock + $cantidad_actual;
                    if ($value > $stock_total) {
                        $fail("La cantidad no puede ser mayor al stock disponible del producto ({$stock_total}).");
                    }
                    if ($stock_total - $value < $producto->stock_minimo) {
                        $fail("La cantidad no puede hacer que el stock caiga por debajo del stock mínimo del producto ({$producto->stock_minimo}).");
                    }
                },
            ],
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
        ]);

        // Actualizar el stock del producto
        $producto = Producto::findOrFail($salida->producto_id);
        $producto->stock += $salida->cantidad;

        $salida->update($request->all());

        $producto->stock -= $salida->cantidad;
        $producto->save();

        return redirect()->route('salidas.index')->with('success', 'Salida actualizada correctamente.');
    }

    public function destroy($id)
    {
        $salida = Salida::findOrFail($id);
        $producto = Producto::findOrFail($salida->producto_id);
        $producto->stock += $salida->cantidad;
        $producto->save();

        $salida->delete();
        return redirect()->route('salidas.index')->with('success', 'Salida eliminada correctamente.');
    }

    public function searchProduct(Request $request)
    {
        $search = $request->input('search');
        $productos = Producto::where('codigo_barras', 'like', '%' . $search . '%')->get();

        return response()->json($productos);
    }
}
