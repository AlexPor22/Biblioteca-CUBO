@extends('layouts.admin')

@section('content')

<style>
    .prestamo-dashboard {
        background: linear-gradient(135deg, #f8f9fa 0%, #F2F2F2 100%);
        min-height: 100vh;
        padding: 2rem 0;
        opacity: 0;
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    @keyframes fadeInUp {
        0% { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideInLeft {
        0% { opacity: 0; transform: translateX(-50px); }
        100% { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes scaleIn {
        0% { opacity: 0; transform: scale(0.8); }
        100% { opacity: 1; transform: scale(1); }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    .prestamo-header {
        background: linear-gradient(135deg, #0D0D0D 0%, #2c2c2c 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: 20px;
        margin-bottom: 3rem;
        box-shadow: 0 15px 35px rgba(13, 13, 13, 0.2);
        position: relative;
        overflow: hidden;
        opacity: 0;
        animation: slideInLeft 0.8s ease-out 0.2s forwards;
    }
    
    .prestamo-header::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
        animation: shimmer 3s infinite;
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .prestamo-header .prestamo-title {
        font-size: 3rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .prestamo-subtitle {
        font-size: 1.3rem;
        color: #b0b0b0;
        margin-top: 1rem;
        font-weight: 300;
        line-height: 1.6;
    }
    
    .prestamo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .prestamo-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        transition: all 0.4s ease;
        position: relative;
        overflow: hidden;
        opacity: 0;
        animation: scaleIn 0.8s ease-out forwards;
        border: 2px solid transparent;
    }
    
    .prestamo-card:nth-child(1) {
        animation-delay: 0.4s;
    }
    
    .prestamo-card:nth-child(2) {
        animation-delay: 0.6s;
    }
    
    .prestamo-card:nth-child(3) {
        animation-delay: 0.8s;
    }
    
    .prestamo-card::before {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 5px;
        background: linear-gradient(90deg, #28a745, #20c997);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .prestamo-card:hover::before {
        transform: scaleX(1);
    }

    .prestamo-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        border-color: rgba(40, 167, 69, 0.3);
    }
    
    .card-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2.5rem;
        color: white;
        animation: float 3s ease-in-out infinite;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .card-icon.nuevo-prestamo {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        animation-delay: 0s;
    }
    
    .card-icon.prestamo-activo {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        animation-delay: 1s;
    }
    
    .card-icon.historial {
        background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%);
        animation-delay: 2s;
    }
    
    .card-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0D0D0D;
        margin-bottom: 1rem;
        text-align: center;
        line-height: 1.3;
    }

    .card-description {
        color: #6c757d;
        font-size: 1rem;
        line-height: 1.6;
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .card-button {
        background: linear-gradient(135deg, #0D0D0D 0%, #2c2c2c 100%);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: block;
        text-align: center;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(13, 13, 13, 0.3);
        cursor: pointer;
        margin-left: auto;
        margin-right: auto;
    }
    
    .card-button::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(40, 167, 69, 0.4), transparent);
        transition: left 0.6s ease;
    }

    .card-button:hover::before {
        left: 100%;
    }

    .card-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(13, 13, 13, 0.4);
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        opacity: 0;
        animation: scaleIn 0.6s ease-out forwards;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card:nth-child(1) { animation-delay: 0.2s; }
    .stat-card:nth-child(2) { animation-delay: 0.4s; }
    .stat-card:nth-child(3) { animation-delay: 0.6s; }
    .stat-card:nth-child(4) { animation-delay: 0.8s; }
    .stat-card:nth-child(5) { animation-delay: 1s; }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #28a745, #20c997);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover::before {
        transform: scaleX(1);
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #0D0D0D;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .prestamos-activos {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-top: 3rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        opacity: 0;
        animation: fadeInUp 0.8s ease-out 1s forwards;
    }
    
    .prestamos-activos h3 {
        color: #0D0D0D;
        font-weight: 700;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .prestamo-item {
        display: flex;
        align-items: center;
        padding: 1.5rem;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #F2F2F2 0%, #e9ecef 100%);
        border-radius: 15px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .prestamo-item .prestamo-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #0D0D0D;
        margin-bottom: 0.3rem;
    }
    
    .prestamo-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .prestamo-item::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(90deg, #28a745, #20c997);
        transform: scaleY(0);
        transition: transform 0.3s ease;
    }
    
    .prestamo-item:hover::before {
        transform: scaleY(1);
    }
    
    .prestamo-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1.5rem;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .prestamo-icon.book-icon {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }
    
    .prestamo-icon.audio-icon {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .prestamo-details {
        flex: 1;
    }
    
    .prestamo-title {
        font-weight: 800;
        color: #0D0D0D;
        margin-bottom: 0.5rem;
        font-size: 3rem;
    }
    
    .prestamo-meta {
        font-size: 0.85rem;
        color: #6c757d;
        margin-bottom: 0.2rem;
    }
    
    .prestamo-usuario {
        font-size: 0.85rem;
        color: #28a745;
        font-weight: 600;
    }
    
    .prestamo-info {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 0.5rem;
    }
    
    .prestamo-fecha {
        background: rgba(111, 66, 193, 0.1);
        color: #28a745;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }
    
    .prestamo-estado {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        text-transform: uppercase;
    }
    
    .estado-activo {
        background: rgba(40, 167, 69, 0.1);
        color: #28a745;
    }

    .prestamos-activos .prestamo-title {
        font-size: 1.2rem;
    }
    
    .estado-vencido {
        background: rgba(220, 53, 69, 0.1);
        color: #dc3545;
    }
    
    .estado-por-vencer {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }
    
    .quick-actions {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .quick-action-btn {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        box-shadow: 0 5px 20px rgba(40, 167, 69, 0.4);
        transition: all 0.3s ease;
        cursor: pointer;
        animation: pulse 2s infinite;
    }
    
    .quick-action-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 8px 30px rgba(40, 167, 69, 0.6);
    }
    
    .quick-action-btn.secondary {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        box-shadow: 0 5px 20px rgba(40, 167, 69, 0.4);
        animation: none;
    }
    
    .quick-action-btn.secondary:hover {
        box-shadow: 0 8px 30px rgba(40, 167, 69, 0.6);
    }
    
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 5px 20px rgba(40, 167, 69, 0.4);
        }
        50% {
            box-shadow: 0 8px 30px rgba(40, 167, 69, 0.6);
        }
    }
    
    .search-bar {
        background: white;
        padding: 1.5rem;
        border-radius: 15px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        display: flex;
        gap: 1rem;
        align-items: center;
    }
    
    .search-input {
        flex: 1;
        padding: 0.75rem 1rem;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #28a745;
        box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.1);
    }
    
    .search-btn {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border: none; 
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(111, 66, 193, 0.3);
    }
    
    @media (max-width: 768px) {
        .prestamo-title {
            font-size: 2.5rem;
        }
        
        .prestamo-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .prestamo-card {
            padding: 2rem;
        }
        
        .quick-actions {
            bottom: 1rem;
            right: 1rem;
        }
        
        .prestamo-item {
            flex-direction: column;
            text-align: center;
        }
        
        .prestamo-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }
        
        .prestamo-info {
            align-items: center;
            margin-top: 1rem;
        }
    }
</style>

<div class="prestamo-dashboard">
    <div class="container">
        <!-- Header de Préstamos -->
        <div class="prestamo-header">
            <h1 class="prestamo-title">Gestión de Préstamos</h1>
            <p class="prestamo-subtitle">Administra préstamos de libros digitales y audiolibros. Controla fechas de vencimiento, renovaciones y historial de préstamos.</p>
        </div>

        <!-- Estadísticas de Préstamos -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">24</div>
                <div class="stat-label">Préstamos Activos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">7</div>
                <div class="stat-label">Por Vencer</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">3</div>
                <div class="stat-label">Vencidos</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">186</div>
                <div class="stat-label">Total Este Mes</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">92%</div>
                <div class="stat-label">Tasa Devolución</div>
            </div>
        </div>

        <!-- Barra de Búsqueda -->
        <div class="search-bar">
            <input type="text" class="search-input" placeholder="Buscar por título, autor o usuario...">
            <button class="search-btn">
                <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <!-- Opciones de Gestión -->
        <div class="prestamo-grid">
            <!-- Nuevo Préstamo -->
            <div class="prestamo-card">
                <div class="card-icon nuevo-prestamo">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h5 class="card-title">Nuevo Préstamo</h5>
                <p class="card-description">Registra un nuevo préstamo de libro digital o audiolibro. Asigna usuario, duración y configura notificaciones.</p>
                <button class="card-button" onclick="window.location.href='#'">
                    <span>Crear Préstamo</span>
                </button>
            </div>

            <!-- Préstamos Activos -->
            <div class="prestamo-card">
                <div class="card-icon prestamo-activo">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                    </svg>
                </div>
                <h5 class="card-title">Préstamos Activos</h5>
                <p class="card-description">Visualiza y administra todos los préstamos en curso. Controla fechas de vencimiento y gestiona renovaciones.</p>
                <button class="card-button" onclick="window.location.href='#'">
                    <span>Ver Activos</span>
                </button>
            </div>

            <!-- Historial -->
            <div class="prestamo-card">
                <div class="card-icon historial">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h5 class="card-title">Historial</h5>
                <p class="card-description">Consulta el historial completo de préstamos. Genera reportes y estadísticas detalladas por período.</p>
                <button class="card-button" onclick="window.location.href='#'">
                    <span>Ver Historial</span>
                </button>
            </div>
        </div>

        <!-- Préstamos Recientes -->
        <div class="prestamos-activos">
            <h3>
                <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                </svg>
                Préstamos Activos Recientes
            </h3>
            
            <div class="prestamo-item">
                <div class="prestamo-icon book-icon">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                    </svg>
                </div>
                <div class="prestamo-details">
                    <div class="prestamo-title">Cien Años de Soledad</div>
                    <div class="prestamo-meta">Gabriel García Márquez • Prestado hace 3 días</div>
                    <div class="prestamo-usuario">María González</div>
                </div>
                <div class="prestamo-info">
                    <div class="prestamo-fecha">Vence: 18 Jul 2025</div>
                    <div class="prestamo-estado estado-activo">Activo</div>
                </div>
            </div>

            <div class="prestamo-item">
                <div class="prestamo-icon audio-icon">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                        <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="prestamo-details">
                    <div class="prestamo-title">El Principito (Audiolibro)</div>
                    <div class="prestamo-meta">Antoine de Saint-Exupéry • Prestado hace 1 semana</div>
                    <div class="prestamo-usuario">Carlos Mendoza</div>
                </div>
                <div class="prestamo-info">
                    <div class="prestamo-fecha">Vence: 13 Jul 2025</div>
                    <div class="prestamo-estado estado-por-vencer">Por Vencer</div>
                </div>
            </div>

            <div class="prestamo-item">
                <div class="prestamo-icon book-icon">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                    </svg>
                </div>
                <div class="prestamo-details">
                    <div class="prestamo-title">Rayuela</div>
                    <div class="prestamo-meta">Julio Cortázar • Prestado hace 2 semanas</div>
                    <div class="prestamo-usuario">Ana Rodríguez</div>
                </div>
                <div class="prestamo-info">
                    <div class="prestamo-fecha">Vence: 10 Jul 2025</div>
                    <div class="prestamo-estado estado-vencido">Vencido</div>
                </div>
            </div>

            <div class="prestamo-item">
                <div class="prestamo-icon book-icon">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"></path>
                    </svg>
                </div>
                <div class="prestamo-details">
                    <div class="prestamo-title">Don Quijote de la Mancha</div>
                    <div class="prestamo-meta">Miguel de Cervantes • Prestado hace 5 días</div>
                    <div class="prestamo-usuario">Pedro Santana</div>
                </div>
                <div class="prestamo-info">
                    <div class="prestamo-fecha">Vence: 25 Jul 2025</div>
                    <div class="prestamo-estado estado-activo">Activo</div>
                </div>
            </div>

            <div class="prestamo-item">
                <div class="prestamo-icon audio-icon">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                        <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="prestamo-details">
                    <div class="prestamo-title">1984 (Audiolibro)</div>
                    <div class="prestamo-meta">George Orwell • Prestado hace 1 día</div>
                    <div class="prestamo-usuario">Laura Jiménez</div>
                </div>
                <div class="prestamo-info">
                    <div class="prestamo-fecha">Vence: 25 Jul 2025</div>
                    <div class="prestamo-estado estado-activo">Activo</div>
                </div>
            </div>
        </div>

        <!-- Filtros Rápidos -->
        <div class="prestamos-activos">
            <h3>
                <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"></path>
                </svg>
                Filtros Rápidos
            </h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-top: 1rem;">
                <div class="prestamo-item" style="cursor: pointer; margin-bottom: 0;">
                    <div class="prestamo-icon" style="background: linear-gradient(135deg, #28a745 0%, #20c997 100%); margin-right: 1rem; width: 50px; height: 50px; font-size: 1.2rem;">
                        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="prestamo-details">
                        <div class="prestamo-title">Préstamos Activos</div>
                        <div class="prestamo-meta">24 préstamos en curso</div>
                    </div>
                </div>

                <div class="prestamo-item" style="cursor: pointer; margin-bottom: 0;">
                    <div class="prestamo-icon" style="background: linear-gradient(135deg, #ffc107 0%, #ffb300 100%); margin-right: 1rem; width: 50px; height: 50px; font-size: 1.2rem;">
                        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="prestamo-details">
                        <div class="prestamo-title">Por Vencer</div>
                        <div class="prestamo-meta">7 préstamos próximos a vencer</div>
                    </div>
                </div>

                <div class="prestamo-item" style="cursor: pointer; margin-bottom: 0;">
                    <div class="prestamo-icon" style="background: linear-gradient(135deg, #dc3545 0%, #c82333 100%); margin-right: 1rem; width: 50px; height: 50px; font-size: 1.2rem;">
                        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="prestamo-details">
                        <div class="prestamo-title">Vencidos</div>
                        <div class="prestamo-meta">3 préstamos vencidos</div>
                    </div>
                </div>

                <div class="prestamo-item" style="cursor: pointer; margin-bottom: 0;">
                    <div class="prestamo-icon" style="background: linear-gradient(135deg, #6f42c1 0%, #5a3ba8 100%); margin-right: 1rem; width: 50px; height: 50px; font-size: 1.2rem;">
                        <svg fill="currentColor" viewBox="0 0 20 20" style="width: 20px; height: 20px;">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="prestamo-details">
                        <div class="prestamo-title">Renovaciones</div>
                        <div class="prestamo-meta">12 solicitudes pendientes</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de Acción Rápida -->
        <div class="quick-actions">
            <button class="quick-action-btn" title="Nuevo Préstamo" onclick="window.location.href='#'">
                <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
            </button>

            <button class="quick-action-btn secondary" title="Renovar Préstamo" onclick="window.location.href='#'">
                <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                </svg>
            </button>

            <button class="quick-action-btn" title="Generar Reporte" onclick="window.location.href='#'" style="background: linear-gradient(135deg, #17a2b8 0%, #138496 100%); box-shadow: 0 5px 20px rgba(23, 162, 184, 0.4);">
                <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
</div>

<script>
// Agregar funcionalidad de búsqueda
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');
    
    searchBtn.addEventListener('click', function() {
        const searchTerm = searchInput.value.trim();
        if (searchTerm) {
            // Aquí iría la lógica de búsqueda
            console.log('Buscando:', searchTerm);
            // Ejemplo: window.location.href = '/prestamos/buscar?q=' + encodeURIComponent(searchTerm);
        }
    });
    
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchBtn.click();
        }
    });
    
    // Funcionalidad para filtros rápidos
    const filterItems = document.querySelectorAll('.prestamo-item[style*="cursor: pointer"]');
    filterItems.forEach(item => {
        item.addEventListener('click', function() {
            const title = this.querySelector('.prestamo-title').textContent;
            console.log('Filtro seleccionado:', title);
            // Aquí iría la lógica de filtrado
        });
    });
});
</script>
@endsection