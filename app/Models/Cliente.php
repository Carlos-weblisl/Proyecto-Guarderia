<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'direccion', 'telefono', 'email', 'tipo_documento', 'numero_documento', 'numero_ruc', 'forma_pago', 'distrito', 'departamento', 'provincia'];

    public function hijos()
    {
        return $this->hasMany(Niño::class);
    }
}
