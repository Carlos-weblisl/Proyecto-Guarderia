<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $table = 'planes'; // Especifica el nombre correcto de la tabla

    protected $fillable = [
        'nombre',
        'precio_por_unidad',
        'unidad_tiempo',
    ];
}
