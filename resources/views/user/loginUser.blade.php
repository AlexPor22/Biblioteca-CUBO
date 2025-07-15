@extends('layouts.app')

@section('content')

<div class="login-wrapper">
  <div class="login-container" id="login-form">
    <h2>Iniciar Sesión</h2>
    <form>
      <div class="form-group">
        <label for="usuario">Usuario</label>
        <input type="text" id="usuario" name="usuario" placeholder="Escribe tu usuario">
      </div>
      <div class="form-group">
        <label for="clave">Contraseña</label>
        <input type="password" id="clave" name="clave" placeholder="Escribe tu contraseña">
      </div>

      <div class="form-links">
        <p>¿No tienes una cuenta? <a href="{{ route('user.registerUser') }}">Regístrate</a></p>
        <p><a href="#">¿Olvidaste tu contraseña?</a></p>
      </div>

      <button type="submit" class="login-btn">Entrar</button>
    </form>
  </div>

  <!-- Tarjeta tipo CUBO -->
  <div class="cubo-card">
    <div class="cubo-image-container">
      <div class="cubo-image" id="animatedImage"></div>
    </div>
    <div class="cubo-content">
      <h3>Sumérgete en la experiencia de la Biblioteca Virtual CUBO</h3>
      <p>Explora libros, audiolibros, eventos culturales y todo un mundo de aprendizaje desde un solo lugar. Esta plataforma está diseñada para inspirarte, informarte y acompañarte en cada paso de tu formación.</p>
      <div class="card-actions">
        <button class="scroll-login-btn">Login</button>
        <a href="{{ route('user.registerUser') }}" class="register-btn">Registrarse</a>
      </div>
    </div>
  </div>
</div>

<!-- ESTILOS -->
<style>
  .login-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 60px 20px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .login-container {
    background-color: #ffffff;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    margin-bottom: 50px;
  }

  .login-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    margin-bottom: 8px;
    color: #555;
    font-weight: bold;
  }

  .form-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    transition: border-color 0.3s;
  }

  .form-group input:focus {
    border-color: #28a745;
    outline: none;
  }

  .form-links {
    text-align: center;
    margin-bottom: 20px;
    font-size: 14px;
    color: #666;
  }

  .form-links a {
    color: #28a745;
    font-weight: 500;
    text-decoration: none;
  }

  .form-links a:hover {
    text-decoration: underline;
  }

  .login-btn {
    width: 100%;
    padding: 12px;
    background-color: #28a745;
    border: none;
    color: white;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s ease;
  }

  .login-btn:hover {
    background-color: #218838;
  }

  /* Tarjeta tipo CUBO */
  .cubo-card {
    display: flex;
    flex-wrap: wrap;
    margin-top: 50px;
    background-color: #f5f5f5;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    width: 100%;
    max-width: 1000px;
  }

  .cubo-image-container {
    flex: 1 1 50%;
    perspective: 1000px;
    min-height: 300px;
  }

  .cubo-image {
    width: 100%;
    height: 100%;
    background-image: url('{{asset("img/CADS-imgLibro.jpg") }}');
    background-size: cover;
    background-position: center;
    transition: transform 1s, background-image 1s ease-in-out;
    transform-origin: left center;
    border-right: 3px solid #ccc;
  }

  .cubo-image-container:hover .cubo-image {
    transform: rotateY(-20deg);
  }

  .cubo-content {
    flex: 1 1 50%;
    padding: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .cubo-content h3 {
    font-size: 24px;
    margin-bottom: 15px;
    color: #222;
  }

  .cubo-content p {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
  }

  .card-actions {
    margin-top: 20px;
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
  }

  .scroll-login-btn,
  .register-btn {
    padding: 10px 20px;
    border-radius: 30px;
    font-weight: bold;
    border: none;
    cursor: pointer;
    transition: background 0.3s ease;
    text-decoration: none;
    display: inline-block;
  }

  .scroll-login-btn {
    background-color: rgb(59, 59, 59);
    color: white;
  }

  .scroll-login-btn:hover {
    background-color: rgb(42, 43, 42);
  }

  .register-btn {
    background-color: rgb(59, 59, 59);
    color: white;
  }

  .register-btn:hover {
    background-color: rgb(42, 43, 42);
  }

  @media screen and (max-width: 768px) {
    .cubo-card {
      flex-direction: column;
    }

    .cubo-content {
      padding: 20px;
    }

    .cubo-image-container {
      min-height: 200px;
    }
  }
</style>

<!-- SCRIPT para scroll y cambio de imagen -->
<script>
  // Scroll con desplazamiento personalizado
  document.querySelector('.scroll-login-btn').addEventListener('click', function () {
    const loginForm = document.getElementById('login-form');
    const yOffset = -175;
    const y = loginForm.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: 'smooth' });
  });

  // Rotación automática de imágenes cada 5 segundos
  const imageElement = document.getElementById('animatedImage');
  const images = [
    '{{ asset("img/CADS-imgLibro.jpg") }}',
    '{{ asset("img/QDLM-imgLibro.jpg") }}',
    '{{ asset("img/SDAAD-imgLibro.jpg") }}'
  ];

  let currentIndex = 0;
  setInterval(() => {
    currentIndex = (currentIndex + 1) % images.length;
    imageElement.style.backgroundImage = `url('${images[currentIndex]}')`;
  }, 5000);
</script>

@endsection
