<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel CUBO</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @vite(['resources/css/sidebar__admin.css', 'resources/js/sidebar__admin.js'])
  @vite(['resources/css/index.css'])
  @vite(['resources/css/table.css'])
  
</head>
<body>

<!-- Botón hamburguesa -->
<button class="toggle-btn" id="hamburguesa">
  <i class="fas fa-bars"></i>
</button>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <div>
    <h4>CUBO</h4>

    <!-- Buscador -->
    <div class="search-box mb-3">
      <input type="text" class="form-control" placeholder="Buscar..." id="sidebarSearch">
    </div>

    <div class="menu-section" id="menuItems">
      <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
        <i class="fas fa-home"></i>Inicio
      </a>

      <!-- Usuarios submenu -->
      <div class="menu-group">
        <button class="submenu-toggle" data-target="usuariosSub">
          <i class="fas fa-users"></i>Usuarios <i class="fas fa-caret-down ms-auto"></i>
        </button>
        <div class="submenu" id="usuariosSub">
          <a href="{{ route('admin.usuarios') }}">Gestión de Usuarios</a>
          <a href="#">Roles y Permisos</a>
        </div>
      </div>

      <!-- Libros submenu -->
      <div class="menu-group">
        <button class="submenu-toggle" data-target="librosSub">
          <i class="fas fa-book"></i>Libros <i class="fas fa-caret-down ms-auto"></i>
        </button>
        <div class="submenu" id="librosSub">
          <a href="{{ route('admin.categoriasLibros') }}">Categorías</a>
          <a href="{{ route('admin.publicar') }}">Publicar Libros</a>
          <a href="{{ route('admin.prestamos') }}">Préstamos</a>
          <a href="{{ route('admin.verlibros') }}">Ver Libros</a>
        </div>
      </div>

      <!-- Sistema submenu -->
      <div class="menu-group">
        <button class="submenu-toggle" data-target="sistemaSub">
          <i class="fas fa-cogs"></i>Sistema <i class="fas fa-caret-down ms-auto"></i>
        </button>
        <div class="submenu" id="sistemaSub">
          <a href="#">Configuración</a>
          <a href="#">Mantenimiento</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="sidebar-footer">
    <a href="{{ route('admin.cerrarSesion') }}">
      <i class="fas fa-sign-out-alt"></i>Cerrar Sesión
    </a>
  </div>
</div>

<!-- Contenido -->
<div class="content" id="content">
  @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
