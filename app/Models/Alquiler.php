<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alquiler extends Model
{
    use HasFactory;

    protected $table = 'alquileres';
    protected $fillable = ['user_id', 'empresa_id', 'plan_id', 'fecha_inicio', 'fecha_fin', 'cantidad_tiempo', 'costo_total', 'tipo', 'estado'];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }
}
