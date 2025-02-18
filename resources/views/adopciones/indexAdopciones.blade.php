<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- jona:iconos -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="container">
    <h2>Pon en adopción y adopta tu mascota preferida</h2>

    <a href="{{ route('adopciones.create') }}" class="btn btn-primary">Crear Publicación</a>

    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <div class="adopciones-container">
        @foreach($adopciones as $adopcion)
            <div class="adopcion-card">
                <p>{{ $adopcion->contenido }}</p>

                @if($adopcion->imagen)
                    <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Imagen de adopción">
                @endif

                <div class="solicitar-container">
                    <button class="btn-solicitar">
                        <i class="fas fa-paw"></i> Solicitar mascota
                    </button>

                    <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta publicación?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</div>

</body>
</html>
