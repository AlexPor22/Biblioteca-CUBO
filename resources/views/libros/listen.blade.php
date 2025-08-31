@extends('layouts.app')
@section('custom-header')
<header class="header">
    <div class="logo">
        <a href="{{ route('inicio') }}">
            <img src="{{ asset('img/CUBOLogoColor.png') }}" alt="Biblioteca Virtual CUBO" class="logo-img">
        </a>
    </div>

    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </label>

   <nav class="navbar">
    <ul>
        <li><a href="{{ route('inicio') }}"><i class="fa-solid fa-house"></i> Inicio</a></li>
        <li><a href="{{ route('libros.index') }}"><i class="fas fa-book"></i>Libros</a></li>
        <li><a href=""><i class="fa-regular fa-face-smile"></i></i>Perfil</a></li>
        <li>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i>Cerrar Sesión</button>
        </form>

        </li>
    </ul>
</nav>

</header>
@endsection
@section('content')
<div class="container py-5">
    <div class="audiobook-card">

        {{-- Portada --}}
        <img src="{{ $audiolibro->portada_url ?? $libro->portada_url }}"
             alt="Portada de {{ $libro->titulo }}"
             class="audiobook-cover">

        {{-- Información + reproductor --}}
        <div class="audiobook-info">
            <h2 class="audiobook-title">{{ $libro->titulo }}</h2>
            <p class="audiobook-author">{{ $libro->autor }}</p>

            @if(!empty($audiolibro) && !empty($audiolibro->audio_url))
                {{-- Contenedor del reproductor --}}
                <div id="waveform"></div>

                <div class="d-flex align-items-center justify-content-between mt-2">
                    <div>
                        <button id="back10" class="btn btn-dark btn-sm">-10s</button>
                        <button id="playPause" class="btn btn-success btn-sm">▶</button>
                        <button id="forward10" class="btn btn-dark btn-sm">+10s</button>
                    </div>
                    <div id="time" class="text-muted small">
                        0:00 / 0:00
                    </div>
                </div>

                {{-- Script del reproductor solo si hay audio --}}
                <script src="https://unpkg.com/wavesurfer.js"></script>
                <script>
                document.addEventListener("DOMContentLoaded", function () {
                    const wavesurfer = WaveSurfer.create({
                        container: '#waveform',
                        waveColor: '#555',
                        progressColor: '#8ef0a2',   // verde claro
                        cursorColor: '#28a745',
                        barWidth: 2,
                        height: 80,
                        responsive: true,
                    });

                    // ✅ Solo carga si existe la URL
                    wavesurfer.load("{{ $audiolibro->audio_url }}");

                    const playPauseBtn = document.getElementById("playPause");
                    const back10Btn = document.getElementById("back10");
                    const forward10Btn = document.getElementById("forward10");
                    const timeDisplay = document.getElementById("time");

                    const formatTime = (seconds) => {
                        if (!seconds) return "0:00";
                        const m = Math.floor(seconds / 60);
                        const s = Math.floor(seconds % 60).toString().padStart(2, "0");
                        return `${m}:${s}`;
                    };

                    // Reproducir / pausar
                    playPauseBtn.addEventListener("click", () => {
                        wavesurfer.playPause();
                        playPauseBtn.textContent = wavesurfer.isPlaying() ? "⏸" : "▶";
                    });

                    // Adelantar / retroceder
                    back10Btn.addEventListener("click", () => wavesurfer.skip(-10));
                    forward10Btn.addEventListener("click", () => wavesurfer.skip(10));

                    // Actualizar tiempos
                    wavesurfer.on("audioprocess", () => {
                        const current = wavesurfer.getCurrentTime();
                        const total = wavesurfer.getDuration();
                        timeDisplay.textContent = `${formatTime(current)} / ${formatTime(total)}`;
                    });

                    wavesurfer.on("ready", () => {
                        const total = wavesurfer.getDuration();
                        timeDisplay.textContent = `0:00 / ${formatTime(total)}`;
                    });

                    wavesurfer.on("finish", () => {
                        playPauseBtn.textContent = "▶";
                    });
                });
                </script>
            @else
                <div class="alert alert-warning mt-3">
                    📢 Audiolibro no disponible.
                </div>
            @endif
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('libros.index') }}" class="btn btn-secondary">Volver al catálogo</a>
    </div>
</div>

<style>
html, body {
    height: 100%;
    margin: 0;
}

body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main {
    flex: 1;
}

/* Tarjeta audiolibro */
.audiobook-card {
    background-color: #e5e5e5;
    border-radius: 10px;
    padding: 20px;
    display: flex;
    align-items: flex-start;
    gap: 20px;
    max-width: 1000px;
    margin: 0 auto;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    flex-wrap: wrap; /* permite que se adapte */
}
.audiobook-cover {
    width: 180px;
    height: auto;
    border-radius: 5px;
    object-fit: cover;
    flex-shrink: 0;
}
.audiobook-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
    min-width: 250px;
}
#waveform {
    width: 100%;
    background: #111;
    border-radius: 8px;
    margin-top: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

/* Responsivo */
@media (max-width: 768px) {
    .audiobook-card {
        flex-direction: column;
        text-align: center;
    }
    .audiobook-cover {
        margin: 0 auto;
        width: 140px;
    }
    #waveform {
        height: 60px; /* más bajo en móvil */
    }
    .audiobook-title {
        font-size: 1.2rem;
    }
}
@media (max-width: 480px) {
    .audiobook-cover {
        width: 120px;
    }
    #waveform {
        height: 50px;
    }
    .audiobook-title {
        font-size: 1rem;
    }
}


.navbar ul li a,
.navbar ul li button {
  display: inline-block;
  padding: 8px 16px;
  border: 2px solid rgb(44, 184, 8);;     /* verde CUBO */
  border-radius: 999px;           /* full círculo */
  color: #949494ff;
  background-color: transparent;
  text-decoration: none;
  font-weight: 600;
  transition: background-color 0.2s ease, color 0.2s ease;
}

.navbar ul li a:hover,
.navbar ul li button:hover {
  background-color: #218838;  /* Verde más oscuro */
  border-color: #218838;
  color: #fff !important;
}
</style>
@endsection
