<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Categoria extends Authenticatable
{
    use Notifiable;

    protected $table = 'categorias';

    // Definición de los campos que se pueden llenar masivamente
    protected $fillable = [
        'nombre',
        'cantidad_libros', // Actualizable manual o con trigger
        'estado',
    ];

    protected $hidden = ['created_at', 'updated_at']; // Oculta los campos de timestamps en las respuestas JSON

    public $timestamps = true; // Habilita los timestamps para este modelo

    // Método para obtener el nombre de la categoría
    public function getNombre()
    {
        return $this->nombre;
    }

    // Relación: Una categoría puede tener muchos libros digitales
    //public function librosDigitales()
    //{
        //return $this->hasMany(LibroDigital::class, 'categoria_id');
    //}

    // Relación: Una categoría puede tener muchos audiolibros
    public function audiolibros()
    {
        return $this->hasMany(AudioLibro::class, 'categoria_id');
    }

}