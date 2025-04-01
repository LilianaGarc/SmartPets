<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Smart Pets')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-left: 15%;
            margin-top: 9%;
            margin-bottom: 5%;
            padding: 0;
            font-size: 100%;
            background-color: #f7f7f7;
            width: 75%;
            height: 200vh;
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        .navbar {
            width: 100%;
            box-shadow: 0 1px 4px rgb(146 161 176 / 15%);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            background-color: rgb(255, 255, 255);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 1rem;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .nav-container {
            display: flex;
            justify-content: start;
            align-items: center;
            width: 92%;
            margin: 0 auto;
            position: relative;
        }

        .navbar .logo img {
            margin-left: 0;
            width: 20vw;
            height: auto;
        }

        .navbar .hamburger-lines {
            display: block;
            cursor: pointer;
            position: absolute;
            right: 0.1vw;
            z-index: 110;
        }

        .navbar .menu-items {
            display: flex;
            justify-content: center;
            align-items: center;
            position: fixed;
            top: 0;
            right: -100%;
            width: 250px;
            height: 100vh;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 100;
            flex-direction: column;
            transition: right 0.3s ease-in-out;
        }

        .navbar .menu-items.open {
            right: 0;
            width: 22%;
        }

        .navbar .menu-items ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .navbar .menu-items li {
            margin: 1.5rem 0;
            transition: transform 0.3s ease;
        }

        .navbar .menu-items a {
            text-decoration: none;
            color: #0e2431;
            font-weight: 500;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .navbar .menu-items a:hover {
            color: #ff7c40;
        }

        .nav-container .hamburger-lines .line {
            display: block;
            height: 4px;
            width: 30px;
            margin: 5px 0;
            background-color: #0e2431;
            border-radius: 5px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .navbar .hamburger-lines.open .line1 {
            transform: rotate(45deg) translate(5px, 5px);
        }

        .navbar .hamburger-lines.open .line2 {
            opacity: 0;
        }

        .navbar .hamburger-lines.open .line3 {
            transform: rotate(-45deg) translate(5px, -5px);
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 1rem 2vw;
            }

            .nav-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-container .hamburger-lines {
                display: block;
                padding-right:2vw;
            }

            .navbar .logo img {
                width: 30vw;
            }

            .navbar .menu-items.open {
                width: 60%;
            }
        }


    </style>
</head>
<body>
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
    @yield("contenido")
</div>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
