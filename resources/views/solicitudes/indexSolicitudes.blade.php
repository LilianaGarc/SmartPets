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
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('solicitudes.show', $adopcion->id) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Solicitudes</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="container2">
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

    <div class="solicitudes-container">
        @if($solicitudes->isEmpty())
            <div class="no-hay">
                @if(auth()->user()->id === $adopcion->id_usuario)
                    <p class="no-hay-message">¡Aún no hay solicitudes para tu mascota! 😿</p>
                @else
                    <p class="no-hay-message">¡No has hecho ninguna solicitud aún! 😿</p>
                @endif
                <img src="{{ asset('images/vacio.svg') }}" alt="No hay solicitudes" class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
            </div>
        @else
            @foreach($solicitudes as $solicitud)
                @php
                    $estadoClase = $solicitud->estado === 'aceptada' ? 'solicitud-card aceptada' : 'solicitud-card';
                $foto = $solicitud->usuario->fotoperfil
                            ? asset('storage/' . $solicitud->usuario->fotoperfil)
                            : asset('images/fotodeperfil.webp');
                @endphp

                <div class="{{ $estadoClase }}">
                    <div class="content-wrapper">
                        <div class="foto-perfil" style="background-image: url('{{ $foto }}');"></div>
                        <p class="solicitud-textt"><strong></strong> {{ $solicitud->usuario->name }}:</p>
                        <p class="solicitud-text">{{ $solicitud->contenido }}</p>
                        <p class="estado-label"> <strong>{{ ucfirst($solicitud->estado) }}</strong></p>

                        @if(auth()->user()->id === $adopcion->id_usuario)
                            <div class="tooltip">
                                <a href="{{ route('solicitudes.showDetails', [$adopcion->id, $solicitud->id]) }}" class="btn-view">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <span class="tooltiptext">Ver solicitud</span>
                            </div>
                        @else
                            @if(auth()->user()->id === $solicitud->id_usuario)
                                <div class="tooltip">
                                    <a href="{{ route('solicitudes.showDetails', [$adopcion->id, $solicitud->id]) }}" class="btn-view">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <span class="tooltiptext">Ver solicitud</span>
                                </div>

                                @if($solicitud->estado !== 'aceptada')
                                    <div class="tooltip">
                                        <a href="{{ route('solicitudes.edit', [$adopcion->id, $solicitud->id]) }}" class="btn-editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <span class="tooltiptext">Editar solicitud</span>
                                    </div>

                                    <div class="tooltip">
                                        <form action="{{ route('solicitudes.destroy', [$adopcion->id, $solicitud->id]) }}" method="POST" id="delete-form-{{$solicitud->id}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn-eliminar" onclick="confirmDeleteSolicitud({{$adopcion->id}}, {{$solicitud->id}})">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                            <span class="tooltiptext">Eliminar solicitud</span>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script src="{{ asset('js/alerts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
