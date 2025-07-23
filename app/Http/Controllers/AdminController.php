<?php
namespace App\Http\Controllers;

class AdminController extends Controller
{
    // Muestra el panel de administración
    public function panelAdministracion()
    {
        return view('admin.panel_administracion');
    }

    // Cerrar sesión (solo redirige por ahora)
    public function cerrarSesion()
    {
        return redirect('/');  // Solo redirige al inicio
    }
}