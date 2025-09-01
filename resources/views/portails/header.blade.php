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
  <nav class="navbar @guest navbar-guest @endguest @auth navbar-auth @endauth">
    <ul>
      {{-- Invitados SIEMPRE ven Inicio --}}
      @guest
      <li><a href="{{ route('inicio') }}"></i> Inicio</a></li>
      @endguest
      {{-- Autenticados ven Inicio SOLO si NO están en la ruta 'inicio' --}}
      @auth
      @unless(Route::is('inicio'))
      <li><a href="{{ route('inicio') }}"><i class="fa-solid fa-house"></i> Inicio</a></li>
      @endunless
      @endauth
      @guest
      <li><a href="{{ route('user.loginUser') }}">Iniciar Sesión</a></li>
      <li><a href="{{ route('user.registerUser') }}">Registrarse</a></li>
      <li><a href="{{ route('user.galeria') }}">Galería</a></li>
      <li><a href="{{ route('user.informacion') }}" class="btn1-verde">Más Información</a></li>
      @endguest
      @auth
      <li><a href="{{ route('libros.index') }}"><i class="fas fa-book"></i> Libros</a></li>
      <li><a href="{{ route('solicitarPrestamo') }}"><i class="fa-solid fa-book-open-reader"></i> Solicitar Préstamo</a></li>
      <li><a href="{{ route('user.perfil') }}"><i class="fa-regular fa-face-smile"></i> Perfil</a></li>
      <li><a href="{{ route('user.informacion') }}" class="btn-verde">Más Información</a></li>
      <li>
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
          @csrf
          <button type="submit"><i class="fa-solid fa-arrow-right-from-bracket"></i> Cerrar Sesión</button>
        </form>
      </li>
      @endauth
    </ul>
  </nav>
</header>