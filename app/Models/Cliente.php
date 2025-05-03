<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'direccion', 'telefono', 'email', 'tipo_documento', 'numero_documento', 'numero_ruc', 'forma_pago', 'distrito', 'departamento', 'provincia'];

    // Relación de uno a muchos con la tabla 'ninos'a
    public function hijos()
    {
        return $this->hasMany(Nino::class, 'cliente_id', 'id');
    }
}
