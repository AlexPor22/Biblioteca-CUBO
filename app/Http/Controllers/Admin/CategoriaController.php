<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias = Categoria::all();
        $total = $categorias->count();
        $totalCategorias = $categorias->count();

        return view('admin.gestion_categorias', compact('categorias', 'total', 'totalCategorias'));
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
            'nombre' => 'required|string|max:100',
            'estado' => 'required|in:habilitado,deshabilitado',
        ]);

        Categoria::create([
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
        $categorias = Categoria::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:100',
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
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->back()->with('success', 'Categoría eliminada exitosamente.');
    }
}
