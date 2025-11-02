@extends('layouts.admin')
@section('content')
<div class="publish-dashboard">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Contenido Reciente</h1>
      <p class="header-subtitle">
        Consulta y gestiona los últimos libros digitales, audiolibros y libros físicos registrados en la plataforma.
      </p>
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
          <div class="stat-number">{{ $contadorLibrosFisicos }}</div>
          <div class="stat-label">Libros Físicos</div>
        </div>
      </div>
    </div>

    <!-- Contenido Reciente -->
    <div class="recent-uploads mt-4">
      <h3>Contenido Reciente</h3>
      <div id="lista-contenido" class="mt-3">
        @forelse ($items as $item)
        <div class="upload-item d-flex justify-content-between align-items-center border rounded p-3 mb-2 bg-white shadow-sm">
          {{-- Tipo de contenido --}}
          @php
            $tipoTexto = match($item['tipo']) {
              'digital' => 'Libro Digital',
              'audio'   => 'Audiolibro',
              'fisico'  => 'Libro Físico',
              default   => 'Contenido',
            };
          @endphp

          <div class="upload-details">
            <div class="upload-title fw-semibold text-dark">
              <strong>{{ $tipoTexto }}:</strong> {{ $item['titulo'] }}
            </div>
            <div class="upload-meta text-muted small">
              Registrado {{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}
              • {{ $item['autor'] ?? 'Autor desconocido' }}
            </div>
          </div>

          {{-- Estado con badge Bootstrap --}}
          @php
            $estado = strtolower($item['estado']);
            $textoEstado = ucfirst($estado);
            $badgeClass = 'bg-secondary';

            if ($item['tipo'] === 'fisico') {
                switch ($estado) {
                    case 'disponible':
                        $badgeClass = 'bg-primary';
                        $textoEstado = 'Disponible';
                        break;
                    case 'prestado':
                        $badgeClass = 'bg-warning text-dark';
                        $textoEstado = 'Prestado';
                        break;
                    case 'reservado':
                        $badgeClass = 'bg-info text-dark';
                        $textoEstado = 'Reservado';
                        break;
                    default:
                        $badgeClass = 'bg-secondary';
                        $textoEstado = ucfirst($estado);
                        break;
                }
            } else {
                if (in_array($estado, ['habilitado','publicado','activo'])) {
                    $badgeClass = 'bg-success';
                    $textoEstado = 'Publicado';
                } else {
                    $badgeClass = 'bg-danger';
                    $textoEstado = ucfirst($estado);
                }
            }
          @endphp

          <span class="badge rounded-pill px-3 py-2 {{ $badgeClass }}">
            {{ $textoEstado }}
          </span>
        </div>
        @empty
          <p class="text-muted mt-3">No hay contenido reciente por ahora.</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
@endsection
