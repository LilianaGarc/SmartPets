<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmartPets</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

@include('MenuPrincipal.Navbar')

<div class="cuadrado-container-wrapper">
    <button class="carousel-btn prev" onclick="moveCarusel('prev')" style="display: none;">←</button>

    <div class="cuadrado-container">
        <div class="cuadrado" onclick="window.location.href='{{ route('publicaciones.index') }}'">
            <div class="texto-overlay">Comparte historias de tus mascotas</div>
            <img src="{{ asset('images/golden.webp') }}" alt="Mascota 1">
        </div>

        <div class="cuadrado" onclick="window.location.href='{{ route('adopciones.index') }}'">
            <div class="texto-overlay">Adopta una mascota</div>
            <img src="{{ asset('images/cat.webp') }}" alt="Mascota 2">
        </div>

        <div class="cuadrado" onclick="window.location.href='{{route('eventos.index')}}'">
            <div class="texto-overlay">Crea eventos</div>
            <img src="{{ asset('images/conejito.webp') }}" alt="Mascota 3">
        </div>

        <div class="cuadrado" onclick="scrollToCarousel()">
            <div class="texto-overlay">Chatea con tus amigos</div>
            <img src="{{ asset('images/perrito.webp') }}" alt="Mascota 4">
        </div>

        <div class="cuadrado" onclick="window.location.href='{{ route('veterinarias.index') }}'">
            <div class="texto-overlay">Encuentra tus veterinarias</div>
            <img src="{{ asset('images/perrito3.webp') }}" alt="Mascota 6">
        </div>

        <div class="cuadrado" onclick="scrollToCarousel()">
            <div class="texto-overlay">Descubre tu mascota ideal</div>
            <img src="{{ asset('images/ave.webp') }}" alt="Mascota 7">
        </div>

        <div class="cuadrado" onclick="window.location.href='{{ route('productos.index') }}'">
            <div class="texto-overlay">PetShop</div>
            <img src="{{ asset('images/fisgon.webp') }}" alt="Mascota 8">
        </div>
    </div>

    <button class="carousel-btn next" onclick="moveCarusel('next')">→</button>

</div>

<section class="vision">
    <div class="vision-text">
        <h2>Rescata mascotas</h2>
        <p>SmartPets se dedica a la misión de rescatar a animales que han sido abandonados, maltratados o que se encuentran en situaciones de vulnerabilidad.</p>
    </div>
</section>

<section class="mision">
    <div class="mision-text">
        <h2>Adopta mascotas</h2>
        <p>SmartPets está diseñado para conectar a personas que buscan un nuevo compañero de vida con animales que necesitan un hogar.</p>
    </div>
</section>

<script src="{{ asset('js/MPscripts.js') }}"></script>
</body>
</html>
