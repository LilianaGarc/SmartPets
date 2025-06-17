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
    <div class="page-title">
        <h1 class="page-title__text">Solicitudes</h1>
    </div>
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

            @if(auth()->user()->id === $adopcion->id_usuario)
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
            @elseif($solicitud && auth()->user()->id === $solicitud->id_usuario)
                <li class="breadcrumb__item breadcrumb__item-active">
                    <a href="{{ route('solicitudes.showDetails', [$adopcion->id, $solicitud->id]) }}" class="breadcrumb__inner">
                        <span class="breadcrumb__title">Mi solicitud</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</div>

<div class="card2-container">
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    draggable: true,
                    confirmButtonColor: '#ff7f50',
                });
            });
        </script>
    @endif

    @if(session('fracaso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('fracaso') }}',
                    confirmButtonColor: '#ff7f50',
                });
            });
        </script>
    @endif
    <div class="card2">
        <div class="card-content">

            <div class="photo" onclick="function openImageModal() { } openImageModal()">
                @if(auth()->user()->id === $solicitud->id_usuario)
                    <h2 style="color: #1e4183;">{{ $adopcion->nombre_mascota }}</h2>
                    @php
                        $fotoMascota = $adopcion->imagen
                            ? asset('storage/' . $adopcion->imagen)
                            : asset('images/default-mascota.webp');
                    @endphp

                    <img src="{{ $fotoMascota }}" alt="Foto de la mascota" class="adopcion-img">
                @else
                    @php
                        $fotoUsuario = $solicitud->usuario->fotoperfil
                            ? asset('storage/' . $solicitud->usuario->fotoperfil)
                            : asset('images/fotodeperfil.webp');
                    @endphp

                    <img src="{{ $fotoUsuario }}" alt="Foto de perfil" class="adopcion-img">
                @endif
            </div>

            <div class="description">
                <h1><strong>
                        @if(auth()->user()->id === $solicitud->id_usuario)
                            Tu solicitud:
                        @else
                            {{ $solicitud->usuario->name }}
                        @endif
                    </strong></h1>
                <p>{{ \Carbon\Carbon::parse($solicitud->created_at)->format('d M Y, H:i') }}</p>
                <p>Motivo de la solicitud: {{ $solicitud->contenido }}</p>
                <p>Experiencia previa: {{ $solicitud->experiencia }}</p>
                <p>Espacio disponible: {{ $solicitud->espacio }}</p>
                <p>Gastos Veterinarios: {{ $solicitud->gastos_veterinarios }}</p>
                <p>Correo: {{ $solicitud->usuario->email }}</p>
                <p style="color: #1e4183;">Estado de la solicitud: <strong>{{ ucfirst($solicitud->estado) }}</strong></p>

                @php
                    $hayAceptada = $adopcion->solicitudes()->where('estado', 'aceptada')->exists();
                @endphp

                <script>
                    const yaHayAceptada = {{ $hayAceptada ? 'true' : 'false' }};
                </script>

                @if(auth()->user()->id === $adopcion->id_usuario && $solicitud->estado !== 'aceptada' && !$hayAceptada)
                    <button type="button" class="action-btn accept-btn" onclick="confirmarAceptarSolicitud({{ $adopcion->id }}, {{ $solicitud->id }})">
                        <i class="fas fa-check-circle"></i> Aceptar Solicitud
                    </button>

                    <form id="form-aceptar-{{ $solicitud->id }}" action="{{ route('solicitudes.aceptar', [$adopcion->id, $solicitud->id]) }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                @elseif(auth()->user()->id === $adopcion->id_usuario && $solicitud->estado !== 'aceptada' && $hayAceptada)
                    @php
                        // Obtener la solicitud aceptada de esta adopción
                        $solicitudAceptada = $adopcion->solicitudes()->where('estado', 'aceptada')->first();
                    @endphp

                    <div class="solicitud-aceptada-box" style="background-color: rgba(255,248,229,0.6); border-left: 5px solid #f0ad4e; padding: 15px 20px; margin-top: 20px; border-radius: 8px;">
                        <p style="color: #d58512; font-size: 16px; font-weight: 600; margin-bottom: 10px;">
                            <i class="fas fa-exclamation-triangle" style="color: #d58512;"></i> Ya has aceptado una solicitud
                        </p>
                        <p style="margin: 0 0 10px; color: #333;">
                            Ya has aceptado una solicitud de adopción. Si deseas aceptar una nueva, primero debes cancelar la solicitud que ya fue aceptada. Por respeto al solicitante y para mantener la transparencia del proceso, es importante que indiques de forma clara el motivo de la cancelación.
                        </p>

                        @if($solicitudAceptada)
                            <p style="margin: 10px 0 0;">
                                <a href="{{ route('solicitudes.showDetails', [$adopcion->id, $solicitudAceptada->id]) }}"
                                   style="color: #d58512; font-weight: 600; font-size: 16px; text-decoration: none;">
                                    Ver solicitud actualmente aceptada <i class="fas fa-hand-pointer" style="margin-left: 6px;"></i>
                                </a>
                            </p>
                        @endif
                    </div>
                @endif




            @if(auth()->user()->id === $adopcion->id_usuario && $solicitud->estado === 'aceptada')
                    <button type="button" class="action-btn cancel-btn" onclick="pedirMotivoCancelar({{ $adopcion->id }}, {{ $solicitud->id }})">
                        <i class="fas fa-times-circle"></i> Cancelar Aceptación
                    </button>

                    <form id="form-cancelar-{{ $solicitud->id }}" action="{{ route('solicitudes.cancelar', [$adopcion->id, $solicitud->id]) }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="motivo_cancelacion" id="motivo-cancelacion-{{ $solicitud->id }}">
                    </form>


                    <form id="form-cancelar-{{ $solicitud->id }}" action="{{ route('solicitudes.cancelar', [$adopcion->id, $solicitud->id]) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif

                @if(auth()->user()->id === $solicitud->id_usuario && $solicitud->estado !== 'aceptada')
                    <div class="boton-container">
                        <form action="{{ route('solicitudes.edit', [$adopcion->id, $solicitud->id]) }}" method="GET">
                            <button type="submit" class="btn-editard">
                                Editar
                            </button>
                        </form>

                        <form action="{{ route('solicitudes.destroy', [$adopcion->id, $solicitud->id]) }}" method="POST" id="delete-form-{{$solicitud->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminard" onclick="confirmDeleteSolicitud({{$adopcion->id}}, {{$solicitud->id}})">
                                Eliminar
                            </button>
                        </form>
                    </div>
                @elseif(auth()->user()->id === $solicitud->id_usuario && $solicitud->estado === 'aceptada')
                    <div class="solicitud-aceptada-box" style="background-color: rgba(30,65,131,0.06); border-left: 5px solid #1e4183; padding: 15px 20px; margin-top: 20px; border-radius: 8px;">
                        <p style="color: #1e4183; font-size: 16px; font-weight: 600; margin-bottom: 10px;">
                            <i class="fas fa-check-circle" style="color: #28a745;"></i> Tu solicitud ha sido aceptada
                        </p>
                        <p style="margin: 0 0 10px; color: #333;">
                            Si por alguna razón deseas cancelarla, deberás ponerte en contacto directamente con el responsable de la publicación de adopción para solicitar la eliminación de tu solicitud.
                        </p>

                        @auth
                            @if(auth()->id() !== $adopcion->id_usuario)
                                <p style="margin: 0;">
                                    <a href="{{ route('chats.iniciar', $adopcion->id_usuario) }}?nombre_mascota={{ urlencode($adopcion->nombre_mascota) }}&mensaje={{ urlencode('Hola ' . $adopcion->usuario->name . ', espero que estés bien. Me gustaría solicitar la cancelación de mi solicitud de adopción para ' . $adopcion->nombre_mascota . '. Agradezco mucho tu tiempo y comprensión.') }}"
                                       class="btn-mensaje-contacto"
                                       style="display: inline-block; background-color: #1e4183; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-weight: bold;">
                                        <i class="fas fa-envelope"></i> Contactar a {{ $adopcion->usuario->name }}
                                    </a>
                                </p>
                            @endif
                        @endauth
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
