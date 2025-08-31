<?php
namespace App\Http\Controllers;
use App\Models\Usuario; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    // Muestra el panel de Login
    public function Login()
    {
        return view('user.loginUser');
    }
    // Muestra el panel de registro
    public function Registro()
    {
        return view('user.registerUser');
    }

    // Guardar usuario
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre'     => 'required|string|max:255',
            'edad'       => 'nullable|integer|min:18',
            'sexo'       => 'nullable|in:masculino,femenino,otro',
            'correo'     => 'required|email:rfc,dns|unique:usuarios,correo',
            'username'   => 'required|string|min:3|max:50|unique:usuarios,nombre_usuario',
            'telefono'   => 'nullable|string|max:20',
            'direccion'  => 'nullable|string|max:255',
            'password'   => 'required|string|min:8|confirmed',
            'imagen'     => 'nullable|image|max:2048',
        ]);

        // Avatar por defecto (NO NULL)
        $defaultAvatar = 'https://ui-avatars.com/api/?name='
            . urlencode($request->nombre_completo ?: 'Usuario')
            . '&background=2C7A7B&color=fff&size=256';

        $usuario = Usuario::create([
            'nombre_completo' => $validated['nombre'],
            'edad'            => $validated['edad'] ?? null,
            'sexo'            => $validated['sexo'] ?? null,
            'nombre_usuario'  => $validated['username'],
            'correo'          => $validated['correo'],
            'numero_telefono' => $validated['telefono'] ?? null,
            'direccion'       => $validated['direccion'] ?? null,
            'contrasena'      => Hash::make($validated['password']),
            'imagen'          => $defaultAvatar,
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('perfiles', 'public'); // storage/app/public/perfiles
            $usuario->update(['url_imagen' => $path]);
        }

        auth()->login($usuario);

         // Redirigir a la vista de libros digitales

return redirect()->route('libros.digitales')->with('success', '¡Registro exitoso! Disfruta de la biblioteca.');

    }

    // para iniciar sesion
public function loginUser(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Buscar usuario por correo
    $usuario = Usuario::where('correo', $credentials['email'])->first();

    if (!$usuario) {
        return back()->withErrors([
            'email' => 'Correo no registrado.',
        ])->withInput();
    }

    if (!\Hash::check($credentials['password'], $usuario->contrasena)) {
        return back()->withErrors([
            'password' => 'Contraseña incorrecta.',
        ])->withInput();
    }

    // Iniciar sesión solo una vez
    auth()->login($usuario);

    // ✅ Redirección según rol
    switch ($usuario->rol) {
        case 'admin':
            return redirect()->route('admin.panel')->with('success', '¡Bienvenido Administrador!');
        default: // cliente
            return redirect()->route('libros.digitales')->with('success', '¡Bienvenido de nuevo!');
    }
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

public function perfil()
{
    $usuario = auth()->user();
    return view('user.perfil', compact('usuario'));
}


     // actulizar perfil
public function actualizarPerfil(Request $request)
{
    $usuario = auth()->user();

    $validated = $request->validate([
        'nombre'    => 'required|string|max:255',
        'edad'      => 'nullable|integer|min:18',
        'sexo'      => 'nullable|in:masculino,femenino,otro',
        'correo'    => [
            'required','email:rfc,dns',
            Rule::unique('usuarios','correo')->ignore($usuario->id),
        ],
        'username'  => [
            'required','string','min:3','max:50',
            Rule::unique('usuarios','nombre_usuario')->ignore($usuario->id),
        ],
        'telefono'  => 'nullable|string|max:20',
        'direccion' => 'nullable|string|max:255',
    ]);

    $usuario->update([
        'nombre_completo' => $validated['nombre'],
        'edad'            => $validated['edad'] ?? null,
        'sexo'            => $validated['sexo'] ?? null,
        'correo'          => $validated['correo'],
        'nombre_usuario'  => $validated['username'],
        'numero_telefono' => $validated['telefono'] ?? null,
        'direccion'       => $validated['direccion'] ?? null,
    ]);

    return back()->with('success', 'Perfil actualizado correctamente.');
}

public function actualizarPassword(Request $request)
{
    $usuario = auth()->user();

    $request->validate([
        'password_actual' => 'required|string',
        'password'        => 'required|string|min:8|confirmed',
    ]);

    if (! Hash::check($request->password_actual, $usuario->contrasena)) {
        return back()->withErrors(['password_actual' => 'La contraseña actual no es correcta.']);
    }

    $usuario->update([
        'contrasena' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Contraseña actualizada correctamente.');
}
public function actualizarImagen(Request $request)
{
    $usuario = auth()->user();

    $request->validate([
        'imagen' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    // Borrar imagen anterior si no es la por defecto y existe físicamente
    if ($usuario->url_imagen && !str_starts_with($usuario->url_imagen, 'http')) {
        Storage::disk('public')->delete($usuario->url_imagen);
    }

    $path = $request->file('imagen')->store('perfiles', 'public'); // storage/app/public/perfiles
    $usuario->update(['url_imagen' => $path]);

    return back()->with('success', 'Imagen de perfil actualizada.');
}

}

