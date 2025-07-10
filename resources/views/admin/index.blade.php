@extends('layouts.admin')

@section('content')
    <div class="content">
        <h3 class="mb-4">Bienvenido al Panel de Administración</h3>
        <p class="lead mb-5">Aquí podrás gestionar todas las secciones del sistema de forma fácil y rápida.</p>

        <!-- Contenedor de los botones -->
        <div class="row">
            <!-- Gestión de Usuarios -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestionar Usuarios</h5>
                        <p class="card-text">Administra los usuarios del sistema.</p>
                        <a href="{{ route('admin.usuarios') }}" class="btn btn-primary btn-lg">Gestionar Usuarios</a>
                    </div>
                </div>
            </div>

            <!-- Gestión de Categorías de Libros -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">Gestionar Categorías de Libros</h5>
                        <p class="card-text">Agrega o edita las categorías de libros.</p>
                        <a href="{{ route('admin.categoriasLibros') }}" class="btn btn-success btn-lg">Gestionar Categorías</a>
                    </div>
                </div>
            </div>

            <!-- Publicar Libros y Audiolibros -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-light">
                    <div class="card-body text-center">
                        <h5 class="card-title">Publicar Libros y Audiolibros</h5>
                        <p class="card-text">Publica nuevos libros o audiolibros en el sistema.</p>
                        <a href="{{ route('admin.publicar') }}" class="btn btn-warning btn-lg">Publicar Contenido</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
