<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $usuarios = Usuario::all();

        $total = $usuarios->count();
        $admins = $usuarios->where('rol', 'admin')->count();
        $empleados = $usuarios->where('rol', 'empleado')->count();
        $clientes = $usuarios->where('rol', 'cliente')->count();


        return view('admin.gestion_usuarios', compact('usuarios', 'total', 'admins', 'empleados', 'clientes'));
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
            'nombre_completo' => 'required|string|max:100',
            'edad' => 'required|integer|min:0',
            'sexo' => 'required|in:masculino,femenino,otro',
            'nombre_usuario' => 'required|string|unique:usuarios,nombre_usuario',
            'correo' => 'required|email|unique:usuarios,correo',
            'rol' => 'required|in:admin,empleado,cliente',
            'password' => 'required|confirmed|min:6',
        ]);

        Usuario::create([
            'nombre_completo' => $request->nombre_completo,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
            'rol' => $request->rol,
            'contrasena' => Hash::make($request->password),
            'estado' => 'activo'
        ]);

        return redirect()->back()->with('success', 'Usuario creado exitosamente.');
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
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre_completo' => 'required|string|max:100',
            'edad' => 'required|integer|min:0',
            'sexo' => 'required|in:masculino,femenino,otro',
            'nombre_usuario' => 'required|string|unique:usuarios,nombre_usuario,' . $id,
            'correo' => 'required|email|unique:usuarios,correo,' . $id,
            'rol' => 'required|in:admin,empleado,cliente',
        ]);

        $usuario->update([
            'nombre_completo' => $request->nombre_completo,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
            'rol' => $request->rol
        ]);

        return redirect()->back()->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente');
    }
}
