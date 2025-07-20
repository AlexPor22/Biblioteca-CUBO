<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel CUBO</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/sidebar__admin.css', 'resources/js/sidebar__admin.js'])
    @vite(['resources/css/globalsAdmin.css'])
    @vite(['resources/css/buttons.css'])
    @vite(['resources/css/status.css'])
    @vite(['resources/css/animations.css'])
    @vite(['resources/css/index.css'])
    @vite(['resources/css/table.css'])
    @vite(['resources/css/search.css'])
    @vite(['resources/css/recent__uploads.css'])
    @vite(['resources/css/cards.css'])
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
        <!-- Menú de navegación -->
        <div class="menu-section" id="menuItems">
          <a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active' : '' }}">
          <i class="bi bi-speedometer2"></i> Panel Principal
          </a>
          <a href="{{ route('admin.usuarios') }}" class="{{ request()->routeIs('admin.usuarios') ? 'active' : '' }}">
          <i class="bi bi-people"></i> Gestión de Usuarios
          </a>
          <a href="{{ route('admin.categoriasLibros') }}" class="{{ request()->routeIs('admin.categoriasLibros') ? 'active' : '' }}">
          <i class="bi bi-tags"></i> Gestión de Categorías
          </a>
          <a href="{{ route('admin.prestamos.historial') }}" class="{{ request()->routeIs('admin.prestamos.historial') ? 'active' : '' }}">
          <i class="bi bi-journal-bookmark"></i> Gestión de Préstamos
          </a>
          <a href="{{ route('admin.verlibros') }}" class="{{ request()->routeIs('admin.verlibros') ? 'active' : '' }}">
          <i class="bi bi-cloud-upload"></i> Gestión de Libros y Audiolibros
          </a>
          <a href="{{ route('admin.prestamos') }}" class="{{ request()->routeIs('admin.prestamos') ? 'active' : '' }}">
          <i class="bi bi-book-half"></i> Préstamos Recientes
          </a>
          <a href="{{ route('admin.publicar') }}" class="{{ request()->routeIs('admin.publicar') ? 'active' : '' }}">
          <i class="bi bi-clock-history"></i> Contenido Reciente
          </a>
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