<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Tipo;
use Illuminate\Http\Request;

class configuracionController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function configuracion(){
        return view('configuracion');
    }

}
