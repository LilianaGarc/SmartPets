<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Smart Pets')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 10vw;
            background-color: #f7f7f7;
            height: 200vh;
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
            margin: 0 0.9vw;
            transition: color 0.3s ease, transform 0.3s ease;
        }
        .navbar a:hover {
            color: #ff7f50;
            transform: scale(1.1);
        }

        .navbar .logo {
            margin-left: 5vw;
        }
    </style>
</head>
<body>
<nav class="navbar" id="navbar">
    <div class="logo">
        <a href="{{ route('index') }}">
            <img src="{{ asset('images/smartpetspng2.webp') }}" alt="Smart Pets" style="width: 20vw; height: auto;">
        </a>
    </div>
    <div>
        <a href="#">Perfil</a>
        <a href="#">Ajustes</a>
        <a href=""></a>
    </div>
</nav>
<div class="container" style="margin-top: 8vw;">
    @yield("contenido")
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
