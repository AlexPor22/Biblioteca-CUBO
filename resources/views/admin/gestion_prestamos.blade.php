@extends('layouts.admin')
@section('content')
<div class="historial-page">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Gestión de Préstamos</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Administra y supervisa todos los préstamos de tu biblioteca digital.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">156</div>
          <div class="stat-label">Total Préstamos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">23</div>
          <div class="stat-label">Préstamos Activos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">8</div>
          <div class="stat-label">Préstamos Vencidos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">125</div>
          <div class="stat-label">Préstamos Devueltos</div>
        </div>
      </div>
    </div>
    <!-- Barra de Búsqueda -->
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Buscar por nombre de usuario y nombre del libro...">
      <button class="search-btn">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <!-- Sección de contenido principal -->
    <div class="content-section">
      <div class="section-header">
        <h3 class="section-title">Catálogo de Prestamos</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="">Activos</a>
          <a href="#" class="filter-btn" data-filter="">Vencidos</a>
          <a href="#" class="filter-btn" data-filter="">Devueltos</a>
          <a href="#" class="filter-btn" data-filter="">Renovados</a>
        </div>
        <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalAgregarPrestamo">Nuevo Préstamo</a>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Libro</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span >1</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div >maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div >El Quijote de la Mancha</div>
              <div >Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status activo">Activo</span></td>
            <td>
              <div class="action-buttons">
                <button class="btn-renew">Renovar</button>
                <button class="btn-edit" data-id="1" data-bs-toggle="modal" data-bs-target="#modalEditarPrestamo">Editar</button>
                <button class="btn-delete" data-id="1">Eliminar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td><span >2</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div >maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div >El Quijote de la Mancha</div>
              <div >Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status vencido">Vencido</span></td>
            <td>
              <div class="action-buttons">
                <button class="btn-renew">Renovar</button>
                <button class="btn-edit" data-id="2" data-bs-toggle="modal" data-bs-target="#modalEditarPrestamo">Editar</button>
                <button class="btn-delete" data-id="2">Eliminar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td><span >3</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div >maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div >El Quijote de la Mancha</div>
              <div >Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status devuelto">Devuelto</span></td>
            <td>
              <div class="action-buttons">
                <button class="btn-renew">Renovar</button>
                <button class="btn-edit" data-id="3" data-bs-toggle="modal" data-bs-target="#modalEditarPrestamo">Editar</button>
                <button class="btn-delete" data-id="3">Eliminar</button>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Paginación 
      <div class="pagination">
        <a href="#">« Anterior</a>
        <a href="#" class="active">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">Siguiente »</a>
      </div> -->
  </div>
</div>
<!-- Modal para agregar préstamo -->
<div class="modal fade" id="modalAgregarPrestamo" tabindex="-1" aria-labelledby="agregarPrestamoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formAgregarPrestamo">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarPrestamoLabel">Nuevo Préstamo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nombre del Usuario</label>
              <input type="text" class="form-control" name="usuario" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Correo del Usuario</label>
              <input type="email" class="form-control" name="correo_usuario" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Título del Libro</label>
              <input type="text" class="form-control" name="titulo_libro" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Código del Libro</label>
              <input type="text" class="form-control" name="codigo_libro" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha Préstamo</label>
              <input type="date" class="form-control" name="fecha_prestamo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha Devolución</label>
              <input type="date" class="form-control" name="fecha_devolucion" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="activo">Activo</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Registrar Préstamo</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal para editar préstamo -->
<div class="modal fade" id="modalEditarPrestamo" tabindex="-1" aria-labelledby="editarPrestamoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formEditarPrestamo">
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="editarPrestamoLabel">Editar Préstamo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nombre del Usuario</label>
              <input type="text" class="form-control" name="usuario" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Correo del Usuario</label>
              <input type="email" class="form-control" name="correo_usuario" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Título del Libro</label>
              <input type="text" class="form-control" name="titulo_libro" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Código del Libro</label>
              <input type="text" class="form-control" name="codigo_libro" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha Préstamo</label>
              <input type="date" class="form-control" name="fecha_prestamo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Fecha Devolución</label>
              <input type="date" class="form-control" name="fecha_devolucion" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="activo">Activo</option>
                <option value="vencido">Vencido</option>
                <option value="devuelto">Devuelto</option>
                <option value="renovado">Renovado</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar Préstamo</button>
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