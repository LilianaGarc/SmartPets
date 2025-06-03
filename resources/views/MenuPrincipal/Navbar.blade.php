<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
</head>

<body>
    @yield('nav')
    <nav class="navbar" id="navbar">
        <div class="nav-container">
            <div class="logo">
                <a href="{{ route('index') }}">
                    <img src="{{ asset('images/smartpetspng2.webp') }}" alt="Smart Pets">
                </a>
            </div>

            @auth
                <div class="username flex items-center gap-2">
                    <a href="{{ route('perfil.index', ['id' => Auth::id()]) }}" class="flex items-center gap-2 hover:text-blue-500 transition">
                        <img
                            src="{{ Auth::user()->fotoperfil ? asset('storage/' . Auth::user()->fotoperfil) : asset('images/fotodeperfil.webp') }}"
                            alt="Foto de perfil"
                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                        <span class="hide-profile-name">{{ Auth::user()->name }}</span>
                    </a>
                </div>
            @endauth


            <div class="hamburger-lines" id="hamburger">
                <span class="line line1"></span>
                <span class="line line2"></span>
                <span class="line line3"></span>
            </div>

            <div class="menu-items" id="menu">
                <ul>
                    @guest
                    <li>
                        <a href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Salir
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    @endguest

                    <li><a href="{{ route('eventos.index') }}"><i class="fas fa-calendar-alt"></i> Eventos</a></li>
                    <li><a href="{{ route('publicaciones.index') }}"><i class="fas fa-newspaper"></i> Publicaciones</a></li>
                    <li><a href="{{ route('adopciones.index') }}"><i class="fas fa-heart"></i> Adopciones</a></li>
                    <li><a href="{{ route('veterinarias.index') }}"><i class="fas fa-user-md"></i> Veterinarias</a></li>
                    <li><a href="{{ route('productos.index') }}"><i class="fas fa-store"></i> PetShop</a></li>
                    <li><a href="{{ route('chats.index') }}"><i class="fas fa-comments"></i> PetChat</a></li>
                    <li><a href="{{ route('chatbot.index') }}"><i class="fas fa-paw"></i> Mascota ideal</a></li>
                </ul>
            </div>

        </div>
    </nav>

    <script src="{{ asset('js/navbar.js') }}"></script>
</body>

</html>
