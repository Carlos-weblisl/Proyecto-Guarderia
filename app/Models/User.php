<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'name',
        'apellido',
        'email',
        'password',
        'telefono',
        'direccion',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relación con el modelo Personal (por si aún lo usas)
    public function personal()
    {
        return $this->hasOne(Personal::class, 'user_id');
    }
}
