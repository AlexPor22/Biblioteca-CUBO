<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibroDigital;
use App\Models\Categoria;

use Kreait\Firebase\Contract\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class LibroDigitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Iniciamos la consulta para obtener los libros digitales
        $query = LibroDigital::query()->with('categoria');

        // Obtenemos todas las categorías habilitadas para el filtro
        $categorias = Categoria::where('estado', 'habilitado')
            ->orderBy('nombre')
            ->get();

             // Ordenamos alfabéticamente por titulo
        $query->orderBy('titulo', 'asc');

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
        $libros_digital = $query
            ->orderBy('titulo', 'asc')
            ->paginate(10)
            ->appends($request->query());

        // Retornar vista con datos
        return view('admin.gestion_libros_digitales', [
            'libros_digital' => $libros_digital,
            'total' => LibroDigital::count(),
            'habilitados' => LibroDigital::where('estado', 'habilitado')->count(),
            'deshabilitados' => LibroDigital::where('estado', 'deshabilitado')->count(),
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
        // Validación de formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'codigo' => 'required|string|unique:libros_digitales,codigo',
            'autor' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'permiso_acceso' => 'required|in:publico,privado',
            'portada_url' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'archivo_url' => 'nullable|mimes:epub|max:50000',
            'estado' => 'required|in:habilitado,deshabilitado',
            'fecha_registro' => 'nullable|date',
        ]);

        // Nombre base para la carpeta y archivos
        $baseName = Str::slug($request->titulo) . '_' . time();
        $folderPath = "libros/{$baseName}/"; // Carpeta única

        try {
            // Instancia de Firebase Storage
            $firebase = app('firebase.storage');
            $bucket   = $firebase->getBucket();
            
            // Portada
            $portada_url = null;
            if ($request->hasFile('portada_url')) {
                $file = $request->file('portada_url');
                $ext  = $file->getClientOriginalExtension() ?: 'jpg';
                $uuid = (string) Str::uuid();
                $path = $folderPath . "portada_{$baseName}." . $ext;

                $bucket->upload(fopen($file->getRealPath(), 'r'), [
                    'name' => $path,
                    'metadata' => ['firebaseStorageDownloadTokens' => $uuid],
                ]);

                $portada_url = "https://firebasestorage.googleapis.com/v0/b/" 
                    . $bucket->name() . "/o/" . rawurlencode($path) 
                    . "?alt=media&token=" . $uuid;
            }

            // EPUB
            $archivo_url = null;
            if ($request->hasFile('archivo_url')) {
                $file = $request->file('archivo_url');
                $ext  = $file->getClientOriginalExtension() ?: 'epub';
                $uuid = (string) Str::uuid();
                $path = $folderPath . "{$baseName}." . $ext;

                $bucket->upload(fopen($file->getRealPath(), 'r'), [
                    'name' => $path,
                    'metadata' => ['firebaseStorageDownloadTokens' => $uuid],
                ]);

                $archivo_url = "https://firebasestorage.googleapis.com/v0/b/" 
                    . $bucket->name() . "/o/" . rawurlencode($path) 
                    . "?alt=media&token=" . $uuid;
            }


        } catch (\Throwable $e) {
            Log::error('Error subiendo archivos a Firebase: ' . $e->getMessage());
        }

        // Guardar libro digital en DB
        LibroDigital::create([
            'titulo' => $request->titulo,
            'codigo' => $request->codigo,
            'autor' => $request->autor,
            'tipo' => 'libro',
            'categoria_id' => $request->categoria_id,
            'permiso_acceso' => $request->permiso_acceso,
            'portada_url' => $portada_url,
            'archivo_url' => $archivo_url,
            'estado' => $request->estado,
            'fecha_registro' => $request->fecha_registro ?: now(),
        ]);

        return redirect()->back()->with('success', 'Libro digital creado exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $libroDigital = LibroDigital::with('categoria')->findOrFail($id);

        return response()->json([
            'titulo' => $libroDigital->titulo,
            'codigo' => $libroDigital->codigo,
            'autor' => $libroDigital->autor,
            'categoria' => $libroDigital->categoria->nombre ?? 'Sin categoría',
            'estado' => $libroDigital->estado,
            'tipo' => $libroDigital->tipo,
            'fecha_registro' => $libroDigital->fecha_registro,
            'permiso_acceso' => $libroDigital->permiso_acceso,
            'portada_url' => $libroDigital->portada_url,
            'archivo_url' => $libroDigital->archivo_url,
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
        $libroDigital = LibroDigital::findOrFail($id);

        // Validamos los datos del formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'codigo' => 'required|string|unique:libros_digitales,codigo,' . $libroDigital->id,
            'autor' => 'required|string|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'permiso_acceso' => 'required|in:publico,privado',
            //'portada_url' => 'required|url',
            //'archivo_url' => 'required|url',
            'estado' => 'required|in:habilitado,deshabilitado',
            'fecha_registro' => 'nullable|date',
        ]);

        // Actualizamos el libro digital
        $libroDigital->update([
            'titulo' => $request->titulo,
            'codigo' => $request->codigo,
            'autor' => $request->autor,
            'categoria_id' => $request->categoria_id,
            'permiso_acceso' => $request->permiso_acceso,
            //'portada_url' => $request->portada_url,
            //'archivo_url' => $request->archivo_url,
            'estado' => $request->estado,
            'fecha_registro' => $request->fecha_registro ?: now(),
        ]);

        return redirect()->back()->with('success', 'Libro digital actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $libroDigital = LibroDigital::findOrFail($id);

        try {
            $firebase = app('firebase.storage');
            $bucket   = $firebase->getBucket();

            // Extraer el nombre base de la URL para identificar la carpeta
            if ($libroDigital->archivo_url) {
                $parsedUrl = parse_url($libroDigital->archivo_url);
                $pathWithToken = urldecode(substr($parsedUrl['path'], strpos($parsedUrl['path'], '/o/') + 3));
                
                // La carpeta es todo lo que va hasta el último '/'
                $folder = substr($pathWithToken, 0, strrpos($pathWithToken, '/') + 1);

                // Listar todos los objetos dentro de la carpeta
                $objects = $bucket->objects(['prefix' => $folder]);

                foreach ($objects as $object) {
                    $object->delete(); // Borrar cada archivo
                }
            }
        } catch (\Throwable $e) {
            Log::error('Error eliminando archivos de Firebase: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al eliminar archivos en Firebase.');
        }

        // Eliminar el registro en la base de datos
        $libroDigital->delete();

        return redirect()->back()->with('success', 'Libro digital eliminado exitosamente.');
    }

}
