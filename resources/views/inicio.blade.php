@extends('layouts.app')

@section('content')
   


<div class="content-container">
    <div class="text-container">
        <h1 class="titulo">Biblioteca Virtual CUBO</h1>
        <p class="descripcion">Bienvenidos a la Biblioteca Virtual CUBO. Aquí podrás encontrar una gran variedad de libros y recursos digitales para tu aprendizaje. ¡Explora y disfruta de nuestro catálogo!</p>
    </div>
    <div class="image-container">
        <img src="{{ asset('img/PORTADA.png') }}" alt="Imagen Flotante" class="floating-image">
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



<style>
   body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
}

.header {
    width: 100%;
    background-color: #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    position: relative;
    z-index: 10;
    height: 150px;
}

/* Contenido debajo del header */
.content-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 50px 5%;
    background-color:rgb(72, 72, 72);
    color: #fff;
    min-height: 400px; /* Aumenta esto si necesitas más espacio vertical */
    position: relative;
    overflow: visible; /* Asegura que la imagen no se recorte */
}

.text-container {
    max-width: 60%;
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

.floating-image {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    animation: float 4s ease-in-out infinite alternate;
    width: 100%;
    height: 300px;
    object-fit: contain;
    will-change: transform;
}

@keyframes float {
    0% {
        transform: translateY(-50%) translateX(10px);
    }
    100% {
        transform: translateY(-50%) translateX(-10px);
    }
}



.services-section {
    padding: 80px;
    background-color: #f4f4f4;
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



</style>

@endsection
