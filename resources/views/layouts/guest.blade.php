<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', config('app.name', 'Laravel'))</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset(path: 'css/all.min.css') }}">

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script>
        document.addEventListener("mousemove", function (e) {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            document.body.style.backgroundPosition = `${50 + x * 10}% ${50 + y * 10}%`;
        });
    </script>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Montserrat", sans-serif;
        }

        html, body {
            width: 100%;
            height: 100dvh;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        body {
            width: 100%;
            min-height: 100dvh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-y: auto !important;
            font-family: "Montserrat", sans-serif;
            background: url('{{ asset('images/fondohuellas.png') }}') no-repeat center center fixed;
            background-size: cover;
        }


        .container {
            width: 800px;
            height: 500px;
            display: flex;
            position: relative;
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            z-index: 10;
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.03);
        }

        .image-esquina {
            position: fixed;
            z-index: 1;
            width: 30vw;
            height: auto;
        }

        .image-superior-derecha {
            top: 0;
            right: 0;
        }

        .image-inferior-izquierda {
            bottom: 0;
            left: 0;
        }

        .container-form {
            width: 100%;
            overflow: hidden;
        }

        .container-form form {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            transition: transform 0.5s ease-in-out;
        }

        .container-form h2 {
            font-size: 30px;
            margin-bottom: 20px;
        }

        .container-form span {
            font-size: 12px;
            margin-bottom: 15px;
        }

        .container-input {
            width: 300px;
            height: 40px;
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            padding: 0 15px;
            background-color: #eeeeee;
        }

        .container-input input {
            border: none;
            outline: none;
            width: 100%;
            height: 100%;
            background-color: inherit;
        }

        .container-form a {
            color: black;
            font-size: 14px;
            margin-bottom: 20px;
            margin-top: 5px;
        }

        .container-form button {
            width: 170px;
            height: 45px;
            font-size: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            background-color: #ff7f50;
            color: white;
        }

        .button {
            width: 170px;
            height: 45px;
            font-size: 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            color: white;
            background-color: transparent;
        }

        /* Animacion del formulario */
        .sign-up {
            transform: translateX(-100%);
        }

        .container.toggle .sign-in {
            transform: translateX(100%);
        }

        .container.toggle .sign-up {
            transform: translateX(0);
        }

        /* Welcome */
        .container-welcome {
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            transform: translateX(100%);
            background-color: #18478b;
            transition: transform 0.5s ease-in-out, border-radius 0.5s ease-in-out;
            overflow: hidden;
            border-radius: 50% 0 0 50%;
        }

        .container.toggle .container-welcome {
            transform: translateX(0);
            border-radius: 0 50% 50% 0;
            background-color: #ff7f50;
        }

        .container.toggle .container-form button {
            background-color: #18478b;
        }

        .container-welcome .welcome {
            position: absolute;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            padding: 0 50px;
            color: white;
            transition: transform 0.5s ease-in-out;
        }

        .welcome-sign-in {
            transform: translateX(100%);
        }

        .container-welcome h3 {
            font-size: 40px;
        }

        .container-welcome p {
            font-size: 14px;
            text-align: center;
        }

        .container-welcome .button {
            border: 2px solid white;
        }

        .container.toggle .welcome-sign-in {
            transform: translateX(0);
        }

        .container.toggle .welcome-sign-up {
            transform: translateX(-100%);
        }

        .welcome-image {
            width: 17vw;
            height: auto;
            margin-bottom: -10vh;
            margin-top: -5vh;
        }

        /* Cambio, reduccion de pantalla */
        @media (max-width: 768px) {
            #animated-gif {
                display: none;
            }

            .container {
                width: 100vw;
                height: 100dvh;
                min-height: 100dvh;
                max-height: 100dvh;
                overflow: hidden !important;
                flex-direction: column;
                border-radius: 0;
            }

            .container-form {
                width: 100%;
                height: 50%;
                transform: translateY(0);

            }

            .sign-up {
                transform: translateY(100%);
            }

            .container.toggle .sign-in {
                transform: translateY(-100%);
            }

            .container.toggle .sign-up {
                transform: translateY(0);
            }

            .container-welcome {
                width: 100%;
                height: 50%;
                background-color: #18478b;
                transform: translateY(100%);
                border-radius: 0 !important;
            }

            .container.toggle .container-welcome {
                transform: translateY(0);
                background-color: #ff7f50;
            }

            .container-welcome .welcome {
                gap: 15px;
            }

            .container-welcome h3 {
                font-size: 25px;
            }

            .container-welcome p {
                font-size: 12px;
            }

            .container-welcome .button {
                border: 1px solid white !important;
                background-color: transparent !important;
            }

            .welcome-image {
                width: 30vw;
                height: auto;
            }

            .container .button {
                width: 100%;
                height: 45px;
                font-size: 15px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                margin-top: 10px;
                background-color: #ff7f50;
                color: white;
            }
        }

        @media (max-width: 576px) {
            .container-form h2 {
                font-size: 24px;
            }

            .container-form span {
                font-size: 10px;
            }

            .container-input {
                width: 80%;
            }

            .container-input input {
                font-size: 14px;
            }

            .container-welcome h3 {
                font-size: 22px;
            }

            .welcome-image {
                width: 40vw;
            }

            .container-welcome .button {
                font-size: 14px;
            }
            .welcome-image {
                width: 60vw;
                height: auto;
                margin-bottom: -60px !important;
            }
        }

        @media (min-width: 769px) {
            .container {
                flex-direction: row;
            }

            .container-form {
                width: 50%;
            }

            .container-welcome {
                width: 50%;
                background-color: #18478b;
                transform: translateX(100%);
                border-radius: 50% 0 0 50%;
            }

            .container.toggle .container-welcome {
                transform: translateX(0);
                background-color: #ff7f50;
            }

            .container.toggle .container-form button {
                background-color: #18478b;
            }

            .container-welcome .welcome {
                gap: 10px;
            }

            .container-welcome h3 {
                font-size: 40px;
            }

            .container-welcome p {
                font-size: 14px;
            }
        }

        .floating-gif {
            position: fixed;
            bottom: 0;
            left: 50%;
            width: 120px;
            height: 120px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
            pointer-events: auto;
            cursor: pointer;
            transition: left 1s ease-in-out;
            z-index: 9999;
            transform: translateX(-50%);
            background-image: url('{{ asset('images/gato1.gif') }}');
        }

        .alert-error {
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            background: #fff5f5;
            border: 1px solid #fed7d7;
            color: #e53e3e;
            padding: 10px 20px;
            border-radius: 4px;
            z-index: 10000;
        }

        .container-form {
            position: relative;
        }

        .home-button {
            position: absolute;
            top: 10px;
            left: 10px;
            display: inline-flex;
            align-items: center !important;
            justify-content: center !important;
            gap: 6px;
            color: white;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
            z-index: 10;
            transition: background-color 0.3s ease;
        }

        .home-button i {
            font-size: 16px;
            line-height: 1;
        }

        .home-button span {
            line-height: 1;
            display: flex;
            align-items: center;
        }

        .home-button:hover{
            transform: scale(1.03);
            background-color: #18478b;
            color: white;
        }

    </style>

</head>
<body>


{{ $slot }}



</body>
</html>

