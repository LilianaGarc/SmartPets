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
            margin-left: 17rem;
            margin-top: 9rem;
            margin-right: 1rem;
            margin-bottom: 70rem;
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
            margin-left: 0vw;
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
            top: 80px;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #18478b;
            padding: 30px;
            box-sizing: border-box;
            border-color: #100f0f;
            box-shadow: 5px 0 30px rgba(0,0,0,.1);
            transition: all .5s ease;
        }

        .left-section a {
            text-decoration: none;
            color: #ffffff;
            font-size: 2rem;
            margin: 2rem;
            transition: color 0.3s ease, transform 0.3s ease;
            background-color: #18478b;
            width: 90%;
            text-align: left;
            display: block;
        }

        .left-section btn{
            margin: 3px;
            font-size: 10px;
        }

        .left-section a:hover {
            color: #ff7f50;
            transform: scale(1.1);
            background-color: #ffffff;
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
        <a href="#"><i class="fas fa-user-circle"></i> Perfil</a>
        <a href="#"><i class="fas fa-cogs"></i> Ajustes</a>
        <a href="#"><i class="fas fa-sign-out-alt"></i> Salir</a>
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
