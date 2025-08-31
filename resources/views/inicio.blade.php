@extends('layouts.app')

@section('content')

<div class="hero-section">
    <div class="hero-content">
        
        <!-- TEXTO CON BOTÓN -->
        <div class="hero-text animar-entrada">
            <h1 class="titulo">Biblioteca Virtual CUBO</h1>
            <p class="descripcion">
                Bienvenidos a la Biblioteca Virtual CUBO. Aquí podrás encontrar una gran variedad de libros y recursos digitales para tu aprendizaje. ¡Explora y disfruta de nuestro catálogo!
            </p>
            <a href="#registro" class="btn-iniciar">INICIAR GRATIS</a>
        </div>

        <!-- IMAGEN -->
        <div class="hero-image-wrapper animar-entrada">
            <img src="{{ asset('img/PORTADA1.png') }}" alt="Imagen Biblioteca" class="hero-image">
        </div>

    </div>
</div>

<!-- Sección de Nuestros Servicios -->
<div class="services-section">
    <div class="services-container">
        <h2 class="services-title">Nuestros Servicios</h2>
        <div class="cards-container">

            <div class="card">
                <div class="card-icon bg-verde">
                    <svg viewBox="0 0 24 24" width="28" height="28" fill="white">
                        <path d="M21 4a1 1 0 00-1-1h-6.5a2.5 2.5 0 00-2.5 2.5V18a.5.5 0 00.832.374L13 17.118l1.168 1.256A.5.5 0 0015 18V5.5A.5.5 0 0115.5 5H20v13h-4.5a.5.5 0 01-.5-.5V16a1 1 0 00-2 0v1.5A2.5 2.5 0 0015.5 20H21a1 1 0 001-1V4zM10 5.5a.5.5 0 00-.5-.5H4v13h4.5a.5.5 0 00.5-.5V16a1 1 0 012 0v1.5A2.5 2.5 0 018.5 20H3a1 1 0 01-1-1V4a1 1 0 011-1h6.5A.5.5 0 0110 4.5V5.5z" />
                    </svg>
                </div>
                <h3 class="card-title">Lectura</h3>
                <p class="card-description">
                    Accede a una amplia variedad de libros en formato digital para tu lectura y aprendizaje.
                </p>
            </div>

            <div class="card">
                <div class="card-icon bg-azul">
                    <svg fill="white" viewBox="0 0 24 24" width="28" height="28">
                        <path d="M12 3a9 9 0 00-9 9v6a3 3 0 003 3h1v-8H6a6 6 0 1112 0h-1v8h1a3 3 0 003-3v-6a9 9 0 00-9-9z" />
                    </svg>
                </div>
                <h3 class="card-title">Audiolibros</h3>
                <p class="card-description">
                    Disfruta de tus libros favoritos en formato de audiolibro, perfecto para escuchar en cualquier momento.
                </p>
            </div>

            <div class="card">
                <div class="card-icon bg-naranja">
                    <svg fill="white" viewBox="0 0 24 24" width="28" height="28">
                        <path d="M17 3h-2.18A3 3 0 0012 1a3 3 0 00-2.82 2H7a2 2 0 00-2 2v16a2 2 0 002 2h10a2 2 0 002-2V5a2 2 0 00-2-2zM12 3a1 1 0 11-1 1 1 1 0 011-1zm1 14H8v-2h5zm3-4H8v-2h8z" />
                    </svg>
                </div>
                <h3 class="card-title">Préstamos</h3>
                <p class="card-description">
                    Realiza préstamos de libros físicos para leerlos en casa, de manera cómoda y sencilla.
                </p>
            </div>
        </div>
        <div class="button-container">
            <a href="#c" class="btn-descubre">Descúbrelo ahora</a>
        </div>

    </div>
</div>


<!-- Sección de LINEA DECORATIVA DE CATALAGO -->
<div class="linea-decorativa-css">
<span class="icono-central">&#x269C;</span>
</div>
<!-- Título antes de las categorías -->
<h2 class="text-center my-4 titulo-catalogo">Explora Nuestro Amplio Catálogo</h2>

<!-- Sección de Categorías -->
<div class="swiper-container categorias-swiper carrusel-espaciado">
<div class="swiper-wrapper">
    @php
    $categorias = [
        ['titulo' => 'Novelas', 'descripcion' => 'Sumérgete en historias emocionantes y mundos ficticios.', 'imagen' => 'https://www.elindependiente.com/wp-content/uploads/2023/07/libros-2023-lunes10j.jpg'],
        ['titulo' => 'Ciencia', 'descripcion' => 'Explora el mundo de la ciencia en cada página.', 'imagen' => 'https://www.muyinteresante.com/wp-content/uploads/sites/5/2024/06/23/6677ce2d06420.jpeg'],
        ['titulo' => 'Historia', 'descripcion' => 'Conoce el pasado a través de grandes obras.', 'imagen' => 'https://s1.elespanol.com/2021/04/22/cultura/historia/575704626_178952264_1706x960.jpg'],
        ['titulo' => 'Infantil', 'descripcion' => 'Libros divertidos para los más pequeños.', 'imagen' => 'https://www.elindependiente.com/wp-content/uploads/2023/07/libros-infantiles.jpg'],
        ['titulo' => 'Autoayuda', 'descripcion' => 'Desarrollo personal y bienestar emocional.', 'imagen' => 'https://universoabierto.org/wp-content/uploads/2020/01/padre-rico-padre-pobre-400-libros-de-finanzas-y-autoayuda-d_nq_np_764254-mla29429659184_022019-f.jpg'],
        ['titulo' => 'Educativo', 'descripcion' => 'Refuerza tu conocimiento con estos libros.', 'imagen' => 'https://www.educaciontrespuntocero.com/wp-content/uploads/2023/12/libros-educativos-favoritos-del-2023.png'],
    ];
      $duplicado = array_merge($categorias, $categorias); // duplicamos para que el loop funcione
    @endphp

    @foreach($duplicado as $categoria)
    <div class="swiper-slide fade-right">
    <div class="card-3d small-card" data-image="{{ $categoria['imagen'] }}">
        <div class="card-inner">
            <div class="card-bg"></div>
            <div class="card-info">
                <h3>{{ $categoria['titulo'] }}</h3>
                <p>{{ $categoria['descripcion'] }}</p>
            </div>
        </div>
    </div>
</div>
    @endforeach
</div>
</div>

<!-- Sección de LINEA DECORATIVA DE AUTORES -->
<div class="linea2-decorativa-css">
<span class="icono2-central">&#x269C;</span>
</div>
<!-- Título antes de las categorías -->
<h2 class="text-center my-4 titulo-catalogo">LEE A TUS AUTORES FAVORITOS Y CONOCE A MUCHOS MAS</h2>

<!-- IMAGNES AUTOR -->
<article class="gallery">
        <img src="https://literatinn.com/wp-content/uploads/2024/03/Pablo-Neruda.jpg" alt="deadpool & marvel">
        <img src="https://i.pinimg.com/originals/41/3f/df/413fdf31d484da7d3933eb6ca655176a.jpg " alt="deadpool & marvel">
        <img src="https://m.media-amazon.com/images/I/71H76HAPA4L._UF1000,1000_QL80_.jpg" alt="deadpool & marvel">
        <img src="https://www.shutterstock.com/image-vector/moscow-russia-september-26-2018-600nw-1206900742.jpg" alt="deadpool & marvel">
        <img src="https://www.pixelstalk.net/wp-content/uploads/images6/Cool-Deadpool-Wallpaper.jpg" alt="deadpool & marvel">
        <img src="https://m.media-amazon.com/images/I/71mpuJpqY-L._UF1000,1000_QL80_.jpg "alt="deadpool & marvel">
        <img src="https://librografias.com/img/biografias/gabriel-garcia-marquez.jpg" alt="deadpool & marvel">
        <img src="https://pixelescuscatlecos.com/wp-content/uploads/2024/06/alfredo-espino.jpg" alt="deadpool & marvel">
    </article>



<!-- Sección COLECCION NACIONAL -->  
<div class="container py-5">
    <h2 class="text-center mb-4 display-5 fw-bold">Disfruta de nuestra coleccion Nacional</h2>

    <div class="row justify-content-center">
        @foreach ([
            ['titulo' => 'Coleccion Nacional', 'subtitulo' => 'Autores Salvadoreños', 'img' => 'https://i.pinimg.com/736x/29/f1/0d/29f10db6ac5c9e08930e1dc457994c8c.jpg'],
            ['titulo' => 'Coleccion General', 'subtitulo' => 'Recursos biblograficos de todas las areas', 'img' => 'https://i.pinimg.com/originals/42/56/34/4256345c02a2df67924e0d05ed392533.jpg'],
            ['titulo' => 'Coleccion Historica y Arquelogica', 'subtitulo' => 'Recuros de nuestra historia y su arqueologia', 'img' => 'https://rutasturisticases901701391.wordpress.com/wp-content/uploads/2017/11/ruta-arqueologica-e1511240327611.jpg?w=886&h=328&crop=1']
        ] as $card)
            <div class="col-md-4 mb-4 d-flex justify-content-center">
                <div class="custom-card">
                    <img src="{{ $card['img'] }}" alt="Imagen" class="card-img">
                    <div class="card-overlay">
                        <h4>{{ $card['titulo'] }}</h4>
                        <p>{{ $card['subtitulo'] }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>



<!-- Sección de COMUNIDAD -->
<section class="comunidad-section text-white">
<div class="container-comunidad">
    <h2 class="comunidad-title">Conectando a la Comunidad con el Conocimiento</h2>
    <div class="comunidad-cards">
    <div class="comunidad-card">
        <div class="comunidad-icon"><i class="fas fa-check-circle"></i></div>
        <h4>Acceso Gratuito</h4>
    </div>
    <div class="comunidad-card">
        <div class="comunidad-icon"><i class="fas fa-check-circle"></i></div>
        <h4>Variedad de Recursos</h4>
    </div>
    <div class="comunidad-card">
        <div class="comunidad-icon"><i class="fas fa-check-circle"></i></div>
        <h4>Seguridad y Privacidad</h4>
    </div>
    </div>
    <p class="comunidad-final">
    Te invitamos a explorar la <strong>Biblioteca Virtual CUBO San Miguel</strong> y a descubrir todo lo que tenemos para ofrecerte.<br />
    <em>¡Sumérgete en un mundo de conocimiento y aventura!</em>
    </p>
    
</div>
</section>


<!-- Sección de VISITANOS -->
<section style="background-color:rgba(163, 163, 163, 1); padding: 50px 20px;">
<div class="container">
    <h2 class="text-center mb-5" style="font-weight: bold; font-family: 'Poppins', sans-serif;">Visítanos en nuestras instalaciones</h2>
    <div class="row justify-content-center align-items-center">
    <!-- Imagen grande -->
    <div class="col-lg-6 col-md-12 mb-4 mb-lg-0 text-center">
        <img src="https://cubo.gob.sv/wp-content/uploads/2023/01/CUBO-Milagro03.jpg" alt="Imagen grande" class="img-fluid imagen-efecto img-grande">
        </a>
    </div>
    <!-- Dos imágenes verticales pequeñas -->
    <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-between gap-4">
        <img src="https://cubo.gob.sv/wp-content/uploads/2022/12/Zacamil.jpg" alt="Imagen 1" class="img-fluid imagen-efecto img-pequena">
        </a>
        <img src="https://cubo.gob.sv/wp-content/uploads/2022/12/CUBO-Image01-999x1024.jpg" alt="Imagen 2" class="img-fluid imagen-efecto img-pequena">
        </a>
    </div>
    </div>

    <!-- Ubicación -->
    <div class="text-center mt-5">
    <h3 style="font-weight: bold; font-family: 'Poppins', sans-serif;">Nuestra Ubicación</h3>
    <div class="mt-3" style="width: 100%; max-width: 800px; margin: 0 auto;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3814.4607890159455!2d-88.19408550000001!3d13.4654441!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f7b2bb7208b5bd5%3A0xd3e595f11181c3bd!2sCentro%20Urbano%20de%20Bienestar%20y%20Oportunidades%20(CUBO)%20Milagro%20de%20La%20Paz!5e1!3m2!1ses-419!2ssv!4v1752523028409!5m2!1ses-419!2ssv" 
        width="100%" height="350" style="border:0; border-radius: 12px;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>
    </div>
</div>
</section>

<!-- Botón para volver arriba -->
<a href="#" class="btn-ir-arriba" title="Volver arriba">
    <i class="fas fa-chevron-up"></i>
</a>

<style>

body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    overflow-x: hidden;
    background-color: rgba(163, 163, 163, 1);
    
}

/* DESCRIPCION DE LA WEB Y ANIMACION DE IMAGEN FLOTANTE */
/* Contenido debajo del header */
.hero-section {
    position: relative;
    background-color: rgb(72, 72, 72);
    padding-top: 170px;
    padding-bottom: 0;
    overflow: visible;
    
}

.hero-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100vw;
    margin: 0;
    padding: 0;
}

.hero-text {
    width: 55%;
    padding-left: 5%;  /* espacio entre borde izquierdo y texto */
    color: #fff;
    z-index: 2;
    margin-top: -300px;
}

.hero-image-wrapper {
    width: 45%;
    margin-top: -80px;      /* hace que sobresalga arriba */
   
    margin-left: -90px
    margin-bottom: -1px;    /* quita el espacio blanco de abajo */
    position: relative;
    z-index: 5;
}

.hero-image {
    width: 100%;
    height: auto;
    display: block;
    position: relative;
    z-index: 1000; /* MÁS ALTO que el header */
    margin-top: -60px; /* o el valor que necesites para que sobresalga */
    
}

.btn-iniciar {
    display: inline-block;
    margin-top: 20px;
    background-color:rgb(82, 167, 40);
    color: white;
    padding: 12px 25px;
    font-size: 16px;
    font-weight: 600;
    border-radius: 30px;
    text-decoration: none;
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(42, 201, 6, 0.4);
}

.btn-iniciar:hover {
    background-color: #218838;
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(40, 167, 69, 0.5);
}

.titulo {
    font-size: 36px;
    color: #ffffff;
    text-align: left;
    margin: 0;
}

.descripcion {
    font-size: 18px;
    color: #dddddd;
    margin-top: 20px;
}

.image-container {
    position: relative;
    width: 35%;
}

.animar-entrada {
    opacity: 0;
    transform: translateX(-50px);
    animation: entrada-suave 1s ease-out forwards;
}

.hero-image-wrapper.animar-entrada {
    animation-delay: 0.3s; /* La imagen entra después del texto */
}

@keyframes entrada-suave {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@media (max-width: 768px) {
    .hero-content {
        flex-direction: column;
        align-items: center;
        padding: 20px;
    }

    .hero-text {
        width: 100%;
        padding-left: 0;
        margin-top: 0;
        text-align: center;
    }

    .titulo {
        font-size: 28px;
        text-align: center;
    }

    .descripcion {
        font-size: 16px;
        margin-top: 10px;
    }

    .btn-iniciar {
        margin-top: 20px;
        font-size: 14px;
        padding: 10px 20px;
    }

    .hero-image-wrapper {
        width: 100%;
        margin-top: 90px;
        margin-right: 0;
        margin-bottom: 0;
        display: flex;
        justify-content: center;
    }

    .hero-image {
        width: 90%;
        max-width: 400px;
        height: auto;
    }
}


/* SECCION DE SERVICIOS QUE SE OFRECEN DONDE ESTAN LAS 3 CARSD */

.services-section {
    padding: 80px;
    
}
.services-container {
    background-color:rgb(203, 203, 203); /* Fondo gris */
    max-width: 1000px; /* Ajusta el ancho para que no cubra todo el espacio */
    margin: 0 auto;
    padding: 40px;
    border-radius: 20px; /* Bordes redondeados */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.services-title {
    font-size: 32px;
    color: rgb(64, 64, 64);
    margin-bottom: 30px;
}

.cards-container {
    display: flex;
    justify-content: space-around;
    gap: 20px;
    flex-wrap: wrap;
    
}

.card {
    background-color:rgb(66, 66, 66); /* Fondo gris */
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(52, 238, 0, 0.72);
    width: 250px;
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
    transform: translateY(-10px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.card-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 0 auto 15px auto;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
}

.bg-verde {
    background-color: #28a745;
}

.bg-azul {
    background-color: #007bff;
}

.bg-naranja {
    background-color: #fd7e14;
}


.card-title {
    font-size: 24px;
    color:rgb(83, 198, 11);
    margin-bottom: 10px;
}

.card-description {
    font-size: 16px;
    color:rgb(255, 255, 255); 
}

.services-section {
    font-family: 'Bebas Neue', sans-serif;
    letter-spacing: 1px;
}

@media (max-width: 768px) {
    .cards-container {
        flex-direction: column;
        align-items: center; /* Centra las tarjetas */
    }

    .card {
        width: 100%;
        max-width: 320px; /* Limita el ancho máximo */
        margin-bottom: 20px;
    }

    .services-title {
        font-size: 24px;
        text-align: center;
    }

    .btn-descubre {
        width: auto;
        font-size: 16px;
        padding: 12px 20px;
    }
}

.button-container {
    margin-top: 40px;
    text-align: center;
}

.btn-descubre {
    background-color:rgb(44, 184, 8);
    color: white;
    padding: 14px 30px;
    border-radius: 30px;
    text-decoration: none;
    font-size: 18px;
    font-weight: bold;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
    display: inline-block;
}

.btn-descubre:hover {
    background-color: #218838;
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
}

/* LINEA DECORATIVA2 DE SEPARACION*/
.linea-decorativa-css {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 5px auto;
    position: relative;
    width: 700px;      /*  ancho total de la línea decorativa */
    max-width: 80%;    /* opcional: responsivo */
}

.linea-decorativa-css::before,
.linea-decorativa-css::after {
    content: "";
    flex: 1;
    height: 2px;
    background: #000;
    margin: 0 15px;
}

.icono-central {
    font-size: 24px;
    color: #daa520; 
    font-family: 'Georgia', serif;
}




/* SECCION DE CARDS DE CATEGORIA O CATALOGO*/

.categorias-section {
    padding: 60px 20px;
    text-align: center;

}

.swiper-container {
    max-width: 100%;
    overflow: hidden;
}

.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Tamaño reducido */
.card-3d.small-card {
    width: 200px;
    height: 280px;
}

.card-3d {
    width: 280px;
    height: 360px;
    perspective: 1000px;
}

.card-inner {
    width: 100%;
    height: 100%;
    background-color: #333;
    border-radius: 12px;
    overflow: hidden;
    transform-style: preserve-3d;
    transition: transform 0.3s ease;
    position: relative;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.card-3d:hover .card-inner {
    transition: transform 0.1s ease;
}

.card-bg {
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    opacity: 0.9;
    z-index: 1;
    pointer-events: none;
}

.card-info {
    position: absolute;
    bottom: 0;
    width: 100%;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 20px;
    z-index: 2;
}

.card-info h3 {
    margin: 0 0 10px;
    font-size: 20px;
}

.card-info p {
    margin: 0;
    font-size: 14px;
}

@media (max-width: 900px) {
    .categorias-grid {
    grid-template-columns: repeat(2, 1fr); /* 2 columnas en tablets */
    }
}

@media (max-width: 600px) {
    .categorias-grid {
    grid-template-columns: 1fr; /* 1 columna en celulares */
    }
}

/* Animación al hacer scroll desde la derecha */
.fade-right {
    opacity: 0;
    transform: translateX(100px);
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
}

.fade-right.active {
    opacity: 1;
    transform: translateX(0);
}

.titulo-catalogo {
    font-size: 2rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 1.5rem;
    font-family: 'Poppins', sans-serif;
}

.categorias-subtitulo {
    text-align: center;
    margin-top: 40px;
    font-family: 'Poppins', sans-serif;
}

.categorias-subtitulo h3 {
    font-size: 24px;
    color: #333;
    font-weight: 600;
}



/* LINEA2 DECORATIVA DE SEPARACION*/
.linea2-decorativa-css {
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 80px auto 30px auto; /* más espacio arriba, menos abajo */
    position: relative;
    width: 700px;      /*  ancho total de la línea decorativa */
    max-width: 80%;    /* opcional: responsivo */
}

.linea2-decorativa-css::before,
.linea2-decorativa-css::after {
    content: "";
    flex: 1;
    height: 2px;
    background: #000;
    margin: 0 15px;
}

.icono2-central {
    font-size: 24px;
    color: #daa520; 
    font-family: 'Georgia', serif;
}


/*SECCION DE AUTORES Y MUCHOS MAS */
.gallery {
    --size: 100px;
    display: grid;
    grid-template-columns: repeat(6, var(--size));
    grid-auto-rows: var(--size);
    margin-bottom: var(--size);
    place-items: start center;
    gap: 5px;
    width: max-content;
    margin-left: auto;
    margin-right: auto;
    margin-top: 100px;
    margin-bottom: 200px;
}

.gallery:has(:hover) img:not(:hover),
.gallery:has(:focus) img:not(:focus) {
    filter: brightness(0.5) contrast(0.5);
}

.gallery img {
    object-fit: cover;
    width: calc(var(--size) * 2);
    height: calc(var(--size) * 2);
    clip-path: path("M90,10 C100,0 100,0 110,10 190,90 190,90 190,90 200,100 200,100 190,110 190,110 110,190 110,190 100,200 100,200 90,190 90,190 10,110 10,110 0,100 0,100 10,90Z");
    transition: clip-path 0.25s, filter 0.75s;
    grid-column: auto / span 2;
    border-radius: 5px;
}

.gallery img:nth-child(5n-1) {
    grid-column: 2 / span 2;
}

.gallery img:hover,
.gallery img:focus {
    clip-path: path("M0,0 C0,0 200,0 200,0 200,0 200,100 200,100 200,100 200,200 200,200 200,200 100,200 100,200 100,200 100,200 0,200 0,200 0,100 0,100 0,100 0,100 0,100Z");
    z-index: 1;
    transition: clip-path 0.25s, filter 0.25s;
}

.gallery img:focus {
    outline: 1px dashed black;
    outline-offset: -5px;
}

@media (max-width: 1024px) {
  .gallery {
    grid-template-columns: repeat(4, var(--size));
  }
}

@media (max-width: 768px) {
  .gallery {
    grid-template-columns: repeat(3, var(--size));
  }
}

@media (max-width: 576px) {
  .gallery {
    grid-template-columns: repeat(2, var(--size));
  }
}



  .custom-card {
        position: relative;
        display: inline-block;
        width: 390px;
        height: 450px;
        overflow: hidden;
        border: 1px solid #ccc;
    }

    .card-img {
        width: 100%;
        height: 100%;
        display: block;
    }

    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 10px;
        transition: all 0.4s ease-in-out;
    }

    .custom-card:hover .card-overlay {
        opacity: 0;
        visibility: hidden;
    }

    .custom-card h4 {
        font-size: 20px;
        margin-bottom: 5px;
    }

    .custom-card p {
        font-size: 14px;
        margin: 0;
    }

    @media (max-width: 768px) {
        .custom-card {
            width: 100%;
            height: auto;
        }

        .card-img {
            height: auto;
        }
    }




/*SECCION DE Conectando a la Comunidad con el Conocimiento*/
.comunidad-section {
  background-color: #222; /* gris oscuro */
    padding: 60px 20px;
    text-align: center;
    margin-top: 80px;
}
.container-comunidad {
    max-width: 1100px;
    margin: 0 auto;
}
.comunidad-title {
    font-size: 28px;
    margin-bottom: 40px;
    color: #ffffff;
    font-weight: 700;
    font-family: 'Poppins', sans-serif;
}

.comunidad-cards {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
    margin-bottom: 40px;
}

.comunidad-card {
    background-color: #2f2f2f;
    border-radius: 12px;
    padding: 20px 30px;
    text-align: center;
    width: 250px;
    transition: box-shadow 0.3s, transform 0.3s;
    cursor: pointer;
}

.comunidad-card:hover {
   box-shadow: 0 0 20px #00ff88aa; /* VERDE brillante */
    transform: translateY(-5px);
}

.comunidad-icon {
    font-size: 30px;
    color: rgb(1, 132, 6);/
    margin-bottom: 10px;
}

.comunidad-card h4 {
    font-size: 18px;
    color: #fff;
}

.comunidad-final {
    font-size: 16px;
    color: #ddd;
    max-width: 800px;
    margin: 0 auto;
    l ine-height: 1.8;
}

/*SECCION DE VISITA NUESTRAS INSTALACIONES*/

.imagen-efecto {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border-radius: 12px;
}
.imagen-efecto:hover {
    transform: scale(1.03);
    box-shadow: 0 12px 25px rgba(0,0,0,0.2);
}

/* Tamaños para que se alineen visualmente */
.img-grande {
    height: 400px;
    object-fit: cover;
    width: 100%;
}
.img-pequena {
    height: 195px;
    object-fit: cover;
    width: 100%;
}


/* Botón flotante de volver arriba */
.btn-ir-arriba {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 999;
    background-color: #28a745;
    color: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    font-size: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
    opacity: 0.7;
}

.btn-ir-arriba:hover {
    background-color: #218838;
    transform: scale(1.1);
    opacity: 1;
}



</style>

<script>

    //ANIMACION XYZ DE LAS CARD DE CATALOGO
    document.querySelectorAll('.card-3d').forEach(card => {
    const inner = card.querySelector('.card-inner');
    const bg = card.querySelector('.card-bg');
    const imageUrl = card.getAttribute('data-image');
    bg.style.backgroundImage = `url('${imageUrl}')`;

    card.addEventListener('mousemove', e => {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        const rotateX = (-y / 20).toFixed(2);
        const rotateY = (x / 20).toFixed(2);
        inner.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
    });

    card.addEventListener('mouseleave', () => {
        inner.style.transform = `rotateX(0deg) rotateY(0deg)`;
    });
    });


//ANIMACION DE LAS CARDS DEL CATALOGO TRANSICION A LA DERCHA

    document.addEventListener("DOMContentLoaded", function () {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
        if (entry.isIntersecting) {
        entry.target.classList.add("active");
        }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.fade-right').forEach(el => {
        observer.observe(el);
    });
    });

//CARUSEL DE LAS CARDS DEL CATALOGO
    document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper('.categorias-swiper', {
        slidesPerView: 6,
        spaceBetween: 20,
        loop: true,
      loopedSlides: 12, // <- el doble que la cantidad original
        autoplay: {
        delay: 2000, // 2 segundos entre desplazamientos
        disableOnInteraction: false
        },
      speed: 800, // velocidad de desplazamiento
        breakpoints: {
        1200: { slidesPerView: 6 },
        992:  { slidesPerView: 4 },
        768:  { slidesPerView: 3 },
        576:  { slidesPerView: 2 },
        0:    { slidesPerView: 1 },
        }
    });
    });

    //EFCTO DE BOTON PARA VOLER ARRIBA

    document.querySelector('.btn-ir-arriba').addEventListener('click', function(e) {
    e.preventDefault();
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});




</script>
@endsection
