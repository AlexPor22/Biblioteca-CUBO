@extends('layouts.admin')

@section('content')
<div class="prestamo-dashboard">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Gestión de Préstamos</h1>
      <p class="header-subtitle">Administra préstamos de libros digitales y audiolibros. Controla fechas de vencimiento, renovaciones y historial de préstamos.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">24</div>
          <div class="stat-label">Préstamos Activos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">7</div>
          <div class="stat-label">Por Vencer</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">3</div>
          <div class="stat-label">Vencidos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">186</div>
          <div class="stat-label">Total Este Mes</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">92%</div>
          <div class="stat-label">Tasa Devolución</div>
        </div>
      </div>
    </div>

    <!-- Cards de Gestión
    <div class="dashboard-grid">
      <!-- Nuevo Préstamo 
      <div class="dashboard-card">
        <div class="card-icon nuevo-prestamo">
          <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
          </svg>
        </div>
        <h5 class="card-title">Nuevo Préstamo</h5>
        <p class="card-description">Registra un nuevo préstamo de libro digital o audiolibro. Asigna usuario, duración y configura notificaciones.</p>
        <button class="card-button" data-bs-toggle="modal" data-bs-target="#modalNuevoPrestamo">
        <span>Crear Prestamo</span>
        </button>
      </div>
      <!-- Préstamos Activos
      <div class="dashboard-card">
        <div class="card-icon prestamo-activo">
          <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
          </svg>
        </div>
        <h5 class="card-title">Préstamos Activos</h5>
        <p class="card-description">Visualiza y administra todos los préstamos en curso. Controla fechas de vencimiento y gestiona renovaciones.</p>
        <a href="#" class="card-button">
        <span>Ver Activos</span>
        </a>
      </div>
      <!-- Historial 
      <div class="dashboard-card">
        <div class="card-icon publish">
          <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
          </svg>
        </div>
        <h5 class="card-title">Historial</h5>
        <p class="card-description">Consulta el historial completo de préstamos. Genera reportes y estadísticas detalladas por período.</p>
        <a href="{{ route('admin.prestamos.historial') }}" class="card-button">
        <span>Ver Historial</span>
        </a>
      </div>
    </div>
    -->

    <!-- Contenido Reciente -->
    <div class="recent-uploads">
      <h3>Prestamos Recientes</h3>
      <div id="lista-contenido">
        <div class="upload-item">
          <div class="upload-icon book-icon">
            <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
              <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
            </svg>
          </div>
          <div class="prestamo-details">
            <div class="prestamo-title">Cien Años de Soledad</div>
            <div class="prestamo-meta">Gabriel García Márquez • Prestado hace 3 días</div>
            <div class="prestamo-usuario">María González</div>
          </div>
          <div class="prestamo-info">
            <div class="prestamo-fecha">Vence: 18 Jul 2025</div>
            <div class="prestamo-estado estado-activo">Activo</div>
          </div>
        </div>
        <div class="upload-item">
          <div class="upload-icon book-icon">
            <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
              <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
            </svg>
          </div>
          <div class="prestamo-details">
            <div class="prestamo-title">Cien Años de Soledad</div>
            <div class="prestamo-meta">Gabriel García Márquez • Prestado hace 3 días</div>
            <div class="prestamo-usuario">María González</div>
          </div>
          <div class="prestamo-info">
            <div class="prestamo-fecha">Vence: 18 Jul 2025</div>
            <div class="prestamo-estado estado-por-vencer">Por Vencer</div>
          </div>
        </div>
        <div class="upload-item">
          <div class="upload-icon book-icon">
            <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
              <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
            </svg>
          </div>
          <div class="prestamo-details">
            <div class="prestamo-title">Cien Años de Soledad</div>
            <div class="prestamo-meta">Gabriel García Márquez • Prestado hace 3 días</div>
            <div class="prestamo-usuario">María González</div>
          </div>
          <div class="prestamo-info">
            <div class="prestamo-fecha">Vence: 18 Jul 2025</div>
            <div class="prestamo-estado estado-vencido">Vencido</div>
          </div>
        </div>
      </div>
    </div>
    <!-- Botones de Acción Rápida 
      <div class="quick-actions">
          <button class="quick-action-btn" title="Nuevo Préstamo" onclick="window.location.href='#'">
              <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                  <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
              </svg>
          </button>
      
          <button class="quick-action-btn secondary" title="Renovar Préstamo" onclick="window.location.href='#'">
              <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                  <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
              </svg>
          </button>
      
          <button class="quick-action-btn" title="Generar Reporte" onclick="window.location.href='#'" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); box-shadow: 0 5px 20px rgba(23, 162, 184, 0.4);">
              <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                  <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
              </svg>
          </button>
      </div>
      -->
  </div>
</div>

<!-- Modal: Nuevo Préstamo 
<div class="modal fade" id="modalNuevoPrestamo" tabindex="-1" aria-labelledby="modalNuevoPrestamoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0" style="border-radius: 16px; animation: fadeInDown 0.4s;">
      <div class="modal-header text-white" style="background: linear-gradient(135deg, #198754, #157347); border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h5 class="modal-title" id="modalNuevoPrestamoLabel">
          <i class="fas fa-book-reader me-2"></i>Nuevo Préstamo
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background-color: #dc3545;"></button>
      </div>
      <form id="formNuevoPrestamo">
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre del Usuario</label>
            <div class="input-group">
              <input type="text" class="form-control" id="nombre_usuario" placeholder="Ej. Juan Pérez" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="titulo_libro" class="form-label">Título del Libro o Audiolibro</label>
            <div class="input-group">
              <input type="text" class="form-control" id="titulo_libro" placeholder="Ej. El Alquimista" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="autor_libro" class="form-label">Autor del Libro</label>
            <div class="input-group">
              <input type="text" class="form-control" id="autor_libro" placeholder="Ej. Paulo Coelho" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" required>
          </div>
          <div class="mb-3">
            <label for="fecha_fin" class="form-label">Fecha de Entrega</label>
            <input type="date" class="form-control" id="fecha_fin" required>
          </div>
        </div>
        <div class="modal-footer px-4 py-3" style="justify-content: space-between;">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          <i class="fas fa-times"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-success">
          <i class="fas fa-check"></i> Guardar Préstamo
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
-->
@endsection