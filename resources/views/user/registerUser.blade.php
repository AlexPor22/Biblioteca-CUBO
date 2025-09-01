@extends('layouts.app')

@section('content')

<div class="register-wrapper">
  {{-- Mensajes de validación y éxito --}}
  @if ($errors->any())
    <div class="alert alert-danger" style="margin-bottom:15px">
      <ul style="margin:0;padding-left:20px">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (session('success'))
    <div class="alert alert-success" style="margin-bottom:15px">
      {{ session('success') }}
    </div>
  @endif

  <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="register-container">
      <h2>Crear una cuenta</h2>
      
      <div class="row">
        <!-- Nombre completo -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="nombre">Nombre completo</label>
            <input type="text" id="nombre" name="nombre" placeholder="Ej. Steysi, Javier" value="{{ old('nombre') }}" required>
            @error('nombre') <small style="color:#c00">{{ $message }}</small> @enderror
          </div>
        </div>
        <!-- Edad (opcional) -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="edad">Edad</label>
            <input type="number" id="edad" name="edad" placeholder="Ej. 25" value="{{ old('edad') }}">
            @error('edad') <small style="color:#c00">{{ $message }}</small> @enderror
          </div>
        </div>
      </div>
      
      <div class="row">
        <!-- Sexo (opcional) -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="sexo">Sexo</label>
            <select id="sexo" name="sexo">
              <option value="" {{ old('sexo')==='' ? 'selected' : '' }}>Seleccione</option>
              <option value="masculino" {{ old('sexo')==='masculino' ? 'selected' : '' }}>Masculino</option>
              <option value="femenino"  {{ old('sexo')==='femenino'  ? 'selected' : '' }}>Femenino</option>
              <option value="otro"      {{ old('sexo')==='otro'      ? 'selected' : '' }}>Otro</option>
            </select>
            @error('sexo') <small style="color:#c00">{{ $message }}</small> @enderror
          </div>
        </div>
        <!-- Correo electrónico -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" placeholder="Ej. correo@ejemplo.com" value="{{ old('correo') }}" required>
            @error('correo') <small style="color:#c00">{{ $message }}</small> @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Nombre de usuario -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="username">Nombre de usuario</label>
            <input type="text" id="username" name="username" placeholder="Ej. steysi25" value="{{ old('username') }}" required>
            @error('username') <small style="color:#c00">{{ $message }}</small> @enderror
          </div>
        </div>
        <!-- Teléfono (opcional) -->
        <div class="col-md-6">
          <div class="form-group">
            <label for="telefono">Número de Teléfono</label>
            <input type="tel" id="telefono" name="telefono" placeholder="Ej. 78896656" value="{{ old('telefono') }}">
            @error('telefono') <small style="color:#c00">{{ $message }}</small> @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Dirección (opcional) -->
        <div class="col-md-12">
          <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" id="direccion" name="direccion" placeholder="Ej. San Miguel" value="{{ old('direccion') }}">
            @error('direccion') <small style="color:#c00">{{ $message }}</small> @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Imagen de perfil (opcional) -->
        <div class="col-md-12">
          <div class="form-group">
            <label for="imagen">Imagen de perfil (opcional)</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">
            @error('imagen') <small style="color:#c00">{{ $message }}</small> @enderror
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Contraseña -->
        <div class="col-md-6">
          <div class="form-group position-relative">
            <label for="password">Contraseña</label>
            <div class="input-group">
              <input type="password" id="password" name="password" placeholder="Crea una contraseña segura" required>
              <div class="input-group-append">
                <span class="input-group-text toggle-password" id="togglePassword" style="cursor: pointer;">
                  <i class="fas fa-eye"></i>
                </span>
              </div>
            </div>
            @error('password') <small style="color:#c00">{{ $message }}</small> @enderror
          </div>
        </div>
        <!-- Confirmar contraseña -->
        <div class="col-md-6">
          <div class="form-group position-relative">
            <label for="password_confirmation">Confirmar contraseña</label>
            <div class="input-group">
              <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña" required>
              <div class="input-group-append">
                <span class="input-group-text toggle-password" id="togglePasswordConfirmation" style="cursor: pointer;">
                  <i class="fas fa-eye"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="text-center">
        <button type="submit" class="register-btn">Registrarse</button>
      </div>

      <!-- Botón de registro con Google (placeholder) -->
      <div class="text-center mt-3">
        <p>O regístrate con:</p>
        <a href="{{ route('login.google') }}" class="btn btn-google">
  <i class="fab fa-google"></i>Google
</a>

      </div>
    </div>
  </form>

  <!-- Beneficios -->
  <div class="benefits-section">
    <h3>¿Por qué registrarte en la Biblioteca Virtual del CUBO?</h3>
    <p>Al crear tu cuenta, tendrás acceso exclusivo a:</p>
    <div class="benefits-grid">
      <div class="benefit-card">
        <i class="fas fa-book-open"></i>
        <h4>Acceso a libros digitales</h4>
        <p>Explora cientos de libros en formato PDF o audiolibros desde cualquier dispositivo.</p>
      </div>
      <div class="benefit-card">
        <i class="fas fa-calendar-check"></i>
        <h4>Reservas de libros físicos</h4>
        <p>Solicita libros directamente en el sistema y retíralos en tu CUBO más cercano.</p>
      </div>
      <div class="benefit-card">
        <i class="fas fa-bell"></i>
        <h4>Notificaciones de eventos</h4>
        <p>Recibe alertas sobre eventos culturales, talleres y nuevas publicaciones.</p>
      </div>
    </div>
  </div>
</div>

<!-- Estilos -->
<style>
  .register-wrapper {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 60px 20px;
    max-width: 1200px;
    margin: 0 auto;
  }

  .register-container {
    background: #b4b1b1ff;  /* Fondo gris claro */
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 900px;
    margin-bottom: 60px;
    animation: fadeIn 0.6s ease-out;
  }

  .register-container h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
  }

  .form-group {
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    margin-bottom: 6px;
    color: #555;
    font-weight: 600;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
  }

  .register-btn {
    width: 50%;
    padding: 12px;
    background-color: #28a745;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s;
    margin: 0 auto;
  }

  .register-btn:hover {
    background-color: #218838;
  }

  .benefits-section {
    text-align: center;
    max-width: 1000px;
    padding: 20px;
  }

  .benefits-section h3 {
    font-size: 24px;
    color: #222;
    margin-bottom: 10px;
  }

  .benefits-section p {
    font-size: 16px;
    color: #555;
    margin-bottom: 30px;
  }

  .benefits-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
  }

  .benefit-card {
    background: #fff;
    border-radius: 16px;
    padding: 20px;
    width: 280px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    text-align: center;
    border: 2px solid transparent;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
  }

  .benefit-card:hover {
    border-color: #198754;
    box-shadow: 0 8px 20px rgba(25, 135, 84, 0.25);
  }

  .benefit-card i {
    font-size: 32px;
    color: #28a745;
    margin-bottom: 15px;
  }

  .benefit-card h4 {
    margin-bottom: 10px;
    color: #333;
    font-size: 18px;
  }

  .benefit-card p {
    color: #666;
    font-size: 14px;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Estilo para el botón de Google */
  .btn-google {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    background-color: #db4437;
    color: white;
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 16px;
    width: 200px;  /* Ajuste del tamaño */
    margin-top: 20px;
    text-decoration: none;
    transition: background-color 0.3s;
    margin-left: 10px;
  }

  .btn-google:hover {
    background-color: #c1351d;
  }

  .btn-google i {
    margin-right: 10px;
    font-size: 20px;
  }

  /* Icono de ojo dentro del campo de contraseña */
  .input-group { position: relative; }
  .input-group-append {
    position: absolute; right: 10px; top: 50%;
    transform: translateY(-50%); cursor: pointer;
  }
</style>

<!-- Font Awesome CDN (solo si no lo tienes ya en tu layout) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    document.getElementById('togglePasswordConfirmation').addEventListener('click', function () {
        const passwordField = document.getElementById('password_confirmation');
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });

    
</script>

@endsection
