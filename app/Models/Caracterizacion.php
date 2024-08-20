<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracterizacion extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'descripcion'];

    public function tipos()
    {
        return $this->hasMany(Tipo::class);
    }
}
