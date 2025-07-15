@extends('layouts.admin')

@section('content')
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
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

    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 5px 20px rgba(40, 167, 69, 0.4);
        }
        50% {
            box-shadow: 0 8px 30px rgba(40, 167, 69, 0.6);
        }
    }

    .container {
        max-width: 1320px;
        margin: 0 auto;
    }
     @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }
    .btn {
        padding: 12px 24px;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
    }

    .btn-primary {
        background: linear-gradient(135deg, #22C55E, #16A34A);
        color: #FFFFFF;
    }

    .btn-warning {
        background: linear-gradient(135deg, #EAB308, #CA8A04);
        color: #FFFFFF;
    }

    .btn-danger {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: #FFFFFF;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 14px;
    }

    .filters {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 25px;
        border-radius: 20px;
        margin: 1rem 0;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        opacity: 0;
        animation: fadeInUp 0.8s ease-out 0.8s forwards;
        transition: all 0.4s ease;
    }

    .filters:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        min-width: 150px;
    }

    .filter-group label {
        color: #374151;
        font-size: 14px;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .filter-group select,
    .filter-group input {
        padding: 12px;
        background: rgba(255, 255, 255, 0.8);
        border: 2px solid rgba(229, 231, 235, 0.5);
        border-radius: 10px;
        color: #0D0D0D;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .filter-group select:focus,
    .filter-group input:focus {
        outline: none;
        border-color: #22C55E;
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
        transform: scale(1.02);
    }

    .table-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        opacity: 0;
        animation: scaleIn 0.8s ease-out 1s forwards;
        transition: all 0.4s ease;
    }

    .table-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        background: rgba(249, 250, 251, 0.8);
        color: #0D0D0D;
        padding: 20px 15px;
        text-align: left;
        font-weight: 700;
        border-bottom: 2px solid rgba(229, 231, 235, 0.5);
        position: relative;
    }

    .table th::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, #22C55E, #16A34A);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .table th:hover::after {
        transform: scaleX(1);
    }

    .table td {
        padding: 20px 15px;
        border-bottom: 1px solid rgba(229, 231, 235, 0.3);
        color: #0D0D0D;
        transition: all 0.3s ease;
    }

    .table tr {
        transition: all 0.3s ease;
        opacity: 0;
        animation: fadeInUp 0.6s ease-out forwards;
    }

    .table tbody tr:nth-child(1) {
        animation-delay: 1.2s;
    }

    .table tr:hover {
        background: rgba(249, 250, 251, 0.5);
        transform: scale(1.01);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .status {
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        display: inline-block;
        min-width: 80px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .status::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s ease;
    }

    .status:hover::before {
        left: 100%;
    }

    .status.activo {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(34, 197, 94, 0.1));
        color: #16A34A;
        border: 2px solid rgba(34, 197, 94, 0.3);
    }

    .status.vencido {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(239, 68, 68, 0.1));
        color: #DC2626;
        border: 2px solid rgba(239, 68, 68, 0.3);
    }

    .status.devuelto {
        background: linear-gradient(135deg, rgba(107, 114, 128, 0.2), rgba(107, 114, 128, 0.1));
        color: #374151;
        border: 2px solid rgba(107, 114, 128, 0.3);
    }

    .status.renovado {
        background: linear-gradient(135deg, rgba(234, 179, 8, 0.2), rgba(234, 179, 8, 0.1));
        color: #CA8A04;
        border: 2px solid rgba(234, 179, 8, 0.3);
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
    }

    .user-info:hover {
        transform: scale(1.05);
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #22C55E, #16A34A);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #FFFFFF;
        font-size: 16px;
        box-shadow: 0 4px 15px rgba(34, 197, 94, 0.3);
        transition: all 0.3s ease;
        animation: pulse 2s infinite;
    }

    .user-avatar:hover {
        transform: scale(1.1);
        animation: none;
    }

    .book-info {
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }

    .book-info:hover {
        transform: translateX(5px);
    }

    .book-title {
        font-weight: 700;
        color: #0D0D0D;
        margin-bottom: 4px;
    }

    .book-author {
        font-size: 12px;
        color: #6B7280;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 8px;
        opacity: 0;
        animation: fadeInUp 0.8s ease-out 1.4s forwards;
    }

    .pagination a {
        padding: 12px 16px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        color: #0D0D0D;
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        border: 1px solid rgba(209, 213, 219, 0.3);
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }

    .pagination a::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(34, 197, 94, 0.2), transparent);
        transition: left 0.6s ease;
    }

    .pagination a:hover::before {
        left: 100%;
    }

    .pagination a:hover,
    .pagination a.active {
        background: linear-gradient(135deg, #22C55E, #16A34A);
        color: #FFFFFF;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(34, 197, 94, 0.3);
    }

    .historial-page {
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


    @media (max-width: 768px) {
        body {
            padding: 10px;
        }
        .filters {
            flex-direction: column;
        }

        .filter-group {
            min-width: auto;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            min-width: 800px;
        }

    }
    </style>
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

        <div class="filters">
            <div class="filter-group">
                <label>Estado</label>
                <select>
                    <option value="">Todos</option>
                    <option value="activo">Activo</option>
                    <option value="vencido">Vencido</option>
                    <option value="devuelto">Devuelto</option>
                    <option value="renovado">Renovado</option>
                </select>
            </div>
            <div class="filter-group">
                <label>Usuario</label>
                <input type="text" placeholder="Buscar usuario...">
            </div>
            <div class="filter-group">
                <label>Libro</label>
                <input type="text" placeholder="Buscar libro...">
            </div>
            <div class="filter-group">
                <label>Fecha desde</label>
                <input type="date">
            </div>
            <div class="filter-group">
                <label>Fecha hasta</label>
                <input type="date">
            </div>
            <div class="filter-group">
                <button class="btn btn-primary">Aplicar Filtros</button>
            </div>
        </div>

        <div class="table-container">
            <table class="table">
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
                        <td>001</td>
                        <td>
                            <div class="user-info">
                                <div class="user-avatar">MA</div>
                                <div>
                                    <div>María Alejandra</div>
                                    <div style="font-size: 12px; color: #6B7280;">maria@email.com</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="book-info">
                                <div class="book-title">Cien años de soledad</div>
                                <div class="book-author">Gabriel García Márquez</div>
                            </div>
                        </td>
                        <td>15/01/2024</td>
                        <td>29/01/2024</td>
                        <td><span class="status activo">Activo</span></td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm">Renovar</a>
                            <a href="#" class="btn btn-primary btn-sm">Devolver</a>
                            <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

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
