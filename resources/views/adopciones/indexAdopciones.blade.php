<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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

                <div class="interacciones">
                    <div class="reactions" id="reactions-{{ $adopcion->id }}">
                        <img src="{{ asset('images/amor.webp') }}" class="reaction-img" id="amor" data-hover="{{ asset('images/amor2.webp') }}">
                        <img src="{{ asset('images/risa.webp') }}" class="reaction-img" id="risa" data-hover="{{ asset('images/risa2.webp') }}">
                        <img src="{{ asset('images/triste.webp') }}" class="reaction-img" id="triste" data-hover="{{ asset('images/llorar2.webp') }}">
                        <img src="{{ asset('images/enojado.webp') }}" class="reaction-img" id="enojado" data-hover="{{ asset('images/enojado2.webp') }}">
                    </div>


                <button class="btn-solicitar">
                        Solicitar mascota
                    </button>
                    <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta publicación?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn-eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</div>
<script>
    const images = document.querySelectorAll('.reaction-img');

    images.forEach(image => {
        const originalSrc = image.src;

        image.addEventListener('mouseover', function() {
            const hoverSrc = image.getAttribute('data-hover');
            image.src = hoverSrc;
        });

        image.addEventListener('mouseout', function() {
            image.src = originalSrc;
        });
    });

</script>
</body>
</html>
