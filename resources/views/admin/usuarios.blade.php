@extends('layouts.admin')

@section('content')
<div class="user-management">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Gestión de Usuarios</h1>
      <p class="header-subtitle">Administra y controla todos los usuarios del sistema.</p>
    </div>

    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">3</div>
          <div class="stat-label">Total Usuarios</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">1</div>
          <div class="stat-label">Administradores</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">1</div>
          <div class="stat-label">Empleados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">1</div>
          <div class="stat-label">Clientes</div>
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
        <h3 class="section-title">Gestión de Usuarios</h3>
        <a href="#" class="btn-add" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
          <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
          </svg>
          Nuevo Usuario
        </a>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
            <th>Telefono</th>
            <th>Nombre de Usuario</th>
            <th>Correo Electronico</th>
            <th>Tipo de Usuario</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span>1</span></td>
            <td><span class="user-name">Denis</span></td>
            <td><span class="user-email">martelldennis259@gmail.com</span></td>
            <td><span class="user-type type-admin">Admin</span></td>
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
            <td><span class="user-name">Alexander</span></td>
            <td><span class="user-email">martelldennis259@gmail.com</span></td>
            <td><span class="user-type type-empleado">Empleado</span></td>
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
            <td><span class="user-name">Martel</span></td>
            <td><span class="user-email">martelldennis259@gmail.com</span></td>
            <td><span class="user-type type-cliente">Cliente</span></td>
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

<!-- Modal para agregar usuario con estilo -->
<div class="modal fade" id="modalAgregarUsuario" tabindex="-1" aria-labelledby="modalAgregarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow-lg" style="border-radius: 16px; animation: bounceIn 0.5s;">
      <div class="modal-header" style="background: linear-gradient(135deg, #0D0D0D, #2c2c2c); color: white; border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h5 class="modal-title" id="modalAgregarUsuarioLabel">
          <i class="fas fa-user-plus me-2"></i><span id="tituloModal">Agregar Nuevo Usuario</span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background-color: #dc3545;"></button>
      </div>
      <form id="formUsuario" onsubmit="guardarUsuario(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="usuarioIndex">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="nombre" class="form-label">Nombre Completo</label>
              <input type="text" class="form-control" id="nombre" required>
            </div>
            <div class="col-md-6">
              <label for="usuario" class="form-label">Usuario</label>
              <input type="text" class="form-control" id="usuario" required>
            </div>
            <div class="col-md-6">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="tel" class="form-control" id="telefono">
            </div>
            <div class="col-md-6">
              <label for="edad" class="form-label">Edad</label>
              <input type="number" class="form-control" id="edad" min="0">
            </div>
            <div class="col-md-6">
              <label for="sexo" class="form-label">Sexo</label>
              <select class="form-select" id="sexo">
                <option value="">Seleccione...</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="direccion" class="form-label">Dirección</label>
              <textarea class="form-control" id="direccion" rows="2"></textarea>
            </div>
            <div class="col-md-6">
              <label for="correo" class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" id="correo" required>
            </div>
            <div class="col-md-6">
              <label for="rol" class="form-label">Tipo de Usuario</label>
              <select class="form-select" id="rol" required>
                <option value="">Seleccione...</option>
                <option value="admin">Administrador</option>
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password" class="form-control" id="password" required>
            </div>
            <div class="col-md-6">
              <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
              <input type="password" class="form-control" id="password_confirmation" required>
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

<!-- Modal: Editar Usuario -->
<div class="modal fade" id="modalEditarUsuario" tabindex="-1" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow-lg" style="border-radius: 16px; animation: bounceIn 0.5s;">
      <div class="modal-header" style="background: linear-gradient(135deg, #0D0D0D, #2c2c2c); color: white; border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h5 class="modal-title" id="modalAgregarUsuarioLabel">
          <i class="fas fa-user-edit me-2"></i><span id="tituloModal">Editar Usuario</span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background-color: #dc3545;"></button>
      </div>
      <form id="formUsuario" onsubmit="guardarUsuario(event)">
        <div class="modal-body p-4">
          <input type="hidden" id="usuarioIndex">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="nombre" class="form-label">Nombre Completo</label>
              <input type="text" class="form-control" id="nombre" required>
            </div>
            <div class="col-md-6">
              <label for="usuario" class="form-label">Usuario</label>
              <input type="text" class="form-control" id="usuario" required>
            </div>
            <div class="col-md-6">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="tel" class="form-control" id="telefono">
            </div>
            <div class="col-md-6">
              <label for="edad" class="form-label">Edad</label>
              <input type="number" class="form-control" id="edad" min="0">
            </div>
            <div class="col-md-6">
              <label for="sexo" class="form-label">Sexo</label>
              <select class="form-select" id="sexo">
                <option value="">Seleccione...</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="direccion" class="form-label">Dirección</label>
              <textarea class="form-control" id="direccion" rows="2"></textarea>
            </div>
            <div class="col-md-6">
              <label for="correo" class="form-label">Correo Electrónico</label>
              <input type="email" class="form-control" id="correo" required>
            </div>
            <div class="col-md-6">
              <label for="rol" class="form-label">Tipo de Usuario</label>
              <select class="form-select" id="rol" required>
                <option value="">Seleccione...</option>
                <option value="admin">Administrador</option>
                <option value="empleado">Empleado</option>
                <option value="cliente">Cliente</option>
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

<script>
function guardarUsuario(e) {
  e.preventDefault();
  const nombre = document.getElementById('nombre').value.trim();
  const usuario = document.getElementById('usuario').value.trim();
  const correo = document.getElementById('correo').value.trim();
  const rol = document.getElementById('rol').value;
  const pass = document.getElementById('password').value;
  const confirm = document.getElementById('password_confirmation').value;
  const index = document.getElementById('usuarioIndex').value;

  if (!nombre || !usuario || !correo || !pass || !confirm || !rol) {
    Swal.fire({ icon: 'error', title: 'Campos requeridos', text: 'Completa todos los campos obligatorios.' });
    return;
  }
  if (pass !== confirm) {
    Swal.fire({ icon: 'error', title: 'Contraseñas no coinciden' });
    return;
  }

  const tabla = document.querySelector(".users-table tbody");

  if (index !== '') {
    const fila = tabla.rows[index];
    fila.querySelector('.user-name').innerText = nombre;
    const tipo = rol.charAt(0).toUpperCase() + rol.slice(1);
    const spanTipo = fila.querySelector('.user-type');
    spanTipo.innerText = tipo;
    spanTipo.className = `user-type type-${rol}`;
    Swal.fire({ icon: 'success', title: 'Usuario actualizado', showConfirmButton: false, timer: 1500 });
  } else {
    const id = String(tabla.rows.length + 1).padStart(2, '0');
    const tipo = rol.charAt(0).toUpperCase() + rol.slice(1);
    const nuevaFila = document.createElement('tr');
    nuevaFila.innerHTML = `
      <td><span class="user-id">${id}</span></td>
      <td><span class="user-name">${nombre}</span></td>
      <td><span class="user-type type-${rol}">${tipo}</span></td>
      <td>
        <div class="action-buttons">
            <a href="#" class="btn-edit">
                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.83-2.828z"></path>
                </svg>
                Editar
            </a>
            <a href="#" class="btn-delete">
                <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-clip-rule="evenodd"></path>
                </svg>
                Eliminar
            </a>
        </div>
      </td>`;
    tabla.appendChild(nuevaFila);
    Swal.fire({ icon: 'success', title: 'Usuario agregado correctamente', showConfirmButton: false, timer: 1500 });
  }

  actualizarEstadisticas();
  bootstrap.Modal.getOrCreateInstance(document.getElementById('modalAgregarUsuario')).hide();
  document.getElementById('formUsuario').reset();
  document.getElementById('usuarioIndex').value = '';
  document.getElementById('tituloModal').innerText = 'Agregar Nuevo Usuario';
}

function editarUsuario(btn) {
  const fila = btn.closest('tr');
  const index = [...fila.parentNode.children].indexOf(fila);
  document.getElementById('nombre').value = fila.querySelector('.user-name').innerText;
  document.getElementById('rol').value = fila.querySelector('.user-type').innerText.toLowerCase();
  document.getElementById('usuarioIndex').value = index;
  document.getElementById('tituloModal').innerText = 'Editar Usuario';
  bootstrap.Modal.getOrCreateInstance(document.getElementById('modalAgregarUsuario')).show();
}

document.querySelectorAll('.btn-edit').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      
      // Cambiar el título del modal
      document.getElementById('tituloModal').textContent = 'Editar Usuario';

      // Mostrar el modal
      const modal = new bootstrap.Modal(document.getElementById('modalEditarUsuario'));
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