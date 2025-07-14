@extends('layouts.app')

@section('content')

<div class="register-wrapper">
  <div class="register-container">
    <h2>Crear una cuenta</h2>
    <form>
      <div class="form-group">
        <label for="nombre">Nombre completo</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ej. Juan Pérez">
      </div>
      <div class="form-group">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" placeholder="Ej. correo@ejemplo.com">
      </div>
      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" placeholder="Crea una contraseña segura">
      </div>
      <div class="form-group">
        <label for="password_confirmation">Confirmar contraseña</label>
        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite la contraseña">
      </div>
      <button type="submit" class="register-btn">Registrarse</button>
    </form>
  </div>

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
    background: white;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 500px;
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

  .form-group input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
  }

  .register-btn {
    width: 100%;
    padding: 12px;
    background-color: #28a745;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s;
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
  border-color: #198754; /* verde tipo Bootstrap */
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
</style>

<!-- Font Awesome CDN (solo si no lo tienes ya en tu layout) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection
