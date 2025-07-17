<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Muestra el panel de administración
    public function index()
    {
        return view('admin.index');
    }

    // Gestión de usuarios
    public function usuarios()
    {
        return view('admin.usuarios');
    }

    // Gestión de empleados
    public function empleados()
    {
        return view('admin.empleados');
    }

    // Gestión de clientes
    public function clientes()
    {
        return view('admin.clientes');
    }

    // Gestión de categorías de libros
    public function categoriasLibros()
    {
        return view('admin.categoriasLibros');
    }

    // Publicación de libros y audiolibros
    public function publicar()
    {
        return view('admin.publicar');
    }

    // Gestión de préstamos
    public function prestamos()
    {
        return view('admin.prestamos');
    }

    // Ver libros
    public function verLibros()
    {
        return view('admin.verLibros');
    }

    // Cerrar sesión (solo redirige por ahora)
    public function cerrarSesion()
    {
        return redirect('/');  // Solo redirige al inicio
    }

    // Historial de préstamos
    public function historialPrestamo()
    {
        return view('admin.prestamosHistorial');
    }

}