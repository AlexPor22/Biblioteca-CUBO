@extends('layouts.admin')

@section('content')
<div class="publish-dashboard">
  @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  @endif
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Gestion de Libros Fisicos</h1>
      <!-- Subtítulo descriptivo -->
      <p class="header-subtitle">Administra y controla todos los libros físicos del sistema.</p>
    </div>

    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">12</div>
          <div class="stat-label">Total de Libros</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">8  </div>
          <div class="stat-label">Libros disponibles</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">4</div>
          <div class="stat-label">Libros prestados</div>
        </div>
      </div>
    </div>

    <!-- Barra de Búsqueda -->
    <form method="GET" action="" class="search-bar" style="margin-bottom: 1rem;">
      <input 
        type="text"
        name="search"
        class="search-input"
        id="buscarLibro"
        placeholder="Buscar por nombre del libro, categoría, código, estado y tipo..."
        value="">
    </form>

    <!-- Sección de contenido principal -->
    <div class="content-section">
      <div class="section-header">
        <h3 class="section-title">Catálogo de Libros</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="habilitado">Habilitados</a>
          <a href="#" class="filter-btn" data-filter="deshabilitado">Deshabilitados</a>
        </div>
        <div>
          <a class="btn-add" data-bs-toggle="modal" data-bs-target="#modalPublicarLibro">Nuevo Libro Digital</a>
        </div>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
            <th>Libro</th>
            <th>Categoría</th>
            <th>Codigo</th>
            <th>Estado</th>
            <th>Tipo</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>


  </div>
</div>
@endsection
