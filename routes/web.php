<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UsuarioController as AdminUsuarioController;
use App\Http\Controllers\Admin\CategoriaController as AdminCategoriaController;
use App\Http\Controllers\Admin\PrestamoController as AdminPrestamoController;
use App\Http\Controllers\Admin\AudiolibroController as AdminAudiolibroController;
use App\Http\Controllers\Admin\LibroDigitalController as AdminLibroDigitalController;
use App\Http\Controllers\Admin\PrestamoRecienteController as AdminPrestamoRecienteController;
use App\Http\Controllers\Admin\ContenidoRecienteController as AdminContenidoRecienteController;
use App\Http\Controllers\Admin\LibrosFisicosController as AdminLibrosFisicosController;
use App\Http\Controllers\Admin\EstadisticasController as AdminEstadisticasController;

use App\Http\Controllers\LibroDigitalController;
use App\Http\Controllers\PrestamosController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Usuario;

//RUTA INICIO 
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Panel de admin me deireg al panel si soy admin
Route::get('/admin/panel', function () {
    return view('admin.panel_administracion');
})->name('admin.panel')->middleware('auth');

Route::middleware(['auth', IsAdmin::class])->group(function () {
});


    // Rutas del Panel de Administración (sin autenticación)
    Route::get('/admin', [AdminController::class, 'panelAdministracion'])->name('admin.panelAdministracion');

    // Rutas de gestión de usuarios del panel de administración
    Route::get('/admin/gestion/usuarios', [AdminUsuarioController::class, 'index'])->name('admin.gestionUsuarios');
    Route::post('/admin/gestion/usuarios', [AdminUsuarioController::class, 'store'])->name('admin.gestionUsuarios.store');
    Route::get('/admin/gestion/usuarios/{id}', [AdminUsuarioController::class, 'show'])->name('admin.gestionUsuarios.show');
    Route::put('/admin/gestion/usuarios/{id}', [AdminUsuarioController::class, 'update'])->name('admin.gestionUsuarios.update');
    Route::delete('/admin/gestion/usuarios/{id}', [AdminUsuarioController::class, 'destroy'])->name('admin.gestionUsuarios.destroy');

    // Rutas de gestión de categorías de libros del panel de administración
    Route::get('/admin/gestion/categorias', [AdminCategoriaController::class, 'index'])->name('admin.gestionCategorias');
    Route::post('/admin/gestion/categorias', [AdminCategoriaController::class, 'store'])->name('admin.gestionCategorias.store');
    Route::get('/admin/gestion/categorias/{id}', [AdminCategoriaController::class, 'show'])->name('admin.gestionCategorias.show');
    Route::put('/admin/gestion/categorias/{id}', [AdminCategoriaController::class, 'update'])->name('admin.gestionCategorias.update');
    Route::delete('/admin/gestion/categorias/{id}', [AdminCategoriaController::class, 'destroy'])->name('admin.gestionCategorias.destroy');
    Route::get('/admin/gestion/categorias/buscar', [AdminCategoriaController::class, 'buscar'])->name('admin.gestionCategorias.buscar');

    // Rutas de gestión de préstamos del panel de administración
    Route::get('/admin/gestion/prestamos', [AdminPrestamoController::class, 'index'])->name('admin.gestionPrestamos');

    // Rutas de gestión de audiolibros del panel de administración
    Route::get('/admin/gestion/libros/audiolibros', [AdminAudiolibroController::class, 'index'])->name('admin.gestionAudiolibros');
    Route::post('/admin/gestion/libros/audiolibros', [AdminAudiolibroController::class, 'store'])->name('admin.gestionAudiolibros.store');
    Route::get('/admin/gestion/libros/audiolibros/{id}', [AdminAudiolibroController::class, 'show'])->name('admin.gestionAudiolibros.show');
    Route::put('/admin/gestion/libros/audiolibros/{id}', [AdminAudiolibroController::class, 'update'])->name('admin.gestionAudiolibros.update');
    Route::delete('/admin/gestion/libros/audiolibros/{id}', [AdminAudiolibroController::class, 'destroy'])->name('admin.gestionAudiolibros.destroy');

    // Rutas de gestión de libros digitales del panel de administración
    Route::get('/admin/gestion/libros/digitales', [AdminLibroDigitalController::class, 'index'])->name('admin.gestionLibrosDigitales');
    Route::post('/admin/gestion/libros/digitales', [AdminLibroDigitalController::class, 'store'])->name('admin.gestionLibrosDigitales.store');
    Route::get('/admin/gestion/libros/digitales/{id}', [AdminLibroDigitalController::class, 'show'])->name('admin.gestionLibrosDigitales.show');
    Route::put('/admin/gestion/libros/digitales/{id}', [AdminLibroDigitalController::class, 'update'])->name('admin.gestionLibrosDigitales.update');
    Route::delete('/admin/gestion/libros/digitales/{id}', [AdminLibroDigitalController::class, 'destroy'])->name('admin.gestionLibrosDigitales.destroy');


    // Rutas de préstamos recientes del panel de administración
    Route::get('/admin/prestamos/recientes', [AdminPrestamoRecienteController::class, 'index'])->name('admin.prestamosRecientes');

    // Rutas de contenido reciente del panel de administración
    Route::get('/admin/contenido/reciente', [AdminContenidoRecienteController::class, 'index'])->name('admin.contenidoReciente');

    // Rutas de gestión de libros físicos del panel de administración
    Route::get('/admin/gestion/libros/fisicos', [AdminLibrosFisicosController::class, 'index'])->name('admin.gestionLibrosFisicos');

    // Ruta de estadísticas del sistema del panel de administración
    Route::get('/admin/estadisticas/sistema', [AdminEstadisticasController::class, 'index'])->name('admin.estadisticasSistema');

    // Cerrar sesión (solo redirige por ahora)
    Route::post('/', [AdminController::class, 'cerrarSesion'])->name('admin.cerrarSesion');

Route::get('/admin/clientes', [AdminController::class, 'clientes'])->name('admin.clientes');

Route::get('/admin/empleados', [AdminController::class, 'empleados'])->name('admin.empleados');

Route::get('/user/loginUser', [UserController::class, 'Login'])->name('user.loginUser');

// Ruta para procesar el formulario de inicio de sesión (POST)
Route::post('/user/loginUser', [UserController::class, 'loginUser'])->name('user.login');




Route::get('/user/galeria', [UserController::class, 'Galeria'])->name('user.galeria');

Route::get('/user/informacion', [UserController::class, 'Informacion'])->name('user.informacion');


// Formulario de registro
Route::get('/user/registerUser', [UserController::class, 'Registro'])->name('user.registerUser');

// Envío del formulario (POST)
Route::post('/user/registerUser', [UserController::class, 'store'])->name('user.store');



// Ruta para mostrar los libros
Route::get('/libros', [LibroDigitalController::class, 'index'])->name('libros.index');

// Redirigir a la ruta correcta que maneja los libros con lógica de controlador
//Route::get('/libros/digitales', function () {
// return redirect()->route('libros.index');  // Redirige a /libros
//})->name('libros.digitales');



// Ruta para leer un libro (con el código del libro)
Route::get('/libros/{codigo}/leer', [LibroDigitalController::class, 'read'])->name('libros.read');

// Ruta para escuchar el audiolibro (con el código del libro)
Route::get('/libros/{codigo}/escuchar', [LibroDigitalController::class, 'listen'])->name('libros.listen');

// Escuchar libro
Route::get('/libros/{codigo}/listen', [App\Http\Controllers\LibroDigitalController::class, 'listen'])
    ->name('libros.listen');

//cierra seinson prtegida
Route::get('/libros/digitales', function () {
    return redirect()->route('libros.index');
})->middleware('auth')->name('libros.digitales');


// Alias compatible con el middleware 'auth'
Route::get('/login', [UserController::class, 'Login'])->name('login');


// Cerrar sesión (ruta de logout)
// Ruta de logout

// Logout de clientes/usuarios normales
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('inicio');
})->name('logout');

// Logout exclusivo para admin
Route::post('/admin/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('inicio');
})->name('admin.cerrarSesion');



Route::middleware('auth')->group(function () {
    Route::get('/perfil', [UserController::class, 'perfil'])->name('user.perfil');
    Route::put('/perfil', [UserController::class, 'actualizarPerfil'])->name('user.perfil.update');
    Route::put('/perfil/password', [UserController::class, 'actualizarPassword'])->name('user.perfil.password');
    Route::put('/perfil/imagen', [UserController::class, 'actualizarImagen'])->name('user.perfil.imagen');
});


//perfil
Route::middleware('auth')->group(function () {
    Route::get('/perfil', [UserController::class, 'perfil'])->name('user.perfil');
});



//prestamo
Route::get('/solicitar-prestamo', [PrestamosController::class, 'solicitarPrestamo'])->name('solicitarPrestamo');



// Ruta para procesar el préstamo
Route::post('/solicitar-prestamo', [PrestamosController::class, 'store'])->name('prestamos.store');


/**************************************************************************************************************************** */


/**************************************************************************************************************************** */

// ===== Login con Google =====
Route::get('auth/google', fn() => Socialite::driver('google')->redirect())->name('login.google');

Route::get('auth/google/callback', function () {
    $g = Socialite::driver('google')->user();

    // Buscar por correo
    $user = Usuario::where('correo', $g->getEmail())->first();

    // Si no existe, crear cliente (sin usar foto de Google)
    if (!$user) {
        $user = Usuario::create([
            'nombre_completo' => $g->getName(),
            'correo'          => $g->getEmail(),
            'nombre_usuario'  => explode('@', $g->getEmail())[0],
            'contrasena'      => bcrypt(Str::random(16)),
            'rol'             => 'cliente',
            'imagen'          => 'https://ui-avatars.com/api/?name=' . urlencode($g->getName()),
            // 'direccion'    => 'San Salvador',
        ]);
    }

    Auth::login($user);

    return redirect()->route('libros.digitales')->with('success', '¡Bienvenido con Google!');
});
