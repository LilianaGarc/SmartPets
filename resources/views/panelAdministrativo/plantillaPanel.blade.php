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
        :root{
            --background-color: #f7f7f7;
            --text-title-color: #032d81;
            --text-color: #32363B;
            --icon-color: #32363B;
            --icon-menu-color: #707780;
            --menu-color: #707780;

            --background-selected: #EBF0FF;
            --background-hover: #F7F9FA;

            --border-color: #E6E9ED;
        }
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body{
            font-family: Arial, sans-serif;
            width: 100%;
            height: 100vh;
        }
        header{
            z-index: 200;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0.45rem 2rem 0.45rem 1.27rem;
            border-bottom: 1px solid var(--border-color);
            position: fixed;
            background-color: white;
            top: 0;
            left: 0;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .left{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.4rem;
        }
        .menu-container{
            height: 100%;
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        .menu{
            width: 1.5rem;
            height: 37%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .menu div{
            width: 100%;
            height: 0.16rem;
            background-color: var(--menu-color);
            transition: all 0.2s ease;
        }
        .menu.menu-toggle div:first-child{
            width: 40%;
            transform: rotate(-35deg) translate(-30%, 175%);
        }
        .menu.menu-toggle div:last-child{
            width: 40%;
            transform: rotate(35deg) translate(-30%, -160%);
        }
        /*Brand*/
        .brand{
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
        }
        .brand .logo{
            width: 15vw;
        }
        .brand .name{
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-title-color);
        }
        .rigth{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1.6rem;
        }
        .rigth a{
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 0.5rem;
            transition: background-color 0.2s ease;
        }
        .rigth a:hover{
            background-color: var(--background-hover);
        }
        .rigth img{
            width: 1.5rem;
            margin: 0.5rem;
        }
        .rigth .user{
            width: 2.1rem;
            border-radius: 50%;
            background-color:  #ff7f50;;

        }
        /*Sidebar elementos*/
        .sidebar{
            margin-top: 4rem;
            width: 4rem;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            padding: 1.1rem 0;
            border-right: 1px solid var(--border-color);
            overflow-y: auto;
            background-color: #18478b;
            transition: width 0.5s ease;
        }
        .sidebar.menu-toggle{
            width: 18.75rem;

        }
        .sidebar a{
           display: flex;
            align-items: center;
            gap: 1.3rem;
            padding: 0.9rem 0.7rem;
            text-decoration: none;
            margin: 0 0.5rem;
            border-radius: 0.5rem;
            white-space: nowrap;
            overflow: hidden;
            color: #ffffff;
        }
        .sidebar a:hover{
            background-color: #a5b5e7;
        }
        .sidebar a.selected{
            background-color: #a5b5e7;
        }
        .sidebar img{
            width: 1.6rem;
        }
        .sidebar ul {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }
        /*Main*/
        main{
            margin-top: 4rem;
            margin-left: 4rem;
            padding: 2rem;
            transition: padding-left 0.5s ease;
        }
        main.menu-toggle {
            margin-left: 18.75rem;
        }
        /*Responsive*/
        @media (max-width: 500px) {
            header{
                height: 7.5vh!important;
            }
            .rigth .icons-header{
                display: none;
            }
            .sidebar{
                width: 0;
            }
            main{
                margin-left: 0!important;
            }
            main.menu-toggle{
                margin-left: 0!important;
            }
            .menu.menu-toggle div:first-child{
                width: 100%;
                transform: rotate(-45deg) translate(-0.2rem, 0.3rem);
            }
            .menu.menu-toggle div:nth-child(2){
                opacity: 0!important;
            }
            .menu.menu-toggle div:last-child{
                width: 100%;
                transform: rotate(45deg) translate(-0.2rem, -0.3rem);
            }

        }

        /*Tablas*/
        .card{
            margin: 0;
            width: 100%;
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
<header>
    <div class="left">
        <div class="menu-container">
            <div class="menu" id="menu">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <div class="brand">
            <img src="{{ asset('images/smartpetspng2.webp') }}" alt="Smart Pets" class="logo">
            <span class="name">Panel Administrativo</span>

        </div>

    </div>
    <div class="rigth">
        <a class="icons-header"><img src="{{ asset('images/home.svg') }}" alt="Smart Pets"></a>
        <a class="icons-header"><img src="{{ asset('images/notificacion.svg') }}" alt="Smart Pets"></a>
        <a class="icons-header"><img src="{{ asset('images/perritoPublicacion.webp') }}" alt="Smart Pets" class="user"></a>
    </div>
</header>

<div class="sidebar" id="sidebar" >
    <nav>
        <ul>
            <li>
                <a href="#" class="selected">
                    <img src="{{ asset('images/principal.svg') }}" alt="Smart Pets">
                    <span>Página principal</span>
                </a>
            </li>
            <li>
                <a href="{{ route('users.panel') }}">
                    <img src="{{ asset('images/user.svg') }}" alt="Smart Pets">
                    <span>Usuarios</span>
                </a>
            </li>
            <li>
                <a href="{{ route('publicaciones.panel') }}">
                    <img src="{{ asset('images/publicaciones.svg') }}" alt="Smart Pets">
                    <span>Publicaciones</span>
                </a>
            </li>
            <li>
                <a href="{{ route('veterinarias.panel') }}">
                    <img src="{{ asset('images/veterinarias.svg') }}" alt="Smart Pets">
                    <span>Veterinarias</span>
                </a>
            </li>
            <li>
                <a href="{{ route('adopciones.panel') }}">
                    <img src="{{ asset('images/adopciones.svg') }}" alt="Smart Pets">
                    <span>Adopciones</span>
                </a>
            </li>
            <li>
                <a href="{{ route('solicitudes.panel') }}">
                    <img src="{{ asset('images/solicitudes.svg') }}" alt="Smart Pets">
                    <span>Solicitudes</span>
                </a>
            </li>
            <li>
                <a href="{{ route('productos.panel') }}">
                    <img src="{{ asset('images/productos.svg') }}" alt="Smart Pets">
                    <span>Productos</span>
                </a>
            </li>
        </ul>
    </nav>
</div>

<main id="main">
    <div class="card">
        <div class="card-body">
            @yield('contenido')
        </div>
    </div>
</main>

<script>
    const menu = document.getElementById('menu');
    const sidebar = document.getElementById('sidebar');
    const main = document.getElementById('main');


    menu.addEventListener('click',()=>{
        sidebar.classList.toggle('menu-toggle');
        menu.classList.toggle('menu-toggle');
        main.classList.toggle('menu-toggle');
    });


</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
