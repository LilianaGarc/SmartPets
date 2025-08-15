<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>

<body>
@php
    use Illuminate\Support\Facades\Storage;
@endphp

@php
    use Carbon\Carbon;
@endphp

@php
    $notificaciones = \App\Models\Notificacion::where('user_id', \Illuminate\Support\Facades\Auth::id())
        ->where('visto', false)
        ->latest()
        ->take(99)
        ->get();
@endphp

@yield('nav')
<nav class="navbar" id="navbar">
    <div class="nav-container">
        <div class="logo">
            <a href="{{ route('index') }}">
                <img src="{{ asset('images/smartpetspng2.webp') }}" alt="Smart Pets">
            </a>
        </div>
        <div class="nav-right">

            @auth
                <div class="notification-panel">
                    <div class="notification-icon" id="notificationToggle" aria-haspopup="true" aria-expanded="false" aria-label="Toggle notifications">
                        <img src="{{ asset('images/bell.svg') }}" alt="Notificaciones" width="30" height="30">
                        @if($notificaciones->count() > 0)
                            <span class="notification-count" id="notificationCount">{{ $notificaciones->count() }}</span>
                        @endif
                    </div>

                    <div class="notification-dropdown" id="notificationDropdown">

                        <div class="notification-header" style="display:flex; justify-content: space-between; align-items: center; padding: 10px 15px; border-bottom: 1px solid #ddd;">
                            <span style="font-weight: bold;">Notificaciones</span>
                            <button id="toggleConfigBtn" aria-label="Configurar Notificaciones" style="background: none; border: none; cursor: pointer; font-size: 18px;">
                                <i class="fas fa-cog"></i>
                            </button>
                        </div>

                        <ul id="notificationList">
                            @forelse($notificaciones as $notificacion)
                                @php
                                    $data = json_decode($notificacion->data, true) ?? [];
                                    $fecha = isset($data['fecha']) ? Carbon::parse($data['fecha'])->diffForHumans() : $notificacion->created_at->diffForHumans();
                                @endphp
                                <li class="notification-item" data-notification-id="{{ $notificacion->id }}">
                                    <a href="{{ $data['url_adopcion'] ?? '#' }}"
                                       style="display: flex; align-items: center; gap: 10px; text-decoration: none; color: inherit;">

                                        <div class="notification-profile-pic" style="flex-shrink: 0;">
                                            @php
                                                $fotoPerfil = asset('images/fotodeperfil.webp');

                                                if (!empty($data['foto_perfil'])) {
                                                    $pathRelativo = ltrim($data['foto_perfil'], '/');

                                                    if (Storage::disk('public')->exists($pathRelativo)) {
                                                        $fotoPerfil = asset('storage/' . $pathRelativo);
                                                    }
                                                }
                                            @endphp
                                            <img src="{{ $fotoPerfil }}" alt="Perfil"
                                                 style="width:40px; height:40px; border-radius:50%; object-fit:cover;">
                                        </div>

                                        <div class="notification-content" style="flex-grow: 1;">
                                            <p style="margin: 4px 0; font-size: 0.9rem; color: #555;">{{ $notificacion->mensaje }}</p>
                                            <small style="color: #999; font-size: 0.75rem;">{{ $fecha }}</small>
                                        </div>

                                        @if(isset($data['imagen_adopcion']) && $data['imagen_adopcion'])
                                            <div class="notification-image-preview" style="flex-shrink: 0;">
                                                <img src="{{ asset('storage/' . $data['imagen_adopcion']) }}" alt="Adopción"
                                                     style="width:50px; height:50px; border-radius:6px; object-fit:cover;">
                                            </div>
                                        @endif

                                    </a>
                                </li>

                            @empty
                                <li style="padding: 10px; text-align: center; color: #555;">
                                    <p>No hay notificaciones nuevas</p>
                                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay adopciones"
                                         class="mx-auto d-block mt-2" style="width: 80px; opacity: 0.7;">
                                </li>
                            @endforelse

                            @if($notificaciones->count() > 0)
                                <li class="clear-all-notifications" style="text-align: center; padding: 20px;">
                                    <button id="clearNotificationsBtn" class="btn-clear-notifications" style="display: inline-block; text-align: center;">
                                        Marcar todas como leídas
                                    </button>
                                </li>
                            @endif
                        </ul>

                        <div id="notificationConfig" style="display:none; padding: 15px;">
                            <div style="display:flex; justify-content: space-between; align-items: center;">
                                <span class="notification-label">Recibir notificaciones</span>
                                <label class="switch">
                                    <input type="checkbox" id="recibirNotificacionesSwitch" {{ Auth::user()->recibir_notificaciones ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <div style="display:flex; justify-content: space-between; align-items: center; margin-top: 10px;">
                                <span class="notification-label">Sonido de mensajes</span>
                                <label class="switch">
                                    <input type="checkbox" id="sonidoMensajesSwitch">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="username flex items-center gap-2">
                    <a href="{{ route('perfil.index', ['id' => Auth::id()]) }}" class="flex items-center gap-2 hover:text-blue-500 transition">
                        <img
                            src="{{ Auth::user()->fotoperfil ? asset('storage/' . Auth::user()->fotoperfil) : asset('images/fotodeperfil.webp') }}"
                            alt="Foto de perfil"
                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        <span class="hide-profile-name">{{ Auth::user()->name }}</span>
                    </a>
                </div>
            @else
                <div class="login-button-container">
                    <a class="btn-login light" href="{{ route('login') }}">
                        <span class="text">Iniciar Sesión</span>
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.66669 11.3334L11.3334 4.66669" stroke="white"
                                  stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.66669 4.66669H11.3334V11.3334" stroke="white"
                                  stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            @endauth

            <div class="hamburger-lines" id="hamburger">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>
        </div>
        <div class="menu-items custom-menu" id="menu">
            <ul>
                @guest
                    <li>
                        <a href="{{ route('login') }}" class="menu-link">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="menu-link">
                            Salir
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endguest

                <li>
                    <a href="{{ route('eventos.index') }}"
                       class="menu-link {{ request()->routeIs('eventos.*') ? 'active' : '' }}">
                        Eventos
                    </a>
                </li>
                <li>
                    <a href="{{ route('publicaciones.index') }}"
                       class="menu-link {{ request()->routeIs('publicaciones.*') ? 'active' : '' }}">
                        Publicaciones
                    </a>
                </li>
                <li>
                    <a href="{{ route('adopciones.index') }}"
                       class="menu-link {{ request()->routeIs('adopciones.*') ? 'active' : '' }}">
                        Adopciones
                    </a>
                </li>
                <li>
                    <a href="{{ route('veterinarias.index') }}"
                       class="menu-link {{ request()->routeIs('veterinarias.*') ? 'active' : '' }}">
                        Veterinarias
                    </a>
                </li>
                <li>
                    <a href="{{ route('productos.index') }}"
                       class="menu-link {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                        PetShop
                    </a>
                </li>
                <li>
                    <a href="{{ route('chats.index') }}"
                       class="menu-link {{ request()->routeIs('chats.*') ? 'active' : '' }}">
                        PetChat
                    </a>
                </li>
                <li>
                    <a href="{{ route('chatbot.index') }}"
                       class="menu-link {{ request()->routeIs('chatbot.*') ? 'active' : '' }}">
                        Mascota ideal
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>

<script>
    window.Laravel = {
        csrfToken: '{{ csrf_token() }}',
        borrarNotificacionesUrl: '{{ route('notificaciones.borrarTodas') }}',
        configurarNotificacionesUrl: '{{ route('notificaciones.configurar') }}'
    };
</script>

<script src="{{ asset('js/navbar.js') }}"></script>

</body>

</html>
