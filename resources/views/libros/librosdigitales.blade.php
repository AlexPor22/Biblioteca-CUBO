@extends('layouts.app')
@section('custom-header')
<header class="header">
  <div class="logo">
    <a href="{{ route('inicio') }}">
    <img src="{{ asset('img/CUBOLogoColor.png') }}" alt="Biblioteca Virtual CUBO" class="logo-img">
    </a>
  </div>
  <!-- Menú hamburguesa -->
  <input type="checkbox" id="menu-toggle" class="menu-toggle">
  <label for="menu-toggle" class="hamburger">
  <span></span>
  <span></span>
  <span></span>
  </label>
  <nav class="navbar">
    <ul>
      <li><a href="{{ route('inicio') }}"><i class="fa-solid fa-house"></i>Inicio</a></li>
      <li><a href="{{ route('solicitarPrestamo') }}"><i class="fa-solid fa-book-open-reader"></i>Solicitar Préstamo</a></li>
      {{-- PERFIL -> va a /perfil --}}
      <li><a href="{{ route('user.perfil') }}"><i class="fa-regular fa-face-smile"></i>Perfil</a></li>
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
<div class="container py-4">
  <div class="row g-5 align-items-start">
    {{-- ===== SIDEBAR DESKTOP ===== --}}
    <div class="col-12 col-md-3 ps-md-0 d-none d-md-block">
      <aside class="cat-sidebar fancy">
        <div class="cat-header">
          <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M4 6h16M4 12h10M4 18h16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
          </svg>
          Categorías
        </div>
        <a href="{{ route('libros.index') }}" class="cat-btn {{ empty($categoriaId) ? 'active' : '' }}">
        <span>Todas</span>
        <span class="badge">{{ isset($categorias) ? $categorias->sum('total') : 0 }}</span>
        </a>
        @foreach($categorias ?? [] as $cat)
        <a href="{{ route('libros.index', ['categoria' => $cat->id]) }}"
          class="cat-btn {{ (isset($categoriaId) && $categoriaId == $cat->id) ? 'active' : '' }}">
        <span>{{ $cat->nombre }}</span>
        <span class="badge">{{ $cat->total }}</span>
        </a>
        @endforeach
      </aside>
    </div>
    {{-- ===== CONTENIDO ===== --}}
    <div class="col-12 col-md-9 ps-md-5 position-relative">
      <div class="content-sep d-none d-md-block" aria-hidden="true"></div>
      {{-- ===== BUSCADOR DE LIBROS ===== --}}
      <form action="{{ route('libros.index') }}" method="GET" class="search-bar mb-4">
        <input type="text" name="buscar" placeholder="Buscar libro por título, autor o categoría..." value="{{ request('buscar') }}">
        <button type="submit"><i class="fas fa-search"></i></button>
      </form>
      {{-- Hamburguesa móvil (CSS only) --}}
      <input type="checkbox" id="catsToggle" class="cats-toggle d-none">
      <label for="catsToggle" class="btn btn-outline-success w-100 d-md-none mb-3 mt-2">
      &#9776; Categorías
      </label>
      {{-- Drawer móvil --}}
      <div class="cats-drawer d-md-none">
        <label for="catsToggle" class="cats-drawer-backdrop"></label>
        <div class="cats-drawer-panel">
          <div class="cats-drawer-head">
            <strong>Categorías</strong>
            <label for="catsToggle" class="btn-close" aria-label="Cerrar"></label>
          </div>
          <div class="cats-drawer-body">
            <a href="{{ route('libros.index') }}"
              class="cat-btn {{ empty($categoriaId) ? 'active' : '' }}">
            <span>Todas</span>
            <span class="badge">{{ isset($categorias) ? $categorias->sum('total') : 0 }}</span>
            </a>
            @foreach($categorias ?? [] as $cat)
            <a href="{{ route('libros.index', ['categoria' => $cat->id]) }}"
              class="cat-btn {{ (isset($categoriaId) && $categoriaId == $cat->id) ? 'active' : '' }}">
            <span>{{ $cat->nombre }}</span>
            <span class="badge">{{ $cat->total }}</span>
            </a>
            @endforeach
          </div>
        </div>
      </div>
      <h2 class="text-center mb-4 mt-0"></h2>
      {{-- ===== tetxo de titulo pendiente ===== --}}
      @if(($libros ?? collect())->isEmpty())
      <div class="alert alert-light border text-center">No hay libros para mostrar.</div>
      @else
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($libros as $libro)
        <div class="col">
          <div class="card shadow-sm card-float">
            <div class="image-container">
              <img src="{{ $libro->portada_url ?: 'https://via.placeholder.com/150' }}"
                class="card-img-top" alt="{{ $libro->titulo }}">
            </div>
            <div class="card-body">
              <h5 class="card-title">{{ $libro->titulo }}</h5>
              <p class="card-text"><strong>Autor:</strong> {{ $libro->autor }}</p>
              <p class="card-text"><strong>Categoría:</strong> {{ $libro->getNombreCategoria() }}</p>
              <p class="card-text">{{ \Illuminate\Support\Str::limit($libro->descripcion, 100) }}</p>
              {{-- ===== BOTONES COMPACTOS CON ICONOS ===== --}}
              <div class="card-actions">
                <a href="{{ route('libros.read', $libro->codigo) }}" class="btn-action btn-read">
                <i class="fas fa-book"></i>
                <span>Leer</span>
                </a>
                <a href="{{ route('libros.listen', $libro->codigo) }}" class="btn btn-listen">
                <i class="fas fa-headphones"></i> Escuchar
                </a>
              </div>
              {{-- ===== /BOTONES ===== --}}
            </div>
          </div>
        </div>
        @endforeach
      </div>
      @endif
    </div>
  </div>
</div>

<style>

  html, body {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}


main {
  flex: 1; /* ocupa todo el espacio disponible */
  display: flex;
  flex-direction: column;
  padding-top: 40px;
}


  /* ===== Sidebar desktop ===== */
  .cat-sidebar.fancy{
    position: sticky;
    top: 0;
    margin-left: -18px;
    padding: 16px;
    border-radius: 16px;
    border: 1px solid rgba(40,167,69,.15);
    background: linear-gradient(180deg, #ffffff 0%, #f8fff9 100%);
    box-shadow: 0 6px 16px rgba(0,0,0,.08);
  }
  .cat-header{
    display:flex; align-items:center; gap:8px;
    font-weight:800; font-size:15px; letter-spacing:.3px;
    color:#1f2d1f; margin-bottom:12px; text-transform:uppercase;
  }
  .cat-btn{
    display:flex; justify-content:space-between; align-items:center;
    padding:10px 12px; border-radius:12px; text-decoration:none; color:#1b1b1b;
    border:1px solid #edf3ee; background:#fafafa; margin-bottom:8px;
    transition:transform .2s, box-shadow .2s, background .2s, border .2s;
    position:relative; overflow:hidden;
  }
  .cat-btn:hover{ transform: translateX(4px); box-shadow: 0 8px 16px rgba(0,0,0,.08); background:#fff; border-color:#e3f4e7; }
  .cat-btn.active{ border-color:#28a745; background:#eaf9ee; font-weight:600; box-shadow: 0 10px 20px rgba(40,167,69,.08); }
  .cat-btn .badge{ min-width:28px; text-align:center; font-weight:700; border-radius:999px; padding:4px 8px; background:#28a745; color:#fff; }

  /* ===== Separación columna derecha ===== */
  .ps-md-5{ padding-left:3rem!important; }
  .content-sep{
    position:absolute; left:0; top:0; bottom:0; width:1px;
    background: linear-gradient(#0000, #e9ecef, #0000);
    transform: translateX(-1.5rem);
  }

  /* ===== Tarjetas ===== */
  .card-float{ transition: transform .25s, box-shadow .25s; }
  .card-float:hover{ transform: translateY(-8px); box-shadow: 0 14px 26px rgba(0,0,0,.15); }
  .card{ border-radius: 15px; overflow:hidden; height:100%; }
  .image-container{ width:100%; height:250px; overflow:hidden; background:#f7f7f7; }
  .card-img-top{ width:100%; height:100%; object-fit:contain; object-position:center; }
  .card-body{ padding:15px; background:#fff; }
  .card-title{ font-size:20px; font-weight:800; color:#1b1b1b; margin-bottom:10px; }
  .card-text{ font-size:14px; color:#555; margin-bottom:10px; }
  .card-text strong{ color:#333; }

  /* ===== BOTONES COMPACTOS CON ICONOS ===== */
  .card-actions{
    display:flex;
    gap:55px;               /* separación entre botones */
    margin-top: 8px;
    flex-wrap: wrap;        /* en móviles se acomodan a dos filas si es necesario */
  }
  .btn-action{
    display:inline-flex; align-items:center; gap:8px;
    padding: 8px 12px;      /* más compacto que antes */
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    text-decoration:none;
    transition: transform .15s ease, box-shadow .15s ease, background-color .2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,.08);
    border: 1px solid transparent;
  }
  .btn-action .icon{ display:block; }
  .btn-action:hover{ transform: translateY(-2px); box-shadow: 0 6px 14px rgba(0,0,0,.12); }

  .btn-read{
    background:#0d6efd; color:#fff; border-color:#0d6efd;
  }
  .btn-read:hover{ background:#0b5ed7; }

  .btn-listen{
    background:#28a745; color:#fff; border-color:#28a745;
  }
  .btn-listen:hover{ background:#218838; }

  /* ===== Drawer móvil (CSS-only) ===== */
  .cats-toggle:checked ~ .cats-drawer { display:block; }
  .cats-drawer{ position:fixed; inset:0; display:none; z-index:1050; }
  .cats-drawer-backdrop{ position:absolute; inset:0; background: rgba(0,0,0,.35); }
  .cats-drawer-panel{
    position:absolute; top:0; left:0; height:100%; width:85%;
    background:#fff; box-shadow: 6px 0 24px rgba(0,0,0,.18);
    transform: translateX(-100%); transition: transform .25s ease;
    padding:16px; z-index:1;
  }
  .cats-toggle:checked ~ .cats-drawer .cats-drawer-panel{ transform: translateX(0); }
  .cats-drawer-head{ display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; }
  .btn-close{ width:32px; height:32px; background:#f1f3f5; border-radius:8px; border:0; display:inline-block; cursor:pointer; }
  .cats-drawer-body{ max-height: calc(100vh - 72px); overflow:auto; }

  @media (max-width: 480px){
    .btn-action{ flex:1 1 calc(50% - 10px); justify-content:center; } /* dos columnas de botones en pantallas muy pequeñas */
  }
  @media (max-width: 768px){
    .cat-sidebar.fancy{ position: static; top:auto; margin-left:0; }
  }


  .navbar ul li a,
.navbar ul li button {
  display: inline-block;
  padding: 8px 16px;
  border: 2px solid rgb(44, 184, 8);;
  border-radius: 999px;
  color: #808080ff;
  background-color: transparent;
  font-weight: 600;
  text-decoration: none;
  transition: all 0.2s ease;
}

.navbar ul li a:hover,
.navbar ul li button:hover {
  background-color: #218838;  /* Verde más oscuro */
  border-color: #218838;
  color: #fff !important;
}

/* ===== BARRA DE BÚSQUEDA ===== */
.search-bar {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px;
  max-width: 600px;
  margin: 0 auto 1rem auto;
  padding: 4px;
  background: linear-gradient(135deg, #f4fffcff, #eafbe9);
  border: 1px solid #45c445ff;
  border-radius: 999px;
  box-shadow: 0 4px 8px rgba(0,0,0,.05);
}

.search-bar input[type="text"] {
  flex: 1;
  padding: 10px 14px;
  border: none;
  border-radius: 999px;
  font-size: 15px;
  outline: none;
  background: transparent;
  color: #333;
}

.search-bar button {
  padding: 10px 14px;
  background-color: #28a745;
  color: white;
  border: none;
  border-radius: 999px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.search-bar button:hover {
  background-color: #218838;
}

</style>
@endsection
