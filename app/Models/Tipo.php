<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripcion',
        'caracterizacion_id',
        'activo',
        'created_by',
        'modified_by',
    ];

    // Relación con productos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function caracterizacion()
    {
        return $this->belongsTo(Caracterizacion::class);
    }
}
