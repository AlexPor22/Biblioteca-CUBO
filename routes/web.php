<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//RUTA INICIO 
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Rutas del Panel de Administración (sin autenticación)
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::get('/admin/empleados', [AdminController::class, 'empleados'])->name('admin.empleados');

Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
Route::get('/admin/categorias-libros', [AdminController::class, 'categoriasLibros'])->name('admin.categoriasLibros');
Route::get('/admin/clientes', [AdminController::class, 'clientes'])->name('admin.clientes');
Route::get('/admin/publicar', [AdminController::class, 'publicar'])->name('admin.publicar');
Route::get('/admin/prestamos', [AdminController::class, 'prestamos'])->name('admin.prestamos');
Route::get('/admin/verlibros', [AdminController::class, 'verLibros'])->name('admin.verlibros');
Route::get('/admin/prestamos/historial', [AdminController::class, 'historialPrestamo'])->name('admin.prestamos.historial');

// Cerrar sesión (solo redirige por ahora)
Route::post('/', [AdminController::class, 'cerrarSesion'])->name('admin.cerrarSesion');

Route::get('/user/loginUser', [UserController::class, 'Login'])->name('user.loginUser');
Route::get('/user/registerUser', [UserController::class, 'Registro'])->name('user.registerUser');
Route::get('/user/galeria', [UserController::class, 'Galeria'])->name('user.galeria');

Route::get('/user/informacion', [UserController::class, 'Informacion'])->name('user.informacion');



