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
            margin-top: 5rem;
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
            margin-left: 5vw;
        }

        .left-section {
            position: fixed;
            top: 55px;
            left: 0;
            width: 250px;
            height: 100%;
            background-color: #18478b;
            padding: 20px;
            box-sizing: border-box;
            border-color: #100f0f;
            box-shadow: 5px 0 30px rgba(0,0,0,.1);
            transition: all .5s ease;
        }

        .left-section a {
            text-decoration: none;
            color: #ffffff;
            font-size: 1rem;
            margin: 0 1.5vw;
            transition: color 0.3s ease, transform 0.3s ease;
            background-color: #18478b;
            width: 90%;
        }

        .left-section a:hover {
            color: #18478b;
            transform: scale(1.1);
        }

        .table {
            margin: 15px;
        }

    </style>



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

<div class="card">
    <div class="card-body">
        @yield('contenido')
    </div>
</div>



</div>

<div class="left-section">
    <br>
    <a href="{{ route('users.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Usuarios</h6></a>
    <a href="{{ route('publicaciones.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Publicaciones</h6></a>
    <a href="{{ route('comentarios.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Comentarios</h6></a>
    <a href="{{ route('reacciones.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Reacciones</h6></a>
    <a href="{{ route('veterinarias.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Veterinarias</h6></a>
    <a href="{{ route('adopciones.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Adopciones</h6></a>
    <a href="{{ route('eventos.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Eventos</h6></a>
    <a href="{{ route('mensajes.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Mensajes</h6></a>
    <a href="{{ route('chats.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Chats</h6></a>
    <a href="{{ route('productos.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Productos</h6></a>
    <a href="{{ route('solicitudes.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Solicitudes</h6></a>
    <a href="{{ route('ubicaciones.panel') }}" class="btn btn-light " style="margin: 5px;"><h6>Ubicaciones</h6></a>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
