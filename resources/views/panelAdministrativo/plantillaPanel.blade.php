<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panel Administrativo</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset(path: 'css/all.min.css') }}">
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
            height: 100%;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
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
            background-color: rgba(237,129,25,0.86);

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
        .sidebar a.selected,
        .sidebar li.selected > a {
            background-color: #a5b5e7;
            color: #fff;
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
            .hide-profile-name{
                display: none !important;
            }
            .name{
                font-size: small !important;
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
            background-color: rgba(237,129,25,0.86);
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
            width: 9vh;
            height: 9vh;
            border-radius: 50%;
            border: none;
            background-color: #ffffff;
            justify-content: center;
            align-items: center;
            border: 4px solid #18478b;
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
            background-color: rgba(237,129,25,0.86);
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
            color: rgba(237,129,25,0.86);
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
        .rigth .username {
            display: block;
            cursor: pointer;
            position: absolute;
            right: 6vw;
            z-index: 110;
            font-size: 1.2rem;
            color: #1e1e1e;
            font-weight: 600;
            gap: 8px;
        }


        .rigth .username span {
            display: inline-block;
            padding-left: 5px;
        }

        .rigth .username a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
        }

        .dropdown-menu-custom {
            position: absolute;
            top: 3.5rem;
            right: 0;
            background-color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 0.5rem;
            min-width: 180px;
            opacity: 0;
            transform: translateY(-10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            pointer-events: none;
        }

        .dropdown-menu-custom.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
            position: absolute !important;
            z-index: 1050;
        }

        .dropdown-menu-custom button {
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            padding: 0.5rem 1rem;
            font-size: 1rem;
            color: #18478b;
            border-radius: 6px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .dropdown-menu-custom button:hover {
            background-color: #ffffff;
            color: rgba(237,129,25,0.86);
        }

        .dropdown-menu-custom.show {
            opacity: 1;
            transform: translateY(0);
            pointer-events: auto;
            position: absolute !important;
            z-index: 1050;
        }


         .imagen-ajustada {
             width: 200px;
             height: 200px;
             object-fit: cover;
             border-radius: 10px;
             display: block;
         }

        .card {
            overflow: visible !important;
            position: relative !important;
        }

        .card-nuevo-comentario {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            max-width: 800px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border: 1px solid #c0c0c0;
            border-radius: 8px 8px 0 0;
            z-index: 1000;
            background-color: white;
            padding: 10px;
        }

        .no-transition {
            transition: none !important;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .custom-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-card img {
            max-height: 150px;
            width: auto;
            object-fit: cover;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .custom-card h5 {
            font-weight: bold;
            color: #18478b;
            margin-bottom: 10px;
        }

        .custom-card p {
            color: #333;
            font-size: 0.95rem;
        }

        .card-link {
            text-decoration: none;
            color: inherit;
        }

        .custom-card {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, opacity 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .custom-card img {
            max-height: 150px;
            width: auto;
            object-fit: cover;
            margin-bottom: 15px;
            border-radius: 8px;
        }

        .custom-card h5 {
            font-weight: bold;
            color: #18478b;
            margin-bottom: 10px;
        }

        .custom-card p {
            color: #333;
            font-size: 0.95rem;
        }

        .row:hover .custom-card {
            opacity: 0.5;
            transform: scale(1);
        }

        .row .custom-card:hover {
            opacity: 1;
            transform: scale(1.05);
            z-index: 1;
        }
        .truncate-cell {
            max-width: 150px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
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

        @auth
            <div class="username" id="userDropdown">
                <a href="javascript:void(0);">
                    <img
                        src="{{ Auth::user()->fotoperfil ? asset('storage/' . Auth::user()->fotoperfil) : asset('images/fotodeperfil.webp') }}"
                        alt="Foto de perfil"
                        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                    <span class="hide-profile-name">{{ Auth::user()->name }}</span>
                </a>

                <div id="dropdownMenu" class="dropdown-menu-custom hidden">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">
                            <i class="fas fa-sign-out-alt me-2"></i> Salir
                        </button>
                    </form>
                </div>
            </div>

        @endauth
    </div>
</header>

<div class="sidebar" id="sidebar" >
    <nav>
        <ul>
            <li>
                <a href="{{ route('panel.dashboard') }}">
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
                <a href="{{ route('productos.panel') }}">
                    <img src="{{ asset('images/productos.svg') }}" alt="Smart Pets">
                    <span>Productos</span>
                </a>
            </li>
            <li>
                <a href="{{ route('eventos.panel') }}">
                    <img src="{{ asset('images/evento.png') }}" alt="Smart Pets">
                    <span>Eventos</span>
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
    (function () {
        const menu = document.getElementById('menu');
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('main');

        // ---- Guardar y cargar estado del sidebar ----
        function cargarEstadoSidebar() {
            const sidebarActivo = localStorage.getItem('sidebarActivo');
            if (sidebarActivo === 'true') {
                sidebar.classList.add('no-transition');
                menu.classList.add('no-transition');
                main.classList.add('no-transition');
                sidebar.classList.add('menu-toggle');
                menu.classList.add('menu-toggle');
                main.classList.add('menu-toggle');
                setTimeout(() => {
                    sidebar.classList.remove('no-transition');
                    menu.classList.remove('no-transition');
                    main.classList.remove('no-transition');
                }, 100);
            } else {
                sidebar.classList.remove('menu-toggle');
                menu.classList.remove('menu-toggle');
                main.classList.remove('menu-toggle');
            }
        }

        menu.addEventListener('click', () => {
            sidebar.classList.toggle('menu-toggle');
            menu.classList.toggle('menu-toggle');
            main.classList.toggle('menu-toggle');
            const activo = sidebar.classList.contains('menu-toggle');
            localStorage.setItem('sidebarActivo', activo);
        });

        // ---- Dropdown usuario ----
        const userDropdown = document.getElementById('userDropdown');
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (userDropdown && dropdownMenu) {
            userDropdown.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });
            document.addEventListener('click', () => dropdownMenu.classList.remove('show'));
        }

        // ---- Lógica para marcar el enlace activo ----
        const sidebarLinks = document.querySelectorAll('.sidebar a');

        function getModuleFromPath(pathname) {
            const parts = String(pathname).replace(/\/+$/, '').split('/').filter(Boolean);

            if (!parts.length) return null;

            // Si empieza con "panel"
            if (parts[0] === 'panel') {
                if (parts[1] === 'buscar') return parts[2] || null;
                return parts[1] || null;
            }

            // Si es ruta pública
            return parts[0];
        }

        function marcarEnlaceActivo() {
            const currentModule = getModuleFromPath(window.location.pathname);
            sidebarLinks.forEach(link => {
                link.classList.remove('selected');
                if (link.parentElement.tagName === 'LI') {
                    link.parentElement.classList.remove('selected');
                }
                const linkPath = new URL(link.getAttribute('href'), window.location.origin).pathname;
                const linkModule = getModuleFromPath(linkPath);
                if (currentModule && linkModule && currentModule === linkModule) {
                    link.classList.add('selected');
                    if (link.parentElement.tagName === 'LI') {
                        link.parentElement.classList.add('selected');
                    }
                }
            });
        }

        window.addEventListener('load', () => {
            cargarEstadoSidebar();
            marcarEnlaceActivo();
        });
    })();
</script>


<script>

</script>
<script src="{{ asset(path: 'js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset(path: 'js/jquery.min.js') }}"></script>
<script src="{{ asset(path: 'js/popper.min.js') }}"></script></body>
</html>
