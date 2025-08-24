<?php

namespace App\Observers;

use App\Models\LibroDigital;
use App\Models\Categoria;

class LibroDigitalObserver
{
    public function created(LibroDigital $libro)
    {
        self::actualizarCantidad($libro->categoria_id);
    }

    public function deleted(LibroDigital $libro)
    {
        self::actualizarCantidad($libro->categoria_id);
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
