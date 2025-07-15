@extends('layouts.app')

@section('content')

<!-- SECCIÓN ENCABEZADO -->
<section class="galeria-header">
  <h1>Sección Libros</h1>
  <p>Conoce algunos de los diferentes libros que encontraras en el CUBO.</p>
</section>

<!-- SECCIÓN DE GALERÍA -->
<section class="galeria-grid">
  @foreach ([
    'img/CADS-imgLibro.jpg',
    'img/QDLM-imgLibro.jpg',
    'img/SDAAD-imgLibro.jpg'
  ] as $img)
    <a href="{{ asset($img) }}" data-lightbox="galeria" data-title="Imagen CUBO">
      <img src="{{ asset($img) }}" alt="Imagen de galería CUBO">
    </a>
  @endforeach
</section>

<!-- LIGHTBOX2: CSS y JS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>

<!-- ESTILOS PERSONALIZADOS -->
<style>
  .galeria-header {
    background-color: #2c2c2c;
    color: white;
    text-align: center;
    padding: 80px 20px;
  }

  .galeria-header h1 {
    font-size: 48px;
    color: #a8ff00;
    margin-bottom: 10px;
  }

  .galeria-header p {
    font-size: 18px;
    color: #ccc;
  }

  .galeria-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    padding: 40px 20px;
    max-width: 1200px;
    margin: auto;
  }

  .galeria-grid a {
    display: block;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s, filter 0.3s;
  }

  .galeria-grid img {
    width: 100%;
    height: auto;
    display: block;
  }

  .galeria-grid a:hover {
    transform: scale(1.02);
    filter: brightness(0.85);
  }
</style>

@endsection
