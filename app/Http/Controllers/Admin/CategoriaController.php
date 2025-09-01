<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = categoria::query();

        // Filtro de búsqueda por nombre o estado
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                ->orWhere('estado', 'LIKE', "%{$search}%");
            });
        }

        // Ordenar por nombre alfabéticamente
        $query->orderBy('nombre', 'asc');

        // Paginamos los resultados
        $categoriasPaginadas = $query->paginate(10)->appends(request()->query());

        // Obtenemos todas las categorías con relaciones para sumar libros
        $categoriasConRelaciones = categoria::with(['librosDigitales', 'audiolibros'])->get();

        // Sumamos libros digitales + audiolibros
        $totalLibros = $categoriasConRelaciones->sum(function ($categoria) {
            return $categoria->librosDigitales->count() + $categoria->audiolibros->count();
        });

        // Retornamos la vista
        return view('admin.gestion_categorias', [
            'categorias' => $categoriasPaginadas,
            'total' => categoria::count(),
            'totalCategorias' => categoria::where('estado', 'habilitado')->count(),
            'totalDeshabilitadas' => categoria::where('estado', 'deshabilitado')->count(),
            'totallibros' => $totalLibros
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
        //
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre',
            'estado' => 'required|in:habilitado,deshabilitado',
        ]);

        categoria::create([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        return redirect()->back()->with('success', 'Categoría agregada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }
public function buscar(Request $request)
{
    dd('¡Sí entra!');
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
        $categorias = categoria::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $id,
            'estado' => 'required|in:habilitado,deshabilitado',
        ]);

        $categorias->update([
            'nombre' => $request->nombre,
            'estado' => $request->estado,
        ]);

        return redirect()->back()->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categoria = categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->back()->with('success', 'Categoría eliminada exitosamente.');
    }
}
