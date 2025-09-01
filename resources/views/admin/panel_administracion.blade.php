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
    <!-- Sección de Estadísticas 
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
      -->
    <!-- Sección de Gestión -->
    <div class="dashboard-grid">
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
      <!--Gestión de Libros -->
      <div class="dashboard-card">
        <div class="card-icon upload">
          <!-- Icono: Libro -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M19.35 10.04A7.49 7.49 0 0012 4a7.49 7.49 0 00-7.36 6.03C3.34 10.36 2 12.28 2 14.5A4.5 4.5 0 006.5 19H19a4 4 0 00.35-8zm-6.85 2.91V17h-2v-4.05l-1.29 1.3-1.42-1.42L12 9l3.54 3.54-1.42 1.42-1.29-1.3z"/>
          </svg>
        </div>
        <h5 class="card-title">Gestión de Libros</h5>
        <p class="card-description">Sube, edita y organiza libros digitales en PDF o EPUB. Gestiona todo el contenido disponible para los usuarios.</p>
        <a href="{{ route('admin.gestionLibrosDigitales') }}" class="card-button"><span>Gestionar Libros</span></a>
      </div>
      <!-- Gestión de Audiolibros -->
      <div class="dashboard-card">
        <div class="card-icon upload">
          <!-- Icono: Audiolibro -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M12 3v10.55a4 4 0 11-2-3.45V6h2m6-3h-2v18h2V3zM6 9H4v12h2V9z"/>
          </svg>
        </div>
        <h5 class="card-title">Gestión de Audiolibros</h5>
        <p class="card-description">Sube, edita y organiza audiolibros en MP3 u otros formatos. Facilita el acceso a contenido sonoro para los usuarios.</p>
        <a href="{{ route('admin.gestionAudiolibros') }}" class="card-button"><span>Gestionar Audiolibros</span></a>
      </div>
      <!-- Gestión de Libros físicos -->
      <div class="dashboard-card">
        <div class="card-icon upload">
          <!-- Icono: Subir nube -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M18 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12v-2H6V4h12v16h2V4a2 2 0 00-2-2z"/>
            <path d="M8 6h8v2H8zM8 10h8v2H8zM8 14h5v2H8z"/>
          </svg>
        </div>
        <h5 class="card-title">Gestión de Libros físicos</h5>
        <p class="card-description">Sube, edita y organiza los libros físicos disponibles. Gestiona todo el contenido disponible para los usuarios.</p>
        <a href="{{ route('admin.gestionLibrosFisicos') }}" class="card-button"><span>Gestionar Contenido</span></a>
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
      <!-- Préstamos Recientes -->
      <div class="dashboard-card">
        <div class="card-icon recent-loans">
          <!-- Icono: Libro abierto -->
          <svg viewBox="0 0 24 24" width="40" height="40" fill="currentColor">
            <path d="M21 4H7c-1.1 0-2 .9-2 2v14h2V6h14v14h2V6c0-1.1-.9-2-2-2zM3 6H1v16c0 1.1.9 2 2 2h16v-2H3V6z"/>
          </svg>
        </div>
        <h5 class="card-title">Préstamos Recientes</h5>
        <p class="card-description">Consulta los préstamos realizados. Monitorea actividad reciente del sistema.</p>
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
  </div>
</div>
@endsection