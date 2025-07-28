<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'cantidad_libros',
        'estado',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public $timestamps = true;

    public function getNombre()
    {
        return $this->nombre;
    }

    public function librosDigitales()
    {
        return $this->hasMany(LibroDigital::class, 'categoria_id');
    }

    public function audiolibros()
    {
        return $this->hasMany(AudioLibro::class, 'categoria_id');
    }

    public function sumarCantidadLibros()
    {
        return $this->librosDigitales()->count() + $this->audiolibros()->count();
    }
}
