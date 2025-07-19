@extends('layouts.admin')

@section('content')
<div class="libros-page">
  <div class="container">
    <!-- Header panel -->
    <div class="header">
      <h1 class="header-title">Biblioteca de Libros</h1>
      <p class="header-subtitle">Explora, busca y gestiona toda tu colección de libros digitales.</p>
    </div>
    <!-- Sección de Estadísticas -->
    <div class="stats-section">
      <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-number">1,247</div>
          <div class="stat-label">Total de Libros</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">1,089</div>
          <div class="stat-label">Disponibles</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">158</div>
          <div class="stat-label">Prestados</div>
        </div>
        <div class="stat-item">
          <div class="stat-number">342</div>
          <div class="stat-label">Reservados</div>
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
        <h3 class="section-title">Catálogo de Libros</h3>
        <!-- Filtros -->
        <div class="filter-buttons">
          <a href="#" class="filter-btn active" data-filter="all">Todos</a>
          <a href="#" class="filter-btn" data-filter="">Disponibles</a>
          <a href="#" class="filter-btn" data-filter="">Prestados</a>
          <a href="#" class="filter-btn" data-filter="">Reservados</a>
        </div>
      </div>
      <table class="modern-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Libro</th>
            <!-- Categoría 
            <th>Categoría</th>
            -->
            <th>ISBN</th>
            <th>Estado</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><span>001</span></td>
            <td>
              <div >El Quijote de la Mancha</div>
              <div >Miguel de Cervantes</div>
            </td>

            <!-- Categoría 
            <td>
              <span class="category-badge">Historia</span>
            </td>
            -->
            
            <td>978-84-376-0494-7</td>
            <td>
              <span class="status-badge status-disponible">Disponible</span>
            </td>
            <td>08/02/2024</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit">Editar</button>
                <button class="btn-delete">Eliminar</button>
              </div>
            </td>
          </tr>

          <tr>
            <td><span >002</span></td>
            <td>
              <div >El Quijote de la Mancha</div>
              <div >Miguel de Cervantes</div>
            </td>
            
            <td>978-84-376-0494-7</td>
            <td>
              <span class="status-badge status-prestado">Prestado</span>
            </td>
            <td>08/02/2024</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit">Editar</button>
                <button class="btn-delete">Eliminar</button>
              </div>
            </td>
          </tr>

          <tr>
            <td><span >003</span></td>
            <td>
              <div >Sapiens: De animales a dioses</div>
              <div >Yuval Noah Harari</div>
            </td>
            
            <td>978-0-06-231609-7</td>
            <td>
              <span class="status-badge status-reservado">Reservado</span>
            </td>
            <td>22/01/2024</td>
            <td>
              <div class="action-buttons">
                <button class="btn-view">Ver</button>
                <button class="btn-edit">Editar</button>
                <button class="btn-delete">Eliminar</button>
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

<script>
    document.querySelectorAll('.btn-delete').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();

      Swal.fire({
        title: '¿Estás seguro?',
        text: "Esta acción no se puede deshacer.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
      }).then((result) => {
        if (result.isConfirmed) {
          // Acción real aquí. Por ejemplo:
          // eliminarUsuario(id);
          Swal.fire({
            icon: 'success',
            title: 'Eliminado',
            text: 'El registro ha sido eliminado exitosamente.',
            confirmButtonColor: '#28a745'
          });

          // También puedes eliminar dinámicamente la fila:
          // btn.closest('tr').remove();
        }
      });
    });
});
</script>
@endsection