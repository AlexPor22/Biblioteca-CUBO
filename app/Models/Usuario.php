<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre_completo',
        'edad',
        'sexo',
        'nombre_usuario',
        'correo',
        'rol', 
        'numero_telefono',
        'direccion',
        'contrasena',
        'url_imagen',
    ];

    protected $hidden = ['contrasena'];

    // Para que Auth use "contrasena" en lugar de "password"
    public function getAuthPassword()
    {
        return $this->contrasena;
    }
}


/************************************************************************************************************** */