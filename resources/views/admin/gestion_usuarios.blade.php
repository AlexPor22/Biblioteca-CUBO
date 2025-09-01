@extends('layouts.admin')
@section('content')
<div class="user-management">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
  @endif
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Gestión de Usuarios</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Administra y controla todos los usuarios del sistema.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">{{ $total }}</div>
          <div class="stat-label">Total Usuarios</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $admins }}</div>
          <div class="stat-label">Administradores</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $empleados }}</div>
          <div class="stat-label">Empleados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $clientes }}</div>
          <div class="stat-label">Clientes</div>
        </div>
      </div>
    </div>
    <!-- Barra de Búsqueda -->
    <form method="GET" action="{{ route('admin.gestionUsuarios') }}" class="search-bar" style="margin-bottom: 1rem;">
      <input 
        type="text" 
        name="search" 
        class="search-input" 
        id="buscadorUsuario" 
        placeholder="Buscar por nombre de usuario o correo electrónico..." 
        value="{{ request('search') }}">
      <button class="search-btn">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </form>
    <!-- Sección de contenido principal -->
    <div class="content-section">
      <div class="section-header">
        <h3 class="section-title">Gestión de Usuarios</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="admin">Admin</a>
          <a href="#" class="filter-btn" data-filter="empleado">Empleados</a>
          <a href="#" class="filter-btn" data-filter="cliente">Clientes</a>
        </div>
        <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">Nuevo Usuario</a>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
            <!--<th>ID</th>-->
            <th>Usuario</th>
            <th>Correo</th>
            <th>Direccion</th>
            <th>Rol</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($usuarios as $usuario)
          <tr data-rol="{{ strtolower($usuario->rol) }}">
            <!--<td>{{ $usuario->id }}</td>-->
            <td><span>{{ $usuario->nombre_usuario }}</span></td>
            <td><span>{{ $usuario->correo }}</span></td>
            <td><span>{{ $usuario->direccion }}</span></td>
            <td>
              <span class="user-type type-{{ strtolower($usuario->rol) }}">{{ ucfirst($usuario->rol) }}</span>
            </td>
            <td>
              <div class="action-buttons">
                <button class="btn-view" data-id="{{ $usuario->id }}">Ver Perfil</button>
                <button class="btn-edit"
                  data-id="{{ $usuario->id }}"
                  data-nombre="{{ $usuario->nombre_completo }}"
                  data-edad="{{ $usuario->edad }}"
                  data-sexo="{{ $usuario->sexo }}"
                  data-nombre_usuario="{{ $usuario->nombre_usuario }}"
                  data-correo="{{ $usuario->correo }}"
                  data-rol="{{ $usuario->rol }}"
                  data-telefono="{{ $usuario->numero_telefono }}"
                  data-direccion="{{ $usuario->direccion }}"
                  data-contrasena="{{ $usuario->contrasena }}"
                  data-url_imagen="{{ $usuario->url_imagen }}"
                  data-bs-toggle="modal"
                  data-bs-target="#modalEditarUsuario">Editar
                </button>
                <form action="{{ route('admin.gestionUsuarios.destroy', $usuario->id) }}" method="POST" style="display: inline-block;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-delete">Eliminar</button>
                </form>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Paginación -->
    <div class="pagination-container d-flex justify-content-center mt-4">
      {{ $usuarios->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>
<!-- Modal para agregar usuarios nuevos-->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="agregarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formAgregarUsuario" action="{{ route('admin.gestionUsuarios.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="agregarUsuarioLabel">Agregar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="row g-3">
            <!-- Nombre Completo -->
            <div class="col-md-6">
              <label class="form-label">Nombre Completo</label>
              <input type="text" class="form-control" name="nombre_completo" value="{{ old('nombre_completo') }}" required>
            </div>
            <!-- Edad -->
            <div class="col-md-6">
              <label class="form-label">Edad</label>
              <input type="text" class="form-control" name="edad" maxlength="2" value="{{ old('edad') }}" required>
            </div>
            <!-- Sexo -->
            <div class="col-md-6">
              <label class="form-label">Sexo</label>
              <select class="form-select" name="sexo" required>
                <option value="" disabled selected>Seleccione un sexo</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
              </select>
            </div>
            <!-- Nombre de Usuario -->
            <div class="col-md-6">
              <label class="form-label">Nombre de Usuario</label>
              <input type="text" class="form-control" name="nombre_usuario" value="{{ old('nombre_usuario') }}" required>
            </div>
            <!-- Correo Electrónico -->
            <div class="col-md-6">
              <label class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" name="correo" value="{{ old('correo') }}" required>
            </div>
            <!-- Rol -->
            <div class="col-md-6">
              <label class="form-label">Rol</label>
              <select class="form-select" name="rol" required>
                <option value="" disabled selected>Seleccione un rol</option>
                <option value="admin">Admin</option>
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
              </select>
            </div>
            <!-- Numero de Teléfono -->
            <div class="col-md-6">
              <label class="form-label">Número de Teléfono</label>
              <input type="text" class="form-control" name="numero_telefono" value="{{ old('numero_telefono') }}" required>
            </div>
            <!-- Dirección -->
            <div class="col-md-6">
              <label class="form-label">Dirección</label>
              <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}" required>
            </div>
            <!-- Contraseña -->
            <div class="col-md-6">
              <label class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
            </div>
            <!-- Confirmar Contraseña -->
            <div class="col-md-6">
              <label class="form-label">Confirmar Contraseña</label>
              <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
            </div>
            <!-- Imagen de Perfil 
              <div class="col-md-12">
                <label class="form-label">Imagen de Perfil (opcional)</label> 
                <input type="file" class="form-control" name="imagen_perfil" accept="image/*">
              </div> -->
            <!-- Imagen de Perfil URL -->
            <div class="col-md-12">
              <label class="form-label">Imagen de Perfil (URL)</label>
              <input type="text" class="form-control" name="url_imagen" value="{{ old('url_imagen') }}" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal: Editar Usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="editarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formEditarUsuario" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="">
        <div class="modal-header">
          <h5 class="modal-title" id="editarUsuarioLabel">Editar Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <!-- Nombre Completo -->
            <div class="col-md-6">
              <label class="form-label">Nombre Completo</label>
              <input type="text" class="form-control" name="nombre_completo" required>
            </div>
            <!-- Edad -->
            <div class="col-md-6">
              <label class="form-label">Edad</label>
              <input type="text" class="form-control" name="edad" maxlength="2" required>
            </div>
            <!-- Sexo -->
            <div class="col-md-6">
              <label class="form-label">Sexo</label>
              <select class="form-select" name="sexo" required>
                <option value="" disabled selected>Seleccione</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
              </select>
            </div>
            <!-- Nombre de Usuario -->
            <div class="col-md-6">
              <label class="form-label">Nombre de Usuario</label>
              <input type="text" class="form-control" name="nombre_usuario" required>
            </div>
            <!-- Correo Electrónico -->
            <div class="col-md-6">
              <label class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" name="correo" required>
            </div>
            <!-- Rol -->
            <div class="col-md-6">
              <label class="form-label">Rol</label>
              <select class="form-select" name="rol" required>
                <option value="" disabled selected>Seleccione un rol</option>
                <option value="admin">Admin</option>
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
              </select>
            </div>
            <!-- Numero de Teléfono -->
            <div class="col-md-6">
              <label class="form-label">Número de Teléfono</label>
              <input type="text" class="form-control" name="numero_telefono" required>
            </div>
            <!-- Dirección -->
            <div class="col-md-6">
              <label class="form-label">Dirección</label>
              <input type="text" class="form-control" name="direccion" required>
            </div>
            <!-- Imagen de Perfil 
              <div class="col-md-12">
                <label class="form-label">Imagen de Perfil (opcional)</label> 
                <input type="file" class="form-control" name="imagen_perfil" accept="image/*">
              </div>
              -->
            <!-- Imagen de Perfil URL -->
            <div class="col-md-12">
              <label class="form-label">Imagen de Perfil (URL)</label>
              <input type="text" class="form-control" name="url_imagen">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal: Vista Profesional de Usuario -->
<div class="modal fade" id="modalVistaUsuario" tabindex="-1" aria-labelledby="modalVistaUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-dark text-white rounded-top-4">
        <h5 class="modal-title" id="modalVistaUsuarioLabel">Perfil de Usuario</h5>
      </div>
      <div class="modal-body p-0">
        <div class="card border-0">
          <!-- Imagen + usuario -->
          <div class="text-center p-1 bg-light border-bottom">
            <img id="card_imagen" src="" alt="Imagen de perfil" class="rounded-circle" style="width: 150px; height: 150px;">
            <h4 class="fw-bold" id="card_nombre_usuario">usuario</h4>
            <span class="badge bg-success" id="card_estado">Activo</span>
          </div>
          <!-- Tabs -->
          <ul class="nav nav-tabs nav-justified fw-semibold border-bottom bg-white" id="tabRol" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabInfo">🧾 Información</button>
            </li>
            <li class="nav-item d-none" id="tabCliente">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabHistorial">📚 Historial</button>
            </li>
            <li class="nav-item d-none" id="tabEmpleado">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabActividad">📋 Actividad</button>
            </li>
            <li class="nav-item d-none" id="tabAdmin">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabSistema">🛠️ Sistema</button>
            </li>
          </ul>
          <!-- Tab content -->
          <div class="tab-content p-4">
            <!-- Info general -->
            <div class="tab-pane fade show active" id="tabInfo">
              <div class="row">
                <div class="col-md-6">
                  <label class="text-muted">Nombre completo</label>
                  <p class="fw-bold" id="card_nombre_completo">-</p>
                </div>
                <div class="col-md-3">
                  <label class="text-muted">Edad</label>
                  <p class="fw-bold" id="card_edad">-</p>
                </div>
                <div class="col-md-3">
                  <label class="text-muted">Sexo</label>
                  <p class="fw-bold" id="card_sexo">-</p>
                </div>
                <div class="col-md-6">
                  <label class="text-muted">Correo</label>
                  <p class="fw-bold" id="card_correo">-</p>
                </div>
                <div class="col-md-6">
                  <label class="text-muted">Teléfono</label>
                  <p class="fw-bold" id="card_telefono">-</p>
                </div>
                <div class="col-12">
                  <label class="text-muted">Dirección</label>
                  <p class="fw-bold" id="card_direccion">-</p>
                </div>
              </div>
            </div>
            <!-- Cliente: historial -->
            <div class="tab-pane fade" id="tabHistorial">
              <p class="text-muted">Últimos préstamos, libros descargados, audiolibros escuchados, etc.</p>
              <ul class="list-group">
                <li class="list-group-item">Último préstamo: <span class="text-muted">N/A</span></li>
                <li class="list-group-item">Total préstamos: <span class="text-muted">0</span></li>
              </ul>
            </div>
            <!-- Empleado: actividad -->
            <div class="tab-pane fade" id="tabActividad">
              <p class="text-muted">Registro de actividades de gestión: registros, ediciones, préstamos, etc.</p>
              <ul class="list-group">
                <li class="list-group-item">Última acción: <span class="text-muted">-</span></li>
                <li class="list-group-item">Registros gestionados: <span class="text-muted">-</span></li>
              </ul>
            </div>
            <!-- Admin: sistema -->
            <div class="tab-pane fade" id="tabSistema">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Rol</label>
                  <p class="fw-bold" id="card_rol">admin</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Estado</label>
                  <p class="fw-bold" id="card_estado_2">activo</p>
                </div>
                <div class="col-md-12 mb-3">
                  <label class="text-muted">Creado el</label>
                  <p class="fw-bold" id="card_fecha_creacion">—</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer bg-light rounded-bottom-4">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      const form = this.closest('form');

      Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          // Acción real aquí. Por ejemplo:
          // eliminarUsuario(id);
          form.submit(); // Envía el formulario para eliminar el usuario
          Swal.fire({
            icon: 'success',
            title: 'Eliminado',
            text: 'El registro ha sido eliminado exitosamente.',
            confirmButtonColor: '#28a745'
          });

          // También puedes eliminar dinámicamente la fila:
          // btn.closest('tr').remove();
        }
      });
    });
});

/**********************************************************************************************/
document.querySelectorAll('.btn-edit').forEach(button => {
  button.addEventListener('click', function () {
    const form = document.getElementById('formEditarUsuario');

    form.action = `/admin/gestion/usuarios/${this.dataset.id}`; // Asume ruta REST

    form.querySelector('input[name="id"]').value = this.dataset.id;
    form.querySelector('input[name="nombre_completo"]').value = this.dataset.nombre;
    form.querySelector('input[name="edad"]').value = this.dataset.edad;
    form.querySelector('select[name="sexo"]').value = this.dataset.sexo;
    form.querySelector('input[name="nombre_usuario"]').value = this.dataset.nombre_usuario;
    form.querySelector('input[name="correo"]').value = this.dataset.correo;
    form.querySelector('select[name="rol"]').value = this.dataset.rol;
    form.querySelector('input[name="numero_telefono"]').value = this.dataset.telefono;
    form.querySelector('input[name="direccion"]').value = this.dataset.direccion;
    form.querySelector('input[name="url_imagen"]').value = this.dataset.url_imagen
  });
});

// Script para el buscador de usuarios
document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('buscadorUsuario');
  const filas = document.querySelectorAll('.modern-table tbody tr');
  const filtros = document.querySelectorAll('.filter-btn');

  let filtroActivo = 'all'; // Estado actual del filtro

  function filtrar() {
    const texto = input.value.toLowerCase().trim();

    filas.forEach(fila => {
      const nombre = fila.children[1].textContent.toLowerCase();
      const correo = fila.children[2].textContent.toLowerCase();
      const rol = fila.dataset.rol; // admin, empleado, cliente

      const coincideFiltro = (filtroActivo === 'all' || filtroActivo === rol);
      const coincideBusqueda = (nombre.includes(texto) || correo.includes(texto));

      if (coincideFiltro && coincideBusqueda) {
        fila.style.display = '';
      } else {
        fila.style.display = 'none';
      }
    });
  }

  // Evento al escribir
  input.addEventListener('keyup', filtrar);

  // Evento al hacer clic en un filtro
  filtros.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      filtros.forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      filtroActivo = this.dataset.filter; // admin, cliente, empleado, all
      filtrar();
    });
  });
});

document.addEventListener('click', async (e) => {
  if (e.target.matches('.btn-view')) {
    const id = e.target.dataset.id;

    try {
      const res = await fetch(`/admin/gestion/usuarios/${id}`);
      const usuario = await res.json();

      // Info general
      document.getElementById('card_nombre_usuario').textContent = usuario.nombre_usuario;
      document.getElementById('card_nombre_completo').textContent = usuario.nombre_completo;
      document.getElementById('card_edad').textContent = usuario.edad;
      document.getElementById('card_sexo').textContent = usuario.sexo;
      document.getElementById('card_correo').textContent = usuario.correo;
      document.getElementById('card_telefono').textContent = usuario.numero_telefono;
      document.getElementById('card_direccion').textContent = usuario.direccion;
      document.getElementById('card_estado').textContent = usuario.estado;
      document.getElementById('card_estado_2').textContent = usuario.estado;
      document.getElementById('card_rol').textContent = usuario.rol;
      document.getElementById('card_fecha_creacion').textContent = new Date(usuario.created_at).toLocaleDateString();

      document.getElementById('card_imagen').src = usuario.url_imagen || 'https://via.placeholder.com/150';

      // Mostrar solo las tabs correspondientes al rol
      document.getElementById('tabCliente').classList.toggle('d-none', usuario.rol !== 'cliente');
      document.getElementById('tabEmpleado').classList.toggle('d-none', usuario.rol !== 'empleado');
      document.getElementById('tabAdmin').classList.toggle('d-none', usuario.rol !== 'admin');

      // Mostrar modal
      new bootstrap.Modal(document.getElementById('modalVistaUsuario')).show();

    } catch (err) {
      console.error(err);
      alert("Error al cargar usuario.");
    }
  }
});



/**********************************************************************************************/
</script>
@endsection

@if ($errors->any())
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const modal = new bootstrap.Modal(document.getElementById('modalAgregarUsuario'));
      modal.show();
    });
  </script>
@endif


