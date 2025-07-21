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

     // Muestra el panel de Galeria
    public function Galeria()
    {
        return view('user.galeria');
    }

    public function Informacion()
    {
        return view('user.informacion');
    }


}