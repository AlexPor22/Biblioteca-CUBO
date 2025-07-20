@extends('layouts.admin')

@section('content')
<div class="categories-page">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Categorías de Libros</h1>
      <p class="header-subtitle">Organiza y administra las categorías de tu biblioteca digital.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">5</div>
          <div class="stat-label">Total Categorías</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">3</div>
          <div class="stat-label">Categorías Activas</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">24</div>
          <div class="stat-label">Libros Categorizados</div>
        </div>
      </div>
    </div>
    <!-- Barra de Búsqueda -->
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Buscar por nombre o correo...">
      <button class="search-btn">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <!-- Sección de contenido principal -->
    <div class="content-section">
      <div class="section-header">
        <h3 class="section-title">Gestión de Categorías</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todas</a>
          <a href="#" class="filter-btn" data-filter="">Habilitadas</a>
          <a href="#" class="filter-btn" data-filter="">Deshabilitadas</a>
        </div>
        <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">Nueva Categoría</a>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre de Categoría</th>
            <th>Libros</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span>1</span></td>
            <td><span >Ficción</span></td>
            <td>12 libros</td>
            <td>
              <span>Habilitada</span>
            </td>
            <td>
              <div class="action-buttons">
                <button class="btn-edit" data-id="1" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria">Editar</button>
                <button class="btn-delete" data-id="1">Eliminar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td><span>2</span></td>
            <td><span >Romance</span></td>
            <td>4 libros</td>
            <td>
              <span >Deshabilitada</span>
            </td>
            <td>
              <div class="action-buttons">
                <button class="btn-edit" data-id="2" data-bs-toggle="modal" data-bs-target="#modalEditarCategoria">Editar</button>
                <button class="btn-delete" data-id="2">Eliminar</button>
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

<!-- Modal: Nueva Categoría -->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="agregarCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <form id="formAgregarCategoria">
        <div class="modal-header">
          <h5 class="modal-title" id="agregarCategoriaLabel">Agregar Nueva Categoría</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label">Nombre de la Categoría</label>
              <input type="text" class="form-control" name="nombre_categoria" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="habilitada">Habilitar</option>
                <option value="deshabilitada">Deshabilitar</option>
              </select>
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

<!-- Modal: Editar Categoría -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="editarCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content">
      <form id="formEditarCategoria">
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="editarCategoriaLabel">Editar Categoría</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-12">
              <label class="form-label">Nombre de la Categoría</label>
              <input type="text" class="form-control" name="nombre_categoria" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="habilitada">Habilitar</option>
                <option value="deshabilitada">Deshabilitar</option>
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

<!-- Script para insertar categoría dinámicamente -->
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