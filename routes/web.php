<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

//RUTA INICIO 
Route::get('/', function () {
    return view('inicio');
})->name('inicio');


// Rutas del Panel de Administración (sin autenticación)
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
Route::get('/admin/categorias-libros', [AdminController::class, 'categoriasLibros'])->name('admin.categoriasLibros');


Route::get('/admin/empleados', [AdminController::class, 'empleados'])->name('admin.empleados');
Route::get('/admin/clientes', [AdminController::class, 'clientes'])->name('admin.clientes');
Route::get('/admin/publicar', [AdminController::class, 'publicar'])->name('admin.publicar');
Route::get('/admin/prestamos', [AdminController::class, 'prestamos'])->name('admin.prestamos');
Route::post('/admin/cerrar-sesion', [AdminController::class, 'cerrarSesion'])->name('admin.cerrarSesion');



