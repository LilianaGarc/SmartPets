<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

<nav class="navbar" id="navbar">
    <div class="logo">
        <img src="{{ asset('images/smartpetspng2.png') }}" alt="" style="width: 20vw; height: auto;">
    </div>
    <div>
        <a href="#">Perfil</a>
        <a href="#">Ajustes</a>
        <a href=""></a>
    </div>
</nav>

<div class="cuadrado-container-wrapper">
    <button class="carousel-btn prev" onclick="moveCarousel('prev')" style="display: none;">←</button>

    <div class="cuadrado-container">
        <div class="cuadrado">
            <div class="texto-overlay">Comparte historias de tus mascotas</div>
            <img src="{{ asset('images/golden.png') }}" alt="Mascota 1">
            <div class="overlay">
                <p>Comparte el día a día de tu mascota</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Crear publicación</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Adopta una mascota</div>
            <img src="{{ asset('images/cat.png') }}" alt="Mascota 2">
            <div class="overlay">
                <p>Pon en adopción y adopta tu mascota preferida</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Adoptar mascota</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Crea eventos</div>
            <img src="{{ asset('images/conejito.png') }}" alt="Mascota 3">
            <div class="overlay">
                <p>Crea y asiste a eventos para tus mascotas</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Crear a eventos</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Chatea con tus amigos</div>
            <img src="{{ asset('images/perrito.png') }}" alt="Mascota 4">
            <div class="overlay">
                <p>Chatea con personas que comparten gustos de tus mascotas</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Ir al PetChat</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Encuentra tus veterinarias</div>
            <img src="{{ asset('images/perrito3.png') }}" alt="Mascota 6">
            <div class="overlay">
                <p>Descubre tus veterinarias mas cercanas</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Ir a veterinarias</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">Descubre tu mascota ideal</div>
            <img src="{{ asset('images/ave.png') }}" alt="Mascota 7">
            <div class="overlay">
                <p>Descubre cúal seria tu mascota ideal</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Mascota ideal</button>
            </div>
        </div>

        <div class="cuadrado">
            <div class="texto-overlay">PetShop</div>
            <img src="{{ asset('images/fisgon.png') }}" alt="Mascota 8">
            <div class="overlay">
                <p>Compra productos de necesidad para tus mascotas</p>
                <button class="btnseccion" onclick="scrollToCarousel()">Ir a Petshop</button>
            </div>
        </div>
    </div>

    <button class="carousel-btn next" onclick="moveCarousel('next')">→</button>
</div>

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f7f7f7;
        height: 200vh;
        scroll-behavior: smooth;
        overflow-x: hidden;
    }

    .navbar {
        background-color: rgb(255, 255, 255);
        padding: 1.5vw;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 100;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .navbar a {
        text-decoration: none;
        color: #333;
        font-size: 1rem;
        margin: 0 1.5vw;
        transition: color 0.3s ease, transform 0.3s ease;
    }
    .navbar a:hover {
        color: #ff7f50;
        transform: scale(1.1);
    }

    .navbar .logo {
        margin-left: 5vw;
    }
    /* jona: botones dentro del cuadrado */
    .carousel-btn {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        font-size: 2rem;
        padding: 1rem;
        position: absolute;
        z-index: 10;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease, border-radius 0.3s ease;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    .carousel-btn:hover {
        background-color: rgba(0, 0, 0, 0.8);
        transform: scale(1.2);
    }
    /* jona: botones del carusel */
    .carousel-btn.prev {
        left: 5vw;
    }

    .carousel-btn.next {
        right: 5vw;
    }
    /* jona: contenedor del carusel */
    .cuadrado-container-wrapper {
        background-image: url("{{ asset('images/fondosp9.png') }}");
        background-size: cover;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        transition: transform 0.3s ease-out;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        width: 100%;
        height: 44vw;
        margin-top: 8vw;
        overflow: hidden;
        padding: 2vw;
    }

    .cuadrado-container {
        display: flex;
        gap: 2vw;
        transition: transform 0.5s ease;
        width: 100%;
        justify-content: flex-start;
    }

    .cuadrado {
        border-radius: 1rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
        animation: camaleon 9s infinite alternate;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        align-items: center;
        text-align: center;
        cursor: pointer;
        transition: transform 0.3s ease, filter 0.3s ease;
        height: 40vh;
        flex: 0 0 21%;
        box-sizing: border-box;
    }
    /* jona: efectos colores */
    @keyframes camaleon {
        0% {
            background-color: rgb(236, 152, 80);
        }
        50% {
            background-color: rgb(237, 129, 25);
        }
        55% {
            background-color: rgb(76, 106, 152);
        }
        100% {
            background-color: rgb(24, 71, 139);
        }
    }

    .cuadrado img {
        width: 80%;
        height: 70%;
        object-fit: cover;
        border-radius: 1rem;
        margin-bottom: 0;
        transition: transform 0.5s ease;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0);
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2rem;
        opacity: 0;
        transition: opacity 0.3s ease;
        flex-direction: column;
        text-align: center;
        transform: translateX(100%);
    }

    .cuadrado:hover .overlay {
        opacity: 1;
        transform: translateX(0);
    }

    .overlay p {
        color: rgba(255, 255, 255, 0.9);
        position: absolute;
        margin-bottom: 10vw;
        font-size: 1.2rem;
        font-weight: bold;
    }

    .btnseccion {
        display: inline-block;
        background-color: #ff7f50;
        position: absolute;
        color: white;
        font-size: 0.9rem;
        padding: 0.9vw 0.9vw;
        border-radius: 2vw;
        border-color: rgba(255, 255, 255, 0.86);
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s;
        margin-left: 4.4vw;
        margin-bottom: 2vw;
        margin-top: 7vw;
    }

    .btnseccion:hover {
        background-color: #1e4183;
        transform: scale(1.1);
        border-color: rgba(255, 255, 255, 0.86);
    }

    .cuadrado .texto-overlay {
        position: absolute;
        top: 1vh;
        color: #ffffff;
        padding: 0.4vw;
        border-radius: 0.5vw;
        font-size: 1.3rem;
        font-weight: bold;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .cuadrado:hover img {
        transform: translateX(-67%);
    }

    .cuadrado:hover {
        transform: scale(1.1) translateZ(0);
    }

    .cuadrado:hover .texto-overlay {
        transform: translateX(-400%);
    }

    .cuadrado-container .cuadrado {
        filter: brightness(1) saturate(1) contrast(1) blur(0);
        transition: filter 0.5s ease;
    }
    /* jona: efecto desenfoque */
    .cuadrado-container .cuadrado.not-hovered {
        filter: brightness(0.9) saturate(0.1) contrast(1) blur(5px);
    }

</style>

<script>
    /* jona: logica del carusel */
    let currentIndex = 0;

    const container = document.querySelector('.cuadrado-container');
    const items = document.querySelectorAll('.cuadrado');
    const totalItems = items.length;
    const itemsVisible = 4;
    const prevBtn = document.querySelector('.carousel-btn.prev');

    function moveCarousel(direction) {
        const itemWidth = items[0].offsetWidth + parseFloat(getComputedStyle(items[0]).marginRight);

        if (direction === 'next') {
            currentIndex++;
            if (currentIndex > totalItems - itemsVisible) {
                currentIndex = 0;
            }
            prevBtn.style.display = 'block';
        } else if (direction === 'prev') {
            currentIndex--;
            if (currentIndex < 0) {
                currentIndex = totalItems - itemsVisible;
            }
        }

        const offset = -currentIndex * itemWidth;
        container.style.transform = `translateX(${offset}px)`;
    }
    /* jona: efecto del desenfoque de los demas cuadrados */
    const cards = document.querySelectorAll('.cuadrado');
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            cards.forEach(otherCard => {
                if (otherCard !== card) {
                    otherCard.classList.add('not-hovered');
                }
            });
        });

        card.addEventListener('mouseleave', () => {
            cards.forEach(otherCard => {
                otherCard.classList.remove('not-hovered');
            });
        });
    });
</script>
@yield('contenido')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>s
</body>
</html>
