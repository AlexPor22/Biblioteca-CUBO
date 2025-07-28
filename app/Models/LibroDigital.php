<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class LibroDigital extends Authenticatable
{
    use Notifiable;

    protected $table = 'libros_digitales';

    // Definición de los campos que se pueden llenar masivamente
    protected $fillable = [
        'titulo',
        'autor',
        'archivo',
        'categoria_id',
        'estado',
    ];

    protected $hidden = ['created_at', 'updated_at']; // Oculta los campos de timestamps en las respuestas JSON

    public $timestamps = true; // Habilita los timestamps para este modelo

    // Método para obtener el título del libro digital
    public function getTitulo()
    {
        return $this->titulo;
    }

    // Relación: Un libro digital pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    
    // Método para obtener el nombre de la categoría directamente
    public function getNombreCategoria()
    {
        return $this->categoria ? $this->categoria->nombre : 'Sin categoría';
    }

    // Método para obtener el estado del libro digital
    public function getEstadoClass()
    {
        if ($this->estado === 'habilitado') {
            return 'status-habilitado';
        } elseif ($this->estado === 'deshabilitado') {
            return 'status-deshabilitado';
        }

        return '';
    }
}