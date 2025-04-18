<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servidor no disponible - 500</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .error-image {
            width: 100%;
            max-width: 600px;
            height: auto;
        }

        p {
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>

@include('MenuPrincipal.Navbar')

<img src="{{ asset('images/error5000.webp') }}" alt="Error 404" class="error-image">
<p>Lo sentimos, presentamos Error interno del servidor.</p>

</body>
</html>
