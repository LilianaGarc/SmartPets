<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Solicitudes</title>
</head>
<body>
@include('MenuPrincipal.Navbar')
<div class="container">
    <div class="breadcrumb-container">
        <ul class="breadcrumb">
            <li class="breadcrumb__item">
                <a href="{{ route('index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Inicio</span>
                </a>
            </li>
            <li class="breadcrumb__item">
                <a href="{{ route('adopciones.index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Adopciones</span>
                </a>
            </li>
            <li class="breadcrumb__item">
                <a href="{{ route('adopciones.show', $adopcion->id) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Ver Adopción</span>
                </a>
            </li>
            <li class="breadcrumb__item">
                <a href="{{ route('solicitudes.show', $adopcion->id) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Solicitudes</span>
                </a>
            </li>
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('solicitudes.showDetails', [$adopcion->id, $solicitud->id]) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Ver solicitud</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="container2">

    <div class="solicitud-detalle">
        <div class="solicitud-info">
            <table class="table">
                <tr>
                    <th>Motivo de la solicitud</th>
                    <td>{{ $solicitud->contenido }}</td>
                </tr>
                <tr>
                    <th>Experiencia previa</th>
                    <td>{{ $solicitud->experiencia }}</td>
                </tr>
                <tr>
                    <th>Tipo de vivienda</th>
                    <td>{{ $solicitud->vivienda }}</td>
                </tr>
                <tr>
                    <th>Espacio disponible</th>
                    <td>{{ $solicitud->espacio }}</td>
                </tr>
                <tr>
                    <th>Otros Animales</th>
                    <td>{{ $solicitud->otros_animales }}</td>
                </tr>
                <tr>
                    <th>Gastos Veterinarios</th>
                    <td>{{ $solicitud->gastos_veterinarios }}</td>
                </tr>
            </table>
        </div>

        <div class="comprobante-container">
            @if($solicitud->comprobante)
                <div>
                    <a href="{{ asset('storage/' . $solicitud->comprobante) }}" target="_blank">
                        <img src="{{ asset('storage/' . $solicitud->comprobante) }}" alt="Comprobante">
                    </a>
                </div>
                <div class="download-button-container">
                    <a href="{{ asset('storage/' . $solicitud->comprobante) }}" download class="Btn-download">
                        <svg class="svgIcon" viewBox="0 0 384 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                            <path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"></path>
                        </svg>
                        <span class="icon2"></span>
                    </a>
                </div>
            @endif
        </div>

    </div>
</div>


<script src="{{ asset('js/alerts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
