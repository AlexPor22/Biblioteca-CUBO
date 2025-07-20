@extends('layouts.admin')

@section('content')
<div class="libros-page">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Biblioteca de Libros</h1>
      <p class="header-subtitle">Explora, busca y gestiona toda tu colección de libros digitales.</p>
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
          <div class="stat-label">Disponibles</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">158</div>
          <div class="stat-label">Prestados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">342</div>
          <div class="stat-label">Reservados</div>
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
        <h3 class="section-title">Catálogo de Libros</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="">Disponibles</a>
          <a href="#" class="filter-btn" data-filter="">Prestados</a>
          <a href="#" class="filter-btn" data-filter="">Reservados</a>
          <a href="#" class="filter-btn" data-filter="">Habilitados</a>
          <a href="#" class="filter-btn" data-filter="">Deshabilitados</a>
        </div>
        <div>
          <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalPublicarLibro">Nuevo Libro</a>
          <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalPublicarAudio">Nuevo Audiolibro</a>
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
          <tr>
            <td><span>1</span></td>
            <td>
              <div >El Quijote de la Mancha</div>
              <div >Miguel de Cervantes</div>
            </td>
            <td><span>Historia</span></td>
            <td>978-84-376-0494-7</td>
            <td>
              <span class="status-badge status-disponible">Disponible</span>
            </td>
            <td><span>Libro</span></td>
            <td>08/02/2024</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit" data-id="1" data-bs-toggle="modal" data-bs-target="#modalEditarLibro">Editar</button>
                <button class="btn-delete" data-id="1">Eliminar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td><span >2</span></td>
            <td>
              <div >El Quijote de la Mancha</div>
              <div >Miguel de Cervantes</div>
            </td>
            <td><span>Ficción</span></td>
            <td>978-84-376-0494-7</td>
            <td>
              <span class="status-badge status-prestado">Prestado</span>
            </td>
            <td><span>Libro</span></td>
            <td>08/02/2024</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit" data-id="2" data-bs-toggle="modal" data-bs-target="#modalEditarLibro">Editar</button>
                <button class="btn-delete" data-id="2">Eliminar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td><span>3</span></td>
            <td>
              <div >Sapiens: De animales a dioses</div>
              <div >Yuval Noah Harari</div>
            </td>
            <td><span>Ciencia</span></td>
            <td>978-0-06-231609-7</td>
            <td>
              <span class="status-badge status-reservado">Reservado</span>
            </td>
            <td><span>Libro</span></td>
            <td>22/01/2024</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit" data-id="3" data-bs-toggle="modal" data-bs-target="#modalEditarLibro">Editar</button>
                <button class="btn-delete" data-id="3">Eliminar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td><span>4</span></td>
            <td>
              <div >Sapiens: De animales a dioses</div>
              <div >Yuval Noah Harari</div>
            </td>
            <td><span>Ciencia</span></td>
            <td>978-0-06-231609-7</td>
            <td>
              <span class="status-badge status-habilitado">Habilitado</span>
            </td>
            <td><span>Audiolibro</span></td>
            <td>22/01/2024</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit" data-id="4" data-bs-toggle="modal" data-bs-target="#modalEditarAudio">Editar</button>
                <button class="btn-delete" data-id="4">Eliminar</button>
              </div>
            </td>
          </tr>
          <tr>
            <td><span>5</span></td>
            <td>
              <div >Sapiens: De animales a dioses</div>
              <div >Yuval Noah Harari</div>
            </td>
            <td><span>Ciencia</span></td>
            <td>978-0-06-231609-7</td>
            <td>
              <span class="status-badge status-deshabilitado">Deshabilitado</span>
            </td>
            <td><span>Audiolibro</span></td>
            <td>22/01/2024</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit" data-id="5" data-bs-toggle="modal" data-bs-target="#modalEditarAudio">Editar</button>
                <button class="btn-delete" data-id="5">Eliminar</button>
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