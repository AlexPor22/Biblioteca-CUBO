@extends('layouts.app')

@section('content')

<div class="galeria-wrapper">

    <!-- VIDEO DE FONDO -->
    <section class="galeria-video">
        <video autoplay muted loop playsinline>
            <source src="https://res.cloudinary.com/dqubpavb8/video/upload/v1752766916/Dise%C3%B1o_sin_t%C3%ADtulo_xauhru.mp4" type="video/mp4">
            Tu navegador no soporta el video.
        </video>
    </section>

</div>



<!-- Galería de imágenes con diferentes tamaños -->
<div class="contenedor-galeria">
    <h2 class="titulo-galeria">Galería CUBO</h2>

    <div class="masonry">
    <div class="masonry-item sm">
        <img src="https://humanidades.com/wp-content/uploads/2018/07/el-principito-e1573523298124.jpg" alt="Actividad A">
    </div>
    <div class="masonry-item md">
        <img src="https://m.media-amazon.com/images/I/91TvVQS7loL._UF1000,1000_QL80_.jpg" alt="Actividad B">
    </div>
    <div class="masonry-item lg">
        <img src="https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/1678144051i/122858226.jpg" alt="Actividad C">
    </div>
    <div class="masonry-item sm">
        <img src="https://arc-anglerfish-arc2-prod-copesa.s3.amazonaws.com/public/RXNXC7MPJ5FOPBH7VLIANYUKZI.jpg" alt="Actividad D">
    </div>
    <div class="masonry-item md">
        <img src="https://images.unsplash.com/photo-1542751110-97427bbecf20" alt="Actividad E">
    </div>
    <div class="masonry-item lg">
        <img src="https://static.cegal.es/imagenes/marcadas/9788417/978841706704.gif" alt="Actividad F">
    </div>
</div>

</div>

<!-- Sección Promocional con fondo que cubre 100% real -->
<div style="margin: 0; padding: 0;">
  <section class="seccion-promocional" style="background-image: url('https://i0.wp.com/alexandrade.net/wp-content/uploads/2022/08/Como-leer-libros-tecnicos-o-academicos-christin-hume-k2Kcwkandwg-unsplash-2.webp?resize=900%2C600&ssl=1');">
    <div class="contenido-promocional">
      <h2>¿Sabías que puedes leer los libros de las imágenes de arriba?</h2>
      <a href="/ruta-a-libros" class="boton-leer">A LEER</a>
    </div>
  </section>
</div>


  
<!-- ESTILOS PERSONALIZADOS -->
<style>
body {
    background-color: #999999ff; /* fondo gris claro */
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    font-family: 'Poppins', sans-serif;
}

/* VIDEO */
.galeria-video {
    width: 100%;
    height: 400px; /* o la altura que desees */
    overflow: hidden;
    background-color: black; /* por si acaso */
}

.galeria-video video {
    width: 100%;
    height: 100%;
    object-fit: fill; /* LLENA TODO sin dejar franjas */
    display: block;
}



h2 {
      text-align: center;
      margin-bottom: 40px;
    }


    .contenedor-galeria {
    padding: 40px 20px;
    max-width: 1400px;
    margin: 0 auto;
}

.titulo-galeria {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 40px;
    font-weight: bold;
    color: #2c3e50;
}
.masonry {
    column-count: 4;
    column-gap: 1rem;
}

.masonry-item {
    break-inside: avoid;
    margin-bottom: 1rem;
    overflow: hidden;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease;
}

.masonry-item:hover {
    transform: scale(1.03);
}

.masonry-item img {
    width: 100%;
    display: block;
    border-radius: 10px;
    height: auto;
}

/* Nuevas clases con alturas más pequeñas */
.masonry-item.sm img {
    height: 200px;
    object-fit: cover;
}

.masonry-item.md img {
    height: 300px;
    object-fit: cover;
}

.masonry-item.lg img {
    height: 400px;
    object-fit: cover;
}

/* Responsive */
@media (max-width: 1200px) {
    .masonry { column-count: 3; }
}
@media (max-width: 768px) {
    .masonry { column-count: 2; }
}
@media (max-width: 480px) {
    .masonry { column-count: 1; }
}


.seccion-promocional {
  position: relative;
  left: 50%;
  transform: translateX(-50%);
  width: 100vw;
  height: 250px;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 60px;
  margin-bottom: 60px;
  overflow: hidden;
}

.seccion-promocional::before {
  content: "";
  position: absolute;
  top: 0; left: 0; right: 0; bottom: 0;
  background-color: rgba(0, 0, 0, 0.5); /* capa oscura */
  z-index: 0;
}

.contenido-promocional {
  position: relative;
  text-align: center;
  color: white;
  z-index: 1;
}

.boton-leer {
  background-color: #2ecc71;
  color: white;
  padding: 12px 30px;
  border-radius: 30px;
  text-decoration: none;
  font-weight: bold;
  transition: all 0.3s ease;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

.boton-leer:hover {
  background-color: #27ae60;
  transform: translateY(-3px);
}
  
</style>

@endsection
