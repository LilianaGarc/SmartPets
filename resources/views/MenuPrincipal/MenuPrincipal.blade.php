<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPets</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

@include('MenuPrincipal.Navbar')
<div class="image-carousel">
    <div class="image-container">
        <div class="image-item">
            <img src="{{ asset('images/disfruta.webp') }}" alt="Comparte momentos con tus mascotas">
            <div class="carousel-text">Comparte momentos inolvidables con tus mascotas</div>
            <div class="carousel-subtext">El amor incondicional de una mascota transforma tu vida. ¡Vívelo cada día!</div>
        </div>

        <div class="image-item">
            <img src="{{ asset('images/comparte.webp') }}" alt="Adopta y rescata mascotas">
            <div class="carousel-text black-text">Adopta y rescata, da un hogar lleno de amor</div>
            <div class="carousel-subtext black-text">Tu gesto de amor puede cambiar la vida de un animal. Haz la diferencia hoy mismo.</div>
        </div>

        <div class="image-item">
            <img src="{{ asset('images/eventos.webp') }}" alt="Asiste a eventos para apoyar a tus mascotas">
            <div class="carousel-text">Apoya el bienestar de tus mascotas en eventos especiales</div>
            <div class="carousel-subtext">Participa en eventos que promuevan el amor y el cuidado de los animales. ¡Tu presencia es valiosa!</div>
        </div>
    </div>

    <div class="carousel-dots">
        <span class="dot" data-index="0"></span>
        <span class="dot" data-index="1"></span>
        <span class="dot" data-index="2"></span>
    </div>
</div>



<div class="cuadrado-container-wrapper">

    <div class="cuadrado-container">
        <div class="cuadrado" onclick="window.location.href='{{route('eventos.index')}}'">
            <div class="texto-overlay">Eventos</div>
            <img src="{{ asset('images/conejito.webp') }}" alt="Mascota 3">
        </div>

        <div class="cuadrado" onclick="window.location.href='{{ route('adopciones.index') }}'">
            <div class="texto-overlay">Adopta una mascota</div>
            <img src="{{ asset('images/cat.webp') }}" alt="Mascota 2">
        </div>

        <div class="cuadrado" onclick="window.location.href='{{ route('veterinarias.index') }}'">
            <div class="texto-overlay">Encuentra tus veterinarias</div>
            <img src="{{ asset('images/perrito3.webp') }}" alt="Mascota 6">
        </div>

        <div class="cuadrado" onclick="window.location.href='{{ route('productos.index') }}'">
            <div class="texto-overlay">PetShop</div>
            <img src="{{ asset('images/fisgon.webp') }}" alt="Mascota 8">
        </div>
    </div>


</div>

<div class="vision">
    <div class="vision-content">
        <h2>Comparte historias de tus mascotas</h2>
        <p>SmartPets te invita a compartir momentos especiales y conectar con una comunidad unida por el amor a los animales.</p>
        <button class="ver-mas-btn" onclick="window.location.href='{{ route('publicaciones.index') }}'">Ver más</button>
    </div>
    <div class="vision-image">
        <img src="{{ asset('images/abrazo.webp') }}" alt="Imagen de visión">
    </div>
    <div class="hand-img">
        <img src="{{ asset('images/mano.webp') }}" alt="Mano">
    </div>
</div>

<div class="mision">
    <div class="mision-content">
        <h2>Descubre tu mascota ideal</h2>
        <p>SmartPets está diseñado para ayudarte a encontrar a tu compañero de vida perfecto, conectándote con animales que necesitan un hogar.</p>
        <button class="ver-mas-btn" onclick="window.location.href='{{ route('chatbot.index') }}'">Ver más</button>
    </div>
</div>



<section class="compartir-mascota">
    <div class="compartir-text">
        <h2>Usa el Petchat, chatea y comparte</h2>
        <p>Conéctate con otros amantes de los animales, comparte consejos, historias y crea una red de apoyo para ti y tus mascotas.</p>
        <button class="ver-mas-btn2" onclick="window.location.href='{{ route('chats.index') }}'">Ver más</button>
    </div>

    <div class="phone-animation">
        <div class="phone">
            <div class="screen">

                <div class="notification-bar">
                    <img src="{{ asset('images/smartpetspng2.webp') }}" alt="Smart Pets">
                </div>
                <div class="fondocel">
                    <img src="{{ asset('images/perro.gif') }}" alt="Smart Pets">
                </div>

                <div class="message-box">
                    <div class="message message-left">
                        <p>¡Hola! ¿Qué tal está Canelito?</p>
                    </div>
                    <div class="message message-right">
                        <p>Todo bien, está corriendo feliz por el parque. 🐶</p>
                    </div>
                    <div class="message message-left">
                        <p>¡Qué lindo! Cuéntame más sobre él!</p>
                    </div>
                    <div class="message message-right">
                        <p>Es un cachorro muy juguetón, siempre está feliz.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="petshop-section">
    <div class="petshop_texto">
        <h2>Explora nuestra PetShop</h2>
        <p>Encuentra los mejores productos para tus mascotas, desde juguetes hasta alimentos y accesorios exclusivos.</p>
        <button class="ver-mas-btn_tienda" onclick="window.location.href='{{ route('productos.index') }}'">Ver más</button>
    </div>
    <div class="petshop-container">
        <div class="petshop-item petshop-item-top-left">
            <img src="{{ asset('images/producto1.webp') }}" alt="Producto 1">
            <div class="petshop-item-text">Juguetes</div>
        </div>
        <div class="petshop-item petshop-item-2">
            <img src="{{ asset('images/producto2.webp') }}" alt="Producto 2">
            <div class="petshop-item-text">Camas</div>
        </div>
        <div class="petshop-item petshop-item-top-right">
            <img src="{{ asset('images/producto3.webp') }}" alt="Producto 3">
            <div class="petshop-item-text">Accesorios</div>
        </div>
        <div class="petshop-item petshop-item-bottom-left">
            <img src="{{ asset('images/producto.webp') }}" alt="Producto 4">
            <div class="petshop-item-text">Comida </div>
        </div>
        <div class="petshop-item petshop-item-bottom-right">
            <img src="{{ asset('images/producto5.webp') }}" alt="Producto 6">
            <div class="petshop-item-text">Ropa</div>
        </div>
        <div class="petshop-item petshop-item-3">
            <img src="{{ asset('images/producto6.webp') }}" alt="Producto 5">
            <div class="petshop-item-text">Cuidado Dental</div>
        </div>
    </div>
</section>


<section class="compartir-mascotas">
    <div class="button">
        <div class="box">S</div>
        <div class="box">M</div>
        <div class="box">A</div>
        <div class="box">R</div>
        <div class="box">T</div>
    </div>
</section>

<footer class="footer">
    <div class="footer__parralax">
        <div class="footer__parralax-trees"></div>
        <div class="footer__parralax-moto"></div>
        <div class="footer__parralax-secondplan"></div>
        <div class="footer__parralax-premierplan"></div>
        <div class="footer__parralax-voiture" id="secret-dog"></div>
    </div>
    <div class="containerfooter">
        <div class="footer__columns">
            <div class="footer__col">
                <h3 class="footer__col-title"><span>SmartPets</span></h3>
                <nav class="footer__nav">
                    <ul class="footer__nav-list">
                        <li class="footer__nav-item">
                            <a href="{{route('publicaciones.index')}}" class="footer__nav-link">Publicaciones</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="{{route('adopciones.index')}}" class="footer__nav-link">Adopciones</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="{{route('veterinarias.index')}}" class="footer__nav-link">Veterinarias</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="{{route('chatbot.index')}}" class="footer__nav-link">Mascota ideal</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="footer__col">
                <h3 class="footer__col-title"><span>‎ </span></h3>
                <nav class="footer__nav">
                    <ul class="footer__nav-list">
                        <li class="footer__nav-item">
                            <a href="#" class="footer__nav-link">PetChat</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="{{route('eventos.index')}}" class="footer__nav-link">Eventos</a>
                        </li>
                        <li class="footer__nav-item">
                            <a href="{{route('productos.index')}}" class="footer__nav-link">PetShop</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="footer__col">
                <h3 class="footer__col-title"><span>‎ </span></h3>
                <nav class="footer__nav">
                    <ul class="footer__nav-list">
                        <li class="footer__nav-item">
                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=smartpetsunah@gmail.com&su=Consulta&body=Hola,%20me%20gustaría%20saber%20más%20sobre..." class="footer__nav-link" target="_blank">smartpetsunah@gmail.com</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="footer__copyrights">
            <p>&copy; 2025 DevStorm. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>



<script src="{{ asset('js/MPscripts.js') }}"></script>
<script>
    document.getElementById('secret-dog').addEventListener('click', function () {
        window.location.href = "{{ route('juego.index') }}";
    });
</script>
@include('chats.chat-float')


</body>
</html>
