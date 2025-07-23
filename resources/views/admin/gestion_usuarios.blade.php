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
    <div class="search-bar">
      <input type="text" class="search-input" id="buscadorUsuario" placeholder="Buscar por nombre de usuario o correo electrónico...">
     <!-- <button class="search-btn">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </button> -->
    </div>
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
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Correo Electronico</th>
            <th>Tipo de Usuario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($usuarios as $usuario)
          <tr data-rol="{{ strtolower($usuario->rol) }}">
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->nombre_usuario }}</td>
            <td>{{ $usuario->correo }}</td>
            <td>
              <span class="user-type type-{{ strtolower($usuario->rol) }}">{{ ucfirst($usuario->rol) }}</span>
            </td>
            <td>
              <div class="action-buttons">
                <button class="btn-edit"
                        data-id="{{ $usuario->id }}"
                        data-nombre="{{ $usuario->nombre_completo }}"
                        data-edad="{{ $usuario->edad }}"
                        data-sexo="{{ $usuario->sexo }}"
                        data-nombre_usuario="{{ $usuario->nombre_usuario }}"
                        data-correo="{{ $usuario->correo }}"
                        data-rol="{{ $usuario->rol }}"
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
    <div class="pagination">
      <a href="#">« Anterior</a>
      <a href="#" class="active">1</a>
      <a href="#">2</a>
      <a href="#">3</a>
      <a href="#">Siguiente »</a>
    </div>
  </div>
</div>

<!-- Modal para agregar usuario con estilo -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="agregarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formAgregarUsuario" action="{{ route('admin.gestionUsuarios.store') }}" method="POST">
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
            <div class="col-md-6">
              <label class="form-label">Nombre Completo</label>
              <input type="text" class="form-control" name="nombre_completo" value="{{ old('nombre_completo') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Edad</label>
              <input type="number" class="form-control" name="edad" min="0" value="{{ old('edad') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Sexo</label>
              <select class="form-select" name="sexo" required>
                <option value="" disabled selected>Seleccione</option>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nombre de Usuario</label>
              <input type="text" class="form-control" name="nombre_usuario" value="{{ old('nombre_usuario') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" name="correo" value="{{ old('correo') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Rol</label>
              <select class="form-select" name="rol" required>
                <option value="" disabled selected>Seleccione un rol</option>
                <option value="admin">Admin</option>
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirmar Contraseña</label>
              <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
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
            <div class="col-md-6">
              <label class="form-label">Nombre Completo</label>
              <input type="text" class="form-control" name="nombre_completo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Edad</label>
              <input type="number" class="form-control" name="edad" min="0" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Sexo</label>
              <select class="form-select" name="sexo" required>
                <option value="masculino">Masculino</option>
                <option value="femenino">Femenino</option>
                <option value="otro">Otro</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Nombre de Usuario</label>
              <input type="text" class="form-control" name="nombre_usuario" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" name="correo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Rol</label>
              <select class="form-select" name="rol" required>
                <option value="admin">Admin</option>
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
              </select>
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

    form.action = `/admin/usuarios/${this.dataset.id}`; // Asume ruta REST

    form.querySelector('input[name="id"]').value = this.dataset.id;
    form.querySelector('input[name="nombre_completo"]').value = this.dataset.nombre;
    form.querySelector('input[name="edad"]').value = this.dataset.edad;
    form.querySelector('select[name="sexo"]').value = this.dataset.sexo;
    form.querySelector('input[name="nombre_usuario"]').value = this.dataset.nombre_usuario;
    form.querySelector('input[name="correo"]').value = this.dataset.correo;
    form.querySelector('select[name="rol"]').value = this.dataset.rol;
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


