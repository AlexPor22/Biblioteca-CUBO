@extends('layouts.admin')

@section('content')
<style>
    .categories-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #F2F2F2 100%);
        min-height: 100vh;
        padding: 2rem 0;
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
    
    .page-header {
        background: linear-gradient(135deg, #0D0D0D 0%, #2c2c2c 100%);
        color: white;
        padding: 2.5rem 2rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        box-shadow: 0 15px 35px rgba(13, 13, 13, 0.2);
        position: relative;
        overflow: hidden;
        opacity: 0;
        animation: slideInLeft 0.8s ease-out 0.2s forwards;
    }
    
    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }
    
    .page-title {
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
        z-index: 1;
    }
    
    .page-subtitle {
        font-size: 1.1rem;
        color: #b0b0b0;
        margin-top: 0.5rem;
        font-weight: 300;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }
    
    .content-section {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        opacity: 0;
        animation: scaleIn 0.8s ease-out 0.4s forwards;
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
    
    .btn-add {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(40, 167, 69, 0.3);
    }
    
    .btn-add::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }
    
    .btn-add:hover::before {
        left: 100%;
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(40, 167, 69, 0.4);
        color: white;
        text-decoration: none;
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
    
    .category-name {
        font-weight: 600;
        color: #0D0D0D;
        font-size: 1rem;
    }
    
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        align-items: center;
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
    
    .stats-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .stat-card {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border-left: 4px solid #28a745;
        opacity: 0;
        animation: slideInLeft 0.8s ease-out forwards;
    }
    
    .stat-card:nth-child(1) {
        animation-delay: 0.6s;
    }
    
    .stat-card:nth-child(2) {
        animation-delay: 0.8s;
    }
    
    .stat-card:nth-child(3) {
        animation-delay: 1.0s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #28a745;
        margin: 0;
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
        margin-top: 0.5rem;
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

    .modal-header .btn-close {
        background-color: red !important;
        border-radius: 50%;
        opacity: 1;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
    }
    
    .empty-description {
        font-size: 0.9rem;
        color: #adb5bd;
    }
    
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
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
        
        .btn-edit,
        .btn-delete {
            width: 100%;
            justify-content: center;
        }
    }

    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

</style>

<div class="categories-page">
    <div class="container">
        <!-- Header de la página -->
        <div class="page-header">
            <h1 class="page-title">Categorías de Libros</h1>
            <p class="page-subtitle">Organiza y administra las categorías de tu biblioteca digital</p>
        </div>

        <!-- Tarjetas de estadísticas -->
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-number">5</div>
                <div class="stat-label">Total Categorías</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">3</div>
                <div class="stat-label">Categorías Activas</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">24</div>
                <div class="stat-label">Libros Categorizados</div>
            </div>
        </div>

        <!-- Sección de contenido principal -->
        <div class="content-section">
            <div class="section-header">
                <h3 class="section-title">Gestión de Categorías</h3>
                <a href="#" class="btn-add" data-bs-toggle="modal" data-bs-target="#modalAgregarCategoria">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Nueva Categoría
                </a>
            </div>

            <table class="modern-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de Categoría</th>
                        <th>Libros</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="id-badge">1</span></td>
                        <td><span class="category-name">Ficción</span></td>
                        <td>12 libros</td>
                        <td>
                            <span style="color: #28a745; font-weight: 600;">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 0.25rem;">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                                Activa
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-edit">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708L5.707 14.001 2 14.866l.855-3.707L12.146.146zm.353.354-1.5 1.5L12.5 3.5l1.5-1.5L12.5.5zm-2.5 2.5L2.5 10.5l-.457 2.043L4.086 12l7.5-7.5L9.999 3z"/>
                                    </svg>
                                    Editar
                                </a>
                                <a href="#" class="btn-delete">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="id-badge">2</span></td>
                        <td><span class="category-name">Ciencia Ficción</span></td>
                        <td>8 libros</td>
                        <td>
                            <span style="color: #28a745; font-weight: 600;">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 0.25rem;">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                </svg>
                                Activa
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-edit">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708L5.707 14.001 2 14.866l.855-3.707L12.146.146zm.353.354-1.5 1.5L12.5 3.5l1.5-1.5L12.5.5zm-2.5 2.5L2.5 10.5l-.457 2.043L4.086 12l7.5-7.5L9.999 3z"/>
                                    </svg>
                                    Editar
                                </a>
                                <a href="#" class="btn-delete">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="id-badge">3</span></td>
                        <td><span class="category-name">Romance</span></td>
                        <td>4 libros</td>
                        <td>
                            <span style="color: #ffc107; font-weight: 600;">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 0.25rem;">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
                                </svg>
                                Pendiente
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="btn-edit">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708L5.707 14.001 2 14.866l.855-3.707L12.146.146zm.353.354-1.5 1.5L12.5 3.5l1.5-1.5L12.5.5zm-2.5 2.5L2.5 10.5l-.457 2.043L4.086 12l7.5-7.5L9.999 3z"/>
                                    </svg>
                                    Editar
                                </a>
                                <a href="#" class="btn-delete">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>
                                    Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Nueva Categoría -->
<div class="modal fade" id="modalAgregarCategoria" tabindex="-1" aria-labelledby="modalAgregarCategoriaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow-lg border-0" style="border-radius: 16px; animation: fadeInDown 0.4s;">
      <div class="modal-header text-white" style="background: linear-gradient(135deg, #343a40, #212529); border-top-left-radius: 16px; border-top-right-radius: 16px;">
        <h5 class="modal-title" id="modalAgregarCategoriaLabel">
          <i class="fas fa-tags me-2"></i>Agregar Nueva Categoría
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar" style="background-color: #dc3545;"></button>
      </div>

      <form id="formCategoria" onsubmit="agregarCategoria(event)">
        <div class="modal-body px-4 py-3">
          <div class="mb-3">
            <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-bookmark"></i></span>
              <input type="text" class="form-control" id="nombre_categoria" placeholder="Ej. Literatura Clásica" required>
            </div>
          </div>

          <div class="mb-3">
            <label for="estado_categoria" class="form-label">Estado</label>
            <div class="input-group">
              <span class="input-group-text"><i class="fas fa-toggle-on"></i></span>
              <select class="form-select" id="estado_categoria" required>
                <option value="activa">Activa</option>
                <option value="pendiente">Pendiente</option>
              </select>
            </div>
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

<!-- Script para insertar categoría dinámicamente -->
<script>
function agregarCategoria(e) {
  e.preventDefault();

  const nombre = document.getElementById('nombre_categoria').value.trim();
  const estado = document.getElementById('estado_categoria').value.trim();

  if (!nombre || !estado) return;

  const tabla = document.querySelector(".modern-table tbody");
  const nuevaFila = document.createElement("tr");
  const id = tabla.rows.length + 1;

  const estadoHTML = estado === 'activa' ?
    `<span style="color: #28a745; font-weight: 600;">
        <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 0.25rem;">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.061L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
        </svg>
        Activa
    </span>` :
    `<span style="color: #ffc107; font-weight: 600;">
        <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 0.25rem;">
            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
            <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
        </svg>
        Pendiente
    </span>`;

  nuevaFila.innerHTML = `
    <td><span class="id-badge">${id}</span></td>
    <td><span class="category-name">${nombre}</span></td>
    <td>0 libros</td>
    <td>${estadoHTML}</td>
    <td>
      <div class="action-buttons">
        <a href="#" class="btn-edit">
            <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708L5.707 14.001 2 14.866l.855-3.707L12.146.146zm.353.354-1.5 15 3.5l1.5-1.5L12.5.5zm-2.5 2.5L2.5 10.5l-.457 2.043L4.086 12l7.5-7.5L9.999 3z"/>
            </svg>
            Editar
        </a>
        <a href="#" class="btn-delete">
            <svg width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
            </svg>
            Eliminar
        </a>
      </div>
    </td>`;

  tabla.appendChild(nuevaFila);

    Swal.fire({
        icon: 'success',
        title: '¡Categoría agregada!',
        text: `Se agregó "${nombre}" correctamente.`,
        timer: 1600,
        showConfirmButton: false
    });

  bootstrap.Modal.getOrCreateInstance(document.getElementById('modalAgregarCategoria')).hide();
  document.getElementById('formCategoria').reset();
}
</script>

@endsection