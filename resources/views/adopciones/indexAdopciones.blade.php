<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Adopciones</title>
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
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('adopciones.index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Adopciones</span>
                </a>
            </li>
            <li class="breadcrumb__item">
                <a href="{{ route('adopciones.create') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Crear publicación</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="modern-filters-row">
        <h3 class="filtro-titulo solo-escritorio">Filtrar por tipo de mascota</h3>
        <p class="filtro-descripcion solo-escritorio">🔍 Elige una categoría para ver solo las publicaciones de ese tipo de mascota.</p>

        <form method="GET" action="{{ route('adopciones.index') }}" class="filters-form">
            <input type="hidden" name="orden" value="{{ request('orden') }}">
            <div class="category-buttons">
                <button type="submit" name="tipo_mascota" value=""
                        class="category-btn {{ request('tipo_mascota') == '' ? 'active' : '' }}">
                    <i class="fas fa-list-ul fa-2x"></i>
                    <span>Todos</span>
                </button>
                @php
                    $tipos = [
                        'Perro' => 'perro.webp',
                        'Gato' => 'gato.webp',
                        'Conejo' => 'conejo.webp',
                        'Tortuga' => 'tortuga.webp',
                        'Peces' => 'peces.webp',
                        'Otro' => 'otro.webp'
                    ];
                @endphp

                @foreach ($tipos as $tipo => $imagen)
                    <button type="submit" name="tipo_mascota" value="{{ $tipo }}"
                            class="category-btn {{ request('tipo_mascota') == $tipo ? 'active' : '' }}">
                        @if($tipo !== 'Otro')
                            <img src="{{ asset('images/' . $imagen) }}" alt="{{ $tipo }}" class="category-icon">
                        @else
                            <i class="fas fa-paw fa-3x"></i>
                        @endif
                        <span>{{ $tipo }}</span>
                    </button>
                @endforeach
            </div>
        </form>
        <span class="toggle-orden-dropdown" onclick="toggleOrden()" aria-label="Mostrar/Ocultar orden">
             <i class="fas fa-chevron-down orden-icon {{ request('orden') ? 'rotated' : '' }}" id="orden-icon"></i>
        </span>
        <h3 class="orden-titulo solo-escritorio">Ordenar publicaciones</h3>
        <p class="orden-descripcion solo-escritorio">📋Organiza las publicaciones según tu preferencia: más recientes, más vistas, o solicitudes enviadas.</p>
        <form method="GET" action="{{ route('adopciones.index') }}" class="order-form" id="orden-form"
              style="display: {{ request('orden') ? 'block' : 'none' }};">            <input type="hidden" name="tipo_mascota" value="{{ request('tipo_mascota') }}">
            <div class="order-pills">

                @php
                    $ordenes = [
                        'desc' => ['icon' => 'fa-clock', 'label' => 'Reciente'],
                        'asc' => ['icon' => 'fa-history', 'label' => 'Antigua'],
                        'most_visited' => ['icon' => 'fa-eye', 'label' => 'Más vistas'],
                        'least_visited' => ['icon' => 'fa-eye-slash', 'label' => 'Menos vistas'],
                        'accepted_requests' => ['icon' => 'fa-check-circle', 'label' => 'Solicitudes Enviadas']
                    ];
                @endphp

                @foreach ($ordenes as $key => $data)
                    <button type="submit" name="orden" value="{{ $key }}"
                            class="pill-btn {{ request('orden') == $key || (request('orden') == '' && $key == 'desc') ? 'active' : '' }}"
                            title="{{ $data['label'] }}">
                        <i class="fas {{ $data['icon'] }}"></i>
                        <span class="pill-text">{{ $data['label'] }}</span>
                    </button>
                @endforeach
            </div>
        </form>
    </div>

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

    <div class="adopciones-container">
        @if($adopciones->isEmpty() && request('orden') === 'accepted_requests')
            <div class="no-hay">
                @php
                    $tipoSeleccionado = request('tipo_mascota');
                    $mensajes = [
                        'Perro' => 'No has enviado solicitudes de adopción para perros. ',
                        'Gato' => 'No has enviado solicitudes de adopción para gatos. ',
                        'Conejo' => 'No has enviado solicitudes de adopción para conejos. ',
                        'Tortuga' => 'No has enviado solicitudes de adopción para tortugas. ',
                        'Peces' => 'No has enviado solicitudes de adopción para peces. ',
                        'Otro' => 'No has enviado solicitudes en esta categoría por el momento. ',
                        '' => 'No has enviado solicitudes de adopción aún. ',
                        null => 'No has enviado solicitudes de adopción aún. ',
                    ];
                @endphp

                <p class="no-hay-message">
                    {{ $mensajes[$tipoSeleccionado] ?? $mensajes[''] }}
                </p>
                <img src="{{ asset('images/vacio.svg') }}" alt="No hay solicitudes enviadas"
                     class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
            </div>
        @elseif($adopciones->isEmpty())
            <div class="no-hay">
                @php
                    $tipoSeleccionado = request('tipo_mascota');
                    $mensajes = [
                        'Perro' => '¡No hay adopciones disponibles de perros por el momento! ',
                        'Gato' => '¡No hay adopciones disponibles de gatos por el momento! ',
                        'Conejo' => '¡No hay adopciones disponibles de conejos por el momento! ',
                        'Tortuga' => '¡No hay adopciones disponibles de tortugas por el momento! ',
                        'Peces' => '¡No hay adopciones disponibles de peces por el momento! ',
                        'Otro' => '¡No hay adopciones disponibles en esta categoría por el momento! ',
                        '' => '¡No hay adopciones disponibles por el momento! ',
                        null => '¡No hay adopciones disponibles por el momento! ',
                    ];
                @endphp

                <p class="no-hay-message">
                    {{ $mensajes[$tipoSeleccionado] ?? $mensajes[''] }}
                </p>
                <img src="{{ asset('images/vacio.svg') }}" alt="No hay adopciones"
                     class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
            </div>
        @endif

        @foreach($adopciones as $adopcion)
            <div class="adopcion-card">
                <div class="perfil-usuario">
                    @php
                        $foto = $adopcion->usuario->fotoperfil
                                ? asset('storage/' . $adopcion->usuario->fotoperfil)
                                : asset('images/fotodeperfil.webp');
                    @endphp

                    <div class="foto-perfil" style="width: 70px; background-image: url('{{ $foto }}');"></div>
                    <div class="informacion-perfil">
                        <p class="nombre-usuario">{{ $adopcion->usuario->name }}</p>
                        <p class="fecha-publicacion">{{ \Carbon\Carbon::parse($adopcion->created_at)->diffForHumans() }}</p>
                        <p class="contador-visitas"><i class="fas fa-eye"></i> {{ $adopcion->visibilidad }}</p>

                        @if ($adopcion->solicitudAceptada && $adopcion->solicitudAceptada->id_usuario === Auth::id())
                            <p class="estado-adopcion" style="font-size: 0.9rem;">
                                <a href="{{ route('solicitudes.showDetails', ['id_adopcion' => $adopcion->id, 'id' => $adopcion->solicitudAceptada->id]) }}"
                                   style="color: #1e4183; font-weight: bold; text-decoration: none;"
                                   title="Ver estado de la solicitud">
                                    Solicitud Aceptada
                                    <i class="fas fa-check-circle" style="margin-left: 5px;"></i>
                                </a>
                            </p>
                        @endif

                        @if($adopcion->solicitudes->isNotEmpty())
                            @php
                                $solicitud = $adopcion->solicitudes->firstWhere('id_usuario', Auth::id());
                            @endphp

                            @if($solicitud && $solicitud->estado == 'pendiente')
                                <p class="estado-adopcion" style="font-size: 0.9rem;">
                                    Solicitud:
                                    <a href="{{ route('solicitudes.showDetails', ['id_adopcion' => $adopcion->id, 'id' => $solicitud->id]) }}" style="font-weight: bold; color: orange; text-decoration: none;">
                                        {{ ucfirst($solicitud->estado) }}
                                    </a>
                                </p>
                            @endif
                        @endif


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

                <p><span style="font-size: 1.1em;">{{ $emoji }}</span> <strong>{{ $adopcion->nombre_mascota }}</strong></p>
                <p>{{ $adopcion->contenido }}</p>

                @if($adopcion->imagen)
                    <a href="{{ route('adopciones.show', $adopcion->id) }}">
                        <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Imagen de adopción" class="adopcion-img" data-id="{{ $adopcion->id }}">
                    </a>
                @endif
            </div>
        @endforeach
    </div>
</div>
<div class="paginacion-mascotas">
    {{ $adopciones->links('vendor.pagination.mascotas') }}
</div>
@include('chats.chat-float')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.querySelector('.category-buttons');
        const activeBtn = container.querySelector('.category-btn.active');

        if (activeBtn) {
            activeBtn.scrollIntoView({
                behavior: 'smooth',
                inline: 'center',
                block: 'nearest'
            });
        }
    });
</script>

<script src="{{ asset('js/Ascripts.js') }}"></script>
<script src="{{ asset('js/alerts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@include('MenuPrincipal.footer')
</body>
</html>
