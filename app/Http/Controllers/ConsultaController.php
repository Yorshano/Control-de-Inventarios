<?php

namespace App\Http\Controllers;

use App\Models\Caracterizacion;
use App\Models\Entrada;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Salida;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    public function index(Request $request)
    {
        $tipoConsulta = $request->get('tipo_consulta');
        $fechaInicio = $request->get('fecha_inicio');
        $fechaFin = $request->get('fecha_fin');
        $caracterizacionId = $request->get('caracterizacion_id');

        $entradas = [];
        $salidas = [];
        $productos = [];
        $proveedores = [];
        $caracterizaciones = Caracterizacion::all();

        if ($tipoConsulta === 'entradas') {
            $entradas = Entrada::with(['producto', 'proveedor'])
                ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                    return $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
                })
                ->when($caracterizacionId, function ($query) use ($caracterizacionId) {
                    return $query->whereHas('producto.tipo.caracterizacion', function ($query) use ($caracterizacionId) {
                        $query->where('id', $caracterizacionId);
                    });
                })
                ->get();
        }

        if ($tipoConsulta === 'salidas') {
            $salidas = Salida::with('producto')
                ->when($fechaInicio && $fechaFin, function ($query) use ($fechaInicio, $fechaFin) {
                    return $query->whereBetween('fecha', [$fechaInicio, $fechaFin]);
                })
                ->get();
        }

        if ($tipoConsulta === 'productos') {
            $productos = Producto::with(['tipo.caracterizacion'])->get();
        }

        if ($tipoConsulta === 'proveedores') {
            $proveedores = Proveedor::all();
        }

        return view('consultas', compact('tipoConsulta', 'entradas', 'salidas', 'productos', 'proveedores', 'caracterizaciones'));
    }
}
