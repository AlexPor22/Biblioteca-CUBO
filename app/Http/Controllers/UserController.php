<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // Muestra el panel de Login
    public function Login()
    {
        return view('user.loginUser');
    }

    // Muestra el panel de Registro
    public function Registro()
    {
        return view('user.registerUser');
    }

    // Cerrar sesión (solo redirige por ahora)
    public function cerrarSesion()
    {
        return redirect('/login');  // Solo redirige al login
    }
}