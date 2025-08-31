<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Contract\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Usuario::query();

        // Si hay búsqueda, filtramos por nombre de usuario, rol o correo
        if ($request->has('search')) {
            $search = $request->input('search');
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
    public function store(Request $request, Storage $storage)
    {
        // Si tu tabla real es 'usuario', usa 'unique:usuario,...'
        $request->validate([
            'nombre_completo'  => 'required|string|max:100',
            'edad'             => 'required|integer|min:0',
            'sexo'             => 'required|in:masculino,femenino,otro',
            'nombre_usuario'   => 'required|string|unique:usuarios,nombre_usuario',
            'correo'           => 'required|email|unique:usuarios,correo',
            'rol'              => 'required|in:admin,empleado,cliente',
            'numero_telefono'  => 'required|string|max:15',
            'direccion'        => 'required|string|max:255',
            'password'         => 'required|confirmed|min:6',
            'imagen_perfil'    => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        // Avatar por defecto (NO NULL)
        $defaultAvatar = 'https://ui-avatars.com/api/?name='
            . urlencode($request->nombre_completo ?: 'Usuario')
            . '&background=2C7A7B&color=fff&size=256';

        // Crear usuario con avatar por defecto
        $usuario = Usuario::create([
            'nombre_completo'  => $request->nombre_completo,
            'edad'             => $request->edad,
            'sexo'             => $request->sexo,
            'nombre_usuario'   => $request->nombre_usuario,
            'correo'           => $request->correo,
            'rol'              => $request->rol,
            'numero_telefono'  => $request->numero_telefono,
            'direccion'        => $request->direccion,
            'estado'           => 'activo',
            'contrasena'       => Hash::make($request->password),
            'url_imagen'       => $defaultAvatar,
        ]);

        // Subir imagen si viene archivo
        if ($request->hasFile('imagen_perfil')) {
            try {
                $file   = $request->file('imagen_perfil');

                // Usa el bucket del .env; si no está, cae a 'dbcubodatos'
                $bucketName = env('FIREBASE_STORAGE_DEFAULT_BUCKET', 'dbcubodatos');
                $bucket     = $storage->getBucket($bucketName);

                $ext  = $file->getClientOriginalExtension() ?: 'jpg';
                $uuid = (string) Str::uuid();
                $path = "usuarios/{$usuario->id}/perfil_" . time() . '.' . $ext;

                $bucket->upload(
                    fopen($file->getRealPath(), 'r'),
                    [
                        'name' => $path,
                        'metadata' => [
                            // Token para descarga pública con URL firmada de Firebase
                            'firebaseStorageDownloadTokens' => $uuid,
                        ],
                    ]
                );

                $publicUrl = "https://firebasestorage.googleapis.com/v0/b/" .
                            $bucket->name() . "/o/" . rawurlencode($path) .
                            "?alt=media&token=" . $uuid;

                $usuario->url_imagen = $publicUrl;

                // Si tienes columna imagen_path, la guardamos (útil para borrar en update)
                if (Schema::hasColumn($usuario->getTable(), 'imagen_path')) {
                    $usuario->imagen_path = $path;
                }

                $usuario->save();

            } catch (\Throwable $e) {
                Log::error('Error subiendo imagen a Firebase: '.$e->getMessage());
                // nos quedamos con $defaultAvatar si falla
            }
        }

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
            //'url_imagen' => 'nullable|string|max:255',
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
            //'url_imagen' => $request->url_imagen,
        ]);

        return redirect()->back()->with('success', 'Usuario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(string $id, Storage $storage) 
    {
        // 1) Busca el usuario
        $usuario = Usuario::findOrFail($id);

        // 2) Intenta borrar su carpeta en Firebase Storage
        try {
            // Usa el bucket del .env; si no hay, cae a tu bucket “dbcubodatos”
            $bucketName = env('FIREBASE_STORAGE_DEFAULT_BUCKET', 'dbcubodatos');
            $bucket     = $storage->getBucket($bucketName);

            // Carpeta donde guardaste sus imágenes
            $prefix = "usuarios/{$usuario->id}/";

            // Lista y borra todos los objetos bajo ese prefijo
            foreach ($bucket->objects(['prefix' => $prefix]) as $object) {
                $object->delete();
            }
        } catch (\Throwable $e) {
            Log::warning("No se pudo borrar la carpeta del usuario {$usuario->id} en Storage: ".$e->getMessage());
            // No bloqueamos la eliminación del usuario por esto.
        }

        // 3) Elimina el registro (duro; si usas SoftDeletes, considera forceDelete())
        $usuario->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente');
    }

}
