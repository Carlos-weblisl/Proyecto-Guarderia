<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BoletoDetalle; // Importa el modelo de los detalles

class Boleto extends Model
{
    // Nombre de la tabla asociada
    protected $table = 'boletos';

    // Definición de los campos que se pueden asignar de forma masiva
    protected $fillable = [
        'nombre',
        'section',
        'tipo_comprobante',
        'establecimiento',
        'tipo_operacion',
        'cliente',
        'vendedor',
        'fecha_emision',
        'serie',
        'moneda',
        'condicion_pago',
        'tipo_cambio',
        'metodo_pago',
        'destino',
        'referencia',
        'monto'
    ];

    // Si deseas usar timestamps (created_at, updated_at)
    public $timestamps = true;

    // Relación: Un boleto tiene muchos detalles (BoletoDetalle)
    public function detalles()
    {
        return $this->hasMany(BoletoDetalle::class);
    }
}
