@extends('layouts.admin')
@section('content')
<div class="publish-dashboard">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Contenido Reciente</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Consulta y gestiona los últimos libros y audiolibros publicados en la plataforma. Aquí podrás ver el estado de cada contenido, así como realizar acciones de edición o eliminación.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">{{ $contadorLibros }}</div>
          <div class="stat-label">Libros Digitales</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">{{ $contadorAudios }}</div>
          <div class="stat-label">Audiolibros</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">0</div>
          <div class="stat-label">Libros físicos</div>
        </div>
      </div>
    </div>
    <!-- Contenido Reciente -->
    <div class="recent-uploads">
      <h3>Contenido Reciente</h3>
      <div id="lista-contenido">
        @forelse ($items as $item)
        <div class="upload-item">
          {{-- Icono según tipo --}}
          <div class="upload-icon {{ $item['tipo'] === 'libro' ? 'book-icon' : 'audio-icon' }}">
            @if($item['tipo'] === 'libro')
            {{-- SVG Libro --}}
            <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
              <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
            </svg>
            @else
            {{-- SVG Audio --}}
            <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
              <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd"></path>
            </svg>
            @endif
          </div>
          {{-- Detalles --}}
          <div class="upload-details">
            <div class="upload-title">
              {{ $item['titulo'] }} @if($item['tipo']==='audio') (Audiolibro) @endif
            </div>
            <div class="upload-meta">
              Subido {{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}
              • {{ $item['autor'] ?? 'Autor/Narrador' }}
            </div>
          </div>
          {{-- Estado visual --}}
          @php
          $estado = strtolower($item['estado']);
          $claseEstado = in_array($estado, ['habilitado','publicado','activo']) ? 'status-published' : 'status-draft';
          $textoEstado = in_array($estado, ['habilitado','publicado','activo']) ? 'Publicado' : ucfirst($estado);
          @endphp
          <div class="upload-status {{ $claseEstado }}">{{ $textoEstado }}</div>
        </div>
        @empty
        <p style="margin-top: .5rem; color:#666;">No hay contenido reciente por ahora.</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection