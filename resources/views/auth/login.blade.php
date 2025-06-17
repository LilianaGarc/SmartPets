<x-guest-layout>

    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="container-form">
            <form class="sign-in" action="{{ route('login') }}" method="POST">
                @csrf
                <h2><strong>Iniciar Sesión</strong></h2>
                <span>Use su correo y contraseña</span>
                <div class="container-input">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email" placeholder="Correo electrónico">
                </div>
                <div class="container-input">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Contraseña">
                </div>
                <a href="#">¿Olvidaste tu contraseña?</a>
                <button>INICIAR SESIÓN</button>
            </form>
        </div>
        <div class="container-form">
            <form class="sign-up" method="POST" action="{{ route('register') }}">
                @csrf
                <h2><strong>Registrarse</strong></h2>
                <span>Use su correo electrónico para registrarse</span>
                <div class="container-input">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="name" name="name" placeholder="Nombre">
                </div>
                <div class="container-input">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email" placeholder="Correo electrónico">
                </div>
                <div class="container-input">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Contraseña">
                </div>
                <div class="container-input">
                    <i class="fa-solid fa-key"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar contraseña">
                </div>
                <button class="button">REGISTRARSE</button>
            </form>
        </div>
        <div class="container-welcome">
            <div class="welcome-sign-up welcome">
                <img src="{{ asset('images/perroLogin.webp') }}" alt="Bienvenido" class="welcome-image">
                <h3><strong>¡Bienvenido!</strong></h3>
                <p>Ingrese sus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-up">Registrarse</button>
            </div>
            <div class="welcome-sign-in welcome">
                <img src="{{ asset('images/perroLogin.webp') }}" alt="Bienvenido" class="welcome-image">
                <h3><strong>¡Hola!</strong></h3>
                <p>Regístrese con sus datos personales para usar todas las funciones del sitio</p>
                <button class="button" id="btn-sign-in">Iniciar Sesión</button>
            </div>
        </div>
    </div>

    <div id="animated-gif" class="floating-gif"></div>

    <script>
        const container = document.querySelector(".container");
        const btnSignIn = document.getElementById("btn-sign-in");
        const btnSignUp = document.getElementById("btn-sign-up");

        btnSignIn.addEventListener("click", () => {
            container.classList.remove("toggle");
        });
        btnSignUp.addEventListener("click", () => {
            container.classList.add("toggle");
        });

        setTimeout(() => {
            const alert = document.querySelector('.alert-error');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);
    </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const gifElement = document.getElementById('animated-gif');

                const gifPaths = [
                    '{{ asset('images/gato1.gif') }}',
                    '{{ asset('images/gato2.gif') }}',
                    '{{ asset('images/gato3.gif') }}'
                ];

                let currentIndex = 0;
                gifElement.style.backgroundImage = `url('${gifPaths[currentIndex]}')`;

                function getRandomPosition() {
                    const padding = 50;
                    const winWidth = window.innerWidth;
                    const winHeight = window.innerHeight;
                    let left, top;

                    do {
                        left = Math.floor(Math.random() * (winWidth - 120));
                        top = Math.floor(Math.random() * (winHeight - 120));
                    } while (
                        left > window.innerWidth / 4 && left < (window.innerWidth * 3) / 4 &&
                        top > window.innerHeight / 4 && top < (window.innerHeight * 3) / 4
                        );

                    return { left, top };
                }

                function moveGifRandomly() {
                    const { left, top } = getRandomPosition();
                    gifElement.style.left = `${left}px`;
                    gifElement.style.top = `${top}px`;
                }

                gifElement.addEventListener('click', () => {
                    currentIndex = (currentIndex + 1) % gifPaths.length;
                    gifElement.style.backgroundImage = `url('${gifPaths[currentIndex]}')`;
                });

                setInterval(moveGifRandomly, 10000);

                moveGifRandomly();
            });
        </script>




</x-guest-layout>
