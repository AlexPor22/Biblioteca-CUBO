<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LibrosFisicos; // Cambié aquí de LibroFisico a LibrosFisicos
use App\Models\Categoria;
use App\Models\Prestamo;
use Illuminate\Support\Facades\Auth;

class PrestamosController extends Controller
{
    // Método para mostrar los libros y el formulario de préstamo
    public function solicitarPrestamo()
    {
        // Obtener todos los libros físicos disponibles
        $libros = LibrosFisicos::where('estado', 'disponible')->get(); // Cambié de LibroFisico a LibrosFisicos
        // Obtener las categorías para el sidebar
        $categorias = Categoria::all();

        // Pasar los datos a la vista 'prestamos.prestamos'
        return view('prestamos.prestamos', compact('libros', 'categorias'));
    }

    // Método para manejar la solicitud del préstamo
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'libro_id' => 'required|exists:libros_fisicos,id', // Cambié de libros_fisicos a libros_fisicos
            'nombre_usuario' => 'required|string|max:255',
            'correo' => 'required|email',
            'fecha_prestamo' => 'required|date',
            'fecha_devolucion' => 'required|date',
        ]);

        // Crear el préstamo
        $prestamo = new Prestamo();
        $prestamo->usuario_id = Auth::user()->id; // Asumiendo que el usuario está logueado
        $prestamo->libro_fisico_id = $request->libro_id;
        $prestamo->fecha_prestamo = $request->fecha_prestamo;
        $prestamo->fecha_devolucion = $request->fecha_devolucion;
        $prestamo->estado = 'activo';
        $prestamo->telefono = $request->telefono; // Si deseas incluir teléfono
        $prestamo->save();

        // Cambiar el estado del libro
        $libro = LibrosFisicos::find($request->libro_id); // Cambié de LibroFisico a LibrosFisicos
        $libro->estado = 'prestado';
        $libro->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('prestamos.index')->with('success', 'Préstamo solicitado exitosamente.');
    }
}
