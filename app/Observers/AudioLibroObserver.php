<?php

namespace App\Observers;

use App\Models\AudioLibro;
use App\Models\Categoria;

class AudioLibroObserver
{
    public function created(AudioLibro $audio)
    {
        self::actualizarCantidad($audio->categoria_id);
    }

    public function deleted(AudioLibro $audio)
    {
        self::actualizarCantidad($audio->categoria_id);
    }

    protected static function actualizarCantidad($categoriaId)
    {
        $categoria = Categoria::find($categoriaId);
        if ($categoria) {
            $cantidad = $categoria->librosDigitales()->count() + $categoria->audiolibros()->count();
            $categoria->update(['cantidad_libros' => $cantidad]);
        }
    }
}
