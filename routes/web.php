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

use Illuminate\Support\Facades\Route;

//RUTA INICIO 
Route::get('/', function () {
    return view('inicio');
})->name('inicio');

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

// Rutas de gestión de préstamos del panel de administración
Route::get('/admin/gestion/prestamos', [AdminPrestamoController::class, 'index'])->name('admin.gestionPrestamos');

// Rutas de gestión de libros y audiolibros del panel de administración
Route::get('/admin/gestion/libros/audiolibros', [AdminAudiolibroController::class, 'index'])->name('admin.gestionAudiolibros');

// Rutas de gestión de libros digitales del panel de administración
Route::get('/admin/gestion/libros/digitales', [AdminLibroDigitalController::class, 'index'])->name('admin.gestionLibrosDigitales');

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
Route::get('/user/registerUser', [UserController::class, 'Registro'])->name('user.registerUser');
Route::get('/user/galeria', [UserController::class, 'Galeria'])->name('user.galeria');


/**************************************************************************************************************************** */


/**************************************************************************************************************************** */