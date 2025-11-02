<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibrosFisicos;
use App\Models\categoria;

class LibrosFisicosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Iniciamos la consulta para obtener los libros fisicos con su categoria
        $query = LibrosFisicos::query()->with('categoria');

        // Obtenemos todas las categorias habilitadas para el filtro
        $categorias = categoria::where('estado', 'habilitado')
            ->orderBy('nombre')
            ->get();

        // Si hay busqueda filtramos por titulo, autor
        if ($search = request('search')) {
            $search = request()->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'ilike', "%{$search}%")
                  ->orWhere('autor', 'ilike', "%{$search}%")
                  ->orWhereHas('categoria', function ($sub) use ($search) {
                      $sub->where('nombre', 'ilike', "%{$search}%");
                  });
            });
        }

        // Ordenamos alafabeticamente por titulo
        $libro_fisico = $query
            ->orderBy('titulo', 'asc')
            ->paginate(10)
            ->appends($request->query());

        // Retornamos a la vista con los datos
        return view('admin.gestion_libros', [
            'libro_fisico' => $libro_fisico,
            'total' => LibrosFisicos::count(),
            'disponibles' => LibrosFisicos::where('estado', 'disponible')->count(),
            'prestados' => LibrosFisicos::where('estado', 'prestado')->count(),
            'reservados' => LibrosFisicos::where('estado', 'reservado')->count(),
            'categorias' => $categorias,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'codigo' => 'required|string|max:100|unique:libros_fisicos,codigo',
            'autor' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'portada_url' => 'nullable|url|max:255',
            'estado' => 'required|in:disponible,prestado,reservado',
            'fecha_registro' => 'nullable|date',
        ]);

        // Crear un nuevo libro fisico
        LibrosFisicos::create([
            'titulo' => $request->titulo,
            'codigo' => $request->codigo,
            'autor' => $request->autor,
            'categoria_id' => $request->categoria_id,
            'portada_url' => $request->portada_url,
            'estado' => $request->estado,
            'fecha_registro' => $request->fecha_registro ?: now(),
        ]);

        // Redirigir de vuelta con un mensaje de exito
        return redirect()->back()->with('success', 'Libro físico creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostrar los detalles del libro físico
        $libro = LibrosFisicos::with('categoria')->findOrFail($id);

        return response()->json([
            'titulo' => $libro->getTitulo(),
            'codigo' => $libro->codigo,
            'autor' => $libro->autor,
            'categoria' => $libro->categoria->nombre ?? 'Sin Categoria',
            'portada_url' => $libro->portada_url,
            'estado' => ucfirst($libro->estado), // sin método extra
            //'estado' => $libro->getEstado(),
            'fecha_registro' => $libro->fecha_registro,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $libroFisico = LibrosFisicos::findOrFail($id);

        // Validar los datos recibidos
        $request->validate([
            'titulo' => 'required|string|max:255',
            'codigo' => 'required|string|max:100|unique:libros_fisicos,codigo,' . $libroFisico->id,
            'autor' => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'portada_url' => 'nullable|url|max:255',
            'estado' => 'required|in:disponible,prestado,reservado',
            'fecha_registro' => 'nullable|date',
        ]);

        // Actualizar los datos del libro fisico
        $libroFisico->update([
            'titulo' => $request->titulo,
            'codigo' => $request->codigo,
            'autor' => $request->autor,
            'categoria_id' => $request->categoria_id,
            'portada_url' => $request->portada_url,
            'estado' => $request->estado,
            'fecha_registro' => $request->fecha_registro ?: now(),
        ]);

        // Redirigir de vuelta con un mensaje de exito
        return redirect()->back()->with('success', 'Libro físico actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar el libro físico
        $libroFisico = LibrosFisicos::findOrFail($id);
        $libroFisico->delete();

        // Redirigir de vuelta con un mensaje de exito
        return redirect()->back()->with('success', 'Libro físico eliminado exitosamente.');
    }
}
