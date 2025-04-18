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

<div class="card-containerver">
    <div class="card">
        @if(Auth::check() && Auth::id() === $adopcion->id_usuario)
            <div class="dropdown">
                <button class="dropbtn" title="Opciones">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-content">
                    <form action="{{ route('adopciones.edit', $adopcion->id) }}" method="GET">
                        <button type="submit" class="btn-editar-dropdown">
                            Editar
                        </button>
                    </form>

                    <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" id="delete-form-{{$adopcion->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-eliminard" onclick="confirmDeleteAdopcion({{$adopcion->id}})">
                             Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @endif



        <div class="card-content">
            <div class="photo" onclick="function openImageModal() { } openImageModal()">
                @if($adopcion->imagen)
                    <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Imagen de adopción" class="adopcion-img">
                @endif
            </div>

            <div class="description">
                <h1>{{ $adopcion->nombre_mascota }}</h1>
                <h2>{{ $adopcion->tipo_mascota }}</h2>
                <p>{{ \Carbon\Carbon::parse($adopcion->created_at)->format('d M Y, H:i') }}</p>
                <p><strong>{{ $adopcion->contenido }}</strong></p>
                @php
                    use Carbon\Carbon;
                    $fechaNacimiento = Carbon::parse($adopcion->fecha_nacimiento);
                    $edad = $fechaNacimiento->diff(Carbon::now());

                    if ($edad->y == 0 && $edad->m == 0 && $edad->d == 0) {
                        $edadTexto = 'Recién nacido';
                    } else {
                        $edadTexto = $edad->y . ' años, ' . $edad->m . ' meses, ' . $edad->d . ' días';
                    }
                @endphp
                <p><strong>Edad:</strong> {{ $edadTexto }}</p>
                <p><strong>Raza:</strong> {{ $adopcion->raza_mascota }}</p>
                <p><strong>Ubicación:</strong> {{ $adopcion->ubicacion_mascota }}</p>
                @auth
                    @php
                        $miSolicitud = \App\Models\Solicitud::where('id_usuario', auth()->id())
                            ->where('id_adopcion', $adopcion->id)
                            ->first();
                    @endphp

                    <div class="boton-container">
                        @if(auth()->id() === $adopcion->id_usuario)
                            <form action="{{ route('solicitudes.show', ['id_adopcion' => $adopcion->id]) }}" method="GET" style="display: inline-block;">
                                <button type="submit">Solicitudes</button>
                            </form>
                        @else
                            @if(!$miSolicitud)
                                <form action="{{ route('solicitudes.create', ['id_adopcion' => $adopcion->id]) }}" method="GET" style="display: inline-block; margin-right: 10px;">
                                    <button type="submit">Solicitar</button>
                                </form>
                            @else
                                <form action="{{ route('solicitudes.showDetails', ['id_adopcion' => $adopcion->id, 'id' => $miSolicitud->id]) }}" method="GET" style="display: inline-block;">
                                    <button type="submit">Mi Solicitud</button>
                                </form>
                            @endif
                        @endif
                    </div>
                @endauth

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
<script src="{{ asset('js/alerts.js') }}"></script>
</body>
</html>
