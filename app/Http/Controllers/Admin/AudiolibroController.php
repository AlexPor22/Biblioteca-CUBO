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
        // Validamos los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'codigo' => 'required|string|unique:audiolibros,codigo',
            'autor' => 'required|string|max:100',
            'narrador' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'duracion' => 'required|string|max:20', // Formato "HH:MM:SS"
            'portada_url' => 'required|url',
            'audio_url' => 'required|url',
            'estado' => 'required|in:habilitado,deshabilitado',
            'fecha_registro' => 'nullable|date',
        ]);

        // Creamos el nuevo audiolibro con los datos validados
        AudioLibro::create([
            'titulo' => $request->titulo,
            'codigo' => $request->codigo,
            'autor' => $request->autor,
            'narrador' => $request->narrador,
            'tipo' => 'audiolibro', // Por defecto será 'audiolibro'
            'categoria_id' => $request->categoria_id,
            'duracion' => $request->duracion,
            'portada_url' => $request->portada_url,
            'audio_url' => $request->audio_url,
            'estado' => $request->estado,
            'fecha_registro' => $request->fecha_registro ?: now(),
        ]);

        return redirect()->back()->with('success', 'Audiolibro creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $audiolibro = AudioLibro::with('categoria')->findOrFail($id);

        return response()->json([
            'titulo' => $audiolibro->titulo,
            'codigo' => $audiolibro->codigo,
            'autor' => $audiolibro->autor,
            'narrador' => $audiolibro->narrador,
            'categoria' => $audiolibro->categoria->nombre ?? 'Sin categoría',
            'duracion' => $audiolibro->duracion,
            'portada_url' => $audiolibro->portada_url,
            'audio_url' => $audiolibro->audio_url,
            'estado' => $audiolibro->estado,
            'tipo' => $audiolibro->tipo,
            'fecha_registro' => $audiolibro->fecha_registro,
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
        // Obtenemos el audiolibro por su ID
        $audiolibro = AudioLibro::findOrFail($id);

        // Validamos los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'codigo' => 'required|string|unique:audiolibros,codigo,' . $audiolibro->id,
            'autor' => 'required|string|max:100',
            'narrador' => 'nullable|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'duracion' => 'nullable|string|max:20', // Formato "HH:MM:SS"
            'portada_url' => 'nullable|url',
            'audio_url' => 'required|url',
            'estado' => 'required|in:habilitado,deshabilitado',
            'fecha_registro' => 'nullable|date',
        ]);

        // Actualizamos el audiolibro con los datos validados
        $audiolibro->update([
            'titulo' => $request->titulo,
            'codigo' => $request->codigo,
            'autor' => $request->autor,
            'narrador' => $request->narrador,
            'categoria_id' => $request->categoria_id,
            'duracion' => $request->duracion,
            'portada_url' => $request->portada_url,
            'audio_url' => $request->audio_url,
            'estado' => $request->estado,
            'fecha_registro' => $request->fecha_registro ?: now(),
        ]);

        return redirect()->back()->with('success', 'Audiolibro actualizado correctamente.');
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
