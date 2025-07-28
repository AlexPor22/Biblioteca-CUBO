@extends('layouts.admin')

@section('content')
<div class="categories-page">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Gestion de Categorías</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Administra las categorías de libros y audiolibros de tu biblioteca digital. Aquí podrás crear, editar y eliminar categorías, así como gestionar su estado.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">{{ $total }}</div>
          <div class="stat-label">Total Categorías</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $totalCategorias }}</div>
          <div class="stat-label">Categorías Activas</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">12</div>
          <div class="stat-label">Libros Categorizados</div>
        </div>
      </div>
    </div>
    <!-- Barra de Búsqueda -->
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Buscar por categoria...">
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
          @foreach ($categorias as $categoria)
            <tr>
              <td><span>{{ $categoria->id }}</span></td>
              <td><span>{{ $categoria->nombre }}</span></td>
              <td>{{ $categoria->audiolibros->count() }} libros</td>
              <td>
                <span>{{ $categoria->estado }}</span>
              </td>
              <td>
                <div class="action-buttons">
                  <button class="btn-edit" 
                  data-id="{{ $categoria->id }}"
                  data-nombre="{{ $categoria->nombre }}"
                  data-estado="{{ $categoria->estado }}"
                  data-bs-toggle="modal" data-bs-target="#modalEditarCategoria">Editar</button>

                  <form action="{{ route('admin.gestionCategorias.destroy', $categoria->id) }}" method="POST" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                  <button type="submit" class="btn-delete">Eliminar</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach


          <!-- 
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
          -->
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
      <form id="formAgregarCategoria" action="{{ route('admin.gestionCategorias.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="agregarCategoriaLabel">Agregar Nueva Categoría</h5>
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
            <div class="col-md-12">
              <label class="form-label">Nombre de la Categoría</label>
              <input type="text" class="form-control" name="nombre_categoria" value="{{ old('nombre') }}" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="habilitado">Habilitar</option>
                <option value="deshabilitado">Deshabilitar</option>
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
      <form id="formEditarCategoria" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="">
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
                <option value="habilitado">Habilitar</option>
                <option value="deshabilitado">Deshabilitar</option>
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
          form.submit();
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


document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function () {
      const form = document.getElementById('formEditarCategoria');

      form.action = `/admin/categorias/${this.getAttribute('data-id')}`;

      form.querySelector('input[name="id"]').value = this.getAttribute('data-id');
      form.querySelector('input[name="nombre_categoria"]').value = this.getAttribute('data-nombre');
      form.querySelector('select[name="estado"]').value = this.getAttribute('data-estado');
    });
});




</script>

@endsection