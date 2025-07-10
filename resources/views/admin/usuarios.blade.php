@extends('layouts.admin')

@section('content')
    <div class="content">
        <h3>Usuarios</h3>
        <a href="#" class="btn btn-success mb-3">+ Nuevo Usuario</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Tipo de Usuario</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tarea Completo</td>
                    <td>Admin</td>
                    <td>
                        <a href="#" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Joel Perez</td>
                    <td>Usuario</td>
                    <td>
                        <a href="#" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
