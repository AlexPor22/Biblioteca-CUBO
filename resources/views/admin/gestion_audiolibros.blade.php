@extends('layouts.admin')

@section('content')
<div class="libros-page">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  @endif
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Gestión de Audiolibros</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Administra tu colección de audiolibros. Aquí podrás publicar, editar y eliminar contenido, así como gestionar su estado y categorías.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number"> {{ $total }} </div>
          <div class="stat-label">Total de Libros</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $habilitados }}</div>
          <div class="stat-label">Habilitados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $deshabilitados }}</div>
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
          <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalPublicarAudio">Nuevo Audiolibro</a>
        </div>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
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
          @foreach ($audiolibros as $audiolibro)
          <tr>
            <td>
              <div>{{ $audiolibro->titulo }}</div>
              <div>{{ $audiolibro->autor }}</div>
            </td>
            <td><span>{{ $audiolibro->getNombreCategoria() }}</span></td>
            <td>{{ $audiolibro->codigo }}</td>
            <td>
              <span class="status-badge {{ $audiolibro->estado }} {{ $audiolibro->getEstadoClass() }}"> 
                {{ ucfirst($audiolibro->estado) }}
              </span>

            </td>
            <td><span>Audiolibro</span></td>
            <td>{{ $audiolibro->fecha_registro }}</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit" data-id="{{ $audiolibro->id }}" data-bs-toggle="modal" data-bs-target="#modalEditarAudio">Editar</button>

                <form action="{{ route('admin.gestionAudiolibros.destroy', $audiolibro->id) }}" method="POST" style="display: inline-block;">
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
      {{ $audiolibros->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<!-- Modal: Publicar Audiolibro -->
<div class="modal fade" id="modalPublicarAudio" tabindex="-1" aria-labelledby="publicarAudioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formPublicarAudio" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="publicarAudioLabel">Publicar Audiolibro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Título del Audiolibro</label>
              <input type="text" class="form-control" name="titulo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Código del Audiolibro</label>
              <input type="text" class="form-control" name="codigo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Narrador</label>
              <input type="text" class="form-control" name="narrador" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Categoría</label>
              <input type="text" class="form-control" name="categoria" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Duración (minutos)</label>
              <input type="number" class="form-control" name="duracion" min="1" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Portada del Audiolibro (JPG, PNG)</label>
              <input type="file" class="form-control" name="portada" accept=".jpg,.jpeg,.png" required>
            </div>
            <div class="col-md-12">
              <label class="form-label">Archivo de Audio (MP3, M4A, WAV)</label>
              <input type="file" class="form-control" name="audio" accept=".mp3,.m4a,.wav" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Subir Audiolibro</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal: Editar Audiolibro -->
<div class="modal fade" id="modalEditarAudio" tabindex="-1" aria-labelledby="editarAudioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formEditarAudio" enctype="multipart/form-data">
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="editarAudioLabel">Editar Audiolibro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Título</label>
              <input type="text" class="form-control" name="titulo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Código del Audiolibro</label>
              <input type="text" class="form-control" name="codigo" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Narrador</label>
              <input type="text" class="form-control" name="narrador" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Categoría</label>
              <input type="text" class="form-control" name="categoria" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Duración (minutos)</label>
              <input type="number" class="form-control" name="duracion" min="1" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="habilitar">Habilitado</option>
                <option value="deshabilitar">Deshabilitado</option>
              </select>
            </div>
            <div class="col-md-12">
              <label class="form-label">Portada (opcional)</label>
              <input type="file" class="form-control" name="portada" accept=".jpg,.jpeg,.png">
            </div>
            <div class="col-md-12">
              <label class="form-label">Archivo de Audio (opcional)</label>
              <input type="file" class="form-control" name="audio" accept=".mp3,.m4a,.wav">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Actualizar Audiolibro</button>
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
</script>
@endsection