@extends('layouts.admin')

@section('content')
<style>
    .admin-dashboard {
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
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    .welcome-header {
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
    
    .welcome-header::before {
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
    
    .welcome-title {
        font-size: 3rem;
        font-weight: 800;
        margin: 0;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        background: linear-gradient(135deg, #ffffff 0%, #e0e0e0 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .welcome-subtitle {
        font-size: 1.3rem;
        color: #b0b0b0;
        margin-top: 1rem;
        font-weight: 300;
        line-height: 1.6;
    }
    
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .dashboard-card {
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
    
    .dashboard-card:nth-child(1) {
        animation-delay: 0.4s;
    }
    
    .dashboard-card:nth-child(2) {
        animation-delay: 0.6s;
    }
    
    .dashboard-card:nth-child(3) {
        animation-delay: 0.8s;
    }
    
    .dashboard-card:nth-child(4) {
        animation-delay: 1.0s;
    }
    
    .dashboard-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #28a745, #20c997);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .dashboard-card:hover::before {
        transform: scaleX(1);
    }
    
    .dashboard-card:hover {
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
    }
    
    .card-icon.users {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        animation-delay: 0s;
    }
    
    .card-icon.categories {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        animation-delay: 1s;
    }
    
    .card-icon.publish {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        animation-delay: 2s;
    }
    
    .card-icon.loans {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        animation-delay: 3s;
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
        color: white;
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    }
    
    .stats-section {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        opacity: 0;
        animation: fadeInUp 0.8s ease-out 1s forwards;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin-top: 1rem;
    }
    
    .stat-item {
        text-align: center;
        padding: 1.5rem;
        background: linear-gradient(135deg, #F2F2F2 0%, #e9ecef 100%);
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
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
    
    .quick-actions {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        z-index: 1000;
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
    
    @keyframes pulse {
        0%, 100% {
            box-shadow: 0 5px 20px rgba(40, 167, 69, 0.4);
        }
        50% {
            box-shadow: 0 8px 30px rgba(40, 167, 69, 0.6);
        }
    }
    
    @media (max-width: 768px) {
        .welcome-title {
            font-size: 2.5rem;
        }
        
        .dashboard-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .dashboard-card {
            padding: 2rem;
        }
        
        .quick-actions {
            bottom: 1rem;
            right: 1rem;
        }
    }
</style>

<div class="admin-dashboard">
    <div class="container">
        <!-- Header de Bienvenida -->
        <div class="welcome-header">
            <h1 class="welcome-title">Panel de Administración</h1>
            <p class="welcome-subtitle">Gestiona todas las secciones del sistema de forma fácil y rápida. Controla usuarios, categorías, préstamos y contenido desde un solo lugar.</p>
        </div>

        <!-- Sección de Estadísticas -->
        <div class="stats-section">
            <h3 style="color: #0D0D0D; font-weight: 700; margin-bottom: 1rem;">Estadísticas del Sistema</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">3</div>
                    <div class="stat-label">Usuarios Activos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">5</div>
                    <div class="stat-label">Categorías</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Libros Publicados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Audiolibros</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">6</div>
                    <div class="stat-label">Préstamos Activos</div>
                </div>
            </div>
        </div>

        <!-- Cards de Gestión -->
        <div class="dashboard-grid">
            <!-- Gestión de Usuarios -->
            <div class="dashboard-card">
                <div class="card-icon users">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                </div>
                <h5 class="card-title">Gestionar Usuarios</h5>
                <p class="card-description">Administra los usuarios del sistema. Controla permisos, roles y accesos de administradores, empleados y clientes.</p>
                <a href="{{ route('admin.usuarios') }}" class="card-button">
                    <span>Gestionar Usuarios</span>
                </a>
            </div>

            <!-- Gestión de Categorías -->
            <div class="dashboard-card">
                <div class="card-icon categories">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                    </svg>
                </div>
                <h5 class="card-title">Gestionar Categorías</h5>
                <p class="card-description">Organiza y administra las categorías de libros. Crea, edita y elimina categorías para mantener el contenido ordenado.</p>
                <a href="{{ route('admin.categoriasLibros') }}" class="card-button">
                    <span>Gestionar Categorías</span>
                </a>
            </div>

            <!-- Publicar Contenido -->
            <div class="dashboard-card">
                <div class="card-icon publish">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h5 class="card-title">Publicar Contenido</h5>
                <p class="card-description">Publica nuevos libros y audiolibros en el sistema. Sube contenido, configura metadatos y gestiona la biblioteca digital.</p>
                <a href="{{ route('admin.publicar') }}" class="card-button">
                    <span>Publicar Contenido</span>
                </a>
            </div>

            <!-- Gestión de Préstamos -->
            <div class="dashboard-card">
                <div class="card-icon loans">
                    <svg fill="currentColor" viewBox="0 0 20 20" style="width: 40px; height: 40px;">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h5 class="card-title">Gestión de Préstamos</h5>
                <p class="card-description">Administra préstamos de libros. Controla fechas de vencimiento, devoluciones y genera reportes de actividad.</p>
                <a href="{{ route('admin.prestamos') }}" class="card-button">
                    <span>Gestionar Préstamos</span>
                </a>
            </div>

            <div class="dashboard-card">
                <div class="card-icon books" style="color: #333;">
                    <svg fill="currentColor" viewBox="0 0 24 24" style="width: 40px; height: 40px;">
                        <path d="M21 5c-1.11-.35-2.33-.5-3.5-.5-1.95 0-4.05.4-5.5 1.5-1.45-1.1-3.55-1.5-5.5-1.5S2.45 4.9 1 6v14.65c0 .25.25.5.5.5.1 0 .15-.05.25-.05C3.1 20.45 5.05 20 6.5 20c1.95 0 4.05.4 5.5 1.5 1.35-.85 3.8-1.5 5.5-1.5 1.65 0 3.35.3 4.75 1.05.1.05.15.05.25.05.25 0 .5-.25.5-.5V6c-.6-.45-1.25-.75-2-1zm0 13.5c-1.1-.35-2.3-.5-3.5-.5-1.7 0-4.15.65-5.5 1.5V8c1.35-.85 3.8-1.5 5.5-1.5 1.2 0 2.4.15 3.5.5v11.5z"/>
                    </svg>
                </div>
                <h5 class="card-title">Gestión de Libros</h5>
                <p class="card-description">Consulta y administra todos los libros disponibles en el sistema. Revisa detalles, clasificaciones y accede a las opciones de visualización.</p>
                <a href="{{ route('admin.verlibros') }}" class="card-button">
                    <span>Ver Libros</span>
                </a>
            </div>
        </div>

        <!-- Botón de Acción Rápida -->
        <div class="quick-actions">
            <button class="quick-action-btn" title="Acciones Rápidas">
                <svg fill="currentColor" viewBox="0 0 20 20" style="width: 24px; height: 24px;">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>
</div>
@endsection