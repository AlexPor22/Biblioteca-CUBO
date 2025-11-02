<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Database\Eloquent\Model; // Asegúrate de importar Eloquent

class LibrosFisicos extends Authenticatable
{
    // Aquí puedes agregar tus relaciones, atributos y métodos específicos del modelo
    use Notifiable;

    protected $table = 'libros_fisicos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'titulo',
        'autor',
        'categoria_id',
        'codigo',
        'estado',
        'portada_url',
        'fecha_registro',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public $timestamps = true;

    // Metodo para obtener el titulo del libro
    public function getTitulo()
    {
        return $this->titulo;
    }

    // Relacion: un libro fisico pertenece a una categoria
    public function categoria()
    {
        return $this->belongsTo(categoria::class);
    }

    // Metodo para obtener el nombre de la categoria
    public function getNombreCategoria()
    {
        return $this->categoria ? $this->categoria->nombre : "Sin Categoria";
    }

    // Metodo para verificar si el libro esta disponible
    public function getEstadoClass()
    {
        if ($this->estado === 'disponible') {
            return "bg-primary text-white";
        } elseif ($this->estado === 'prestado') {
            return "bg-warning text-dark";
        } elseif ($this->estado === 'reservado') {
            return "bg-info text-dark";
        }

        return "";
    }
}
