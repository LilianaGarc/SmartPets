<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Adopciones</title>
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="container">
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
        <div class="filter-container">
            <form action="{{ route('adopciones.index') }}" method="GET">
                <div class="select-wrapper">
                    <select name="tipo_mascota" onchange="this.form.submit()" class="select-dropdown">
                        <option value="">Seleccionar tipo de mascota</option>
                        <option value="Perro" {{ request('tipo_mascota') == 'Perro' ? 'selected' : '' }}>Perro</option>
                        <option value="Gato" {{ request('tipo_mascota') == 'Gato' ? 'selected' : '' }}>Gato</option>
                        <option value="Conejo" {{ request('tipo_mascota') == 'Conejo' ? 'selected' : '' }}>Conejo</option>
                        <option value="Tortuga" {{ request('tipo_mascota') == 'Tortuga' ? 'selected' : '' }}>Tortuga</option>
                        <option value="Peces" {{ request('tipo_mascota') == 'Peces' ? 'selected' : '' }}>Peces</option>
                        <option value="Otro" {{ request('tipo_mascota') == 'Otro' ? 'selected' : '' }}>Otro</option>
                        <option value="" {{ request('tipo_mascota') == '' ? 'selected' : '' }}>Todos</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
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
    @if($adopciones->isEmpty())
        <div class="no-hay">
            <p class="no-hay-message">¡No hay adopciones disponibles por el momento! 😿</p>
            <img src="{{ asset('images/vacio.svg') }}" alt="No hay adopciones" class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
        </div>
    @endif
@foreach($adopciones as $adopcion)
        <div class="adopcion-card">
            <div class="perfil-usuario">
                <div class="foto-perfil" style="background-image: url('{{ asset('images/fotodeperfil.webp') }}');"></div>
                <div class="informacion-perfil">
                    <p class="nombre-usuario">Anonymous</p>
                    <p class="fecha-publicacion">
                        Fecha: {{ \Carbon\Carbon::parse($adopcion->created_at)->format('d M Y, H:i') }}
                    </p>
                    <p class="contador-visitas">
                        <i class="fas fa-eye"></i> {{ $adopcion->visibilidad }}
                    </p>
                </div>
            </div>
            <p>{{ $adopcion->contenido }}</p>

            @if($adopcion->imagen)
                <a href="{{ route('adopciones.show', $adopcion->id) }}">
                    <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Imagen de adopción" class="adopcion-img" data-id="{{ $adopcion->id }}">
                </a>
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
                        <form action="{{ route('adopciones.show', $adopcion->id) }}" method="GET">
                            <button type="submit" class="btn-editar-dropdown">
                                <i></i> Ver detalles
                            </button>
                        </form>

                        <form action="{{ route('adopciones.edit', $adopcion->id) }}" method="GET">
                            <button type="submit" class="btn-editar-dropdown">
                                <i></i> Editar
                            </button>
                        </form>

                        <form action="{{ route('adopciones.destroy', $adopcion->id) }}" method="POST" id="delete-form-{{$adopcion->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminard" onclick="confirmDeleteAdopcion({{$adopcion->id}})">
                                <i></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script src="{{ asset('js/Ascripts.js') }}"></script>
<script src="{{ asset('js/alerts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
