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
    <h2>
        <a href="{{ route('index') }}" class="btn-volver" style="text-decoration: none;">
            <i class="fas fa-arrow-left" style="color: #ff7f50; font-size: 24px; "></i>
        </a>
        Pon en adopción y adopta tu mascota preferida
    </h2>

    <a href="{{ route('adopciones.create') }}" class="btn btn-primary">Crear Publicación</a>

    @if(session('success'))
        <p class="alert alert-success">{{ session('success') }}</p>
    @endif

    <div class="adopciones-container">
        @foreach($adopciones as $adopcion)
            <div class="adopcion-card">
                <div class="perfil-usuario">
                    <div class="foto-perfil" style="background-image: url('{{ asset('images/fotodeperfil.webp') }}');">
                    </div>
                    <div class="informacion-perfil">
                        <p class="nombre-usuario">Anonymous</p>
                        <p class="fecha-publicacion">Fecha de publicación: {{ \Carbon\Carbon::parse($adopcion->created_at)->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                <p>{{ $adopcion->contenido }}</p>

                @if($adopcion->imagen)
                    <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Imagen de adopción" class="adopcion-img" data-id="{{ $adopcion->id }}">
                @endif

                <div class="interacciones">
                    <div class="reactions">
                        <img src="{{ asset('images/amor.webp') }}" class="reaction-img" id="amor" data-hover="{{ asset('images/amor2.webp') }}">
                        <img src="{{ asset('images/risa.webp') }}" class="reaction-img" id="risa" data-hover="{{ asset('images/risa2.webp') }}">
                        <img src="{{ asset('images/triste.webp') }}" class="reaction-img" id="triste" data-hover="{{ asset('images/llorar2.webp') }}">
                        <img src="{{ asset('images/enojado.webp') }}" class="reaction-img" id="enojado" data-hover="{{ asset('images/enojado2.webp') }}">
                    </div>

                    <div class="dropdown">
                        <button class="dropbtn">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <div class="dropdown-content">
                            <form action="{{ route('solicitudes.create', ['id_adopcion' => $adopcion->id]) }}" method="GET">
                                <button type="submit" class="btn-solicitar-dropdown">
                                    <i class="fas fa-paw"></i> Solicitar mascota
                                </button>
                            </form>
                            <form action="{{ route('solicitudes.show', ['id_adopcion' => $adopcion->id]) }}" method="GET">
                                <button type="submit" class="btn-ver">
                                    <i class="fas fa-eye"></i> Ver Solicitudes
                                </button>
                            </form>
                            <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta publicación?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-eliminar">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

</div>
<script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>
