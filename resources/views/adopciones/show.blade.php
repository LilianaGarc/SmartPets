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


<div class="card">
    <nav>
        <span class="usuario">{{"Anonymous" }}</span>
    </nav>

    <div class="card-content">
        <div class="photo" onclick="function openImageModal() {
            }
            openImageModal()">
            @if($adopcion->imagen)
                <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Imagen de adopción" class="adopcion-img">
            @endif

                <div class="wrapper">
                    <a href="{{ asset('storage/' . $adopcion->imagen) }}" class="c-btn" download>
                        <span class="c-btn__label">Download
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.50005 1.04999C7.74858 1.04999 7.95005 1.25146 7.95005 1.49999V8.41359L10.1819 6.18179C10.3576 6.00605 10.6425 6.00605 10.8182 6.18179C10.994 6.35753 10.994 6.64245 10.8182 6.81819L7.81825 9.81819C7.64251 9.99392 7.35759 9.99392 7.18185 9.81819L4.18185 6.81819C4.00611 6.64245 4.00611 6.35753 4.18185 6.18179C4.35759 6.00605 4.64251 6.00605 4.81825 6.18179L7.05005 8.41359V1.49999C7.05005 1.25146 7.25152 1.04999 7.50005 1.04999ZM2.5 10C2.77614 10 3 10.2239 3 10.5V12C3 12.5539 3.44565 13 3.99635 13H11.0012C11.5529 13 12 12.5528 12 12V10.5C12 10.2239 12.2239 10 12.5 10C12.7761 10 13 10.2239 13 10.5V12C13 13.1041 12.1062 14 11.0012 14H3.99635C2.89019 14 2 13.103 2 12V10.5C2 10.2239 2.22386 10 2.5 10Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </span>
                    </a>
                </div>

        </div>

        <div class="description">
            <h1>{{ $adopcion->nombre_mascota }}</h1>
            <h2>{{ $adopcion->tipo_mascota }}</h2>

            <p>{{ \Carbon\Carbon::parse($adopcion->created_at)->format('d M Y, H:i') }}</p>

            <p>{{ $adopcion->contenido }}</p>

            <div class="boton-container">
                <form action="{{ route('solicitudes.create', ['id_adopcion' => $adopcion->id]) }}" method="GET" style="display: inline-block; margin-right: 10px;">
                    <button type="submit">Solicitar</button>
                </form>

                <form action="{{ route('solicitudes.show', ['id_adopcion' => $adopcion->id]) }}" method="GET" style="display: inline-block;">
                    <button type="submit">Solicitudes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<script src="{{ asset('js/Modalscripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
