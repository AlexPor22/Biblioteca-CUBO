<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibroDigital;
use App\Models\Audiolibro;
use App\Models\LibrosFisicos;

class ContenidoRecienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Límite de registros por tipo
        $limite = 3;

        // 🔹 Libros digitales
        $libros = LibroDigital::select('id', 'titulo', 'autor', 'estado', 'created_at')
            ->latest('created_at')
            ->take($limite)
            ->get()
            ->map(function ($l) {
                return [
                    'tipo'       => 'digital',
                    'id'         => $l->id,
                    'titulo'     => $l->titulo,
                    'autor'      => $l->autor,
                    'estado'     => $l->estado ?? 'borrador',
                    'created_at' => $l->created_at,
                ];
            });

        // 🔹 Audiolibros
        $audios = Audiolibro::select('id', 'titulo', 'autor', 'narrador', 'estado', 'created_at')
            ->latest('created_at')
            ->take($limite)
            ->get()
            ->map(function ($a) {
                return [
                    'tipo'       => 'audio',
                    'id'         => $a->id,
                    'titulo'     => $a->titulo,
                    'autor'      => $a->autor ?: ($a->narrador ?? 'Autor/Narrador'),
                    'estado'     => $a->estado ?? 'borrador',
                    'created_at' => $a->created_at,
                ];
            });

        // 🔹 Libros físicos
        $fisicos = LibrosFisicos::select('id', 'titulo', 'autor', 'estado', 'created_at')
            ->latest('created_at')
            ->take($limite)
            ->get()
            ->map(function ($f) {
                return [
                    'tipo'       => 'fisico',
                    'id'         => $f->id,
                    'titulo'     => $f->titulo,
                    'autor'      => $f->autor,
                    'estado'     => $f->estado ?? 'desconocido',
                    'created_at' => $f->created_at,
                ];
            });

        // 🔹 Unir y ordenar por fecha (más reciente primero)
        $items = collect()
            ->merge($libros)
            ->merge($audios)
            ->merge($fisicos)
            ->sortByDesc('created_at')
            ->values();

        // 🔹 Contadores para estadísticas
        return view('admin.contenido_reciente', [
            'items' => $items,
            'contadorLibros' => LibroDigital::count(),
            'contadorAudios' => Audiolibro::count(),
            'contadorLibrosFisicos' => LibrosFisicos::count(),
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
    }
}
