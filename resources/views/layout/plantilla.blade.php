<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            margin-left: 0vw;
        }

        .btn {
            text-decoration: none;
            color: #ffffff;
            background-color: #ff7f50;
            transition: color 0.3s ease, transform 0.3s ease;
            border-radius: 20px;
        }

        .btn:hover {
            color: #ffffff;
            transform: scale(1.1);
            background-color: #18478b;
        }

        .card-publicacion{
            width: 96%;
            height: 100%;
            padding: 2%;
            margin: 2%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            box-sizing: border-box ;
            transition: all .5s ease ;
            overflow-x: auto;
            border: 1px solid #c0c0c0;
            border-radius: 5px;
            z-index: 5;
        }

        .imagen-publicacion-reaccion{
            width: 6%;
            height: 6%;
            margin: 0.4%;
        }

        .imagen-publicacion-reaccion:hover{
            transform: scale(1.4);
        }

        .btn-user {
            text-decoration: none;
            color: #ffffff;
            font-size: 120%;
            background-color: #18478b;
            transition: color 0.3s ease, transform 0.3s ease;
            border-radius: 20px;
            margin-top: 2%;
            width: 30%;
            padding: 1%;
        }
        .btn-user:hover {
            transform: scale(1.1);
        }

        .round-button {
            width: 16%;
            border-radius: 50%;
            border: none;
            background-color: #ffffff;
            justify-content: center;
            align-items: center;
            display: flex;
            border: 3px solid black;
            border-radius: 50%;
        }

        .button-img {
            width: 100%;
            margin: 2%;
            object-fit: cover;
        }

        .round-button:hover {
            color: #ffffff;
            transform: scale(1.1);
            background-color: #e7e7e7;
        }

        .round-button-2 {
            width: 7%;
            border-radius: 50%;
            border: none;
            background-color: #ffffff;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
            border-radius: 50%;
        }

        .button-img-2 {
            width: 100%;
            margin: 0;
            object-fit: cover;
        }

        .round-button-2:hover {
            color: #ffffff;
            background-color:  #e7e7e7;
            transform: scale(1.1);
        }

        .round-button-comentario {
            width: 100%;
            height: 40%;
            border-radius: 50%;
            border: none;
            background-color: #ffffff;
            justify-content: center;
            align-items: center;
            border: 2px solid black;
            border-radius: 50%;
        }

        .button-img-comentario {
            width: 90%;
            height: 90%;
            margin: 0;
            object-fit: cover;
        }

        .card-comentario{
            width: 96%;
            height: 100%;
            box-sizing: border-box ;
            transition: all .5s ease ;
            overflow-x: auto;
            border: 1px solid #c0c0c0;
            border-radius: 5px;
            background-color: #eaeaea;
        }

        .navicon {
            font-size: 150% !important;
        }

        .card-nuevo-comentario{
            width: 68.6%;
            height: 10.1%;
            margin-top: 41.7%;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            box-sizing: border-box ;
            transition: all .5s ease ;
            position: fixed;
            overflow-x: auto;
            border: 1px solid #c0c0c0;
            border-radius: 5px;
            z-index: 10;
            background-color: white;
        }

        .alert {
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }

        .alert.hidden {
            opacity: 0;
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
    <div class="row">
        <div class="col-10">
            <a class="navicon" href="{{ route('index') }}" ><i class="fa-solid fa-house"></i></a>
            <a class="navicon" href="{{ route('publicaciones.index') }}"><i class="fa-solid fa-image"></i></a>
            <a class="navicon" href="#"><i class="fas fa-envelope"></i></a>
            <a class="navicon" href="#"><i class="fas fa-user-circle"></i></a>
        </div>
        <div class="col-1">
            <div class="btn-group dropstart" style="font-size: 100% !important;">
                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cogs"></i> Ajustes</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
                </ul>
            </div>
        </div>


    </div>
</nav>
@yield('contenido')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
 