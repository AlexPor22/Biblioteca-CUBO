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
    @vite([
      'resources/css/globalsAdmin.css',
      'resources/css/buttons.css',
      'resources/css/status.css',
      'resources/css/animations.css',
      'resources/css/index.css',
      'resources/css/table.css',
      'resources/css/search.css',
      'resources/css/recent__uploads.css',
      'resources/css/cards.css',
      'resources/css/sidebar__admin.css',
      'resources/js/sidebar__admin.js',
    ])

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
          <a href="{{ route('admin.panelAdministracion') }}" class="{{ request()->routeIs('admin.panelAdministracion') ? 'active' : '' }}">
          <i class="bi bi-speedometer2"></i> Panel de Administración
          </a>
          <a href="{{ route('admin.gestionUsuarios') }}" class="{{ request()->routeIs('admin.gestionUsuarios') ? 'active' : '' }}">
          <i class="bi bi-people"></i> Gestión de Usuarios
          </a>
          <a href="{{ route('admin.gestionCategorias') }}" class="{{ request()->routeIs('admin.gestionCategorias') ? 'active' : '' }}">
          <i class="bi bi-tags"></i> Gestión de Categorías
          </a>
          <a href="{{ route('admin.gestionLibrosDigitales') }}" class="{{ request()->routeIs('admin.gestionLibrosDigitales') ? 'active' : '' }}">
          <i class="bi bi-cloud-upload"></i> Gestión de Libros Digitales
          </a>
          <a href="{{ route('admin.gestionAudiolibros') }}" class="{{ request()->routeIs('admin.gestionAudiolibros') ? 'active' : '' }}">
          <i class="bi bi-cloud-upload"></i> Gestión de Audiolibros
          </a>
          <a href="{{ route('admin.gestionLibrosFisicos') }}" class="{{ request()->routeIs('admin.gestionLibrosFisicos') ? 'active' : '' }}">
          <i class="bi bi-book"></i> Gestión de Libros Físicos
          </a>
          <a href="{{ route('admin.gestionPrestamos') }}" class="{{ request()->routeIs('admin.gestionPrestamos') ? 'active' : '' }}">
          <i class="bi bi-journal-bookmark"></i> Gestión de Préstamos
          </a>
          <a href="{{ route('admin.prestamosRecientes') }}" class="{{ request()->routeIs('admin.prestamosRecientes') ? 'active' : '' }}">
          <i class="bi bi-book-half"></i> Préstamos Recientes
          </a>
          <a href="{{ route('admin.contenidoReciente') }}" class="{{ request()->routeIs('admin.contenidoReciente') ? 'active' : '' }}">
          <i class="bi bi-clock-history"></i> Contenido Reciente
          </a>
          <a href="{{ route('admin.estadisticasSistema') }}" class="{{ request()->routeIs('admin.estadisticasSistema') ? 'active' : '' }}">
          <i class="bi bi-graph-up"></i> Estadísticas del Sistema
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