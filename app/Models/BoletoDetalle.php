<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoletoDetalle extends Model
{
    // Nombre de la tabla asociada
    protected $table = 'boleto_detalles';

    // Campos que pueden asignarse de forma masiva
    protected $fillable = [
        'boleto_id',
        'descripcion',
        'unidad',
        'cantidad',
        'valor_unitario',
        'precio_unitario',
        'subtotal',
        'total'
    ];

    // Habilita timestamps (created_at y updated_at) si lo necesitas
    public $timestamps = true;

    /**
     * Relación inversa: Un detalle pertenece a un boleto.
     */
    public function boleto()
    {
        return $this->belongsTo(Boleto::class);
    }
}
