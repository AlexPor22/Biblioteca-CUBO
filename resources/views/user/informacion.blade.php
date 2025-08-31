@extends('layouts.app')

@section('content')



<!-- Sección informativa con efecto animado -->
<div class="card-info">
  <h2>¿Qué es la Biblioteca Virtual?</h2>
  <p>
    La Biblioteca Virtual del CUBO es una plataforma digital que permite a los usuarios acceder a libros físicos, digitales y audiolibros desde cualquier dispositivo. Aquí fomentamos la lectura, el aprendizaje autónomo y la innovación educativa.
  </p>
</div>

<!-- Sección Información de contacto -->
<section class="seccion-contacto">
  <h2>Información de contacto</h2>
  <p class="subtitulo-contacto">Puedes llamarnos, escribirnos directamente o visitarnos.</p>

  <div class="contenedor-cajas-contacto">
    <!-- Teléfono -->
    <div class="caja-contacto">
      <div class="icono-circulo">
        <!-- Teléfono SVG colorido -->
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
          <path fill="#007BFF" d="M6.6,10.79A15.05,15.05,0,0,0,13.21,17.4l1.89-1.89a1,1,0,0,1,1-.26,11.72,11.72,0,0,0,3.68.59,1,1,0,0,1,1,1V20a1,1,0,0,1-1,1A16,16,0,0,1,3,5a1,1,0,0,1,1-1H6.21a1,1,0,0,1,1,1,11.72,11.72,0,0,0,.59,3.68,1,1,0,0,1-.26,1Z"/>
        </svg>
      </div>
      <div>
        <strong>Llámanos</strong><br>
        <span class="dato">2248 9150</span>
      </div>
    </div>

    <!-- Correo -->
    <div class="caja-contacto">
      <div class="icono-circulo">
        <!-- Correo SVG colorido -->
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
          <path fill="#DC3545" d="M4,4H20a2,2,0,0,1,2,2V6.5L12,13,2,6.5V6A2,2,0,0,1,4,4ZM2,8.26V18a2,2,0,0,0,2,2H20a2,2,0,0,0,2-2V8.26L12,15Z"/>
        </svg>
      </div>
      <div>
        <strong>Escríbenos</strong><br>
        <span class="dato">tejidosocialsv@gmail.com</span>
      </div>
    </div>

    <!-- Dirección -->
    <div class="caja-contacto">
      <div class="icono-circulo">
        <!-- Ubicación SVG colorido -->
        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24">
          <path fill="#28A745" d="M12,2A7,7,0,0,0,5,9c0,5.25,7,13,7,13s7-7.75,7-13A7,7,0,0,0,12,2Zm0,9.5A2.5,2.5,0,1,1,14.5,9,2.5,2.5,0,0,1,12,11.5Z"/>
        </svg>
      </div>
      <div>
        <strong>Visítanos</strong><br>
        <span class="dato">Pasaje Aparico, San Miguel</span>
      </div>
    </div>
  </div>
</section>

<!-- Sección Preguntas Frecuentes -->
<section class="seccion-contacto">
  <h2>Preguntas Frecuentes</h2>
  <p class="subtitulo-contacto">Haz clic en una pregunta para ver la respuesta.</p>

  <div class="faq-contenedor">
    <!-- Pregunta 1 -->
    <div class="faq-item">
      <button class="faq-pregunta">¿Cómo puedo registrarme en la Biblioteca Virtual?</button>
      <div class="faq-respuesta">
        <p>Puedes registrarte creando una cuenta en la sección de registro, donde deberás ingresar tus datos. Una vez registrado, podrás acceder a todos los recursos disponibles.</p>
      </div>
    </div>

    <!-- Pregunta 2 -->
    <div class="faq-item">
      <button class="faq-pregunta">¿Puedo acceder desde cualquier dispositivo?</button>
      <div class="faq-respuesta">
        <p>Sí,  Puedes ingresar desde computadoras, tablets o teléfonos móviles.</p>
      </div>
    </div>

    <!-- Pregunta 3 -->
    <div class="faq-item">
      <button class="faq-pregunta">Puedo solicitar un libro fisico</button>
      <div class="faq-respuesta">
        <p>Si, puedes solictar el libro que te llamo la atencion, y ir a las instlaciones a traer tu libro</p>
      </div>
    </div>
  </div>
</section>

<style>
  /* Sección de bienvenida */



  /* Card informativa con efecto borde y hover */
  .card-info {
    width: 100%;
  max-width: 100%;
    margin: 0 auto;
    padding: 30px;
    background-color: #2c2c2c;
    color: #fff;
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    font-size: 1.1rem;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
  }

  .card-info h2 {
    font-size: 2rem;
    margin-bottom: 20px;
  }

  .card-info:hover {
    transform: translateY(-8px) scale(1.01);
    box-shadow: 0 12px 25px rgba(0, 255, 204, 0.3);
  }

  /* Bordes animados */
  .card-info::before,
  .card-info::after {
    content: "";
    position: absolute;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, #26e005ff, #59ff00ff);
    top: 0;
    left: 0;
    animation: moveLine 3s linear infinite;
  }

  .card-info::after {
    top: auto;
    bottom: 0;
    animation-direction: reverse;
  }

  @keyframes moveLine {
    0% {
      transform: translateX(-100%);
    }
    100% {
      transform: translateX(100%);
    }
  }

 .seccion-contacto {
    max-width: 1100px;
    margin: 60px auto;
    text-align: center;
    padding: 0 15px;
  }

  .seccion-contacto h2 {
    font-size: 2rem;
    font-weight: bold;
    color: #111;
    margin-bottom: 10px;
  }

  .subtitulo-contacto {
    color: #6c757d;
    margin-bottom: 40px;
  }

  .contenedor-cajas-contacto {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
  }

  .caja-contacto {
    background: #fff;
    border-radius: 16px;
    padding: 25px 30px;
    display: flex;
    align-items: center;
    gap: 18px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    min-width: 280px;
    max-width: 330px;
  }

  .caja-contacto:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
  }

  .icono-circulo {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: #2e2e2e;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .dato {
    color: #6c757d;
    font-size: 0.95rem;
  }

  @media (max-width: 768px) {
    .contenedor-cajas-contacto {
      flex-direction: column;
      align-items: center;
    }
  }

   .faq-contenedor {
    max-width: 800px;
    margin: 0 auto;
    text-align: left;
  }

  .faq-item {
    border-bottom: 1px solid #ddd;
    margin-bottom: 15px;
  }

  .faq-pregunta {
    width: 100%;
    background: none;
    border: none;
    text-align: left;
    font-size: 1.1rem;
    font-weight: bold;
    padding: 12px;
    cursor: pointer;
    position: relative;
    transition: color 0.3s ease;
  }

  .faq-pregunta::after {
    content: '+';
    position: absolute;
    right: 20px;
    font-size: 1.3rem;
    transition: transform 0.3s ease;
  }

  .faq-pregunta.activa {
    color: #28a745;
  }

  .faq-pregunta.activa::after {
    content: '−';
    transform: rotate(180deg);
  }

  .faq-respuesta {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease, padding 0.3s ease;
    padding: 0 12px;
    color: #6c757d;
  }

  .faq-respuesta.activa {
    max-height: 200px; /* Ajusta según lo largo de la respuesta */
    padding: 12px;
  }
  
</style>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const preguntas = document.querySelectorAll(".faq-pregunta");

    preguntas.forEach(pregunta => {
      pregunta.addEventListener("click", () => {
        const respuesta = pregunta.nextElementSibling;
        pregunta.classList.toggle("activa");
        respuesta.classList.toggle("activa");
      });
    });
  });
</script>
@endsection

