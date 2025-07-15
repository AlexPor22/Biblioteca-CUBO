@extends('layouts.admin')

@section('content')
<style>
    .publish-dashboard {
        background: linear-gradient(135deg, #f8f9fa 0%, #F2F2F2 100%);
        min-height: 100vh;
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
    
    @keyframes scaleIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }
    
    .publish-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .publish-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        opacity: 0;
        animation: scaleIn 0.8s ease-out forwards;
        border: 2px solid transparent;
    }
    
    .publish-card:nth-child(1) {
        animation-delay: 0.4s;
    }
    
    .publish-card:nth-child(2) {
        animation-delay: 0.6s;
    }
    
    .publish-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #28a745, #20c997);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .publish-card:hover::before {
        transform: scaleX(1);
    }
    
    .publish-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border-color: rgba(40, 167, 69, 0.3);
    }
    
    .card-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: white;
        animation: float 3s ease-in-out infinite;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    
    .card-icon.book {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        animation-delay: 0s;
    }
    
    .card-icon.audiobook {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        animation-delay: 1s;
    }
    
    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0D0D0D;
        margin-bottom: 1rem;
        text-align: center;
        line-height: 1.3;
    }
    
    .card-description {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.6;
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .card-button {
        background: linear-gradient(135deg, #0D0D0D 0%, #2c2c2c 100%);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(13, 13, 13, 0.3);
        cursor: pointer;
        margin-left: auto;
        margin-right: auto;
    }
    
    .card-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(40, 167, 69, 0.4), transparent);
        transition: left 0.6s ease;
    }
    
    .card-button:hover::before {
        left: 100%;
    }
    
    .card-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(13, 13, 13, 0.4);
        color: white;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .recent-uploads {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-top: 3rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        opacity: 0;
        animation: fadeInUp 0.8s ease-out 1s forwards;
    }
    
    .recent-uploads h3 {
        color: #0D0D0D;
        font-weight: 700;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }
    
    .upload-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #F2F2F2 0%, #e9ecef 100%);
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .upload-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }
    
    .upload-icon {
        width: 50px;
        height: 50px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        color: white;
        font-size: 1.2rem;
    }
    
    .upload-icon.book-icon {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }
    
    .upload-icon.audio-icon {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .upload-details {
        flex: 1;
    }
    
    .upload-title {
        font-weight: 600;
        color: #0D0D0D;
        margin-bottom: 0.25rem;
    }
    
    .upload-meta {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .upload-status {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
    }
    
    .status-published {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }
    
    .status-draft {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    
    .quick-actions {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .quick-action-btn {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 5px 20px rgba(40, 167, 69, 0.4);
        transition: all 0.3s ease;
        cursor: pointer;
        animation: pulse 2s infinite;
    }
    
    .quick-action-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 30px rgba(40, 167, 69, 0.6);
    }
    
    .quick-action-btn.secondary {
        background: linear-gradient(135deg, #0D0D0D 0%, #2c2c2c 100%);
        box-shadow: 0 5px 20px rgba(13, 13, 13, 0.4);
        animation: none;
    }
    
    .quick-action-btn.secondary:hover {
        box-shadow: 0 8px 30px rgba(13, 13, 13, 0.6);
    }
    
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 5px 20px rgba(40, 167, 69, 0.4);
        }
        50% {
            box-shadow: 0 8px 30px rgba(40, 167, 69, 0.6);
        }
    }
    
    .modal-header .btn-close {
        background-color: red !important;
        border-radius: 50%;
        opacity: 1;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
    }
    
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        opacity: 0;
        animation: scaleIn 0.6s ease-out forwards;
    }
    
    .stat-card:nth-child(1) { animation-delay: 0.2s; }
    .stat-card:nth-child(2) { animation-delay: 0.4s; }
    .stat-card:nth-child(3) { animation-delay: 0.6s; }
    .stat-card:nth-child(4) { animation-delay: 0.8s; }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    @media (max-width: 768px) {
        .publish-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    
        
        .publish-card {
            padding: 2rem;
        }
        
        .quick-actions {
            bottom: 1rem;
            right: 1rem;
        }
    }
</style>

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

        <!-- Opciones de Publicación -->
        <div class="publish-grid">
            <!-- Publicar Libro -->
            <div class="publish-card">
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

            <!-- Publicar Audiolibro -->
            <div class="publish-card">
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
        </div>

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

        <!-- Botones de Acción Rápida -->
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
    </div>
</div>

<!-- Modal: Publicar Libro Digital -->
<div class="modal fade" id="modalPublicarLibro" tabindex="-1" aria-labelledby="modalPublicarLibroLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow-lg border-0" style="border-radius: 16px; animation: zoomIn 0.5s;">
    <div class="modal-header" style="background: linear-gradient(135deg, #0D0D0D, #2c2c2c); color: white; border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h5 class="modal-title" id="modalPublicarLibroLabel">
          <i class="fas fa-book me-2"></i>Publicar Libro Digital
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background-color: #dc3545;"></button>
    </div>
    
    <form id="formLibro">
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label for="titulo_libro" class="form-label">Título del Libro</label>
            <input type="text" class="form-control" id="titulo_libro" placeholder="Ej. El nombre del viento" required>
          </div>
          <div class="mb-3">
            <label for="archivo_libro" class="form-label">Archivo PDF/EPUB</label>
            <input type="file" class="form-control" id="archivo_libro" accept=".pdf,.epub,.mobi" required>
          </div>
          <div class="mb-3">
            <label for="autor_libro" class="form-label">Autor</label>
            <input type="text" class="form-control" id="autor_libro" required>
          </div>
          <div class="mb-3">
            <label for="categoria_libro" class="form-label">Categoría</label>
            <select id="categoria_libro" class="form-select" required>
              <option value="">Seleccione una categoría</option>
              <option value="ficcion">Ficción</option>
              <option value="educativo">Educativo</option>
              <option value="biografia">Biografía</option>
            </select>
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

<!-- Modal: Publicar Audiolibro -->
<div class="modal fade" id="modalPublicarAudio" tabindex="-1" aria-labelledby="modalPublicarAudioLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content shadow-lg border-0" style="border-radius: 16px; animation: zoomIn 0.5s;">
      <div class="modal-header" style="background: linear-gradient(135deg, #0D0D0D, #2c2c2c); color: white; border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h5 class="modal-title" id="modalPublicarAudioLabel">
          <i class="fas fa-headphones me-2"></i>Publicar Audiolibro
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background-color: #dc3545;"></button>
      </div>

      <form id="formAudio">
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label for="titulo_audio" class="form-label">Título del Audiolibro</label>
            <input type="text" class="form-control" id="titulo_audio" placeholder="Ej. El alquimista" required>
          </div>
          <div class="mb-3">
            <label for="archivo_audio" class="form-label">Archivo MP3/M4A/WAV</label>
            <input type="file" class="form-control" id="archivo_audio" accept="audio/*" required>
          </div>
          <div class="mb-3">
            <label for="narrador_audio" class="form-label">Narrador</label>
            <input type="text" class="form-control" id="narrador_audio" required>
          </div>
          <div class="mb-3">
            <label for="duracion_audio" class="form-label">Duración (minutos)</label>
            <input type="number" class="form-control" id="duracion_audio" required>
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
document.addEventListener('DOMContentLoaded', () => {
  const formLibro = document.getElementById('formLibro');
  const formAudio = document.getElementById('formAudio');
  const listaContenido = document.getElementById('lista-contenido');

  formLibro.addEventListener('submit', function(e) {
    e.preventDefault();

    const titulo = document.getElementById('titulo_libro').value.trim();
    const autor = document.getElementById('autor_libro').value.trim();
    const categoria = document.getElementById('categoria_libro').value.trim();

    if (!titulo || !autor || !categoria) return;

    const nuevoLibro = document.createElement('div');
    nuevoLibro.classList.add('upload-item');
    nuevoLibro.innerHTML = `
      <div class="upload-icon book-icon">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
        </svg>
      </div>
      <div class="upload-details">
        <div class="upload-title">${titulo}</div>
        <div class="upload-meta">Publicado ahora • ${autor}</div>
      </div>
      <div class="upload-status status-published">Publicado</div>
    `;
    listaContenido.prepend(nuevoLibro);

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPublicarLibro')).hide();
    formLibro.reset();

    Swal.fire({
      icon: 'success',
      title: '¡Libro publicado!',
      text: `El libro "${titulo}" se agregó correctamente.`,
      timer: 2000,
      showConfirmButton: false
    });
  });

  formAudio.addEventListener('submit', function(e) {
    e.preventDefault();

    const titulo = document.getElementById('titulo_audio').value.trim();
    const narrador = document.getElementById('narrador_audio').value.trim();
    const duracion = document.getElementById('duracion_audio').value.trim();

    if (!titulo || !narrador || !duracion) return;

    const nuevoAudio = document.createElement('div');
    nuevoAudio.classList.add('upload-item');
    nuevoAudio.innerHTML = `
      <div class="upload-icon audio-icon">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd"></path>
        </svg>
      </div>
      <div class="upload-details">
        <div class="upload-title">${titulo}</div>
        <div class="upload-meta">Publicado ahora • ${narrador}</div>
      </div>
      <div class="upload-status status-published">Publicado</div>
    `;
    listaContenido.prepend(nuevoAudio);

    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPublicarAudio')).hide();
    formAudio.reset();

    Swal.fire({
      icon: 'success',
      title: '¡Audiolibro publicado!',
      text: `El audiolibro "${titulo}" se agregó correctamente.`,
      timer: 2000,
      showConfirmButton: false
    });
  });
});
</script>

@endsection