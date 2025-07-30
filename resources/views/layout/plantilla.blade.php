<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        window.Laravel = {
            csrfToken: '{{ csrf_token() }}'
        };
    </script>
    <title>@yield('titulo')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    @stack('scripts')
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f7f7f7;
            flex-direction: column;
        }

        .stories-section {
            margin-bottom: 20px;
            padding: 10px 0;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
        }

        .stories-container {
            width: 100%;
            overflow: hidden; /* Important for Swiper */
            padding: 10px 0;
            position: relative;
        }

        /* Swiper specific overrides/enhancements */
        .swiper-container {
            width: 100%;
            height: auto; /* Adjust based on content */
            padding: 10px 0; /* Add some vertical padding */
        }

        .swiper-wrapper {
            display: flex; /* Swiper usually handles this, but good to ensure */
            align-items: center; /* Align items vertically in the center */
        }

        .swiper-slide {
            width: 80px; /* Fixed width for story cards */
            height: 80px; /* Fixed height for story cards */
            border-radius: 50%; /* Make them circular */
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            cursor: pointer;
            position: relative;
            flex-shrink: 0; /* Important for fixed width slides in Swiper */
            margin-right: 15px; /* Spacing between slides */
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Subtle shadow */
            border: 2px solid transparent; /* Default border */
            transition: transform 0.2s ease-in-out; /* Smooth scale on hover */
        }

        .swiper-slide:hover {
            transform: scale(1.05); /* Slightly enlarge on hover */
        }

        /* Styles for the "Create Story" card */
        .create-story-card {
            background: linear-gradient(45deg, #FF6B6B, #5D8BF4); /* Gradient background */
            color: white;
            font-size: 14px;
            font-weight: bold;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .create-story-card .icon {
            font-size: 30px; /* Big plus icon */
            margin-bottom: 5px;
        }

        /* Styles for story cards with images/videos */
        .story-card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            border-radius: 50%; /* Inherit from parent */
        }

        .story-gradient {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: linear-gradient(to top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 50%);
            z-index: 1; /* Above image, below text */
        }

        .story-user-info {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 2;
        }

        .story-user-avatar {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            border: 2px solid white; /* White border around avatar */
            object-fit: cover;
            margin-bottom: 2px;
        }

        .story-user-name {
            color: white;
            font-size: 10px;
            font-weight: bold;
            text-shadow: 0 0 3px rgba(0,0,0,0.5);
            white-space: nowrap; /* Prevent name from wrapping */
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 70px; /* Limit width of name */
        }

        /* Active story card border */
        .swiper-slide.active-story-card {
            border-color: #007bff; /* Highlight border for active story */
        }

        /* Swiper Navigation Arrows */
        .swiper-button-next,
        .swiper-button-prev {
            color: #333 !important; /* Make sure they are visible */
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
            z-index: 10;
        }

        .swiper-button-next::after,
        .swiper-button-prev::after {
            font-size: 20px !important;
            font-weight: bold;
        }

        /* Story Viewer Modal Styles */
        .story-viewer-modal {
            display: none; /* Oculto por defecto */
            position: fixed;
            z-index: 1050; /* Z-index de modal de Bootstrap */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden; /* Para evitar scroll */
            background-color: rgba(0, 0, 0, 0.9); /* Fondo oscuro */
            justify-content: center;
            align-items: center;
        }

        .modal-fullscreen .modal-content {
            background: transparent; /* Fondo transparente para el contenido del modal */
            border: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            width: 100%;
        }

        .story-viewer-header {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            z-index: 1051; /* Por encima del contenido del carrusel */
            display: flex;
            align-items: center;
            color: white; /* Color del texto para el encabezado */
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .story-viewer-user-info {
            display: flex;
            flex-direction: column; /* Cambiado a columna para el nombre y la hora */
            /* Elimina 'align-items: center;' si quieres que el texto se alinee a la izquierda */
            /* Deja 'align-items: flex-start;' si quieres alinear a la izquierda */
            /* Deja 'align-items: center;' si quieres que el texto quede centrado */
        }

        .story-viewer-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
            border: 2px solid white;
        }


        .story-viewer-close {
            position: absolute;
            top: 0px; /* Ajusta según sea necesario */
            right: 0px; /* Ajusta según sea necesario */
            font-size: 3em;
            font-weight: bold;
            color: white;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0 10px;
            line-height: 1;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.5);
        }

        .story-viewer-progress-bar-container {
            position: absolute;
            top: 70px; /* Debajo del header */
            left: 20px;
            right: 20px;
            display: flex;
            gap: 5px; /* Espacio entre las barras */
            z-index: 1051;
            width: calc(100% - 40px);
        }

        .story-viewer-progress-bar {
            height: 4px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 2px;
            overflow: hidden;
            position: relative;
        }

        .story-viewer-progress-bar::after {
            content: '';
            display: block;
            height: 100%;
            background-color: white;
            width: 0%;
            transition: width linear; /* La transición es para la animación */
        }

        #userStoriesCarousel {
            width: 100%;
            height: 100%;
            display: flex; /* Para centrar el carousel-inner */
            align-items: center;
            justify-content: center;
            max-width: 500px; /* Ancho máximo para el carrusel de la historia */
            max-height: 90vh; /* Altura máxima */
            margin: auto;
        }

        #userStoriesCarousel .carousel-inner {
            width: 100%;
            height: 100%;
            position: relative;
        }

        #userStoriesCarousel .carousel-item {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%; /* Asegura que el item ocupe la altura disponible */
            background-color: black; /* Fondo negro por si la imagen no llena todo */
        }

        #userStoriesCarousel .carousel-item img,
        #userStoriesCarousel .carousel-item video {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain; /* Ajusta la imagen/video dentro del contenedor manteniendo la relación de aspecto */
        }

        .story-viewer-caption {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
            color: white;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
            z-index: 1051;
            white-space: pre-wrap; /* Para respetar saltos de línea en el caption */
        }

        /* Navigation buttons inside story viewer (Bootstrap handles this, but here for reference) */
        /* Bootstrap ya provee estas clases, si necesitas personalizarlas puedes hacerlo aquí */
        .carousel-control-prev,
        .carousel-control-next {
            width: 15%; /* Aumenta el área de clic */
            /* Puedes personalizar el ícono y el fondo si es necesario */
        }



        /* Styles for the Story Upload Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            margin: 0;
            font-size: 1.5em;
        }

        .modal-body {
            /* styles for modal body */
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* File input and preview styles */
        .file-input-container {
            margin-bottom: 20px;
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            border-radius: 8px;
        }

        .file-input-container:hover {
            border-color: #007bff;
            color: #007bff;
        }

        .file-input-container input[type="file"] {
            display: none;
        }

        .file-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 15px;
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid #eee;
            padding: 10px;
            border-radius: 5px;
        }

        .file-preview-item {
            position: relative;
            width: 100px;
            height: 100px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .file-preview-item img,
        .file-preview-item video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-preview-item .caption-input {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
            border: none;
            border-top: 1px solid #eee;
            font-size: 0.8em;
            resize: vertical;
            min-height: 30px;
            max-height: 60px;
            overflow-y: auto;
        }

        .remove-file-button {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.9em;
            cursor: pointer;
            line-height: 1;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .loading-spinner {
            display: none;
            border: 4px solid rgba(255,255,255,.2);
            border-top-color: #fff;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .row-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;

        }

        .btn {
            text-decoration: none;
            color: #ffffff;
            background-color: rgba(237,129,25,0.86);
            transition: color 0.3s ease, transform 0.3s ease;
            border-radius: 20px;
            border: none;
        }

        .btn:hover {
            color: #ffffff;
            transform: scale(1.1);
            background-color: #18478b;
        }

        .like-button.liked {
            background-color: #dc3545 !important;
        }

        .like-button.liked:hover {
            background-color: #c82333 !important;
        }


        .card-publicacion{
            width: 50vw;
            height: auto;
            padding: 2vw;
            margin: 0;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            box-sizing: border-box ;
            transition: all .5s ease ;
            overflow-x: auto;
            border: 1px solid #c0c0c0;
            border-radius: 20px;
            z-index: 5;
            background-color: white;
        }

        .card-footer{
            max-width: 50vw;
            height: 40vh;
            overflow: hidden;
            border-radius: 5px;
            margin-top: 10px;
        }

        .footer-img {
            max-width: 50vw;
            height: auto;
            border-radius: 5px;
            margin-top: 10px;
        }

        .imagen-publicacion-reaccion{
            width: 4vw;
            height: 7vh;
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
            margin-top: 1vh;
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

        @keyframes palpitacion {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.15);
            }
        }

        .imagen-publicacion-reaccion.reaccion-activa {
            animation: palpitacion 2s infinite ease-in-out;
            cursor: pointer;
        }


        /*Responsive*/
        @media (max-width: 500px) {
            body{
                margin-top: 10% !important;
            }
            .btn {
                text-size: small;
            }
            .card-publicacion{
                width: 85%;
                height: auto;
                padding: 2vw;
                margin: 1px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
                box-sizing: border-box ;
                transition: all .5s ease ;
                overflow-x: auto;
                border: 1px solid #c0c0c0;
                border-radius: 20px;
                z-index: 5;
                background-color: white;
            }
            .card-footer{
                height: 40%;
                overflow: hidden;
                border-radius: 5px;
                margin-top: 10px;
            }

            .footer-img {
                max-width: 100%;
                height: 100%;
                border-radius: 5px;
                margin-top: 10px;
            }

            .imagen-publicacion-reaccion{
                width: 6vw;
                height: 5vh;
                margin: 0.4%;
            }

            .imagen-publicacion-reaccion:hover{
                transform: scale(1.4);
            }
            .btn{
                font-size: small !important;
                text-align: center;

            }

            .breadcrumb-container {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 2.5vh;
                margin-top: 1vh;
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
                width: auto;
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
                margin: 1px;
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
                font-size: 60%;
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
            hr{
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

<div class="container">
    @yield('contenido')
</div>
@yield('footer', View::make('MenuPrincipal.footer2'))

<script>
    window.onload = function() {
        var alert = document.querySelector('.alert');

        if (alert) {
            setTimeout(function() {
                alert.style.display = 'none';
            }, 2000);
        }
    };
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
