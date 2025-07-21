<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


/************************************************************************************************************** */
use App\Models\Usuario; //NECESARIO PARA USAR EL MODELO Usuario
use Illuminate\Support\Facades\Hash; //NECESARIO PARA ENCRIPTAR CONTRASEÑAS
/************************************************************************************************************** */

class AdminController extends Controller
{
    // Muestra el panel de administración
    public function panelAdministracion()
    {
        return view('admin.panel_administracion');
    }

    /***************************************************************************************************************/
    // Gestión de usuarios
    public function gestionUsuarios() // Muestra la lista de usuarios y estadísticas
    {
        $usuarios = Usuario::all();

        $total = $usuarios->count();
        $admins = $usuarios->where('rol', 'admin')->count();
        $empleados = $usuarios->where('rol', 'empleado')->count();
        $clientes = $usuarios->where('rol', 'cliente')->count();


        return view('admin.gestion_usuarios', compact('usuarios', 'total', 'admins', 'empleados', 'clientes'));
    }

    public function storeUsuario(Request $request){ // Crear un nuevo usuario
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

    public function updateUsuario(Request $request, $id) // Actualizar un usuario existente
    {
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

    public function destroyUsuario($id) // Eliminar usuario
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente');
    }

    /***************************************************************************************************************/

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