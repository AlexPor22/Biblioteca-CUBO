@extends('layouts.admin')

@section('content')
<div class="libros-page">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Gestión de Libros Digitales</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Administra tu colección de libros digitales. Aquí podrás publicar, editar y eliminar contenido, así como gestionar su estado y categorías.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">1,247</div>
          <div class="stat-label">Total de Libros</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">1,089</div>
          <div class="stat-label">Habilitados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">158</div>
          <div class="stat-label">Deshabilitados</div>
        </div>
      </div>
    </div>
    <!-- Barra de Búsqueda -->
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Buscar por nombre del libro, categoría, código, estado y tipo...">
      <button class="search-btn">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <!-- Sección de contenido principal -->
    <div class="content-section">
      <div class="section-header">
        <h3 class="section-title">Catálogo de Libros</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="">Habilitados</a>
          <a href="#" class="filter-btn" data-filter="">Deshabilitados</a>
        </div>
        <div>
          <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalPublicarLibro">Nuevo Libro Digital</a>
        </div>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Libro</th>
            <th>Categoría</th>
            <th>Codigo</th>
            <th>Estado</th>
            <th>Tipo</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($libros_digital as $librodigital)
          <tr>
            <td><span>{{ $librodigital->id }}</span></td>
            <td>
              <div>{{ $librodigital->titulo }}</div>
              <div>{{ $librodigital->autor }}</div>
            </td>
            <td><span>{{ $librodigital->getNombreCategoria() }}</span></td    >
            <td>{{ $librodigital->codigo }}</td>
            <td>
              <span class="status-badge {{ $librodigital->estado }} {{ $librodigital->getEstadoClass() }}">
                {{ ucfirst($librodigital->estado) }}
              </span>
            </td>
            <td><span>Libro</span></td>
            <td>{{ $librodigital->fecha_registro }}</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit" data-id="{{ $librodigital->id }}" data-bs-toggle="modal" data-bs-target="#modalEditarLibro">Editar</button>
                <button class="btn-delete" data-id="{{ $librodigital->id }}">Eliminar</button>
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

<!-- Modal: Publicar Libro Digital -->
<div class="modal fade" id="modalPublicarLibro" tabindex="-1" aria-labelledby="publicarLibroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formPublicarLibro" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="publicarLibroLabel">Publicar Libro Digital</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Título del Libro</label>
              <input type="text" class="form-control" name="titulo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Código del Libro</label>
              <input type="text" class="form-control" name="codigo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Categoría</label>
              <input type="text" class="form-control" name="categoria" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Permisos de Acceso</label>
              <select class="form-select" name="acceso" required>
                <option value="publico">Público</option>
                <option value="privado">Privado</option>
              </select>
            </div>
            <div class="col-md-12">
              <label class="form-label">Portada del Libro (JPG, PNG)</label>
              <input type="file" class="form-control" name="portada" accept=".jpg,.jpeg,.png" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Archivo del Libro (PDF, EPUB, MOBI)</label>
              <input type="file" class="form-control" name="archivo" accept=".pdf,.epub,.mobi" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Subir Libro</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal: Editar Libro Digital -->
<div class="modal fade" id="modalEditarLibro" tabindex="-1" aria-labelledby="editarLibroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formEditarLibro" enctype="multipart/form-data">
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="editarLibroLabel">Editar Libro Digital</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Título</label>
              <input type="text" class="form-control" name="titulo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Código del Libro</label>
              <input type="text" class="form-control" name="codigo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Categoría</label>
              <input type="text" class="form-control" name="categoria" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Permisos de Acceso</label>
              <select class="form-select" name="acceso" required>
                <option value="publico">Público</option>
                <option value="privado">Privado</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Estado del Libro</label>
              <select class="form-select" name="estado" required>
                <option value="disponible">Disponible</option>
                <option value="prestado">Prestado</option>
                <option value="reservado">Reservado</option>
                <option value="habilitar">Habilitar</option>
                <option value="deshabilitar">Deshabilitar</option>
              </select>
            </div>
            <div class="col-md-12">
              <label class="form-label">Portada (opcional)</label>
              <input type="file" class="form-control" name="portada" accept=".jpg,.jpeg,.png">
            </div>
            <div class="col-md-12">
              <label class="form-label">Archivo del Libro (opcional)</label>
              <input type="file" class="form-control" name="archivo" accept=".pdf,.epub,.mobi">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar Libro</button>
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