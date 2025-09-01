<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LibroDigital;
use App\Models\Audiolibro;

class ContenidoRecienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Trae los últimos N por tipo
        $limite = 10;

        // Mapea libros a un formato común
        $libros = LibroDigital::select('id','titulo','autor','estado','created_at')
            ->latest('created_at')
            ->take($limite)
            ->get()
            ->map(function ($l) {
                return [
                    'tipo'       => 'libro',            // para icono y etiqueta
                    'id'         => $l->id,
                    'titulo'     => $l->titulo,
                    'autor'      => $l->autor,
                    'estado'     => $l->estado ?? 'borrador', // ajusta si usas otro campo/enum
                    'created_at' => $l->created_at,
                ];
            });

        // Mapea audiolibros a un formato común
        $audios = Audiolibro::select('id','titulo','autor','narrador','estado','created_at')
            ->latest('created_at')
            ->take($limite)
            ->get()
            ->map(function ($a) {
                return [
                    'tipo'       => 'audio',
                    'id'         => $a->id,
                    'titulo'     => $a->titulo,
                    // prioriza autor, si no hay, usa narrador
                    'autor'      => $a->autor ?: ($a->narrador ?? 'Autor/Narrador'),
                    'estado'     => $a->estado ?? 'borrador',
                    'created_at' => $a->created_at,
                ];
            });

        // Une y ordena por fecha (más reciente primero)
        $items = $libros->merge($audios)
                        ->sortByDesc('created_at')
                        ->values();

        // Contadores para estadísticas
        $contadorLibros = LibroDigital::count();
        $contadorAudios = Audiolibro::count();

        return view('admin.contenido_reciente', [
            'items' => $items,
            'contadorLibros' => $contadorLibros,
            'contadorAudios' => $contadorAudios,
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
