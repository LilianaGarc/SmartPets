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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f7f7f7;
            flex-direction: column;
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

            /* Carrusel de historias */
            .historia-card {
                width: 80px;
                text-align: center;
                cursor: pointer;
            }
            .historia-avatar {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                border: 3px solid #25d366;
                object-fit: cover;
            }
            .historia-username {
                font-size: 12px;
                margin-top: 5px;
                color: #333;
            }
            .create-historia .historia-create {
                width: 60px;
                height: 60px;
                border-radius: 50%;
                background-color: #eee;
                font-size: 2rem;
                display: flex;
                align-items: center;
                justify-content: center;
            }

        
            .historia-container {
                position: relative;
                padding: 20px;
            }
            .historia-img {
                max-height: 85vh;
                object-fit: contain;
            }
            .historia-progress-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: rgba(255, 255, 255, 0.3);
            }
            .historia-progress-bar {
                width: 0%;
                height: 100%;
                background: #25d366;
                transition: width 0.1s linear;
            }

            .nueva-historia{
                width: 10rem !important;
                height: auto !important;
            }



        }

    </style>




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
