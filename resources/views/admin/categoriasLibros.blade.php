@extends('layouts.admin')

@section('content')
    <div class="content">
        <h3>Categorías de Libros</h3>
        <a href="#" class="btn btn-success mb-3">+ Nueva Categoría</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Ficción</td>
                    <td>
                        <a href="#" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
