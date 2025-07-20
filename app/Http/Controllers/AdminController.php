<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Muestra el panel de administración
    public function panelAdministracion()
    {
        return view('admin.panel_administracion');
    }

    // Gestión de usuarios 
    public function gestionUsuarios()
    {
        return view('admin.gestion_usuarios');
    }

    // Gestión de categorías
    public function gestionCategorias()
    {
        return view('admin.gestion_categorias');
    }

    // Gestión de préstamos
    public function gestionPrestamos()
    {
        return view('admin.gestion_prestamos');
    }

    // Gestión de libros y audiolibros
    public function gestionLibrosAudiolibros()
    {
        return view('admin.gestion_libros_audiolibros');
    }

    // Préstamos recientes
    public function prestamosRecientes()
    {
        return view('admin.prestamos_recientes');
    }

    // Contenido reciente
    public function contenidoReciente()
    {
        return view('admin.contenido_reciente');
    }

    // Estadisticas del sistema
    public function estadisticasSistema()
    {
        return view('admin.estadisticas_sistema');
    }

    // Cerrar sesión (solo redirige por ahora)
    public function cerrarSesion()
    {
        return redirect('/');  // Solo redirige al inicio
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
}