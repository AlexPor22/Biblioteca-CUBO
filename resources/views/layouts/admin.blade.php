<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel CUBO</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #f4f6f9;
    }

    .sidebar {
      width: 250px;
      height: 100vh;
      background-color: #1d2635;
      color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1000;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding-top: 1rem;
      overflow: hidden;
    }

    .sidebar h4 {
      text-align: center;
      margin-bottom: 1rem;
      font-size: 1.5rem;
      font-weight: bold;
    }

    .sidebar a,
    .sidebar button {
      color: #fff;
      display: flex;
      align-items: center;
      padding: 12px 20px;
      text-decoration: none;
      background: none;
      border: none;
      width: 100%;
      text-align: left;
      transition: all 0.3s ease;
    }

    .sidebar a:hover,
    .sidebar button:hover {
      background-color: #2d3b4f;
      transform: scale(1.02);
    }

    .sidebar a i,
    .sidebar button i {
      margin-right: 12px;
      font-size: 1.2rem;
      transition: transform 0.3s;
    }

    .sidebar a:hover i,
    .sidebar button:hover i {
      transform: rotate(8deg);
    }

    .sidebar a.active {
      background-color: #0d6efd;
      font-weight: bold;
    }

    .submenu {
      background-color: #283142;
      display: none;
      flex-direction: column;
    }

    .submenu a {
      padding-left: 40px;
      font-size: 0.9rem;
    }

    .sidebar .search-box {
      padding: 0 20px;
    }

    .sidebar .form-control {
      font-size: 0.9rem;
    }

    .sidebar-footer a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: #fff;
      text-decoration: none;
      transition: all 0.3s;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar-footer a:hover {
      background-color: #2d3b4f;
      transform: scale(1.02);
    }

    .sidebar-footer a i {
      margin-right: 10px;
    }

    .content {
      margin-left: 250px;
      padding: 2rem;
      transition: margin-left 0.3s;
    }

    .content.collapsed {
      margin-left: 0;
    }

    .toggle-btn {
      position: fixed;
      top: 15px;
      left: 15px;
      background-color: #0d6efd;
      color: #fff;
      border: none;
      font-size: 1.2rem;
      padding: 8px 12px;
      border-radius: 5px;
      z-index: 1100;
      display: none;
    }

    @media (max-width: 768px) {
      .toggle-btn {
        display: block;
      }

      .sidebar .form-control {
        margin-top: 30px;
    }


      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.show {
        transform: translateX(0);
      }

      .content {
        margin-left: 0;
      }
    }
  </style>
</head>
<body>

<!-- Botón hamburguesa -->
<button class="toggle-btn" onclick="toggleSidebar()">
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
        <button onclick="toggleSubmenu('usuariosSub')">
          <i class="fas fa-users"></i>Usuarios <i class="fas fa-caret-down ms-auto"></i>
        </button>
        <div class="submenu" id="usuariosSub">
          <a href="{{ route('admin.usuarios') }}">Gestión de Usuarios</a>
          <a href="#">Roles y Permisos</a>
        </div>
      </div>

      <!-- Libros submenu -->
      <div class="menu-group">
        <button onclick="toggleSubmenu('librosSub')">
          <i class="fas fa-book"></i>Libros <i class="fas fa-caret-down ms-auto"></i>
        </button>
        <div class="submenu" id="librosSub">
          <a href="{{ route('admin.categoriasLibros') }}">Categorías</a>
          <a href="{{ route('admin.publicar') }}">Publicar Libros</a>
          <a href="{{ route('admin.prestamos') }}">Préstamos</a>
        </div>
      </div>

      <!-- Sistema submenu -->
      <div class="menu-group">
        <button onclick="toggleSubmenu('sistemaSub')">
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

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('show');
    document.getElementById('content').classList.toggle('collapsed');
  }

  function toggleSubmenu(id) {
    const submenu = document.getElementById(id);
    submenu.style.display = submenu.style.display === 'flex' ? 'none' : 'flex';
  }

  // Buscador en tiempo real con ocultación de grupos
  document.getElementById('sidebarSearch').addEventListener('input', function () {
    const filter = this.value.toLowerCase();
    const allGroups = document.querySelectorAll('.menu-group');

    allGroups.forEach(group => {
      const submenu = group.querySelector('.submenu');
      const links = submenu.querySelectorAll('a');
      let hasMatch = false;

      links.forEach(link => {
        const text = link.textContent.toLowerCase();
        if (text.includes(filter)) {
          link.style.display = 'flex';
          hasMatch = true;
        } else {
          link.style.display = 'none';
        }
      });

      if (hasMatch) {
        group.style.display = 'block';
        submenu.style.display = 'flex';
      } else {
        group.style.display = 'none';
      }
    });

    // Filtra también los enlaces fuera de menú agrupado
    const staticLinks = document.querySelectorAll('#menuItems > a');
    staticLinks.forEach(link => {
      const text = link.textContent.toLowerCase();
      link.style.display = text.includes(filter) ? 'flex' : 'none';
    });
  });
</script>


</body>
</html>
