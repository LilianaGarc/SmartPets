<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>
<body>
@yield('nav')
<nav class="navbar" id="navbar">
    <div class="nav-container">
        <div class="logo">
            <a href="{{ route('index') }}">
                <img src="{{ asset('images/smartpetspng2.webp') }}" alt="Smart Pets">
            </a>
        </div>

        <div class="hamburger-lines" id="hamburger">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>

        <div class="menu-items" id="menu">

            <ul>
                <li><a href="#">Iniciar Sesión</a></li>
                <li><a href='{{ route('eventos.index') }}'>Eventos</a></li>
                <li><a href='{{ route('publicaciones.index') }}'>Publicaciones</a></li>
                <li><a href='{{ route('adopciones.index') }}'>Adopciones</a></li>
                <li><a href='{{ route('veterinarias.index') }}'>Veterinarias</a></li>
                <li><a href='{{ route('productos.index') }}'>PetShop</a></li>
                <li><a href="#">PetChat</a></li>
                <li><a href="#">Mascota ideal</a></li>
                <li><a href="#">Salir</a></li>
            </ul>
        </div>
    </div>
</nav>

<script src="{{ asset('js/navbar.js') }}"></script>
<script>
</script>
</body>
</html>
