@extends('layouts.app')

@section('content')

  <!-- FORMULARIO DE INICIO DE SESION-->
<div class="login-wrapper">
  <div class="login-container">
    <div class="login-image"></div>
    <div class="login-form">
      <h2>Iniciar sesión</h2>

      <form action="" method="POST">
        @csrf

        <div class="form-group">
          <label for="email">Correo electrónico</label>
          <input type="email" id="email" name="email" placeholder="ejemplo@correo.com" required>
        </div>

        <div class="form-group">
          <label for="password">Contraseña</label>
          <div class="password-wrapper">
            <input type="password" id="password" name="password" placeholder="********" required>
              <span class="toggle-password" onclick="togglePassword()">
                <i class="fa-solid fa-eye" id="eye-icon"></i>
              </span>
        </div>
      </div>


        <div class="form-options">
          <label><input type="checkbox" name="remember"> Recuérdame</label>
          <a href="">¿Olvidaste tu contraseña?</a>
        </div>
        <button type="submit" class="login-btn">Iniciar sesión</button>
        <div class="extra-links">
          ¿No tienes una cuenta? <a href="{{ route('user.registerUser') }}">Regístrate</a>
        </div>
        <div class="or-divider">— o iniciar con —</div>

        <button class="google-btn">
          <div class="google-icon-wrapper">
            <img class="google-icon" src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google logo">
      </div>
        <span class="btn-text">Iniciar sesión con Google</span>
      </button>
      </form>
    </div>
  </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

  

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

/* FORMULARIO DE INICIO DE SECCION */
  .login-wrapper {
  display: flex;
  justify-content: center;
  padding-top: 80px;
  padding-bottom: 40px;
}

.login-container {
  display: flex;
  background: #111;
  color: white;
  width: 900px;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
}

.login-image {
  flex: 1;
  background: url('https://res.cloudinary.com/dqubpavb8/image/upload/v1752792133/ChatGPT_Image_17_jul_2025_16_39_12_bmv3aq.png') no-repeat center center;
  background-size: cover;
  transition: transform 0.5s ease;
  will-change: transform;
}

.login-image:hover {
  transform: scale(1.05);
}

.login-form {
  flex: 1;
  padding: 3rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.login-form h2 {
  margin-bottom: 1.5rem;
  font-size: 2rem;
}

.form-group {
  margin-bottom: 1rem;
  position: relative;
}

.form-group label {
  display: block;
  margin-bottom: 0.3rem;
  font-size: 0.9rem;
}

.form-group input {
  width: 100%;
  padding: 0.7rem 1rem;
  padding-right: 2.8rem; /* espacio para el ícono */
  border-radius: 8px;
  border: none;
  background: #dfe7fb;
  color: #000;
  font-size: 1rem;
  height: 45px;
  line-height: 1.5;
}

.password-wrapper {
  position: relative;
  width: 100%;
}

.password-wrapper input {
  width: 100%;
  padding: 0.7rem 1rem;
  padding-right: 3rem; /* espacio para el icono */
  border-radius: 8px;
  border: none;
  background: #dfe7fb;
  color: #000;
  font-size: 1rem;
  height: 45px;
  box-sizing: border-box;
}

.toggle-password {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  color: #555;
  font-size: 1.2rem;
  line-height: 1;
  height: 20px;
  width: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
}



.form-options {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 0.85rem;
  margin: 1rem 0;
}

.login-btn {
  background: linear-gradient(to right, #29ad0cff, #0eaf10ff);
  border: none;
  color: white;
  font-size: 1rem;
  padding: 0.8rem;
  width: 100%;
  border-radius: 8px;
  cursor: pointer;
  margin-top: 1rem;
  transition: 0.3s;
}

.login-btn:hover {
  background: linear-gradient(to right, #29ad0cff, #0eaf10ff);
}

.extra-links {
  margin-top: 1rem;
  text-align: center;
  font-size: 0.9rem;
}

.extra-links a {
  color: #aaa;
  text-decoration: none;
}

.or-divider {
  margin: 1.2rem 0;
  text-align: center;
  color: #888;
  font-size: 0.9rem;
}
.google-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: #ffffff;
  color: #444;
  width: 100%;
  padding: 0.7rem;
  border-radius: 8px;
  border: 1px solid #ddd;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 600;
  font-size: 0.95rem;
  gap: 10px;
}

.google-btn:hover {
  background-color: #f7f7f7;
  transform: scale(1.01);
}

.google-icon-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
}

.google-icon {
  width: 20px;
  height: 20px;
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
    margin: 50px auto;
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

function togglePassword() {
    const passwordInput = document.getElementById("password");
    const icon = document.getElementById("eye-icon");
    const showing = passwordInput.type === "text";

    passwordInput.type = showing ? "password" : "text";
    icon.classList.toggle("fa-eye", showing);
    icon.classList.toggle("fa-eye-slash", !showing);
  }


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
