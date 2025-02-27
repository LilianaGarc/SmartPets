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
        <div class="cuadrado">
            <div class="texto-overlay">Comparte historias de tus mascotas</div>
            <img src="{{ asset('images/golden.webp') }}" alt="Mascota 1">
            <div class="overlay">
                <p>Comparte el día a día de tu mascota</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Crear publicación</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Adopta una mascota</div>
            <img src="{{ asset('images/cat.webp') }}" alt="Mascota 2">
            <div class="overlay">
                <p>Pon en adopción y adopta tu mascota preferida</p>
                <button class="btnseccion" onclick="window.location.href='{{ route('adopciones.index') }}'">Adoptar mascota</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Crea eventos</div>
            <img src="{{ asset('images/conejito.webp') }}" alt="Mascota 3">
            <div class="overlay">
                <p>Crea y asiste a eventos para tus mascotas</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Crear a eventos</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Chatea con tus amigos</div>
            <img src="{{ asset('images/perrito.webp') }}" alt="Mascota 4">
            <div class="overlay">
                <p>Chatea con personas que comparten gustos de tus mascotas</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Ir al PetChat</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Encuentra tus veterinarias</div>
            <img src="{{ asset('images/perrito3.webp') }}" alt="Mascota 6">
            <div class="overlay">
                <p>Descubre tus veterinarias mas cercanas</p>
                <button class="btnseccion" onclick="window.location.href='{{ route('veterinarias.index') }}'">Ir a veterinarias</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Descubre tu mascota ideal</div>
            <img src="{{ asset('images/ave.webp') }}" alt="Mascota 7">
            <div class="overlay">
                <p>Descubre cúal seria tu mascota ideal</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Mascota ideal</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">PetShop</div>
            <img src="{{ asset('images/fisgon.webp') }}" alt="Mascota 8">
            <div class="overlay">
                <p>Compra productos de necesidad para tus mascotas</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Ir a Petshop</button>
            </div>
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
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
