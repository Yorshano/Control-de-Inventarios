<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_barras',
        'nombre',
        'stock_minimo',
        'stock_maximo',
        'tipo_id',
        'activo',
        'created_by',
        'modified_by',
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class);
    }

    public function entradas()
    {
        return $this->hasMany(Entrada::class);
    }

    public function salidas()
    {
        return $this->hasMany(Salida::class);
    }
}
