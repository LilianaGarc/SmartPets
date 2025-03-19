<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Detalles de Adopción</title>
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
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('adopciones.show', $adopcion->id) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Ver Adopción</span>
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
                    <th>Usuario</th>
                    <td>Anonymus</td>
                </tr>
                <tr>
                    <th>Fecha de Publicación</th>
                    <td>{{ \Carbon\Carbon::parse($adopcion->created_at)->format('d M Y, H:i') }}</td>
                </tr>
                <tr>
                    <th>Contenido de la Publicación</th>
                    <td>{{ $adopcion->contenido }}</td>
                </tr>
                <tr>
                    <th>Tipo</th>
                    <td>Perro</td>
                </tr>
                <tr>
                    <th>Nombre de mascota</th>
                    <td>Firulais</td>
                </tr>

            </table>
        </div>

        <div class="comprobante-container">
            @if($adopcion->imagen)
                <div>
                    <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Imagen de adopción" class="adopcion-img" id="imageClick">
                </div>
                <div class="download-button-container">
                    <a href="{{ asset('storage/' . $adopcion->imagen) }}" download class="Btn-download">
                        <svg class="svgIcon" viewBox="0 0 384 512" height="1em" xmlns="http://www.w3.org/2000/svg">
                            <path d="M169.4 470.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 370.8 224 64c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 306.7L54.6 265.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"></path>
                        </svg>
                        <span class="icon2"></span>
                        <span class="tooltip">Descargar</span>
                    </a>
                </div>
            @endif
        </div>


    </div>
    <div class="boton-container">
        <form action="{{ route('solicitudes.create', ['id_adopcion' => $adopcion->id]) }}" method="GET" style="display: inline-block; margin-right: 10px;">
            <button type="submit" class="btn btn-success">
                Solicitar
            </button>
        </form>

        <form action="{{ route('solicitudes.show', ['id_adopcion' => $adopcion->id]) }}" method="GET" style="display: inline-block;">
            <button type="submit" class="btn btn-success">
                 Solicitudes
            </button>
        </form>
    </div>
</div>


<div id="imageModal" class="modal">
    <span class="close">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<script src="{{ asset('js/Modalscripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
