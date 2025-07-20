<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//RUTA INICIO 
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

// Rutas del Panel de Administración (sin autenticación)
Route::get('/admin/panel/administracion', [AdminController::class, 'panelAdministracion'])->name('admin.panelAdministracion');

// Rutas de gestión de usuarios del panel de administración
Route::get('/admin/gestion/usuarios', [AdminController::class, 'gestionUsuarios'])->name('admin.gestionUsuarios');

// Rutas de gestión de categorías de libros del panel de administración
Route::get('/admin/gestion/categorias', [AdminController::class, 'gestionCategorias'])->name('admin.gestionCategorias');

// Rutas de gestión de préstamos del panel de administración
Route::get('/admin/gestion/prestamos', [AdminController::class, 'gestionPrestamos'])->name('admin.gestionPrestamos');

// Rutas de gestión de libros y audiolibros del panel de administración
Route::get('/admin/gestion/libros/audiolibros', [AdminController::class, 'gestionLibrosAudiolibros'])->name('admin.gestionLibrosAudiolibros');

// Rutas de préstamos recientes del panel de administración
Route::get('/admin/prestamos/recientes', [AdminController::class, 'prestamosRecientes'])->name('admin.prestamosRecientes');

// Rutas de contenido reciente del panel de administración
Route::get('/admin/contenido/reciente', [AdminController::class, 'contenidoReciente'])->name('admin.contenidoReciente');

// Ruta de estadísticas del sistema del panel de administración
Route::get('/admin/estadisticas/sistema', [AdminController::class, 'estadisticasSistema'])->name('admin.estadisticasSistema');

// Cerrar sesión (solo redirige por ahora)
Route::post('/', [AdminController::class, 'cerrarSesion'])->name('admin.cerrarSesion');





Route::get('/admin/clientes', [AdminController::class, 'clientes'])->name('admin.clientes');

Route::get('/admin/empleados', [AdminController::class, 'empleados'])->name('admin.empleados');

Route::get('/user/loginUser', [UserController::class, 'Login'])->name('user.loginUser');
Route::get('/user/registerUser', [UserController::class, 'Registro'])->name('user.registerUser');
Route::get('/user/galeria', [UserController::class, 'Galeria'])->name('user.galeria');
