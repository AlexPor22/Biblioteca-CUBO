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
        <a href="#" class="btn-add" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
          </svg>
          Nueva Categoría
        </a>
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
            <td><span class="category-name">Ficción</span></td>
            <td>12 libros</td>
            <td>
              <span style="color: #28a745; font-weight: 600;">
                <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 0.25rem;">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                </svg>
                Activa
              </span>
            </td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-edit">
                  <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                    </path>
                  </svg>
                  Editar
                </a>
                <a href="#" class="btn-delete">
                  <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  Eliminar
                </a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span>2</span></td>
            <td><span class="category-name">Ciencia Ficción</span></td>
            <td>8 libros</td>
            <td>
              <span style="color: #28a745; font-weight: 600;">
                <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 0.25rem;">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                </svg>
                Activa
              </span>
            </td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-edit">
                  <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                    </path>
                  </svg>
                  Editar
                </a>
                <a href="#" class="btn-delete">
                  <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  Eliminar
                </a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span>3</span></td>
            <td><span class="category-name">Romance</span></td>
            <td>4 libros</td>
            <td>
              <span style="color: #ffc107; font-weight: 600;">
                <svg width="14" height="14" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 4px;">
                  <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                  <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                </svg>
                Pendiente
              </span>
            </td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-edit">
                  <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                    </path>
                  </svg>
                  Editar
                </a>
                <a href="#" class="btn-delete">
                  <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                  </svg>
                  Eliminar
                </a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- Modal: Nueva Categoría -->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalAgregarCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0" style="border-radius: 16px; animation: fadeInDown 0.4s;">
      <div class="modal-header text-white" style="background: linear-gradient(135deg, #343a40, #212529); border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h5 class="modal-title" id="modalAgregarCategoriaLabel">
          <i class="fas fa-tags me-2"></i>
          <span id="tituloModal">
          Agregar Nueva Categoría
          </span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background-color: #dc3545;"></button>
      </div>
      <form id="formCategoria" onsubmit="agregarCategoria(event)">
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
              <input type="text" class="form-control" id="nombre_categoria" placeholder="Ej. Literatura Clásica" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="estado_categoria" class="form-label">Estado</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
              <select class="form-select" id="estado_categoria" required>
                <option value="activa">Activa</option>
                <option value="pendiente">Pendiente</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer px-4 py-3" style="justify-content: space-between;">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-success">
          <i class="fas fa-check"></i> Guardar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal: Editar Categoría -->
<div class="modal fade" id="modalEditarCategoria" tabindex="-1" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0" style="border-radius: 16px; animation: fadeInDown 0.4s;">
      <div class="modal-header text-white" style="background: linear-gradient(135deg, #343a40, #212529); border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h5 class="modal-title" id="modalEditarCategoriaLabel">
          <i class="fas fa-edit me-2"></i>
          <span id="tituloModalEditar">
          Editar Categoría
          </span> 
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background-color: #dc3545;"></button>
      </div>
      <form id="formEditarCategoria" onsubmit="actualizarCategoria(event)">
        <div class="modal-body px-4 py-3">
          <input type="hidden" id="categoria_id">
          <div class="mb-3">
            <label for="editar_nombre_categoria" class="form-label">Nombre de la Categoría</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
              <input type="text" class="form-control" id="editar_nombre_categoria" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="editar_estado_categoria" class="form-label">Estado</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
              <select class="form-select" id="editar_estado_categoria" required>
                <option value="activa">Activa</option>
                <option value="pendiente">Pendiente</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer px-4 py-3" style="justify-content: space-between;">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-primary">
          <i class="fas fa-save"></i> Actualizar
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Script para insertar categoría dinámicamente -->
<script>
function agregarCategoria(e) {
  e.preventDefault();

  const nombre = document.getElementById('nombre_categoria').value.trim();
  const estado = document.getElementById('estado_categoria').value.trim();

  if (!nombre || !estado) return;

  const tabla = document.querySelector(".modern-table tbody");
  const nuevaFila = document.createElement("tr");
  const id = tabla.rows.length + 1;

  const estadoHTML = estado === 'activa' ?
    `<span style="color: #28a745; font-weight: 600;">
        <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 0.25rem;">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
        </svg>
        Activa
    </span>` :
    `<span style="color: #ffc107; font-weight: 600;">
        <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 0.25rem;">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
        </svg>
        Pendiente
    </span>`;

  nuevaFila.innerHTML = `
    <td><span class="id-badge">${id}</span></td>
    <td><span class="category-name">${nombre}</span></td>
    <td>0 libros</td>
    <td>${estadoHTML}</td>
    <td>
      <div class="action-buttons">
        <a href="#" class="btn-edit">
            <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708L5.707 14.001 2 14.866l.855-3.707L12.146.146zm.353.354-1.5 15 3.5l1.5-1.5L12.5.5zm-2.5 2.5L2.5 10.5l-.457 2.043L4.086 12l7.5-7.5L9.999 3z"/>
            </svg>
            Editar
        </a>
        <a href="#" class="btn-delete">
            <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>
            Eliminar
        </a>
      </div>
    </td>`;

  tabla.appendChild(nuevaFila);

    Swal.fire({
        icon: 'success',
        title: '¡Categoría agregada!',
        text: `Se agregó "${nombre}" correctamente.`,
        timer: 1600,
        showConfirmButton: false
    });

  bootstrap.Modal.getOrCreateInstance(document.getElementById('modalAgregarCategoria')).hide();
  document.getElementById('formCategoria').reset();
}

document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      
      // Cambiar el título del modal
      document.getElementById('tituloModalEditar').textContent = 'Editar Categoría';

      // Mostrar el modal
      const modal = new bootstrap.Modal(document.getElementById('modalEditarCategoria'));
      modal.show();

      // Aquí podrías precargar datos si trabajas con una tabla real
      // Por ejemplo: cargarUsuario(id)
    });
  });

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