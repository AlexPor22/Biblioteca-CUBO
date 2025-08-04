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
    <form method="GET" action="{{ route('admin.gestionAudiolibros') }}" class="search-bar" style="margin-bottom: 1rem;">
      <input 
      type="text"
      name="search"
      class="search-input"
      id="buscarAudiolibro"
      placeholder="Buscar por nombre del libro, categoría, código, estado y tipo..."
      value="{{ request('search') }}">
    </form>
    <!-- Sección de contenido principal -->
    <div class="content-section">
      <div class="section-header">
        <h3 class="section-title">Catálogo de Libros</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="habilitado">Habilitados</a>
          <a href="#" class="filter-btn" data-filter="deshabilitado">Deshabilitados</a>
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
          <tr data-estado="{{ strtolower($audiolibro->estado) }}">
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
                <button class="btn-view" data-id="{{ $audiolibro->id }}">Ver Audiolibro</button>

                <button class="btn-edit" 
                data-id="{{ $audiolibro->id }}"
                data-titulo="{{ $audiolibro->titulo }}"
                data-codigo="{{ $audiolibro->codigo }}"
                data-autor="{{ $audiolibro->autor }}"
                data-narrador="{{ $audiolibro->narrador }}"
                data-categoria="{{ $audiolibro->categoria_id }}"
                data-duracion="{{ $audiolibro->duracion }}"
                data-portada="{{ $audiolibro->portada_url }}"
                data-audio="{{ $audiolibro->audio_url }}"
                data-estado="{{ $audiolibro->estado }}"
                data-bs-toggle="modal" data-bs-target="#modalEditarAudio">Editar</button>

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
      <form id="formPublicarAudio" action="{{ route('admin.gestionAudiolibros.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="publicarAudioLabel">Publicar Audiolibro</h5>
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
            <!-- Título del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Título del Audiolibro</label>
              <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" required>
            </div>

            <!-- Código del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Código del Audiolibro</label>
              <input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}" required>
            </div>

            <!-- Autor del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" value="{{ old('autor') }}" required>
            </div>

            <!-- Narrador del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Narrador</label>
              <input type="text" class="form-control" name="narrador" value="{{ old('narrador') }}" required>
            </div>

            <!-- Duración del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Duración (minutos)</label>
              <input type="text" class="form-control" name="duracion" value="{{ old('duracion') }}" min="1" required>
            </div>

            <!-- Estado del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="habilitado">Habilitar</option>
                <option value="deshabilitado">Deshabilitar</option>
              </select>
            </div>

            <!-- Categoría del Audiolibro -->
            <div class="col-md-12">
              <label for="categoria_id" class="form-label">Categoría</label>
              <select class="form-select" name="categoria_id" id="categoria_id" required>
                <option value="" disabled selected>Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                  <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                  </option>
                @endforeach
              </select>
              @error('categoria_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Portada del Audiolibro -->
            <div class="col-md-12">
              <label class="form-label">Portada del Audiolibro (JPG, PNG)</label>
              <input type="text" class="form-control" name="portada_url" accept=".jpg,.jpeg,.png" required>
            </div>

            <!-- Archivo de Audio -->
            <div class="col-md-12">
              <label class="form-label">Archivo de Audio (MP3, M4A, WAV)</label>
              <input type="text" class="form-control" name="audio_url" accept=".mp3,.m4a,.wav" required>
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
      <form id="formEditarAudio" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="editarAudioLabel">Editar Audiolibro</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <!-- Título del audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Título</label>
              <input type="text" class="form-control" name="titulo" required>
            </div>

            <!-- Código del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Código del Audiolibro</label>
              <input type="text" class="form-control" name="codigo" required>
            </div>

            <!-- Autor del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" required>
            </div>

            <!-- Narrador del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Narrador</label>
              <input type="text" class="form-control" name="narrador" required>
            </div>

            <!-- Duración del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Duración (minutos)</label>
              <input type="text" class="form-control" name="duracion" required>
            </div>

            <!-- Estado del Audiolibro -->
            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="habilitado">Habilitado</option>
                <option value="deshabilitado">Deshabilitado</option>
              </select>
            </div>

            <!-- Categoría del Audiolibro -->
            <div class="col-md-12">
              <label for="categoria_id" class="form-label">Categoría</label>
              <select class="form-select" name="categoria_id" id="categoria_id" required>
                @foreach($categorias as $categoria)
                  <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nombre }}
                  </option>
                @endforeach
              </select>
              @error('categoria_id')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>

            <!-- Portada del Audiolibro -->
            <div class="col-md-12">
              <label class="form-label">Portada (opcional)</label>
              <input type="text" class="form-control" name="portada_url" accept=".jpg,.jpeg,.png">
            </div>

            <!-- Archivo de Audio -->
            <div class="col-md-12">
              <label class="form-label">Archivo de Audio (opcional)</label>
              <input type="text" class="form-control" name="audio_url" accept=".mp3,.m4a,.wav">
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

<!-- Modal: Vista Detallada de Audiolibro -->
<div class="modal fade" id="modalVistaAudiolibro" tabindex="-1" aria-labelledby="modalVistaAudiolibroLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <div class="modal-header bg-dark text-white rounded-top-4">
        <h5 class="modal-title" id="modalVistaAudiolibroLabel">Detalles del Audiolibro</h5>
      </div>

      <div class="modal-body p-0">
        <div class="card border-0">

          <!-- Portada + título -->
          <div class="text-center p-1 bg-light border-bottom">
            <img id="audiolibro_portada" src="" alt="Portada del audiolibro"
            class="rounded shadow cursor-pointer"
            style="width: 140px; height: 190px; object-fit: cover; cursor: pointer;"
            data-bs-toggle="modal" data-bs-target="#modalImagenPortada">
            <h4 class="fw-bold mt-3" id="audiolibro_titulo">-</h4>
          </div>

          <!-- Tabs -->
          <ul class="nav nav-tabs nav-justified fw-semibold border-bottom bg-white" id="tabAudiolibro" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabInfoAudiolibro">Información</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAccesoAudiolibro">Audio</button>
            </li>
          </ul>

          <!-- Tab content -->
          <div class="tab-content p-4">
            <!-- Información -->
            <div class="tab-pane fade show active" id="tabInfoAudiolibro">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Autor</label>
                  <p class="fw-bold" id="audiolibro_autor">-</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Narrador</label>
                  <p class="fw-bold" id="audiolibro_narrador">-</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Categoría</label>
                  <p class="fw-bold" id="audiolibro_categoria">-</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Código</label>
                  <p class="fw-bold" id="audiolibro_codigo">-</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Duración</label>
                  <p class="fw-bold" id="audiolibro_duracion">-</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Estado</label>
                  <p class="fw-bold" id="audiolibro_estado">-</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Tipo</label>
                  <p class="fw-bold" id="audiolibro_tipo">-</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Registrado el</label>
                  <p class="fw-bold" id="audiolibro_fecha">-</p>
                </div>
              </div>
            </div>

            <!-- Acceso -->
            <div class="tab-pane fade" id="tabAccesoAudiolibro">
              <div class="mb-3">
                <label class="text-muted">Reproductor</label><br>
                <audio id="audiolibro_audio" controls style="width: 100%;">
                  <source src="#" type="audio/mpeg">
                  Tu navegador no soporta el elemento de audio.
                </audio>
              </div>
              <div class="mb-3">
                <label class="text-muted">Enlace al audio</label><br>
                <a href="#" id="audiolibro_audio_enlace" class="btn btn-outline-primary btn-sm" target="_blank">Escuchar completo</a>
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

<!-- Modal para mostrar portada en grande -->
<div class="modal fade" id="modalImagenPortada" tabindex="-1" aria-labelledby="modalImagenPortadaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-transparent border-0 text-center position-relative">

      <!-- Botón de cerrar -->
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3 bg-white rounded-circle p-2"
              data-bs-dismiss="modal" aria-label="Cerrar"
              style="z-index: 1055;"></button>

      <!-- Imagen ampliada -->
      <img id="imagen_ampliada" src="" alt="Portada grande"class="img-fluid rounded shadow-lg border border-white" style="max-height: 85vh;">


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

  document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function () {
      const form = document.getElementById('formEditarAudio');

      form.action = `/admin/gestion/libros/audiolibros/${this.dataset.id}`;

      // Rellenar el formulario con los datos del audiolibro
      form.querySelector('input[name="id"]').value = this.dataset.id;
      form.querySelector('input[name="titulo"]').value = this.dataset.titulo;
      form.querySelector('input[name="codigo"]').value = this.dataset.codigo;
      form.querySelector('input[name="autor"]').value = this.dataset.autor;
      form.querySelector('input[name="narrador"]').value = this.dataset.narrador;
      form.querySelector('select[name="categoria_id"]').value = this.dataset.categoria;
      form.querySelector('input[name="duracion"]').value = this.dataset.duracion;
      form.querySelector('select[name="estado"]').value = this.dataset.estado;
      form.querySelector('input[name="portada_url"]').value = this.dataset.portada;
      form.querySelector('input[name="audio_url"]').value = this.dataset.audio;

      // Forzar el cambio de categoría si por alguna razón no se refleja en la UI
      const categoriaSelect = form.querySelector('select[name="categoria_id"]');
      const categoriaId = this.dataset.categoria;

      if (categoriaSelect) {
        [...categoriaSelect.options].forEach(option => {
          option.selected = option.value === categoriaId;
        });
      }
    });
  });

document.addEventListener('DOMContentLoaded', function () {
  const input = document.getElementById('buscarAudiolibro');
  const filas = document.querySelectorAll('.modern-table tbody tr');
  const filtros = document.querySelectorAll('.filter-btn');

  let filtroActivo = 'all';

  function filtrar() {
    const texto = input.value.toLowerCase().trim();

    filas.forEach(fila => {
      const titulo = fila.children[0].textContent.toLowerCase();
      const autor = fila.children[1].textContent.toLowerCase();
      const categoria = fila.children[2].textContent.toLowerCase();
      const codigo = fila.children[3].textContent.toLowerCase();
      const estado = fila.dataset.estado;

      const coincideFiltro = filtroActivo === 'all' || filtroActivo === estado;
      const coincideBusqueda = (titulo.includes(texto) || autor.includes(texto) || categoria.includes(texto) || codigo.includes(texto));

      if (coincideFiltro && coincideBusqueda) {
        fila.style.display = '';
      } else {
        fila.style.display = 'none';
      }
    });
  }

  input.addEventListener('keyup', filtrar);

  filtros.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      filtros.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');

      filtroActivo = this.dataset.filter;
      filtrar();
    });
  });
});

document.addEventListener('click', async (e) => {
  if (e.target.matches('.btn-view')) {
    const id = e.target.dataset.id;

    try {
      const response = await fetch(`/admin/gestion/libros/audiolibros/${id}`);
      const audiolibro = await response.json();

      // Rellenar el modal con los datos del audiolibro
      document.getElementById('audiolibro_titulo').textContent = audiolibro.titulo;
      document.getElementById('audiolibro_autor').textContent = audiolibro.autor;
      document.getElementById('audiolibro_narrador').textContent = audiolibro.narrador;
      document.getElementById('audiolibro_categoria').textContent = audiolibro.categoria;
      document.getElementById('audiolibro_codigo').textContent = audiolibro.codigo;
      document.getElementById('audiolibro_duracion').textContent = audiolibro.duracion + ' minutos';
      document.getElementById('audiolibro_estado').textContent = audiolibro.estado.charAt(0).toUpperCase() + audiolibro.estado.slice(1);
      document.getElementById('audiolibro_tipo').textContent = 'Audiolibro';
      document.getElementById('audiolibro_fecha').textContent = new Date(audiolibro.fecha_registro).toLocaleDateString();
      document.getElementById('audiolibro_portada').src = audiolibro.portada_url || 'https://i.pinimg.com/736x/9b/4e/45/9b4e45904003e8f1c70e800a27da6352.jpg';
      document.getElementById('audiolibro_audio').src = audiolibro.audio_url || '#';

      new bootstrap.Modal(document.getElementById('modalVistaAudiolibro')).show();
    } catch (error) {
      console.error('Error al cargar el audiolibro:', error);
      alert('No se pudo cargar el audiolibro. Por favor, inténtalo de nuevo más tarde.');
    }
  }
});

document.getElementById('audiolibro_portada').addEventListener('click', function () {
  const src = this.getAttribute('src');
  document.getElementById('imagen_ampliada').setAttribute('src', src);
});

</script>
@endsection