<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nino extends Model
{
    use HasFactory;

    protected $table = 'ninos'; // Especificamos el nombre de la tabla

    protected $fillable = [
        'nombre_completo',
        'fecha_nacimiento',
        'sexo',
        'nombre_tutor',
        'dni_tutor',
        'telefono_tutor',
        'email_tutor',
        'direccion',
        'alergias',
        'condiciones_medicas',
        'medicamentos',
        'nombre_medico',
        'telefono_medico',
        'autorizacion_primeros_auxilios',
        'hora_ingreso',
        'hora_salida',
        'persona_autorizada_recoger',
        'foto',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'hora_ingreso' => 'datetime',
        'hora_salida' => 'datetime',
        'autorizacion_primeros_auxilios' => 'boolean',
    ];

    // Accesor para calcular la edad
    public function getEdadAttribute()
    {
        return now()->diffInYears($this->fecha_nacimiento);
    }

    // Relación con el Cliente (padre o tutor)
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
}
