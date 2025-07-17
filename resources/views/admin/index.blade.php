@extends('layouts.admin')

@section('content')

<div class="admin-dashboard">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Panel de Administración</h1>
      <p class="header-subtitle">Gestiona todas las secciones del sistema de forma fácil y rápida. Controla usuarios, categorías, préstamos y contenido desde un solo lugar.</p>
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

    <!-- Cards de Gestión -->
    <div class="dashboard-grid">
      <!-- Gestión de Usuarios -->
      <div class="dashboard-card">
        <div class="card-icon users">
          <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
            <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
          </svg>
        </div>
        <h5 class="card-title">Gestionar Usuarios</h5>
        <p class="card-description">Administra los usuarios del sistema. Controla permisos, roles y accesos de administradores, empleados y clientes.</p>
        <a href="{{ route('admin.usuarios') }}" class="card-button">
        <span>Gestionar Usuarios</span>
        </a>
      </div>
      <!-- Gestión de Categorías -->
      <div class="dashboard-card">
        <div class="card-icon categories">
          <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
          </svg>
        </div>
        <h5 class="card-title">Gestionar Categorías</h5>
        <p class="card-description">Organiza y administra las categorías de libros. Crea, edita y elimina categorías para mantener el contenido ordenado.</p>
        <a href="{{ route('admin.categoriasLibros') }}" class="card-button">
        <span>Gestionar Categorías</span>
        </a>
      </div>
      <!-- Publicar Contenido -->
      <div class="dashboard-card">
        <div class="card-icon publish">
          <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
          </svg>
        </div>
        <h5 class="card-title">Publicar Contenido</h5>
        <p class="card-description">Publica nuevos libros y audiolibros en el sistema. Sube contenido, configura metadatos y gestiona la biblioteca digital.</p>
        <a href="{{ route('admin.publicar') }}" class="card-button">
        <span>Publicar Contenido</span>
        </a>
      </div>
      <!-- Gestión de Préstamos -->
      <div class="dashboard-card">
        <div class="card-icon loans">
          <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
        <h5 class="card-title">Gestión de Préstamos</h5>
        <p class="card-description">Administra préstamos de libros. Controla fechas de vencimiento, devoluciones y genera reportes de actividad.</p>
        <a href="{{ route('admin.prestamos') }}" class="card-button">
        <span>Gestionar Préstamos</span>
        </a>
      </div>
      <!-- Gestión de Libros -->
      <div class="dashboard-card">
        <div class="card-icon books" style="color: #333;">
          <svg fill="currentColor" viewBox="0 0 24 24" style="width: 40px; height: 40px;">
            <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zm0 13.5c-1.1-.35-2.3-.5-3.5-.5-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5 1.2 0 2.4.15 3.5.5v11.5z"/>
          </svg>
        </div>
        <h5 class="card-title">Gestión de Libros</h5>
        <p class="card-description">Consulta y administra todos los libros disponibles. Revisa detalles, clasificaciones y accede a las opciones de visualización.</p>
        <a href="{{ route('admin.verlibros') }}" class="card-button">
        <span>Ver Libros</span>
        </a>
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