@extends('layouts.admin')

@section('content')
<style>
    .user-management {
        background: linear-gradient(135deg, #f8f9fa 0%, #F2F2F2 100%);
        min-height: 100vh;
        padding: 2rem 0;
        opacity: 0;
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes slideInLeft {
        0% {
            opacity: 0;
            transform: translateX(-50px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInRight {
        0% {
            opacity: 0;
            transform: translateX(50px);
        }
        100% {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes scaleIn {
        0% {
            opacity: 0;
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .page-header {
        background: linear-gradient(135deg, #0D0D0D 0%, #2c2c2c 100%);
        color: white;
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(13, 13, 13, 0.15);
        opacity: 0;
        animation: slideInLeft 0.8s ease-out 0.2s forwards;
    }
    
    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    
    .page-subtitle {
        color: #a0a0a0;
        font-size: 1.1rem;
        margin-top: 0.5rem;
    }
    
    .btn-nuevo {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        padding: 1rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        transition: all 0.3s ease;
        text-decoration: none;
        color: white;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        opacity: 0;
        animation: bounceIn 0.8s ease-out 0.6s forwards;
    }
    
    .btn-nuevo:hover {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.4);
        color: white;
    }
    
    .users-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: none;
        opacity: 0;
        animation: slideInRight 0.8s ease-out 0.8s forwards;
    }
    
    .card-header-custom {
        background: linear-gradient(135deg, #0D0D0D 0%, #2c2c2c 100%);
        color: white;
        padding: 1.5rem 2rem;
        border-bottom: none;
    }
    
    .card-title-custom {
        font-size: 1.3rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .users-table {
        margin: 0;
        background: white;
    }
    
    .users-table thead th {
        background: #F2F2F2;
        color: #0D0D0D;
        font-weight: 600;
        padding: 1rem;
        border: none;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .users-table tbody tr {
        transition: all 0.4s ease;
        border-bottom: 1px solid #eee;
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .users-table tbody tr:nth-child(1) {
        animation-delay: 1s;
    }
    
    .users-table tbody tr:nth-child(2) {
        animation-delay: 1.2s;
    }
    
    .users-table tbody tr:nth-child(3) {
        animation-delay: 1.4s;
    }
    
    .users-table tbody tr:hover {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        transform: translateX(8px) scale(1.01);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .users-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border: none;
        font-size: 0.95rem;
    }
    
    .user-id {
        background: #0D0D0D;
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    
    .user-name {
        font-weight: 600;
        color: #0D0D0D;
    }
    
    .user-type {
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s ease;
        display: inline-block;
    }
    
    .user-type:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .type-admin {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }
    
    .type-empleado {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
    }
    
    .type-cliente {
        background: linear-gradient(135deg, #6f42c1 0%, #563d7c 100%);
        color: white;
    }
    
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #ffc107 0%, #ffeb3b 100%);
        border: none;
        padding: 0.4rem 1rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        color: #0D0D0D;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }
    
    .btn-edit:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
        color: #0D0D0D;
    }
    
    .btn-edit::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-edit:hover::before {
        left: 100%;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #dc3545 0%, #e74c3c 100%);
        border: none;
        padding: 0.4rem 1rem;
        border-radius: 6px;
        font-size: 0.8rem;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }
    
    .btn-delete:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
        color: white;
    }
    
    .btn-delete::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-delete:hover::before {
        left: 100%;
    }
    
    .stats-bar {
        background: white;
        padding: 1.5rem 2rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        opacity: 0;
        animation: scaleIn 0.8s ease-out 0.4s forwards;
    }
    
    .stat-item {
        text-align: center;
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        color: #0D0D0D;
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
    }
    
    .icon {
        width: 20px;
        height: 20px;
    }

    .modal-header .btn-close {
        background-color: red !important;
        border-radius: 50%;
        opacity: 1;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 0.3rem;
        }
        
        .stats-bar {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>

<div class="user-management">
    <div class="container">
        <!-- Header de la página -->
        <div class="page-header">
            <h1 class="page-title">Gestión de Usuarios</h1>
            <p class="page-subtitle">Administra y controla todos los usuarios del sistema</p>
        </div>

        <!-- Barra de estadísticas -->
        <div class="stats-bar">
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

        <!-- Botón para añadir nuevo usuario -->
        <div class="mb-4">
            <a href="#" class="btn-nuevo" data-bs-toggle="modal" data-bs-target="#modalAgregarUsuario">
                <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
                Nuevo Usuario
            </a>
        </div>

        <!-- Card con tabla de usuarios -->
        <div class="users-card">
            <div class="card-header-custom">
                <h5 class="card-title-custom">
                    <svg class="icon" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                    Usuarios Registrados
                </h5>
            </div>
            <div class="table-responsive">
                <table class="users-table table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombres</th>
                            <th>Tipo de Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <span class="user-id">01</span>
                            </td>
                            <td>
                                <span class="user-name">Tarea Completo</span>
                            </td>
                            <td>
                                <span class="user-type type-admin">Admin</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn-edit">
                                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
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
                            <td>
                                <span class="user-id">02</span>
                            </td>
                            <td>
                                <span class="user-name">Joel Perez</span>
                            </td>
                            <td>
                                <span class="user-type type-empleado">Empleado</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn-edit">
                                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
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
                            <td>
                                <span class="user-id">03</span>
                            </td>
                            <td>
                                <span class="user-name">Maria González</span>
                            </td>
                            <td>
                                <span class="user-type type-cliente">Cliente</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn-edit">
                                        <svg class="icon" fill="currentColor" viewBox="0 0 20 20" style="width: 14px; height: 14px; margin-right: 4px;">
                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
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

<script>
function actualizarEstadisticas() {
  const filas = document.querySelectorAll('.users-table tbody tr');
  const total = filas.length;
  let admin = 0, empleado = 0, cliente = 0;

  filas.forEach(fila => {
    const tipo = fila.querySelector('.user-type').innerText.toLowerCase();
    if (tipo.includes('admin')) admin++;
    else if (tipo.includes('empleado')) empleado++;
    else if (tipo.includes('cliente')) cliente++;
  });

  document.querySelector('.stats-bar .stat-item:nth-child(1) .stat-number').innerText = total;
  document.querySelector('.stats-bar .stat-item:nth-child(2) .stat-number').innerText = admin;
  document.querySelector('.stats-bar .stat-item:nth-child(3) .stat-number').innerText = empleado;
  document.querySelector('.stats-bar .stat-item:nth-child(4) .stat-number').innerText = cliente;
}

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
</script>

@endsection