@extends('layouts.admin')

@section('content')
    <style>
        .libros-page {
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
        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }
            100% {
                transform: translateX(100%);
            }
        } 
        .search-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            margin: 1rem 0;
            opacity: 0;
            animation: scaleIn 0.8s ease-out 0.4s forwards;
        }
        
        .search-container {
            position: relative;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .search-input {
            width: 100%;
            padding: 1rem 1.5rem 1rem 3rem;
            border: 2px solid #e9ecef;
            border-radius: 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
            background: white;
        }
        
        .search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            font-size: 1.2rem;
        }
        
        .filter-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .filter-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            background: white;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .filter-btn:hover,
        .filter-btn.active {
            background: #28a745;
            color: white;
            border-color: #28a745;
            text-decoration: none;
        }
        
        .content-section {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
            opacity: 0;
            animation: scaleIn 0.8s ease-out 0.6s forwards;
            position: relative;
            overflow: hidden;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #F2F2F2;
        }
        
        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0D0D0D;
            margin: 0;
        }
        
        .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        }
        
        .modern-table thead {
            background: linear-gradient(135deg, #F2F2F2 0%, #e9ecef 100%);
        }
        
        .modern-table th {
            padding: 1.25rem 1.5rem;
            font-weight: 700;
            color: #0D0D0D;
            text-align: left;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            position: relative;
        }
        
        .modern-table th:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, #28a745, #20c997);
        }
        
        .modern-table td {
            padding: 1.25rem 1.5rem;
            border: none;
            color: #495057;
            font-size: 0.95rem;
            border-bottom: 1px solid #f8f9fa;
            transition: all 0.3s ease;
        }
        
        .modern-table tbody tr {
            transition: all 0.3s ease;
        }
        
        .modern-table tbody tr:hover {
            background: linear-gradient(135deg, #f8f9fa 0%, #F2F2F2 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .modern-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .id-badge {
            background: linear-gradient(135deg, #0D0D0D 0%, #2c2c2c 100%);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-block;
            min-width: 40px;
            text-align: center;
        }
        
        .book-title {
            font-weight: 600;
            color: #0D0D0D;
            font-size: 1rem;
            margin-bottom: 0.2rem;
        }
        
        .book-author {
            color: #6c757d;
            font-size: 0.85rem;
            font-style: italic;
        }
        
        .book-cover {
            width: 40px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }
        
        .category-badge {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-block;
        }
        
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .status-disponible {
            background: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }
        
        .status-prestado {
            background: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .status-reservado {
            background: rgba(23, 162, 184, 0.1);
            color: #17a2b8;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        
        .btn-view {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(23, 162, 184, 0.3);
        }
        
        .btn-view:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(23, 162, 184, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(255, 193, 7, 0.3);
        }
        
        .btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(220, 53, 69, 0.3);
        }
        
        .btn-delete:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #6c757d;
            opacity: 0;
            animation: fadeInUp 0.8s ease-out 1s forwards;
        }
        
        .empty-icon {
            font-size: 4rem;
            color: #dee2e6;
            margin-bottom: 1rem;
        }
        
        .empty-message {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        
        .empty-description {
            font-size: 0.9rem;
            color: #adb5bd;
        }
        
        .rating-stars {
            color: #ffc107;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .search-container {
                max-width: 100%;
            }
            
            .filter-buttons {
                justify-content: flex-start;
            }
            
            .section-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }
            
            .modern-table {
                font-size: 0.85rem;
            }
            
            .modern-table th,
            .modern-table td {
                padding: 1rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }
            
            .btn-view,
            .btn-edit,
            .btn-delete {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
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

            <!-- Sección de búsqueda -->
            <div class="search-section">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" class="search-input" placeholder="Buscar por título, autor, ISBN o categoría..." id="searchInput">
                </div>
                <div class="filter-buttons">
                    <a href="#" class="filter-btn active" data-filter="all">Todos</a>
                    <a href="#" class="filter-btn" data-filter="disponible">Disponibles</a>
                    <a href="#" class="filter-btn" data-filter="prestado">Prestados</a>
                    <a href="#" class="filter-btn" data-filter="reservado">Reservados</a>
                </div>
            </div>

            <!-- Sección de contenido principal -->
            <div class="content-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="fas fa-list me-2"></i>
                        Catálogo de Libros
                    </h3>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-secondary">Mostrando 1,247 libros</span>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="modern-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Libro</th>
                                <th>Categoría</th>
                                <th>ISBN</th>
                                <th>Estado</th>
                                <th>Fecha Registro</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="booksTableBody">
                            <tr>
                                <td><span class="id-badge">001</span></td>
                                <td>
                                    <div class="book-title">Cien años de soledad</div>
                                    <div class="book-author">Gabriel García Márquez</div>
                                </td>
                                <td>
                                    <span class="category-badge">Ficción</span>
                                </td>
                                <td>978-0-06-088328-7</td>
                                <td>
                                    <span class="status-badge status-disponible">
                                        <i class="fas fa-check-circle"></i>
                                        Disponible
                                    </span>
                                </td>
                                <td>15/03/2024</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="#" class="btn-view">
                                            <i class="fas fa-eye"></i>
                                            Ver
                                        </a>
                                        <a href="#" class="btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>
                                        <a href="#" class="btn-delete">
                                            <i class="fas fa-trash"></i>
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td><span class="id-badge">002</span></td>
                                <td>
                                    <div class="book-title">El Quijote de la Mancha</div>
                                    <div class="book-author">Miguel de Cervantes</div>
                                </td>
                                <td>
                                    <span class="category-badge">Clásicos</span>
                                </td>
                                <td>978-84-376-0494-7</td>
                                <td>
                                    <span class="status-badge status-prestado">
                                        <i class="fas fa-clock"></i>
                                        Prestado
                                    </span>
                                </td>
                                <td>08/02/2024</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="#" class="btn-view">
                                            <i class="fas fa-eye"></i>
                                            Ver
                                        </a>
                                        <a href="#" class="btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>
                                        <a href="#" class="btn-delete">
                                            <i class="fas fa-trash"></i>
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="id-badge">003</span></td>
                                <td>
                                    <div class="book-title">Sapiens: De animales a dioses</div>
                                    <div class="book-author">Yuval Noah Harari</div>
                                </td>
                                <td>
                                    <span class="category-badge">Historia</span>
                                </td>
                                <td>978-0-06-231609-7</td>
                                <td>
                                    <span class="status-badge status-reservado">
                                        <i class="fas fa-bookmark"></i>
                                        Reservado
                                    </span>
                                </td>
                                <td>22/01/2024</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="#" class="btn-view">
                                            <i class="fas fa-eye"></i>
                                            Ver
                                        </a>
                                        <a href="#" class="btn-edit">
                                            <i class="fas fa-edit"></i>
                                            Editar
                                        </a>
                                        <a href="#" class="btn-delete">
                                            <i class="fas fa-trash"></i>
                                            Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> <!-- .content-section -->
        </div> <!-- .container -->
    </div> <!-- .libros-page -->

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