@extends('layouts.admin')

@section('content')

<div class="admin-dashboard">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Panel de Administración</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Bienvenido al panel de administración del sistema. Aquí podrás gestionar todos los aspectos de la plataforma de forma centralizada.</p>
    </div>

    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">3</div>
          <div class="stat-label">Usuarios Activos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">5</div>
          <div class="stat-label">Categorías</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">12</div>
          <div class="stat-label">Libros Publicados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">8</div>
          <div class="stat-label">Audiolibros</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">6</div>
          <div class="stat-label">Préstamos Activos</div>
        </div>
      </div>
    </div>

    <div class="dashboard-grid">
      <!-- Panel de Administración 
      <div class="dashboard-card">
        <div class="card-icon dashboard">
          <!-- Icono: Dashboard con paneles 
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/>
          </svg>
        </div>
        <h5 class="card-title">Panel de Administración</h5>
        <p class="card-description">Accede al panel principal del sistema y supervisa de forma global las funcionalidades clave de la plataforma.</p>
        <a href="{{ route('admin.panelAdministracion') }}" class="card-button"><span>Ir al Panel</span></a>
      </div>
      -->

      <!-- Gestión de Usuarios -->
      <div class="dashboard-card">
        <div class="card-icon users">
          <!-- Icono: Grupo de personas -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M16 11c1.66 0 3-1.34 3-3s-1.34-3-3-3S13 6.34 13 8s1.34 3 3 3zM8 11c1.66 0 3-1.34 3-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm8 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zM8 13c-.29 0-.62.02-.97.05C6.13 13.4 5 14.1 5 15v2h6v-1.5c0-.78-.45-1.45-1.03-1.78C9.12 13.02 8.57 13 8 13z"/>
          </svg>
        </div>
        <h5 class="card-title">Gestión de Usuarios</h5>
        <p class="card-description">Controla y administra todos los usuarios del sistema. Modifica roles, accesos y perfiles según necesidad.</p>
        <a href="{{ route('admin.gestionUsuarios') }}" class="card-button"><span>Gestionar Usuarios</span></a>
      </div>

      <!-- Gestión de Categorías -->
      <div class="dashboard-card">
        <div class="card-icon categories">
          <!-- Icono: Etiquetas -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M20.59 13.41L12 4.83 3.41 13.41c-.78.78-.78 2.05 0 2.83l6.58 6.58c.78.78 2.05.78 2.83 0l8.59-8.59c.78-.78.78-2.05 0-2.83zM7 14c-.83 0-1.5-.67-1.5-1.5S6.17 11 7 11s1.5.67 1.5 1.5S7.83 14 7 14z"/>
          </svg>
        </div>
        <h5 class="card-title">Gestión de Categorías</h5>
        <p class="card-description">Organiza el contenido mediante categorías. Crea, edita o elimina clasificaciones para libros y audiolibros.</p>
        <a href="{{ route('admin.gestionCategorias') }}" class="card-button"><span>Gestionar Categorías</span></a>
      </div>

      <!-- Gestión de Préstamos -->
      <div class="dashboard-card">
        <div class="card-icon loans">
          <!-- Icono: Libro con marca -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M6 4v16h2V4H6zm10 0v6.17l-1.59-1.58L13 9l4 4 4-4-1.41-1.41L18 10.17V4h-2zm-8 0h2v16H8V4zm8 16v-6h2v6h-2z"/>
          </svg>
        </div>
        <h5 class="card-title">Gestión de Préstamos</h5>
        <p class="card-description">Administra todos los préstamos activos, vencidos o devueltos. Genera reportes y controla la circulación del material.</p>
        <a href="{{ route('admin.gestionPrestamos') }}" class="card-button"><span>Gestionar Préstamos</span></a>
      </div>

      <!-- Libros y Audiolibros -->
      <div class="dashboard-card">
        <div class="card-icon upload">
          <!-- Icono: Subir nube -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M19.35 10.04A7.49 7.49 0 0012 4a7.49 7.49 0 00-7.36 6.03C3.34 10.36 2 12.28 2 14.5A4.5 4.5 0 006.5 19H19a4 4 0 00.35-8zm-6.85 2.91V17h-2v-4.05l-1.29 1.3-1.42-1.42L12 9l3.54 3.54-1.42 1.42-1.29-1.3z"/>
          </svg>
        </div>
        <h5 class="card-title">Gestión de Libros y Audiolibros</h5>
        <p class="card-description">Sube, edita y organiza libros en PDF o audiolibros. Gestiona todo el contenido disponible para los usuarios.</p>
        <a href="{{ route('admin.gestionAudiolibros') }}" class="card-button"><span>Gestionar Contenido</span></a>
      </div>

      <!-- Préstamos Recientes -->
      <div class="dashboard-card">
        <div class="card-icon recent-loans">
          <!-- Icono: Libro abierto -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M21 4H7c-1.1 0-2 .9-2 2v14h2V6h14v14h2V6c0-1.1-.9-2-2-2zM3 6H1v16c0 1.1.9 2 2 2h16v-2H3V6z"/>
          </svg>
        </div>
        <h5 class="card-title">Préstamos Recientes</h5>
        <p class="card-description">Consulta los últimos préstamos realizados por los usuarios. Monitorea actividad reciente del sistema.</p>
        <a href="{{ route('admin.prestamosRecientes') }}" class="card-button"><span>Ver Préstamos</span></a>
      </div>

      <!-- Contenido Reciente -->
      <div class="dashboard-card">
        <div class="card-icon recent-content">
          <!-- Icono: Reloj histórico -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M13 3a9 9 0 00-9 9H1l4 4 4-4H6a7 7 0 117 7v2a9 9 0 000-18zm-1 5h2v5h-4v-2h2z"/>
          </svg>
        </div>
        <h5 class="card-title">Contenido Reciente</h5>
        <p class="card-description">Visualiza los últimos libros y audiolibros publicados en la plataforma.</p>
        <a href="{{ route('admin.contenidoReciente') }}" class="card-button"><span>Ver Contenido</span></a>
      </div>

      <!-- Estadísticas del Sistema -->
      <div class="dashboard-card">
        <div class="card-icon statistics">
          <!-- Icono: Gráfica de barras -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M4 22h16v-2H4v2zM6 10h2v7H6v-7zm4-4h2v11h-2V6zm4 6h2v5h-2v-5zm4-4h2v9h-2V8z"/>
          </svg>
        </div>
        <h5 class="card-title">Estadísticas del Sistema</h5>
        <p class="card-description">Consulta métricas clave del sistema: actividad de usuarios, contenido y rendimiento general.</p>
        <a href="{{ route('admin.estadisticasSistema') }}" class="card-button"><span>Ver Estadísticas</span></a>
      </div>
    </div>

    <!-- Botón de Acción Rápida 
      <div class="quick-actions">
          <button class="quick-action-btn" title="Acciones Rápidas">
              <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                  <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
              </svg>
          </button>
      </div>
      -->
  </div>
</div>
@endsection