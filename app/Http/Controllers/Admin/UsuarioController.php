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
    public function index(Request $request)
    {
        $query = Usuario::query();

        // Si hay búsqueda, filtramos por nombre de usuario, rol o correo
        if (request()->has('search')) {
            $search = request()->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nombre_usuario', 'ilike', "%{$search}%")
                ->orWhere('rol', 'ilike', "%{$search}%")
                ->orWhere('correo', 'ilike', "%{$search}%");
            });
        }

        // Ordenamos alfabéticamente por nombre_usuario
        $query->orderBy('nombre_usuario', 'asc');

        // Paginamos
        $usuarios = $query->paginate(10)->appends($request->query());

        return view('admin.gestion_usuarios', [
            'usuarios' => $usuarios,
            'total' => Usuario::count(),
            'admins' => Usuario::where('rol', 'admin')->count(),
            'empleados' => Usuario::where('rol', 'empleado')->count(),
            'clientes' => Usuario::where('rol', 'cliente')->count()
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
        $request->validate([
            'nombre_completo' => 'required|string|max:100',
            'edad' => 'required|integer|min:0',
            'sexo' => 'required|in:masculino,femenino,otro',
            'nombre_usuario' => 'required|string|unique:usuarios,nombre_usuario',
            'correo' => 'required|email|unique:usuarios,correo',
            'rol' => 'required|in:admin,empleado,cliente',
            'numero_telefono' => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'password' => 'required|confirmed|min:6',
            'url_imagen' => 'nullable|string|max:255',
        ]);

        Usuario::create([
            'nombre_completo' => $request->nombre_completo,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
            'rol' => $request->rol,
            'numero_telefono' => $request->numero_telefono,
            'direccion' => $request->direccion,
            'estado' => 'activo', // Por defecto, el estado es activo
            'contrasena' => Hash::make($request->password),
            'url_imagen' => $request->url_imagen,
        ]);

        return redirect()->back()->with('success', 'Usuario creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $usuario = Usuario::findOrFail($id);
        return response()->json($usuario);
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
            'nombre_completo' => 'required|string|max:255',
            'edad' => 'required|integer|min:0',
            'sexo' => 'required|in:masculino,femenino,otro',
            'nombre_usuario' => 'required|string|unique:usuarios,nombre_usuario,' . $id,
            'correo' => 'required|email|unique:usuarios,correo,' . $id,
            'rol' => 'required|in:admin,empleado,cliente',
            'numero_telefono' => 'nullable|string|max:15',
            'direccion' => 'nullable|string|max:255',
            'url_imagen' => 'nullable|string|max:255',
        ]);

        $usuario->update([
            'nombre_completo' => $request->nombre_completo,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'nombre_usuario' => $request->nombre_usuario,
            'correo' => $request->correo,
            'rol' => $request->rol,
            'numero_telefono' => $request->numero_telefono,
            'direccion' => $request->direccion,
            'url_imagen' => $request->url_imagen,
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
