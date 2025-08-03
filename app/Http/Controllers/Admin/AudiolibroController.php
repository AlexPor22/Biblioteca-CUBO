<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AudioLibro;
use Illuminate\Http\Request;
use App\Models\Categoria;
class AudiolibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Iniciamos la consulta para obtener los audiolibros
        $query = AudioLibro::query()->with('categoria');

        // Obtenemos todas las categorías habilitadas para el filtro
        $categorias = Categoria::where('estado', 'habilitado')
            ->orderBy('nombre')
            ->get();

        // Si hay búsqueda, filtramos por título, autor, código, estado, tipo o categoría
        if ($request->has('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('titulo', 'ilike', "%{$search}%")
                ->orWhere('autor', 'ilike', "%{$search}%")
                ->orWhere('codigo', 'ilike', "%{$search}%")
                ->orWhere('estado', 'ilike', "%{$search}%")
                ->orWhere('tipo', 'ilike', "%{$search}%")
                ->orWhereHas('categoria', function ($sub) use ($search) {
                    $sub->where('nombre', 'ilike', "%{$search}%");
                });
            });
        }

        // Ordenar alfabéticamente por título
        $audiolibros = $query
            ->orderBy('titulo', 'asc')
            ->paginate(10)
            ->appends($request->query());
        
        // Retornar vista con datos
        return view('admin.gestion_audiolibros', [
            'audiolibros' => $audiolibros,
            'total' => AudioLibro::count(),
            'habilitados' => AudioLibro::where('estado', 'habilitado')->count(),
            'deshabilitados' => AudioLibro::where('estado', 'deshabilitado')->count(),
            'categorias' => $categorias
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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $audiolibro = AudioLibro::findOrFail($id);
        $audiolibro->delete();

        return redirect()->route('admin.gestionAudiolibros')->with('success', 'Audiolibro eliminado correctamente.');
    }
}
