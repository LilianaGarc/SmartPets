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

<div class="card2-container">
    <div class="card2">
        <div class="card-content">
            <div class="photo" onclick="function openImageModal() {
            }
            openImageModal()">

                @php
                    $foto = $solicitud->usuario->fotoperfil
                        ? asset('storage/' . $solicitud->usuario->fotoperfil)
                        : asset('images/fotodeperfil.webp');
                @endphp

                <img src="{{ $foto }}" alt="Foto de perfil" class="adopcion-img">

            </div>
            <div class="description">
                <h1><strong></strong> {{ $solicitud->usuario->name }}</h1>
                <p>{{ \Carbon\Carbon::parse($solicitud->created_at)->format('d M Y, H:i') }}</p>
                <p>Motivo de la solicitud: {{ $solicitud->contenido }}</p>
                <p>Experiencia previa: {{ $solicitud->experiencia }}</p>
                <p>Espacio disponible: {{ $solicitud->espacio }}</p>
                <p>Gastos Veterinarios: {{ $solicitud->gastos_veterinarios }}</p>

                @if(auth()->user()->id === $adopcion->id_usuario)
                    <div class="solicitud-actions">
                        <button class="action-btn accept-btn">
                            <i class="fas fa-check-circle"></i> Aceptar Solicitud
                        </button>
                        <button class="action-btn reject-btn">
                            <i class="fas fa-times-circle"></i> Rechazar Solicitud
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>

<script src="{{ asset('js/alerts.js') }}"></script>
<script src="{{ asset('js/Modalscripts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
