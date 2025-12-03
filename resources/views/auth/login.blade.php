<x-guest-layout>
    @section('title', 'Iniciar Sesión')

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
            <a href="{{ route('index') }}" class="home-button">
                <i class="fa-solid fa-house"></i><h3>Inicio</h3>
            </a>
            <form class="sign-in" action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                <h2><strong>Iniciar Sesión</strong></h2>
                <span>Use su correo y contraseña</span>

                <div class="container-input">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email" placeholder="Correo electrónico" maxlength="100" required
                           value="{{ old('email') }}" class="@error('email') error-border @enderror">
                </div>

                <div class="container-input">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="Contraseña" maxlength="25" required
                           class="@error('password') error-border @enderror">
                </div>

                <a href="{{ route('password.request') }}" class="link-recuperar">¿Olvidaste tu contraseña?</a>

                @if (session('login_attempts', 0) >= 3 && isset($captcha_question))
                    <div class="container-input">
                        <label>{{ $captcha_question }}</label>
                        <input type="text" name="captcha" placeholder="Respuesta" required
                               class="@error('captcha') error-border @enderror">
                    </div>
                @endif

                <button class="button-login" type="submit">INICIAR SESIÓN</button>
            </form>
        </div>

        <div class="container-form">
            <form class="sign-up" method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                <h2><strong>Registrarse</strong></h2>
                <span>Use su correo electrónico para registrarse</span>

                <div class="container-input">
                    <i class="fa-solid fa-user"></i>
                    <input type="text" id="name" name="name" maxlength="20" placeholder="Nombre" required>
                </div>

                <div class="container-input">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" id="email" name="email" maxlength="100" placeholder="Correo electrónico" required>
                </div>

                <div class="container-input">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" maxlength="25" placeholder="Contraseña" required>
                    <small style="font-size: 12px; color: #666;">No se permiten espacios</small>
                </div>

                <div class="container-input">
                    <i class="fa-solid fa-key"></i>
                    <input type="password" id="password_confirmation" name="password_confirmation" maxlength="25" placeholder="Confirmar contraseña" required>
                </div>

                <div class="container-input" style="margin-top: 10px;">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        Acepto los
                        <a href="{{ route('terminos') }}" target="_blank">términos y condiciones</a>
                    </label>
                </div>

                <button class="button-register">REGISTRARSE</button>
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
                <button class="btn" id="btn-sign-in">Iniciar Sesión</button>
            </div>
        </div>
    </div>

    <div id="animated-gif" class="floating-gif"></div>
    <script>
        document.getElementById('email').addEventListener('input', function () {

            // Eliminar caracteres no permitidos
            this.value = this.value.replace(/[^A-Za-z0-9@._-]/g, '');

            // Evitar más de un @
            let firstAt = this.value.indexOf('@');
            if (firstAt !== -1) {
                // quitar todos los @ adicionales
                let cleaned = this.value.slice(0, firstAt + 1) +
                    this.value.slice(firstAt + 1).replace(/@/g, '');
                this.value = cleaned;
            }
        });
    </script>
    <script>
        const container = document.querySelector(".container");
        const btnSignIn = document.getElementById("btn-sign-in");
        const btnSignUp = document.getElementById("btn-sign-up");
        const registerForm = document.getElementById('registerForm');

        btnSignIn.addEventListener("click", () => {
            container.classList.remove("toggle");
        });

        btnSignUp.addEventListener("click", () => {
            container.classList.add("toggle");
        });

        // Validación en tiempo real para espacios en la contraseña (registro)
        document.getElementById('password')?.addEventListener('input', function(e) {
            const password = e.target.value;
            if (password.includes(' ')) {
                e.target.setCustomValidity('La contraseña no puede contener espacios');
                e.target.style.borderColor = 'red';
            } else {
                e.target.setCustomValidity('');
                e.target.style.borderColor = '';
            }
        });

        // Validación para evitar que el nombre sea igual a la contraseña (registro)
        registerForm?.addEventListener('submit', function(e) {
            const name = document.getElementById('name').value;
            const password = document.getElementById('password').value;

            if (name === password) {
                e.preventDefault();
                // Crear mensaje de error en la parte superior
                showErrorInAlert('El nombre de usuario no puede ser igual a la contraseña.');
                return false;
            }

            if (password.includes(' ')) {
                e.preventDefault();
                showErrorInAlert('La contraseña no puede contener espacios.');
                return false;
            }
        });

        // Validación en tiempo real para nombre vs contraseña (registro)
        document.getElementById('name')?.addEventListener('input', validateNamePassword);
        document.getElementById('password')?.addEventListener('input', validateNamePassword);

        function validateNamePassword() {
            const name = document.getElementById('name')?.value;
            const password = document.getElementById('password')?.value;
            const nameInput = document.getElementById('name');

            if (name && password && name === password) {
                nameInput.setCustomValidity('El nombre de usuario no puede ser igual a la contraseña');
                nameInput.style.borderColor = 'red';
            } else {
                nameInput.setCustomValidity('');
                nameInput.style.borderColor = '';
            }
        }

        // Función para mostrar errores en la alerta superior
        function showErrorInAlert(message) {
            // Crear o actualizar la alerta de error
            let alertDiv = document.querySelector('.alert-error');
            if (!alertDiv) {
                alertDiv = document.createElement('div');
                alertDiv.className = 'alert-error';
                document.querySelector('x-guest-layout').insertBefore(alertDiv, document.querySelector('.container'));
            }

            alertDiv.innerHTML = `<ul><li>${message}</li></ul>`;
            alertDiv.style.display = 'block';

            // Ocultar después de 5 segundos
            setTimeout(() => {
                alertDiv.style.display = 'none';
            }, 5000);
        }

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

            function getRandomHorizontalPosition() {
                const winWidth = window.innerWidth;
                const gifWidth = 120;
                const left = Math.floor(Math.random() * (winWidth - gifWidth));
                return left;
            }

            function moveGifHorizontally() {
                const left = getRandomHorizontalPosition();
                const top = Math.floor(Math.random() * 300) + 50;
                gifElement.style.left = `${left}px`;
                gifElement.style.top = `${top}px`;
            }

            gifElement.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % gifPaths.length;
                gifElement.style.backgroundImage = `url('${gifPaths[currentIndex]}')`;
            });

            setInterval(moveGifHorizontally, 10000);
            moveGifHorizontally();
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const btnSignIn = document.getElementById("btn-sign-in");
            const btnSignUp = document.getElementById("btn-sign-up");

            if (btnSignIn) {
                btnSignIn.addEventListener("click", () => {
                    document.title = "Iniciar Sesión";
                });
            }

            if (btnSignUp) {
                btnSignUp.addEventListener("click", () => {
                    document.title = "Registrarse";
                });
            }
        });
    </script>

    <style>
        .link-recuperar {
            color: #ff7f50;
            text-decoration: none;
            font-weight: bold;
        }

        .link-recuperar:hover {
            text-decoration: underline;
        }

        /* Estilos para el botón de registro */
        .button-register {
            width: auto !important;
            min-width: 150px;
            padding: 12px 24px;
            background-color: #ff7f50;
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button-register:hover {
            background-color: #e56a3a;
        }

        /* Estilos para la alerta de errores */
        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
            width: 90%;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 20px;
        }

        .alert-error li {
            margin: 5px 0;
        }

        /* Bordes rojos para inputs con error */
        .error-border {
            border-color: #dc3545 !important;
            border-width: 2px !important;
        }

        /* Estilos para el checkbox de términos (como antes) */
        .container-input {
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
        }

        .container-input input[type="checkbox"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #ff7f50;
            border-radius: 4px;
            cursor: pointer;
            position: relative;
            background-color: white;
        }

        .container-input input[type="checkbox"]:checked::after {
            content: '';
            position: absolute;
            top: 2px;
            left: 6px;
            width: 4px;
            height: 9px;
            border: solid #ff7f50;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .container-input label {
            line-height: 1.4;
            margin: 0;
        }

        .container-input label a {
            color: #ff7f50;
            text-decoration: none;
            font-weight: bold;
            margin-left: 4px;
        }

        /* Estilo para mensajes informativos */
        small {
            display: block;
            margin-top: 5px;
        }
    </style>
</x-guest-layout>
