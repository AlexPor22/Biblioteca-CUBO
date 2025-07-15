<header class="header">
    <div class="logo">
        <a href="{{ route('inicio') }}">
            <img src="{{ asset('img/CUBOLogoColor.png') }}" alt="Biblioteca Virtual CUBO" class="logo-img">
        </a>
    </div>

    <!-- Botón hamburguesa y checkbox -->
    <input type="checkbox" id="menu-toggle" class="menu-toggle">
    <label for="menu-toggle" class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </label>

    <!-- Menú debe estar al mismo nivel del checkbox -->
    <nav class="navbar">
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Iniciar Sesión</a></li>
            <li><a href="#">Registrarse</a></li>
            <li><a href="#">Galería</a></li>
            <li><a href="#" class="btn-verde">Más Información</a></li>
        </ul>
    </nav>
</header>
