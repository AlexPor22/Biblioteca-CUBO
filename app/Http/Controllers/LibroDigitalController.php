<?php

namespace App\Http\Controllers;

use App\Models\LibroDigital;
use App\Models\categoria;
use Illuminate\Http\Request;
use App\Models\Audiolibro;

class LibroDigitalController extends Controller
{

    public function index(Request $request)
    {
        $categoriaId = $request->get('categoria');
        $busqueda = $request->get('buscar');

        $librosQuery = LibroDigital::with('categoria')
            ->where('estado', 'habilitado');

        if ($categoriaId) {
            $librosQuery->where('categoria_id', $categoriaId);
        }

        if ($busqueda) {
            $librosQuery->where(function ($query) use ($busqueda) {
                $query->where('titulo', 'ILIKE', "%$busqueda%")
                    ->orWhere('autor', 'ILIKE', "%$busqueda%")
                    ->orWhereHas('categoria', function ($q) use ($busqueda) {
                        $q->where('nombre', 'ILIKE', "%$busqueda%");
                    });
            });
        }

        $libros = $librosQuery->get();

        $categorias = categoria::select('id', 'nombre')
            ->withCount(['librosDigitales as total' => function ($q) {
                $q->where('estado', 'habilitado');
            }])
            ->orderBy('nombre')
            ->get();

        return view('libros.librosdigitales', compact('libros', 'categorias', 'categoriaId', 'busqueda'));
    }




    /**
     * Muestra el contenido del libro digital (archivo EPUB).
     *
     */
    public function read($codigo)
    {
        // Obtener el libro digital por su código
        $libro = LibroDigital::where('codigo', $codigo)->firstOrFail();

        // Obtener la URL del archivo EPUB desde la base de datos
        $epubUrl = $libro->archivo_url; // Asegúrate de que el campo esté siendo consultado correctamente

        // Verificar si la URL es válida
        if (!$epubUrl) {
            return redirect()->route('libros.index')->with('error', 'El libro no tiene archivo EPUB asociado.');
        }

        // Pasar el libro y la URL del archivo EPUB a la vista
        return view('libros.read', compact('libro', 'epubUrl'));
    }


    /**
     * Muestra el contenido del audiolibro.
     *
     */
    public function listen($codigo)
    {
        $libro = LibroDigital::where('codigo', $codigo)->firstOrFail();
        $audiolibro = Audiolibro::where('codigo', $codigo)->first(); // Buscamos por el mismo código

        return view('libros.listen', compact('libro', 'audiolibro'));
    }
}
