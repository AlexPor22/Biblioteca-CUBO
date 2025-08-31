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

    // Cerrar sesión
    public function cerrarSesion(Request $request)
    {
        auth()->logout(); // Cierra la sesión del administrador
        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF

        return redirect('/');  // Redirige al inicio después de cerrar sesión
    }
}
