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
      <h1 class="header-title">Gestión de Libros Digitales</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Administra tu colección de libros digitales. Aquí podrás publicar, editar y eliminar contenido, así como gestionar su estado y categorías.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">{{ $total }}</div>
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
    <form method="GET" action="{{ route('admin.gestionLibrosDigitales') }}" class="search-bar" style="margin-bottom: 1rem;">
      <input 
        type="text"
        name="search"
        class="search-input"
        id="buscarLibro"
        placeholder="Buscar por nombre del libro, categoría, código, estado y tipo..."
        value="{{ request('search') }}">
        <!-- Botón de búsqueda 
      <button class="search-btn">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </button>
      -->
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
          <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalPublicarLibro">Nuevo Libro Digital</a>
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
          @foreach ($libros_digital as $librodigital)
          <tr data-estado="{{ strtolower($librodigital->estado) }}">
            <td>
              <div>{{ $librodigital->titulo }}</div>
              <div>{{ $librodigital->autor }}</div>
            </td>
            <td><span>{{ $librodigital->getNombreCategoria() }}</span></td>
            <td>{{ $librodigital->codigo }}</td>
            <td>
              <span class="status-badge {{ $librodigital->estado }} {{ $librodigital->getEstadoClass() }}">
                {{ ucfirst($librodigital->estado) }}
              </span>
            </td>
            <td><span>{{ $librodigital->permiso_acceso }}</span></td>
            <td>{{ $librodigital->fecha_registro }}</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view" data-id="{{ $librodigital->id }}">Ver libro</button>

                <button class="btn-edit" 
                data-id="{{ $librodigital->id }}"
                data-titulo="{{ $librodigital->titulo }}"
                data-codigo="{{ $librodigital->codigo }}"
                data-autor="{{ $librodigital->autor }}"
                data-categoria="{{ $librodigital->categoria_id }}"
                data-acceso="{{ $librodigital->permiso_acceso }}"
                data-estado="{{ $librodigital->estado }}"
                data-portada="{{ $librodigital->portada_url }}"
                data-archivo="{{ $librodigital->archivo_url }}"
                data-bs-toggle="modal" data-bs-target="#modalEditarLibro">Editar</button>

                <form action="{{ route('admin.gestionLibrosDigitales.destroy', $librodigital->id) }}" method="POST" style="display: inline-block;">
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
      {{ $libros_digital->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<!-- Modal: Publicar Libro Digital -->
<div class="modal fade" id="modalPublicarLibro" tabindex="-1" aria-labelledby="publicarLibroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formPublicarLibro" action="{{ route('admin.gestionLibrosDigitales.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="publicarLibroLabel">Publicar Libro Digital</h5>
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
            <!-- Titulo del libro -->
            <div class="col-md-6">
              <label class="form-label">Título del Libro</label>
              <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" required>
            </div>

            <!-- Código del libro -->
            <div class="col-md-6">
              <label class="form-label">Código del Libro</label>
              <input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}" required>
            </div>

            <!-- Autor del libro -->
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" value="{{ old('autor') }}" required>
            </div>

            <!-- Categoría del libro -->
            <div class="col-md-6">
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

            <!-- Permisos de acceso -->
            <div class="col-md-6">
              <label class="form-label">Permisos de Acceso</label>
              <select class="form-select" name="permiso_acceso" required>
                <option value="" disabled selected>Seleccione un permiso</option>
                <option value="publico">Público</option>
                <option value="privado">Privado</option>
              </select>
            </div>

            <!-- Estado del libro -->
            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="habilitado">Habilitar</option>
                <option value="deshabilitado">Deshabilitar</option>
              </select>
            </div>

            <!-- Portada del Libro -->
            <div class="col-md-12">
              <label class="form-label">Portada del Libro (JPG, PNG)</label>
              <input type="text" class="form-control" name="portada_url" value="{{ old('portada_url') }}" accept=".jpg,.jpeg,.png" required>
            </div>

            <!-- Archivo del Libro -->
            <div class="col-md-12">
              <label class="form-label">Archivo del Libro (PDF, EPUB, MOBI)</label>
              <input type="text" class="form-control" name="archivo_url" value="{{ old('archivo_url') }}" accept=".pdf,.epub,.mobi" required>
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
      <form id="formEditarLibro" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id">
        <div class="modal-header">
          <h5 class="modal-title" id="editarLibroLabel">Editar Libro Digital</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <!-- Título del Libro -->
            <div class="col-md-6">
              <label class="form-label">Título</label>
              <input type="text" class="form-control" name="titulo" required>
            </div>

            <!-- Código del Libro -->
            <div class="col-md-6">
              <label class="form-label">Código del Libro</label>
              <input type="text" class="form-control" name="codigo" required>
            </div>

            <!-- Autor del Libro -->
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" required>
            </div>

            <!-- Categoría del Libro -->
            <div class="col-md-6">
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

            <!-- Permisos de Acceso -->
            <div class="col-md-6">
              <label class="form-label">Permisos de Acceso</label>
              <select class="form-select" name="permiso_acceso" required>
                <option value="publico">Público</option>
                <option value="privado">Privado</option>
              </select>
            </div>

            <!-- Estado del Libro -->
            <div class="col-md-6">
              <label class="form-label">Estado del Libro</label>
              <select class="form-select" name="estado" required>
                <option value="habilitado">Habilitar</option>
                <option value="deshabilitado">Deshabilitar</option>
              </select>
            </div>

            <!-- Portada del Libro (opcional) -->
            <div class="col-md-12">
              <label class="form-label">Portada (opcional)</label>
              <input type="text" class="form-control" name="portada_url" accept=".jpg,.jpeg,.png">
            </div>

            <!-- Archivo del Libro (opcional) -->
            <div class="col-md-12">
              <label class="form-label">Archivo del Libro (opcional)</label>
              <input type="text" class="form-control" name="archivo_url" accept=".pdf,.epub,.mobi">
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

<!-- Modal: Vista Detallada de Libro Digital -->
<div class="modal fade" id="modalVistaLibro" tabindex="-1" aria-labelledby="modalVistaLibroLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">

      <div class="modal-header bg-dark text-white rounded-top-4">
        <h5 class="modal-title" id="modalVistaLibroLabel">Detalles del Libro Digital</h5>
      </div>

      <div class="modal-body p-0">
        <div class="card border-0">

          <!-- Portada + título -->
          <div class="text-center p-1 bg-light border-bottom">
            <img id="libro_portada" src="" alt="Portada del libro"
            class="rounded shadow cursor-pointer"
            style="width: 140px; height: 190px; object-fit: cover; cursor: pointer;"
            data-bs-toggle="modal" data-bs-target="#modalImagenPortada">

            <h4 class="fw-bold mt-3" id="libro_titulo">-</h4>
          </div>

          <!-- Tabs -->
          <ul class="nav nav-tabs nav-justified fw-semibold border-bottom bg-white" id="tabLibro" role="tablist">
            <li class="nav-item">
              <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabInfoLibro">Información</button>
            </li>
            <li class="nav-item">
              <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAccesoLibro">Acceso</button>
            </li>
          </ul>

          <!-- Tab content -->
          <div class="tab-content p-4">
            <!-- Información -->
            <div class="tab-pane fade show active" id="tabInfoLibro">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Autor</label>
                  <p class="fw-bold" id="libro_autor">-</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Categoría</label>
                  <p class="fw-bold" id="libro_categoria">-</p>
                </div>
                <div class="col-md-6 mb-3">
                  <label class="text-muted">Código</label>
                  <p class="fw-bold" id="libro_codigo">-</p>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="text-muted">Estado</label>
                  <p class="fw-bold" id="libro_estado">-</p>
                </div>

                <div class="col-md-6 mb-3">
                  <label class="text-muted">Tipo</label>
                  <p class="fw-bold" id="libro_tipo">-</p>

                </div>

                <div class="col-md-6 mb-3">
                  <label class="text-muted">Registrado el</label>
                  <p class="fw-bold" id="libro_fecha">-</p>
                </div>
              </div>
            </div>

            <!-- Acceso -->
            <div class="tab-pane fade" id="tabAccesoLibro">
              <div class="mb-3">
                <label class="text-muted">Permiso de Acceso</label>
                <p class="fw-bold" id="libro_acceso">-</p>
              </div>
              <div class="mb-3">
                <label class="text-muted">Enlace al archivo</label><br>
                <a href="#" id="libro_archivo" class="btn btn-outline-primary btn-sm" target="_blank">Ver archivo</a>
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

document.querySelectorAll('.btn-edit').forEach(button => {
  button.addEventListener('click', function () {
    const form = document.getElementById('formEditarLibro');

    // Actualizar la acción del formulario con el ID del libro
    form.action = `/admin/gestion/libros/digitales/${this.dataset.id}`;

    // Rellenar los campos del formulario
    form.querySelector('input[name="id"]').value = this.dataset.id;
    form.querySelector('input[name="titulo"]').value = this.dataset.titulo;
    form.querySelector('input[name="codigo"]').value = this.dataset.codigo;
    form.querySelector('input[name="autor"]').value = this.dataset.autor;
    form.querySelector('select[name="categoria_id"]').value = this.dataset.categoria;
    form.querySelector('select[name="permiso_acceso"]').value = this.dataset.acceso;
    form.querySelector('select[name="estado"]').value = this.dataset.estado;
    form.querySelector('input[name="portada_url"]').value = this.dataset.portada;
    form.querySelector('input[name="archivo_url"]').value = this.dataset.archivo;

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
  const input = document.getElementById('buscarLibro');
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
      const estado = fila.children[4].textContent.toLowerCase();
      const tipo = fila.children[5].textContent.toLowerCase();

      const coincideFiltro = filtroActivo === 'all' || filtroActivo === estado;
      const coincideBusqueda = (titulo.includes(texto) || autor.includes(texto) || categoria.includes(texto) || codigo.includes(texto) || estado.includes(texto) || tipo.includes(texto));

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
      const res = await fetch(`/admin/gestion/libros/digitales/${id}`);
      const libro = await res.json();

      document.getElementById('libro_titulo').textContent = libro.titulo;
      document.getElementById('libro_codigo').textContent = libro.codigo;
      document.getElementById('libro_autor').textContent = libro.autor;
      document.getElementById('libro_categoria').textContent = libro.categoria;
      document.getElementById('libro_estado').textContent = libro.estado;
      document.getElementById('libro_tipo').textContent = libro.tipo;
      document.getElementById('libro_fecha').textContent = new Date(libro.fecha_registro).toLocaleDateString();
      document.getElementById('libro_acceso').textContent = libro.permiso_acceso;
      document.getElementById('libro_portada').src = libro.portada_url || 'https://i.pinimg.com/736x/9b/4e/45/9b4e45904003e8f1c70e800a27da6352.jpg';
      document.getElementById('libro_archivo').href = libro.archivo_url || '#';
      document.getElementById('libro_archivo').textContent = libro.archivo_url ? ' Ver archivo' : 'Archivo no disponible';

      new bootstrap.Modal(document.getElementById('modalVistaLibro')).show();
    } catch (error) {
      console.error('Error al cargar los detalles del libro:', error);
      alert("Error al cargar libro.");
    }
  }
});

document.getElementById('libro_portada').addEventListener('click', function () {
  const src = this.getAttribute('src');
  document.getElementById('imagen_ampliada').setAttribute('src', src);
});

</script>
@endsection