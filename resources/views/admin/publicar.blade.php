@extends('layouts.admin')

@section('content')
<div class="publish-dashboard">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Publicar Contenido</h1>
      <p class="header-subtitle">Sube y gestiona libros digitales y audiolibros. Comparte conocimiento y enriquece la biblioteca digital con contenido de calidad.</p>
    </div>

    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">12</div>
          <div class="stat-label">Libros Publicados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">8</div>
          <div class="stat-label">Audiolibros</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">5</div>
          <div class="stat-label">Borradores</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">156</div>
          <div class="stat-label">Descargas Total</div>
        </div>
      </div>
    </div>

    <!-- Cards de Gestión 
    <div class="dashboard-grid">
      <!-- Publicar Libro 
      <div class="dashboard-card">
        <div class="card-icon book">
          <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
          </svg>
        </div>
        <h5 class="card-title">Publicar Libro Digital</h5>
        <p class="card-description">Sube libros en formato PDF, EPUB o MOBI. Configura metadatos, categorías y permisos de acceso para tu contenido.</p>
        <button class="card-button" data-bs-toggle="modal" data-bs-target="#modalPublicarLibro">
        <span>Subir Libro</span>
        </button>
      </div>
      

      <!-- Publicar Audiolibro 
      <div class="dashboard-card">
        <div class="card-icon audiobook">
          <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
            <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM15.657 6.343a1 1 0 010 1.414A4.98 4.98 0 0117 10a4.98 4.98 0 01-1.343 2.243 1 1 0 11-1.414-1.414A2.98 2.98 0 0015 10a2.98 2.98 0 00-.757-1.829 1 1 0 010-1.414l.414-.414z" clip-rule="evenodd"></path>
          </svg>
        </div>
        <h5 class="card-title">Publicar Audiolibro</h5>
        <p class="card-description">Sube audiolibros en formato MP3, M4A o WAV. Gestiona capítulos, duración y información del narrador.</p>
        <button class="card-button" data-bs-toggle="modal" data-bs-target="#modalPublicarAudio">
        <span>Subir Audiolibro</span>
        </button>
      </div>
      -->

      <!-- Gestión de Libros 
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
    -->

    <!-- Contenido Reciente -->
    <div class="recent-uploads">
      <h3>Contenido Reciente</h3>
      <div id="lista-contenido">
        <div class="upload-item">
          <div class="upload-icon book-icon">
            <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
              <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
            </svg>
          </div>
          <div class="upload-details">
            <div class="upload-title">Cien Años de Soledad</div>
            <div class="upload-meta">Subido hace 2 días • Gabriel García Márquez</div>
          </div>
          <div class="upload-status status-published">Publicado</div>
        </div>
        <div class="upload-item">
          <div class="upload-icon audio-icon">
            <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
              <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd"></path>
            </svg>
          </div>
          <div class="upload-details">
            <div class="upload-title">El Principito (Audiolibro)</div>
            <div class="upload-meta">Subido hace 1 semana • Antoine de Saint-Exupéry</div>
          </div>
          <div class="upload-status status-published">Publicado</div>
        </div>
        <div class="upload-item">
          <div class="upload-icon book-icon">
            <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
              <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
            </svg>
          </div>
          <div class="upload-details">
            <div class="upload-title">Rayuela - Julio Cortázar</div>
            <div class="upload-meta">Subido hace 3 días • En proceso de revisión</div>
          </div>
          <div class="upload-status status-draft">Borrador</div>
        </div>
      </div>
    </div>

    <!-- Botones de Acción Rápida 
      <div class="quick-actions">
          <button class="quick-action-btn" title="Publicar Libro" onclick="window.location.href='#'">
              <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                  <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
              </svg>
          </button>
      
          <button class="quick-action-btn secondary" title="Ver Biblioteca" onclick="window.location.href='#'">
              <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                  <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                  <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
              </svg>
          </button>
      </div>
      -->
  </div>
</div>
@endsection