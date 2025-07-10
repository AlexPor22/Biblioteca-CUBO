<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        /* Fondo */
        body {
            background-color: #ecf0f1;
            font-family: 'Roboto', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #2c3e50;
            position: fixed;
            padding-top: 30px;
            transition: transform 0.3s ease;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar h4 {
            color: #ecf0f1;
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        .sidebar img.logo {
            width: 60%;
            margin-bottom: 30px;
            display: block;
            margin: 0 auto;
        }

        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            padding: 15px;
            display: block;
            border-radius: 5px;
            margin-bottom: 10px;
            font-size: 1.1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .sidebar a:hover {
            background-color: #16a085;
            transform: translateX(10px);
        }

        /* Submenús */
        .submenu {
            display: none;
            margin-left: 20px;
        }
        .has-submenu.active .submenu {
            display: block;
            animation: slideIn 0.3s ease-in-out;
        }

        @keyframes slideIn {
            0% {
                opacity: 0;
                transform: translateX(-20px);
            }
            100% {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Contenido Principal */
        .content {
            margin-left: 250px;
            padding: 30px;
            background-color: #f4f6f9;
            min-height: 100vh;
        }

        .content h1 {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        /* Modal */
        .modal-content {
            border-radius: 10px;
        }

        /* Footer en el sidebar */
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 10px 15px;
            background-color: #2c3e50;
            text-align: center;
        }

        /* Estilo para el enlace activo */
        .sidebar a.active {
            background-color: #16a085;
            font-weight: bold;
        }

        /* Tooltip */
        .sidebar a[data-bs-toggle="tooltip"] {
            position: relative;
        }

    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Logo -->
        <img src="https://cubo.gob.sv/wp-content/uploads/2022/12/CUBOLogoGray.png" alt="Logo CUBO" class="logo">

        <!-- Título del Panel -->
        <h4></h4>

        <a href="{{ route('admin.index') }}" class="menu-link" id="inicio" data-bs-toggle="tooltip" title="Ir al Inicio">
            <i class="fas fa-tachometer-alt"></i> Inicio
        </a>

        <!-- Opción con submenú -->
        <div class="has-submenu" id="librosMenuContainer">
            <a href="javascript:void(0)" id="librosMenu" class="menu-link" data-bs-toggle="tooltip" title="Gestionar Libros">
                <i class="fas fa-book"></i> Libros
            </a>
            <div class="submenu">
                <a href="{{ route('admin.categoriasLibros') }}" class="menu-link" id="categoriasLibros" data-bs-toggle="tooltip" title="Gestionar Categorías"><i class="fas fa-list"></i> Categorías</a>
                <a href="{{ route('admin.publicar') }}" class="menu-link" id="publicarLibros" data-bs-toggle="tooltip" title="Publicar Nuevos Libros"><i class="fas fa-upload"></i> Publicar Libros</a>
            </div>
        </div>

        <a href="{{ route('admin.usuarios') }}" class="menu-link" id="usuarios" data-bs-toggle="tooltip" title="Gestionar Usuarios">
            <i class="fas fa-users"></i> Usuarios
        </a>
        <a href="{{ route('admin.prestamos') }}" class="menu-link" id="prestamos" data-bs-toggle="tooltip" title="Gestionar Préstamos">
            <i class="fas fa-hand-holding"></i> Préstamos
        </a>

        <!-- Footer con Cerrar Sesión -->
        <div class="sidebar-footer">
            <a href="{{ route('admin.cerrarSesion') }}" class="btn btn-danger btn-sm">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Función para alternar el menú de libros
        document.getElementById('librosMenu').addEventListener('click', function() {
            var submenu = this.nextElementSibling;
            var parentDiv = this.parentElement;
            // Alterna la clase 'active' para mostrar/ocultar el submenú
            parentDiv.classList.toggle('active');
        });

        // Guardar el estado activo en localStorage
        document.querySelectorAll('.menu-link').forEach(link => {
            link.addEventListener('click', function() {
                // Eliminar 'active' de todos los enlaces
                document.querySelectorAll('.menu-link').forEach(item => item.classList.remove('active'));
                // Añadir 'active' al enlace clickeado
                this.classList.add('active');
                // Guardar la sección activa en localStorage
                localStorage.setItem('activeMenu', this.id);
            });
        });

        // Recuperar y aplicar el estado activo desde localStorage al cargar la página
        window.addEventListener('load', function() {
            const activeMenu = localStorage.getItem('activeMenu');
            if (activeMenu) {
                document.getElementById(activeMenu)?.classList.add('active');
            }
        });

        // Habilitar Tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>
</html>
