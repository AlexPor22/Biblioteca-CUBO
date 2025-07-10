@extends('layouts.app')

@section('content')
    <div class="content-container">
        <div class="text-container">
            <h1>BIBLIOTECA VIRTUAL<br>CUBO SAN MIGUEL</h1>
            <p>Explora el conocimiento sin límites desde cualquier lugar. Nuestra biblioteca virtual del Centro Urbano de Bienestar y Oportunidades (CUBO) en El Salvador pone a tu alcance una amplia colección de libros digitales, audiolibros, noticias sobre eventos culturales y un sistema moderno de préstamo de libros físicos.
Aquí promovemos la lectura, el aprendizaje y el acceso equitativo a la información para todas las comunidades. ¡Descubre, aprende y conéctate con la cultura en un solo lugar!
</p>
        </div>
        <img src="{{ asset('img/PORTADA.png') }}" alt="Imagen Flotante" class="floating-image">
    </div>

<style>
    body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
}

.content-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 50px;
}

.text-container {
    max-width: 60%;
}

.titulo {
    font-size: 36px;
    color: #333;
    text-align: left;
}

.descripcion {
    font-size: 18px;
    color: #666;
    margin-top: 20px;
}

.floating-image {
    position: fixed;
    top: 50%;
    right: 10%; /* Ajusta esta propiedad para alejar la imagen del borde derecho */
    transform: translateY(-50%);
    animation: float 5s infinite alternate;
    width: 300px; /* Ajusta el tamaño de la imagen según lo necesites */
    height: auto; /* Mantiene la proporción original de la imagen */
}

@keyframes float {
    0% {
        transform: translateY(-50%) translateX(10px);
    }
    100% {
        transform: translateY(-50%) translateX(-10px);
    }
}


</style>

@endsection
