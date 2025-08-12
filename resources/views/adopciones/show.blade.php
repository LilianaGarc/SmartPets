<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>Detalles de Adopción</title>
    <link rel="stylesheet" href="{{ asset(path: 'css/all.min.css') }}">
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="container">
    <div class="page-title">
        <h1 class="page-title__text">Mascotas en Adopción</h1>
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
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('adopciones.show', $adopcion->id) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Ver Adopción</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="card-containerverX">
    <div class="cardX">
        @if(Auth::check() && Auth::id() === $adopcion->id_usuario)
            <div class="dropdown">
                <button class="dropbtn" title="Opciones">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-content">
                    <form action="{{ route('adopciones.edit', $adopcion->id) }}" method="GET">
                        <button type="submit" class="btn-editar-dropdown">✏️ Editar
                        </button>
                    </form>

                    <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" id="delete-form-{{$adopcion->id}}">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn-eliminard" onclick="confirmDeleteAdopcion({{$adopcion->id}})">
                            🗑️ Eliminar
                        </button>
                    </form>
                </div>
            </div>
        @endif
            <div class="header">
                <div class="pet-greeting">
                    <h1>¡Hola! Soy {{ $adopcion->nombre_mascota }}</h1>
                    <p>Estoy buscando un hogar lleno de amor donde me cuiden y me hagan feliz. ¿Quieres ser mi nueva familia?. Aquí encontrarás toda mi información para que puedas conocerme mejor.</p>


                </div>
            </div>


            <div class="card-contentX">
            <div class="photosX">
                @if($adopcion->imagen)
                    <img id="mainImage" src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Imagen de adopción" class="adopcion-imgX">
                @endif


            </div>

            <div class="descriptionsX">
                <h1>{{ $adopcion->nombre_mascota }}</h1>
                <h2>{{ $adopcion->tipo_mascota }}</h2>
                <p>Publlicado el {{ \Carbon\Carbon::parse($adopcion->created_at)->format('d M Y, H:i') }}</p>
                <div class="detalle-item contenido-detalle">
                    <span>{{ $adopcion->contenido }}</span>
                </div>
                @php
                    use Carbon\Carbon;

                    $fechaNacimiento = Carbon::parse($adopcion->fecha_nacimiento);
                    $edad = $fechaNacimiento->diff(Carbon::now());
                    $diferenciaHoras = $fechaNacimiento->diffInHours(Carbon::now());

                    if ($diferenciaHoras < 24) {
                        $edadTexto = 'Recién nacido';
                    } else {
                        $edadTexto = '';

                        if ($edad->y == 1) {
                            $edadTexto .= '1 año, ';
                        } elseif ($edad->y > 1) {
                            $edadTexto .= $edad->y . ' años, ';
                        }

                        if ($edad->m == 1) {
                            $edadTexto .= '1 mes, ';
                        } elseif ($edad->m > 1) {
                            $edadTexto .= $edad->m . ' meses, ';
                        }

                        if ($edad->d == 1) {
                            $edadTexto .= '1 día';
                        } elseif ($edad->d > 1) {
                            $edadTexto .= $edad->d . ' días';
                        }
                    }
                @endphp

                <div class="detalle-item">
                    <i class="fas fa-birthday-cake"></i>
                    <span>Edad: {{ $edadTexto }}</span>
                </div>
                <div class="detalle-item">
                    <i class="fas fa-dog"></i>
                    <span>Raza: {{ $adopcion->raza_mascota }}</span>
                </div>
                <div class="detalle-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Ubicación: {{ $adopcion->ubicacion_mascota }}</span>
                </div>                @auth
                    @if(auth()->id() !== $adopcion->id_usuario)
                        <p>
                            <a href="{{ route('chats.iniciar', $adopcion->id_usuario) }}?nombre_mascota={{ urlencode($adopcion->nombre_mascota) }}&mensaje={{ urlencode('Hola, estoy interesado en adoptar a ' . $adopcion->nombre_mascota . '. ¿Podrías darme más información? 😸') }}" class="enlace-mensajeX">
                                <i class="fas fa-envelope"></i> Enviar mensaje a: {{ $adopcion->usuario->name }}
                            </a>
                        </p>
                    @endif
                @endauth

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
                            @if ($adopcion->imagenes_secundarias)
                                @php
                                    $imagenesSecundarias = json_decode($adopcion->imagenes_secundarias, true);
                                @endphp

                                <div class="imagenes-secundaria-containerX">
                                    @if($adopcion->imagen)
                                        <div class="imagen-secundaria-containerX">
                                            <img id="mainImage" src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Imagen de adopción" class="imagen-secundariaX" onclick="changeMainImage(this)">
                                        </div>
                                    @endif
                                    @foreach ($imagenesSecundarias as $imagen)
                                        <div class="imagen-secundaria-containerX">
                                            <img src="{{ asset('storage/'.$imagen) }}" alt="Imagen Secundaria" class="imagen-secundariaX" onclick="changeMainImage(this)">
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<section class="sugerencias-adopcion">
    <h2 class="titulo-sugerencias">
        Adopciones similares que podrían interesarte 🐶❤️‍🩹
    </h2>
    <p class="descripcion-sugerencias">
        ¿Te gustó lo que viste? Estas otras mascotas también podrían robarte el corazón.
    </p>
</section>


<div class="containersimi">
    <div class="adopciones-container">
        @foreach ($adopcionesRelacionadas as $adopcionRelacionada)
            <div class="adopcion-card">
                <div class="perfil-usuario">
                    @php
                        $foto = $adopcionRelacionada->usuario->fotoperfil
                                ? asset('storage/' . $adopcionRelacionada->usuario->fotoperfil)
                                : asset('images/fotodeperfil.webp');
                    @endphp

                    <div class="foto-perfil" style="width: 70px; background-image: url('{{ $foto }}');"></div>
                    <div class="informacion-perfil">
                        <p class="nombre-usuario">{{ $adopcionRelacionada->usuario->name }}</p>
                        <p class="fecha-publicacion">
                            {{ \Carbon\Carbon::parse($adopcionRelacionada->created_at)->diffForHumans() }}
                        </p>
                        <p class="contador-visitas">
                            <i class="fas fa-eye"></i> {{ $adopcionRelacionada->visibilidad }}
                        </p>
                    </div>
                </div>
                @php
                    $emojis = [
                        'Perro' => '🐶',
                        'Gato' => '😺',
                        'Conejo' => '🐰',
                        'Tortuga' => '🐢',
                        'Peces' => '🐟',
                        'Otro' => '🐾',
                    ];
                    $emoji = $emojis[$adopcion->tipo_mascota] ?? '🐾';
                @endphp

                <p>
                    <span style="font-size: 1.2em;">{{ $emoji }}</span>
                    <strong>{{ $adopcionRelacionada->nombre_mascota }}</strong>
                </p>
                <p>{{ $adopcionRelacionada->contenido }}</p>
                @if($adopcionRelacionada->imagen)
                    <a href="{{ route('adopciones.show', $adopcionRelacionada->id) }}">
                        <img src="{{ asset('storage/' . $adopcionRelacionada->imagen) }}" alt="Imagen de adopción" class="adopcion-img">
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
<div class="ver-todas-container">
    <a href="{{ route('adopciones.index') }}" class="btn-ver-todas">
        Ver todas
    </a>
</div>

<div id="imageModal" class="modal">
    <span class="close" onclick="closeModal()">&times;</span>
    <img class="modal-content" id="modalImage">
</div>
@include('MenuPrincipal.footer')
<script src="{{ asset('js/Ascripts.js') }}"></script>
<script src="{{ asset('js/Modalscripts.js') }}"></script>
<script src="{{ asset('js/variasimagenes.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/alerts.js') }}"></script>
</body>
</html>
