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
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 0;
            margin: 0;
            margin-top: 15vh !important;
            font-size: 100%;
            background-color: #f7f7f7;
            scroll-behavior: smooth;
            overflow-x: hidden;
            flex-direction: column;
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
            width: 100vw;
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

        .btnl {
            text-decoration: none;
            color: #ffffff;
            background-color: #ff7f50;
            transition: color 0.3s ease, transform 0.3s ease;
            border-radius: 20px;
            border: none;
        }

        .btnl:hover {
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
            background-color: rgb(3, 45, 129);
            transition: color 0.3s ease, transform 0.3s ease;
            border-radius: 20px;
            margin-top: 1vh;
            width: 20vw;
            padding: 2vh;
        }
        .btn-user:hover {
            transform: scale(1.1);
        }

        .round-button {
            width: 15vh;
            height: 15vh;
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
            margin: 0;
            object-fit: cover;
        }

        .round-button:hover {
            color: #ffffff;
            transform: scale(1.1);
            background-color: #e7e7e7;
        }

        .round-button-2 {
            width: 6vh;
            height: 6vh;
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


        .breadcrumb-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 2.5vh;
        }

        .breadcrumb {
            display: flex;
            border-radius: 10px;
            text-align: center;
            height: 40px;
            z-index: 1;
            justify-content: flex-start;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .breadcrumb__item {
            height: 100%;
            background-color: white;
            color: #252525;
            font-family: 'Oswald', sans-serif;
            border-radius: 7px;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            position: relative;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            transform: skew(-21deg);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
            margin: 5px;
            padding: 0 40px;
        }

        .breadcrumb__item:hover {
            background: #1e4183;
            color: #FFF;
        }

        .breadcrumb__inner {
            display: flex;
            flex-direction: column;
            margin: auto;
            z-index: 2;
            transform: skew(21deg);
        }

        .breadcrumb__title {
            font-size: 16px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .breadcrumb__item a {
            color: inherit;
            text-decoration: none;
            cursor: pointer;
        }

        .breadcrumb__item-active {
            background-color: #1e4183;
            color: #FFF;
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                               onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </ul>
            </div>
        </div>


    </div>
</nav>
<div class="container">
    @yield('contenido')
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
