<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin-left: 19%;
            margin-top: 9%;
            margin-right: 1%;
            margin-bottom: 5%;
            padding: 0;
            font-size: 100%;
            background-color: #f7f7f7;
            height: 80vh;
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
            width: 97%;
            height: 100%;
            padding: 2%;
            margin: 0.5% 1.5% 1.5% 1.5%;
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
            width: 10vh;
            height: 10vh;
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
            width: 10vh;
            height: 10vh;
            margin: 2%;
            object-fit: cover;
        }

        .round-button:hover {
            color: #ffffff;
            transform: scale(1.1);
            background-color: #e7e7e7;
        }

        .round-button-2 {
            width: 7vh;
            height: 7vh;
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

        .button-img-comentario {
            width: 100%;
            margin: 0;
            object-fit: cover !important;
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

        .btn {
            text-decoration: none;
            color: #ffffff;
            background-color: #ff7f50;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .btn:hover {
            color: #ffffff;
            transform: scale(1.1);
            background-color: #18478b;
        }

        .left-section {
            position: fixed;
            top: 10%;
            left: 0;
            width: 18%;
            height: 100%;
            background-color: #18478b;
            padding: 30px;
            box-sizing: border-box;
            border-color: #100f0f;
            box-shadow: 5px 0 30px rgba(0,0,0,.1);
            transition: all .5s ease;
            overflow-x: auto !important;
        }

        .left-section a {
            text-decoration: none;
            color: #ffffff;
            font-size: 100% !important;
            margin: 10%;
            transition: color 0.3s ease, transform 0.3s ease;
            background-color: #18478b;
            width: 90%;
            text-align: left;
            display: block;
        }


        .left-section a:hover {
            color: #ff7f50;
            transform: scale(1.1);
            background-color: #ffffff;
        }

        .table a {
            text-decoration: none;
            color: #18478b;
            font-size: 100%;
            transition: color 0.3s ease, transform 0.3s ease;
            background-color: #ffffff;
            width: 90%;
            text-align: left;
            display: block;
        }


        .table a:hover {
            color: #ff7f50;
            transform: scale(1.1);
            background-color: #ffffff;
        }

        .dropdown-item-custom  {
            text-decoration: none !important;
            color: #18478b !important;
            margin: 5% !important;
            transition: color 0.3s ease, transform 0.3s ease !important;
            background-color: #ffffff !important;
            width: 40% !important;
            text-align: left !important;
            display: block !important;
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
            <a class="navicon" href="{{ route('publicaciones.panel') }}" ><i class="fa-solid fa-pager"></i></a>
            <a class="navicon" href="#"><i class="fa-solid fa-bell"></i></a>
            <a class="navicon" href="#"><i class="fas fa-user-circle"></i></a>
        </div>
        <div class="col-2">
            <div class="btn-group dropstart" style="font-size: 100% !important; margin-left: 2% !important;">
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

<div class="card">
    <div class="card-body">
        @yield('contenido')
    </div>
</div>



</div>

<div class="left-section">
    <br>
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: white; color: #ff7f50;">
            <i class="fas fa-plus-circle"></i> Crear Nuevo

        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item-custom"  href="{{ route('users.panelcreate') }}">Usuarios</a></li>
            <li><a class="dropdown-item-custom"  href="{{ route('publicaciones.panelcreate') }}">Publicaciones</a></li>
            <li><a class="dropdown-item-custom"  href="#">Comentarios</a></li>
            <li><a class="dropdown-item-custom"  href="#">Reacciones</a></li>
            <li><a class="dropdown-item-custom"  href="{{ route('veterinarias.create') }}">Veterinarias</a></li>
            <li><a class="dropdown-item-custom"  href="#">Adopciones</a></li>
            <li><a class="dropdown-item-custom"  href="#">Eventos</a></li>
            <li><a class="dropdown-item-custom"  href="#">Mensajes</a></li>
            <li><a class="dropdown-item-custom"  href="#">Chats</a></li>
            <li><a class="dropdown-item-custom"  href="#">Productos</a></li>
            <li><a class="dropdown-item-custom"  href="#">Solicitudes</a></li>
            <li><a class="dropdown-item-custom"  href="#">Ubicaciones</a></li>
        </ul>
    </div>
    <hr style="color: white;">
    <a href="{{ route('users.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-user"></i>      Usuarios</h6></a>
    <a href="{{ route('publicaciones.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-newspaper"></i>      Publicaciones</h6></a>
    <a href="{{ route('comentarios.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-comment"></i>      Comentarios</h6></a>
    <a href="{{ route('reacciones.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-thumbs-up"></i>      Reacciones</h6></a>
    <a href="{{ route('veterinarias.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-paw"></i>      Veterinarias</h6></a>
    <a href="{{ route('adopciones.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-dog"></i>      Adopciones</h6></a>
    <a href="{{ route('eventos.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-calendar-alt"></i>      Eventos</h6></a>
    <a href="{{ route('mensajes.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-envelope"></i>      Mensajes</h6></a>
    <a href="{{ route('chats.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-comments"></i>      Chats</h6></a>
    <a href="{{ route('productos.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-bone"></i>      Productos</h6></a>
    <a href="{{ route('solicitudes.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-paper-plane"></i>      Solicitudes</h6></a>
    <a href="{{ route('ubicaciones.panel') }}" class="btn" role="button" style="margin: 5px;"><h6><i class="fas fa-map-marker-alt"></i>      Ubicaciones</h6></a>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
