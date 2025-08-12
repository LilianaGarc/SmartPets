<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>
<body>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        });
    </script>
@endif
@if ($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                timer: 4000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        });
    </script>
@endif

@include('MenuPrincipal.Navbar')
<div class="perfil">
    <div class="cabecera">
        <img src="{{ $user->fotoperfil ? asset('storage/' . $user->fotoperfil) : asset('images/fotodeperfil.webp') }}" alt="Foto de perfil" class="foto-perfil"/>
        <div class="info">
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
            @if($user->telefono)
                <p><i class="fas fa-phone"></i> {{ $user->telefono }}</p>
            @endif
            @if($user->direccion)
                <p><i class="fas fa-map-marker-alt"></i> {{ $user->direccion }}</p>
            @endif
            @if($user->bio)
                <p><i class="fas fa-user-edit"></i> {{ $user->bio }}</p>
            @endif
            <p class="mb-0 text-muted">Miembro desde: {{ $user->created_at->format('d/m/Y') }}</p>
            <p>
                <strong>Estado:</strong>
                @if($user->en_linea)
                    <span class="badge bg-success">En línea</span>
                @else
                    <span class="badge bg-secondary">Desconectado</span>
                @endif
            </p>

            <div class="acciones">
                <form action="{{ route('perfil.actualizarFoto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="fotoInput" class="btn-actualizar-foto">Actualizar foto de perfil</label>
                    <input type="file" name="fotoperfil" id="fotoInput" accept="image/*" onchange="this.form.submit()" hidden>
                </form>

                <a href="{{ route('profile.edit') }}" title="Editar perfil">
                    <i data-lucide="settings" class="icono"></i>
                </a>

            </div>


            <div class="productos-guardados" style="margin-top: 10px;">
                <a href="{{ route('productos.guardados') }}">
                    <img class="marcador" id="icono-marcador" src="{{ asset('images/marcadorAzul.png') }}" alt="Guardados" title="Productos Guardados" style="width: 20px; height: 20px;">
                </a>
            </div>

        </div>
        <div class="mascota-virtual" style="width: 100%; text-align: center;">

        @if(!$user->fotoperfil)
                <h3 class="titulo-mascota">Tu Mascota Virtual</h3>
                <p>Actualiza tu foto de perfil para desbloquear tu mascota virtual.</p>
            @elseif(!$user->mascota_virtual)
                <form action="{{ route('perfil.seleccionarMascota') }}" method="POST">
                    @csrf
                    <div class="carousel-container">
                        <div class="carousel-track" id="carousel-track">
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="carousel-item">
                                    <label>
                                        <input type="radio" name="mascota_virtual" value="mascota{{ $i }}.png"
                                               hidden>
                                        <img src="{{ asset('images/mascota' . $i . '.png') }}" class="mascota-img" alt="Mascota {{ $i }}">
                                    </label>
                                </div>
                            @endfor
                        </div>
                        <button type="button" class="carousel-btn prev" onclick="moverCarrusel(-1)">❮</button>
                        <button type="button" class="carousel-btn next" onclick="moverCarrusel(1)">❯</button>
                    </div>
                    <button type="submit" class="btn-guardar-mascota">Guardar Mascota</button>
                </form>
            @else
                <div class="mascota-seleccionada">
                    <div class="contenedor-mascota-y-botones" style="position: relative;">
                        <div class="columna-boton-estadistica">
                            <button onclick="alimentarMascota()" class="btn-izquierda">🍖</button>
                            <p class="estadistica">Hambre: <span id="nivelHambre">100</span>%</p>
                        </div>

                        <div class="mascota-con-animaciones" style="position: relative; width: 220px; height: 220px;">
                            <img src="{{ asset('images/' . $user->mascota_virtual) }}" alt="Mascota seleccionada" class="mascota-centro">

                            <div id="animacionAlimentar" class="animacion-interaccion">🍖</div>
                            <div id="animacionAcariciar" class="animacion-interaccion">💖</div>
                        </div>

                        <div class="columna-boton-estadistica">
                            <button onclick="acariciarMascota()" class="btn-derecha">💖</button>
                            <p class="estadistica">Felicidad: <span id="nivelFelicidad">100</span>%</p>
                        </div>
                    </div>


                    <form action="{{ route('perfil.actualizarMascotaVirtual') }}" method="POST">
                        @csrf
                        <input type="text" name="nombre_mascota_virtual" value="{{ $user->nombre_mascota_virtual }}" placeholder="Ponle un nombre...">
                        <button type="submit" class="btn-guardar-mascota">Guardar Nombre</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    </div>

    <div class="tabs">
        <button class="tab activo" onclick="cambiarTab('adopciones')" title="Adopciones">
            <i class="fas fa-paw"></i>
            <span class="tab-text">Mascotas en adopción</span>
        </button>
        <button class="tab" onclick="cambiarTab('solicitudes')" title="Solicitudes">
            <i class="fas fa-paper-plane"></i>
            <span class="tab-text">Solicitudes enviadas</span>
        </button>
        <button class="tab" onclick="cambiarTab('publicaciones')" title="Publicaciones">
            <i class="fas fa-clone"></i>
            <span class="tab-text">Publicaciones</span>
        </button>
        <button class="tab" onclick="cambiarTab('veterinarias')" title="Veterinarias">
            <i class="fas fa-clinic-medical"></i>
            <span class="tab-text">Veterinarias</span>
        </button>
        <button class="tab" onclick="cambiarTab('eventos')" title="Eventos">
            <i class="fas fa-calendar-alt"></i>
            <span class="tab-text">Eventos</span>
        </button>
        <button class="tab" onclick="cambiarTab('petshop')" title="Petshop">
            <i class="fas fa-store"></i>
            <span class="tab-text">Productos</span>
        </button>
    </div>

    <div class="contenido">

        <div id="adopciones" class="grid activo">
            @if($adopciones->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡No has publicado adopciones aún! 😿</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay adopciones" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @else
                @foreach($adopciones as $adopcion)
                    @if($adopcion->imagen)
                        <div class="card">
                            <a href="{{ route('adopciones.show', $adopcion->id) }}">
                                <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Adopción" class="img-card">
                            </a>
                            <div class="overlay-info">
                                <p><i class="fas fa-file-alt"></i> Solicitudes recibidas: <strong>{{ $adopcion->solicitudes->count() }}</strong></p>
                            </div>
                            <p class="contador-visitas">
                                <i class="fas fa-eye"></i> {{ $adopcion->visibilidad }}
                            </p>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div id="solicitudes" class="grid">
            @if($adopcionesSolicitadas->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡Aún no has enviado solicitudes! 🐾</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay solicitudes" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @else
                @foreach($adopcionesSolicitadas as $item)
                    @php
                        $adopcion = $item['adopcion'];
                        $solicitud = $item['solicitud'];
                    @endphp
                    @if($adopcion && $adopcion->imagen)
                        @php
                            $foto = $adopcion->usuario->fotoperfil
                                ? asset('storage/' . $adopcion->usuario->fotoperfil)
                                : asset('images/fotodeperfil.webp');
                        @endphp

                        <div class="card">
                            <a href="{{ route('solicitudes.showDetails', ['id_adopcion' => $adopcion->id, 'id' => $solicitud->id]) }}">
                                <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Adopción" class="img-card">
                            </a>

                            <div class="overlay-info">
                                <div class="perfil-info">
                                    <div class="foto-perfil-mini" style="background-image: url('{{ $foto }}');"></div>
                                    <div class="perfil-texto">
                                        <p><strong>{{ $adopcion->usuario->name }}</strong></p>
                                        <p class="fecha-publicacion">{{ \Carbon\Carbon::parse($adopcion->created_at)->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p><strong> {{ $adopcion->tipo_mascota }}</strong></p>
                                <p><strong>Nombre:</strong> {{ $adopcion->nombre_mascota }}</p>
                                <p style="color: #ffffff;">Estado de la solicitud: <strong>{{ ucfirst($solicitud->estado) }}</strong></p>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div id="publicaciones" class="grid"></div>
        <div id="veterinarias" class="grid"></div>
        <div id="eventos" class="grid"></div>
        <div id="petshop" class="grid">
            @if($productosUsuario->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡Aún no has publicado productos!</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay productos" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @else
                @foreach($productosUsuario as $producto)
                    <div class="card">
                        <a href="{{ route('productos.show', $producto->id) }}">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Producto" class="img-card">
                        </a>
                        <div class="overlay-info">
                            <p><strong>{{ $producto->nombre }}</strong></p>
                            <p>Precio: ${{ number_format($producto->precio, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<script src="{{ asset('js/perfil.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let currentIndex = 0;

    function moverCarrusel(direccion) {
        const track = document.getElementById('carousel-track');
        const items = track.querySelectorAll('.carousel-item');
        const total = items.length;

        currentIndex = (currentIndex + direccion + total) % total;

        const offset = -currentIndex * 100;
        track.style.transform = `translateX(${offset}%)`;

        const input = items[currentIndex].querySelector('input[type="radio"]');
        if (input) input.checked = true;
    }

    document.addEventListener('DOMContentLoaded', () => {
        const items = document.querySelectorAll('.carousel-item input[type="radio"]');
        items.forEach((input, index) => {
            if (input.checked) {
                currentIndex = index;
                moverCarrusel(0);
            }
        });
    });
</script>

<script>
    let nivelHambre = {{ $user->hambre_mascota_virtual ?? 100 }};
    let nivelFelicidad = {{ $user->felicidad_mascota_virtual ?? 100 }};
    const spanHambre = document.getElementById('nivelHambre');
    const spanFelicidad = document.getElementById('nivelFelicidad');

    function mostrarAnimacion(idElemento) {
        const animacion = document.getElementById(idElemento);

        animacion.style.animation = 'none';
        animacion.offsetHeight;
        animacion.style.animation = null;

        animacion.style.opacity = '1';

        setTimeout(() => {
            animacion.style.opacity = '0';
        }, 1000);
    }


    function actualizarEstadisticas() {
        spanHambre.textContent = nivelHambre.toFixed(0);
        spanFelicidad.textContent = nivelFelicidad.toFixed(0);
    }

    function disminuirEstadisticas() {
        nivelHambre = Math.max(0, nivelHambre - 5);
        nivelFelicidad = Math.max(0, nivelFelicidad - 3);
        actualizarEstadisticas();
        guardarEstadisticas();
    }

    function alimentarMascota() {
        nivelHambre = Math.min(100, nivelHambre + 20);
        nivelFelicidad = Math.min(100, nivelFelicidad + 5);
        actualizarEstadisticas();
        guardarEstadisticas();
        mostrarAnimacion('animacionAlimentar');
    }

    function acariciarMascota() {
        nivelFelicidad = Math.min(100, nivelFelicidad + 15);
        actualizarEstadisticas();
        guardarEstadisticas();
        mostrarAnimacion('animacionAcariciar');
    }

    function guardarEstadisticas() {
        fetch('{{ route("perfil.actualizarEstadisticas") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                hambre: nivelHambre,
                felicidad: nivelFelicidad
            }),
        })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    console.error('Error al guardar estadísticas');
                }
            })
            .catch(error => {
                console.error('Error en la petición:', error);
            });
    }

    document.addEventListener('DOMContentLoaded', () => {
        actualizarEstadisticas();
        setInterval(disminuirEstadisticas, 10000);
    });
</script>

</body>
</html>
