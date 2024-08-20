<?php

use App\Http\Controllers\CaracterizacionController;
use App\Http\Controllers\configuracionController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\TipoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [configuracionController::class,'welcome'])->name('welcome');

Route::get('/configuracion', [configuracionController::class,'configuracion'])->name('configuracion');

Route::resource('tipos', TipoController::class);

Route::resource('proveedores', ProveedorController::class);

Route::resource('productos', ProductoController::class);

Route::resource('entradas', EntradaController::class);

Route::resource('salidas', SalidaController::class);

Route::post('entradas/search-product', [EntradaController::class, 'searchProduct'])->name('entradas.searchProduct');

Route::get('productos/{id}/stock', [ProductoController::class, 'getStock']);

Route::post('salidas/search-product', [SalidaController::class, 'searchProduct'])->name('salidas.searchProduct');

Route::resource('caracterizacions', CaracterizacionController::class);

Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');