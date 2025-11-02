@extends('layouts.admin')
@section('content')
<div class="publish-dashboard">
  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
  </div>
  @endif
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Gestion de Libros Fisicos</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Administra y controla todos los libros físicos del sistema.</p>
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
          <div class="stat-number">{{ $disponibles }}</div>
          <div class="stat-label">Libros disponibles</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $prestados }}</div>
          <div class="stat-label">Libros prestados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $reservados }}</div>
          <div class="stat-label">Reservados</div>
        </div>
      </div>
    </div>
    <!-- Barra de Búsqueda -->
    <form method="GET" action="" class="search-bar" style="margin-bottom: 1rem;">
      <input
        type="text"
        name="search"
        class="search-input"
        id="buscarLibro"
        placeholder="Buscar por nombre del libro, autor y categoria..."
        value="">
    </form>
    <!-- Sección de contenido principal -->
    <div class="content-section">
      <div class="section-header">
        <h3 class="section-title">Catálogo de Libros</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="disponible">Disponibles</a>
          <a href="#" class="filter-btn" data-filter="prestado">Prestados</a>
          <a href="#" class="filter-btn" data-filter="reservado">Reservados</a>
        </div>
        <div>
          <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalRegistrarLibroFisico">Nuevo Libro</a>
        </div>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
            <th>Libro</th>
            <th>Categoría</th>
            <th>Codigo</th>
            <th>Estado</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($libro_fisico as $librofisico)
            <tr data-estado="{{ strtolower($librofisico->estado) }}">
                <td>
                    <div>{{ $librofisico->titulo }}</div>
                    <div>{{ $librofisico->autor }}</div>
                </td>

                <td><span>{{ $librofisico->getNombreCategoria() }}</span></td>
                <td><span>{{ $librofisico->codigo }}</span></td>
                <td>
                    <span class="status-badge {{$librofisico->estado}} {{$librofisico->getEstadoClass()}}">
                        {{ ucfirst($librofisico->estado) }}
                    </span>
                </td>

                <td><span>{{ $librofisico->fecha_registro }}</span></td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-view" data-id="{{ $librofisico->id }}">Ver libro</button>
                        <button class="btn-edit"
                          data-id="{{ $librofisico->id }}"
                          data-titulo="{{ $librofisico->titulo }}"
                          data-codigo="{{ $librofisico->codigo }}"
                          data-autor="{{ $librofisico->autor }}"
                          data-categoria="{{ $librofisico->categoria_id }}"
                          data-estado="{{ $librofisico->estado }}"
                          data-portada="{{ $librofisico->portada_url }}"
                          data-bs-toggle="modal" data-bs-target="#modalEditarLibroFisico">Editar</button>
                        <form action="{{ route('admin.gestionLibrosFisicos.destroy', $librofisico->id) }}" method="POST" style="display: inline-block;">
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
    <div class="pagination-container d-flex justify-content-center mt-4">
      {{ $libro_fisico->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<!-- Modal: Registrar Libro Físico -->
<div class="modal fade" id="modalRegistrarLibroFisico" tabindex="-1" aria-labelledby="registrarLibroFisicoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <form id="formRegistrarLibroFisico" action="{{ route('admin.gestionLibrosFisicos.store') }}" method="POST">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="registrarLibroFisicoLabel">Registrar Libro Físico</h5>
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
            <!-- Título del libro -->
            <div class="col-md-6">
              <label class="form-label">Título del Libro</label>
              <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" required>
            </div>

            <!-- Código del libro -->
            <div class="col-md-6">
              <label class="form-label">Código del Libro</label>
              <input type="text" class="form-control" name="codigo" value="{{ old('codigo') }}" required>
            </div>

            <!-- Autor -->
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" value="{{ old('autor') }}" required>
            </div>

            <!-- Categoría -->
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

            <!-- Estado -->
            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" required>
                <option value="" disabled selected>Seleccione un estado</option>
                <option value="disponible">Disponible</option>
                <option value="prestado">Prestado</option>
                <option value="reservado">Reservado</option>
              </select>
            </div>

            <!-- Portada -->
            <div class="col-md-12">
              <label class="form-label">URL de la Portada</label>
              <input type="text" class="form-control" name="portada_url" value="{{ old('portada_url') }}" placeholder="https://mi-servidor.com/portadas/ejemplo.jpg" required>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Registrar Libro</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal: Editar Libro Físico -->
<div class="modal fade" id="modalEditarLibroFisico" tabindex="-1" aria-labelledby="editarLibroFisicoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <!-- Acción se actualiza dinámicamente con JS -->
      <form id="formEditarLibroFisico" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="editarLibroFisicoLabel">Actualizar Libro Físico</h5>
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
            <!-- ID oculto -->
            <input type="hidden" name="id" id="edit_id">

            <!-- Título del libro -->
            <div class="col-md-6">
              <label class="form-label">Título del Libro</label>
              <input type="text" class="form-control" name="titulo" id="edit_titulo" required>
            </div>

            <!-- Código del libro -->
            <div class="col-md-6">
              <label class="form-label">Código del Libro</label>
              <input type="text" class="form-control" name="codigo" id="edit_codigo" required>
            </div>

            <!-- Autor -->
            <div class="col-md-6">
              <label class="form-label">Autor</label>
              <input type="text" class="form-control" name="autor" id="edit_autor" required>
            </div>

            <!-- Categoría -->
            <div class="col-md-6">
              <label for="edit_categoria_id" class="form-label">Categoría</label>
              <select class="form-select" name="categoria_id" id="edit_categoria_id" required>
                <option value="" disabled selected>Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
              </select>
            </div>

            <!-- Estado -->
            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <select class="form-select" name="estado" id="edit_estado" required>
                <option value="disponible">Disponible</option>
                <option value="prestado">Prestado</option>
                <option value="reservado">Reservado</option>
              </select>
            </div>

            <!-- Portada -->
            <div class="col-md-12">
              <label class="form-label">URL de la Portada</label>
              <input type="text" class="form-control" name="portada_url" id="edit_portada_url" placeholder="https://mi-servidor.com/portadas/ejemplo.jpg" required>
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

<!-- Modal: Vista Detallada de Libro Físico -->
<div class="modal fade" id="modalVistaLibroFisico" tabindex="-1" aria-labelledby="modalVistaLibroFisicoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg rounded-4">
      <div class="modal-header bg-dark text-white rounded-top-4">
        <h5 class="modal-title" id="modalVistaLibroFisicoLabel">Detalles del Libro Físico</h5>
      </div>

      <div class="modal-body p-0">
        <div class="card border-0">
          <!-- Portada + título -->
          <div class="text-center p-3 bg-light border-bottom">
            <img id="libroFisico_portada" src="" alt="Portada del libro"
              class="rounded shadow cursor-pointer"
              style="width: 140px; height: 190px; object-fit: cover; cursor: pointer;"
              data-bs-toggle="modal" data-bs-target="#modalImagenPortadaFisico">
            <h4 class="fw-bold mt-3" id="libroFisico_titulo">-</h4>
          </div>

          <!-- Información del libro -->
          <div class="p-4">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="text-muted">Autor</label>
                <p class="fw-bold" id="libroFisico_autor">-</p>
              </div>

              <div class="col-md-6 mb-3">
                <label class="text-muted">Categoría</label>
                <p class="fw-bold" id="libroFisico_categoria">-</p>
              </div>

              <div class="col-md-6 mb-3">
                <label class="text-muted">Código</label>
                <p class="fw-bold" id="libroFisico_codigo">-</p>
              </div>

              <div class="col-md-6 mb-3">
                <label class="text-muted">Estado</label>
                <p class="fw-bold" id="libroFisico_estado">-</p>
              </div>

              <div class="col-md-6 mb-3">
                <label class="text-muted">Fecha de Registro</label>
                <p class="fw-bold" id="libroFisico_fecha">-</p>
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
<div class="modal fade" id="modalImagenPortadaFisico" tabindex="-1" aria-labelledby="modalImagenPortadaFisicoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content bg-transparent border-0 text-center position-relative">
      <!-- Botón de cerrar -->
      <button type="button" class="btn-close position-absolute top-0 end-0 m-3 bg-white rounded-circle p-2"
        data-bs-dismiss="modal" aria-label="Cerrar"
        style="z-index: 1055;"></button>
      <!-- Imagen ampliada -->
      <img id="imagen_ampliada_fisico" src="" alt="Portada grande"
        class="img-fluid rounded shadow-lg border border-white" style="max-height: 85vh;">
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

document.querySelectorAll('.btn-edit').forEach(button =>{
    button.addEventListener('click', function() {
        const form = document.getElementById('formEditarLibroFisico');

        // Actualizar la acción del formulario con el ID del libro
        form.action = `/admin/gestion/libros/fisicos/${this.dataset.id}`;

        // Rellenar los campos del formulario con los datos del libro
        form.querySelector('input[name="id"]').value = this.dataset.id;
        form.querySelector('input[name="titulo"]').value = this.dataset.titulo;
        form.querySelector('input[name="codigo"]').value = this.dataset.codigo;
        form.querySelector('input[name="autor"]').value = this.dataset.autor;
        form.querySelector('select[name="categoria_id"]').value = this.dataset.categoria;
        form.querySelector('select[name="estado"]').value = this.dataset.estado;
        form.querySelector('input[name="portada_url"]').value = this.dataset.portada;

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

document.addEventListener('DOMContentLoaded', () => {
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
            const estado  = fila.dataset.estado;

            const coincideFiltro = filtroActivo === 'all' || filtroActivo === estado;
            const coincideBusqueda = titulo.includes(texto) || autor.includes(texto) || categoria.includes(texto);

            if (coincideFiltro && coincideBusqueda) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    }

    input.addEventListener('keyup', filtrar);

    filtros.forEach(btn => {
        btn.addEventListener('click', function(e) {
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
            const res = await fetch(`/admin/gestion/libros/fisicos/${id}`);
            const libro = await res.json();

            // Rellenar los datos en el modal
            document.getElementById('libroFisico_titulo').textContent = libro.titulo;
            document.getElementById('libroFisico_autor').textContent = libro.autor;
            document.getElementById('libroFisico_categoria').textContent = libro.categoria;
            document.getElementById('libroFisico_codigo').textContent = libro.codigo;
            document.getElementById('libroFisico_fecha').textContent = new Date(libro.fecha_registro).toLocaleDateString();
            document.getElementById('libroFisico_estado').textContent = libro.estado.charAt(0).toUpperCase() + libro.estado.slice(1);
            document.getElementById('libroFisico_portada').src = libro.portada_url || '#';

            new bootstrap.Modal(document.getElementById('modalVistaLibroFisico')).show();
        } catch (error) {
            console.error('Error al obtener los detalles del libro:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudieron cargar los detalles del libro. Por favor, inténtalo de nuevo más tarde.',
                confirmButtonColor: '#dc3545'
            });
        }
    }
});

document.getElementById('libroFisico_portada').addEventListener('click', function() {
    const src = this.src;
    document.getElementById('imagen_ampliada_fisico').src = src;
});
</script>


@endsection
