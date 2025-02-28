<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="container">
    <h2>
        <a href="{{ route('adopciones.index') }}" class="btn-volver" style="text-decoration: none;">
            <i class="fas fa-arrow-left" style="color: #ff7f50; font-size: 24px;"></i>
        </a>
        Solicitudes para la adopción
    </h2>

    <div class="solicitudes-container">
        @foreach($solicitudes as $solicitud)
            <div class="solicitud-card">
                <p>Contenido: {{ $solicitud->contenido }}</p>

                @if($solicitud->comprobante)
                    <a href="{{ asset('storage/' . $solicitud->comprobante) }}" target="_blank">Ver comprobante</a>
                @endif

                <form action="{{ route('solicitudes.destroy', [$adopcion->id, $solicitud->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta solicitud?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn-eliminar">
                        Eliminar Solicitud
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
