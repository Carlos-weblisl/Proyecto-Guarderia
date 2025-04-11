<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

    // Si solo estás permitiendo la asignación masiva de estos campos:
    protected $fillable = ['user_id', 'telefono', 'direccion', 'rol'];

    // La relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class); // Establece que cada registro de Personal pertenece a un User
    }

    // Si necesitas personalizar el comportamiento de acceso a los campos
    // como nombre completo (en lugar de acceder a 'name' y 'apellido' por separado):
    public function getFullNameAttribute()
    {
        return $this->user->name . ' ' . $this->user->apellido;
    }
}

