<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AudioLibro extends Authenticatable
{
    use Notifiable;

    protected $table = 'audiolibros';

    // Definición de los campos que se pueden llenar masivamente
    protected $fillable = [
        'titulo',
        'autor',
        'duracion',
        'archivo',
        'categoria_id',
        'estado',
    ];

    protected $hidden = ['created_at', 'updated_at']; // Oculta los campos de timestamps en las respuestas JSON

    public $timestamps = true; // Habilita los timestamps para este modelo

    // Método para obtener el título del audiolibro
    public function getTitulo()
    {
        return $this->titulo;
    }

    // Relación: Un audiolibro pertenece a una categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    
    // Método para obtener el nombre de la categoría directamente
    public function getNombreCategoria()
    {
        return $this->categoria ? $this->categoria->nombre : 'Sin categoría';
    }

    // Método para obtener el estado del audiolibro
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