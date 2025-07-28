<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/****************************************************************************************************** */
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
        'estado',
        'contrasena',
        'url_imagen',
    ];

   protected $hidden = ['contrasena']; // Oculta el campo de contraseña en las respuestas JSON

    // Método para obtener la contraseña del usuario
    // Esto es necesario para la autenticación
   public function getAuthPassword()
    {   
        return $this->contrasena;
    }

    public $timestamps = true;
}

/************************************************************************************************************** */