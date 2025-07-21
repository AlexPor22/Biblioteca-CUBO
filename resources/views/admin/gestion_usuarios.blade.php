@extends('layouts.admin')

@section('content')
<div class="user-management">
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
          <div class="stat-number">3</div>
          <div class="stat-label">Total Usuarios</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">1</div>
          <div class="stat-label">Administradores</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">1</div>
          <div class="stat-label">Empleados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">1</div>
          <div class="stat-label">Clientes</div>
        </div>
      </div>
    </div>
    <!-- Barra de Búsqueda -->
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Buscar por nombre de usuario o correo electrónico...">
      <button class="search-btn">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <!-- Sección de contenido principal -->
    <div class="content-section">
      <div class="section-header">
        <h3 class="section-title">Gestión de Usuarios</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="">Admin</a>
          <a href="#" class="filter-btn" data-filter="">Empleados</a>
          <a href="#" class="filter-btn" data-filter="">Clientes</a>
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
          <tr>
            <td><span>1</span></td>
            <td><span >Denis</span></td>
            <td><span >martelldennis259@gmail.com</span></td>
            <td><span class="user-type type-admin">Admin</span></td>
            <td>
              <div class="action-buttons">
                <button class="btn-edit" data-id="1" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario">Editar</button>
                <button class="btn-delete" data-id="1">Eliminar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td><span>2</span></td>
            <td><span >Alexander</span></td>
            <td><span >martelldennis259@gmail.com</span></td>
            <td><span class="user-type type-empleado">Empleado</span></td>
            <td>
              <div class="action-buttons">
                <button class="btn-edit" data-id="2" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario">Editar</button>
                <button class="btn-delete" data-id="2">Eliminar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td><span>3</span></td>
            <td><span >Martel</span></td>
            <td><span >martelldennis259@gmail.com</span></td>
            <td><span class="user-type type-cliente">Cliente</span></td>
            <td>
              <div class="action-buttons">
                <button class="btn-edit" data-id="3" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario">Editar</button>
                <button class="btn-delete" data-id="3">Eliminar</button>
              </div>
            </td>
          </tr>
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
      <form id="formAgregarUsuario">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarUsuarioLabel">Agregar Usuario</h5>
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
                <option value="" disabled selected>Seleccione</option>
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
                <option value="" disabled selected>Seleccione un rol</option>
                <option value="admin">Admin</option>
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Contraseña</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Confirmar Contraseña</label>
              <input type="password" class="form-control" name="password_confirmation" required>
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
      <form id="formEditarUsuario">
        <input type="hidden" name="id">
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
</script>
@endsection