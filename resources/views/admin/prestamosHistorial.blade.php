@extends('layouts.admin')

@section('content')
<div class="historial-page">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Historial de Préstamos</h1>
      <p class="header-subtitle">Administra y supervisa todos los préstamos de tu biblioteca digital.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">156</div>
          <div class="stat-label">Total Préstamos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">23</div>
          <div class="stat-label">Préstamos Activos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">8</div>
          <div class="stat-label">Préstamos Vencidos</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">125</div>
          <div class="stat-label">Préstamos Devueltos</div>
        </div>
      </div>
    </div>
    <!-- Barra de Búsqueda -->
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Buscar por nombre o correo...">
      <button class="search-btn">
        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
          <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <!-- Sección de contenido principal -->
    <div class="content-section">
      <div class="section-header">
        <h3 class="section-title">Catálogo de Prestamos</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="">Activos</a>
          <a href="#" class="filter-btn" data-filter="">Vencidos</a>
          <a href="#" class="filter-btn" data-filter="">Devueltos</a>
          <a href="#" class="filter-btn" data-filter="">Renovados</a>
        </div>
        <!-- Paginación -->
        <div class="pagination">
          <a href="#">« Anterior</a>
          <a href="#" class="active">1</a>
          <a href="#">2</a>
          <a href="#">3</a>
          <a href="#">Siguiente »</a>
        </div>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Libro</th>
            <th>Fecha Préstamo</th>
            <th>Fecha Devolución</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span class="id-badge">001</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status activo">Activo</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span class="id-badge">002</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status vencido">Vencido</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span class="id-badge">003</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status devuelto">Devuelto</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span class="id-badge">004</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status renovado">Renovado</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span class="id-badge">005</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status renovado">Renovado</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span class="id-badge">006</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status renovado">Renovado</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span class="id-badge">007</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status renovado">Renovado</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span class="id-badge">008</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status renovado">Renovado</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span class="id-badge">009</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status renovado">Renovado</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
          <tr>
            <td><span class="id-badge">010</span></td>
            <td>
              <div class="user-info">
                <div>
                  <div>María Alejandra</div>
                  <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                </div>
              </div>
            </td>
            <td>
              <div class="book-title">El Quijote de la Mancha</div>
              <div class="book-author">Miguel de Cervantes</div>
            </td>
            <td>15/01/2024</td>
            <td>29/01/2024</td>
            <td><span class="status renovado">Renovado</span></td>
            <td>
              <div class="action-buttons">
                <a href="#" class="btn-renovar">Renovar</a>
                <a href="#" class="btn-edit">Editar</a>
                <a href="#" class="btn-delete">Eliminar</a>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Paginación -->
    <div class="pagination">
      <a href="#">« Anterior</a>
      <a href="#" class="active">1</a>
      <a href="#">2</a>
      <a href="#">3</a>
      <a href="#">Siguiente »</a>
    </div>
  </div>
</div>
@endsection
