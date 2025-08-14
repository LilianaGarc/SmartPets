@section('title', 'Recuperar Contraseña')

<x-guest-layout>
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            background: white;
        }
        
        .form-title {
            text-align: center;
            margin-bottom: 1.5 rem;
            color: #2d3748;
        }
        
        .form-description {
            display: block;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #4a5568;
        }
        
        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .form-input {
            width: 100%;
            padding: 1rem 0.75rem 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            font-size: 1rem;
            transition: all 0.2s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #4299e1;
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.2);
        }
        
        .form-label {
            position: absolute;
            top: 0.5rem;
            left: 0.75rem;
            color: #718096;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            pointer-events: none;
        }
        
        .form-input:focus + .form-label,
        .form-input:not(:placeholder-shown) + .form-label {
            top: -0.6rem;
            left: 0.5rem;
            font-size: 0.75rem;
            color: #4299e1;
            background: white;
            padding: 0 0.25rem;
        }
        
        .form-button {
            width: 100%;
            padding: 0.75rem;
            background: #ff7f50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s ease;
        }
        
        .form-button:hover {
            background: #e0673e;
        }
        
        .form-link {
            display: block;
            text-align: center;
            margin-top: 1rem;
            color: #4299e1;
            text-decoration: none;
        }
        
        .form-link:hover {
            text-decoration: underline;
        }
        
        .alert {
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }
        
        .alert-success {
            background: #f0fff4;
            color: #38a169;
            border: 1px solid #c6f6d5;
        }
        
        .alert-error {
            background: #fff5f5;
            color: #e53e3e;
            border: 1px solid #fed7d7;
        }
        
        .alert i {
            margin-right: 0.5rem;
        }
    </style>

    <div class="form-container">
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <h1 class="form-title"><strong>Recuperar Contraseña</strong></h1>
            <span class="form-description">Ingresa tu correo y te enviaremos un enlace para restablecer tu contraseña.</span>

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fa-solid fa-envelope"></i> {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-error mb-1">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            

            <div class="form-group">
                <input type="email" id="email" name="email" class="form-input @error('email') is-invalid @enderror" placeholder="Correo electrónico" maxlength="100" value="{{ old('email') }}" autofocus>
                <label for="email" class="form-label">Correo electrónico</label>
            </div>

            <button type="submit" class="form-button">Enviar enlace</button>
            <a href="{{ route('login') }}" class="form-link">Volver a iniciar sesión</a>
        </form>
    </div>
</x-guest-layout>