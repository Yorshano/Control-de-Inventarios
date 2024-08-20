<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::with('producto')->get();
        return view('entradas.index', compact('entradas'));
    }

    public function create()
    {
        $productos = Producto::all(); // Obtener todos los productos
        $proveedores = Proveedor::all(); // Obtener todos los proveedores
        return view('entradas.create', compact('productos', 'proveedores'));
    }

    public function store(Request $request)
    {
        // Validación de los datos recibidos
        //dd($request->input());
        $request->validate([
            'producto_id' => 'required|exists:productos,id', // Asegúrate de que el producto exista en la base de datos
            'proveedor_id' => 'required|exists:proveedores,id',
            'cantidad' => [
                'required',
                'integer',
                'min:1',
                // Validación personalizada para verificar el stock máximo del producto
                function ($attribute, $value, $fail) use ($request) {
                    $producto = Producto::findOrFail($request->producto_id);
                    if ($value > $producto->stock_maximo) {
                        $fail("La cantidad no puede ser mayor al stock máximo del producto ({$producto->stock_maximo}).");
                    }
                },
            ],
            'fecha' => 'required|date',
            'descripcion' => 'required|string',
        ]);

        // Creación de la nueva entrada
        $entrada = new Entrada();
        $entrada->producto_id = $request->producto_id;
        $entrada->proveedor_id = $request->proveedor_id;
        $entrada->cantidad = $request->cantidad;
        $entrada->fecha = $request->fecha;
        $entrada->descripcion = $request->descripcion;
        $entrada->save();

        // Actualizar el stock del producto
        $producto = Producto::findOrFail($request->producto_id);
        $producto->stock += $request->cantidad; // Sumar la cantidad ingresada al stock actual
        $producto->save();

        // Redireccionar con mensaje de éxito
        return redirect()->route('entradas.index')->with('success', 'Entrada registrada correctamente.');
    }

    public function show(Entrada $entrada)
    {
        return view('entradas.show', compact('entrada'));
    }

    public function edit($id)
    {
        $entrada = Entrada::findOrFail($id);
        $productos = Producto::all();
        $proveedores = Proveedor::all();
        return view('entradas.edit', compact('entrada', 'productos', 'proveedores'));
    }

    public function update(Request $request, $id)
{
    $entrada = Entrada::findOrFail($id);

    // Validación de los datos recibidos
    $request->validate([
        'producto_id' => 'required|exists:productos,id',
        'proveedor_id' => 'required|exists:proveedores,id',
        'cantidad' => [
            'required',
            'integer',
            'min:1',
            function ($attribute, $value, $fail) use ($request, $entrada) {
                $producto = Producto::findOrFail($request->producto_id);
                $cantidad_actual = $entrada->cantidad;
                $stock_total = $producto->stock + $cantidad_actual;
                if ($value > $stock_total) {
                    $fail("La cantidad no puede ser mayor al stock disponible del producto ({$stock_total}).");
                }
                if ($stock_total - $value > $producto->stock_maximo) {
                    $fail("La cantidad no puede hacer que el stock caiga por debajo del stock mínimo del producto ({$producto->stock_minimo}).");
                }
            },
        ],
        'fecha' => 'required|date',
        'descripcion' => 'required|string',
    ]);

    // Obtener el producto relacionado con la entrada
    $producto = Producto::findOrFail($entrada->producto_id);

    // Restar la cantidad original del stock
    $producto->stock -= $entrada->cantidad;

    // Actualizar la entrada con los nuevos datos
    $entrada->update([
        'producto_id' => $request->producto_id,
        'proveedor_id' => $request->proveedor_id,
        'cantidad' => $request->cantidad,
        'fecha' => $request->fecha,
        'descripcion' => $request->descripcion,
    ]);

    // Sumar la nueva cantidad al stock
    $producto->stock += $request->cantidad;
    $producto->save();

    return redirect()->route('entradas.index')->with('success', 'Entrada actualizada correctamente.');
}


    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);
        $producto = Producto::findOrFail($entrada->producto_id);
        $producto->stock -= $entrada->cantidad; // Restar la cantidad del stock
        $producto->save();

        $entrada->delete();
        return redirect()->route('entradas.index')->with('success', 'Entrada eliminada correctamente.');
    }

    public function searchProduct(Request $request)
    {
        $search = $request->input('search');
        $productos = Producto::where('codigo_barras', 'like', '%' . $search . '%')->get();

        return response()->json($productos);
    }
}
