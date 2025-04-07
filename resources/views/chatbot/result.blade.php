<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Mascota Ideal</title>
    <link rel="stylesheet" href="{{ asset('css/mascotaideal.css') }}">

</head>
<body>
@include('MenuPrincipal.Navbar')
<form action="{{ route('chatbot.reiniciar') }}" method="GET">
    <div class="resultado-container">
        <h1>
            {{ $tipoMascota == 'Perro' ? '¡Tu tipo de mascota ideal es: Perro!' :
               ($tipoMascota == 'Gato' ? '¡Tu tipo de mascota ideal es: Gato!' :
               ($tipoMascota == 'Conejo' ? '¡Tu tipo de mascota ideal es: Conejo!' :
               ($tipoMascota == 'Tortuga' ? '¡Tu tipo de mascota ideal es: Tortuga!' :
               '¡Algo salió mal, no pudimos determinar tu mascota ideal.'))) }}
        </h1>
        <p>¡Gracias por completar el cuestionario!</p>

        <h2>Resumen de tus respuestas:</h2>
        <ul>
            @foreach($tipoMascotaCount as $tipo => $count)
                <li>{{ $tipo }}: {{ $count }} respuestas</li>
            @endforeach
        </ul>

        <div class="mascota-imagen-container">
            @if($tipoMascota == 'Perro')
                <img src="{{ asset('images/miperro.webp') }}" alt="Perro" class="mascota-imagen">
            @elseif($tipoMascota == 'Gato')
                <img src="{{ asset('images/migato.webp') }}" alt="Gato" class="mascota-imagen">
            @elseif($tipoMascota == 'Conejo')
                <img src="{{ asset('images/miconejo.webp') }}" alt="Conejo" class="mascota-imagen">
            @elseif($tipoMascota == 'Tortuga')
                <img src="{{ asset('images/mitortuga.webp') }}" alt="Tortuga" class="mascota-imagen">
            @else
                <p>¡Ups! Algo salió mal, no pudimos determinar tu mascota ideal.</p>
            @endif
        </div>

        <button type="submit" class="reiniciar-btn">Reiniciar Cuestionario</button>
    </div>
</form>
</body>
</html>
