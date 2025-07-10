<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #343a40;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-white text-center">SIS TEMPLATE</h4>
        <a href="{{ route('admin.index') }}">Inicio</a>
        <a href="{{ route('admin.usuarios') }}">Usuarios</a>
        <a href="{{ route('admin.categoriasLibros') }}">Categorías de Libros</a>
        <a href="{{ route('admin.publicar') }}">Publicar Libros</a>
        <a href="{{ route('admin.prestamos') }}">Préstamos</a>
        <a href="{{ route('admin.cerrarSesion') }}">Cerrar Sesión</a>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
