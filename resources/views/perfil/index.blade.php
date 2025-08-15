<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="{{ asset(path: 'css/all.min.css') }}">
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
            <p>✉️ {{ $user->email }}</p>
            @if($user->telefono)
                <p>📞 {{ $user->telefono }}</p>
            @endif
            @if($user->direccion)
                <p>📍 {{ $user->direccion }}</p>
            @endif
            @if($user->descripción)
                <p>📝 {{ $user->descripción }}</p>
            @endif

            <p>
                <strong>Estado:</strong>
                @if($user->en_linea)
                    <span class="badge bg-success">🟢 En línea</span>
                @else
                    <span class="badge bg-secondary">⚪ Desconectado</span>
                @endif
            </p>

             <p class="mb-0 text-muted">Miembro desde: {{ $user->created_at->format('d/m/Y') }}</p>

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


        <div id="publicaciones" class="grid">
            @if($publicaciones->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡Aún no has creado publicaciones!</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay publicaciones" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @else
                @foreach($publicaciones as $publicacion)
                    <div class="card">

                        <a href="{{ route('publicaciones.show', $publicacion->id) }}">
                            @php
                                $imagen = null;

                                if ($publicacion->publicacionOriginal && $publicacion->publicacionOriginal->imagen) {
                                    $imagen = asset('storage/' . $publicacion->publicacionOriginal->imagen);
                                } elseif ($publicacion->imagen) {
                                    $imagen = asset('storage/' . $publicacion->imagen);
                                } else {
                                    $imagen = asset('images/sin_imagen.png');
                                }
                            @endphp
                            <img src="{{ $imagen }}" alt="Publicación" class="img-card">
                        </a>

                        <div class="overlay-info">
                            <p><strong>{{ $publicacion->titulo }}</strong></p>
                            <p><i class="fas fa-heart"></i> {{ $publicacion->likes_count }} Me gusta</p>
                        </div>
                        <p class="contador-visitas">
                            <i class="fas fa-heart"></i> {{ $publicacion->likes_count }}
                        </p>

                    </div>
                @endforeach
            @endif
        </div>







        <div id="veterinarias" class="grid">
    @if($veterinarias->isEmpty())
        <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
            <p class="no-hay-message" style="font-size: 18px;">¡Aún no has publicado veterinarias 😿!</p>
            <img src="{{ asset('images/vacio.svg') }}" alt="No hay veterinarias" style="width: 150px; opacity: 0.7; margin-top: 10px;">
        </div>
    @else
        @foreach($veterinarias as $veterinaria)
            @php
                $imagen = $veterinaria->imagenes->first();
            @endphp

            <div class="card">
                <a href="{{ route('veterinarias.show', $veterinaria->id) }}" class="card-img-top" style="border-radius: 0.5rem 0.5rem 0 0; display: flex; justify-content: center; align-items: center; height: 300px; background-color: #f8f9fa;">
                    @if ($imagen)
                        <img src="{{ asset('storage/' . $imagen->path) }}" alt="Veterinaria {{ $veterinaria->nombre }}" class="img-card" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                    @else
                        <div class="d-flex flex-column align-items-center justify-content-center text-muted" style="height: 100%;">
                            <p>No hay imágenes disponibles</p>
                            <img src="{{ asset('images/no_hay.svg') }}" alt="No hay imágenes" style="width: 150px; opacity: 0.7;">
                        </div>
                    @endif
                </a>

                <div class="overlay-info" style="padding: 10px;">
                    <p><strong>{{ $veterinaria->nombre }}</strong></p>
                    <p>Teléfono: {{ $veterinaria->telefono }}</p>
                </div>
            </div>
        @endforeach
    @endif
</div>


        <div id="eventos" class="grid">
            @if($eventos->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡Aún no has publicado eventos!</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay eventos" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @else
                @foreach($eventos as $evento)
                    <div class="card">
                        <a href="{{ route('eventos.show', $evento->id) }}">
                            <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Evento" class="img-card">
                        </a>
                        <div class="overlay-info">
                            <p><strong>{{ $evento->titulo }}</strong></p>
                            <p>Fecha: {{ $evento->fecha }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div id="petshop" class="grid">
            @if($productosUsuario->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">No tienes productos en tu tienda.</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay productos" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>

            @else
                @foreach($productosUsuario as $producto)
                    <div class="card">
                        <a href="{{ route('productos.show', $producto->id) }}">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Producto" class="img-card">
                        </a>
                        <div class="overlay-info">
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

        let anyChecked = false;

        items.forEach((input, index) => {
            if (input.checked) {
                currentIndex = index;
                moverCarrusel(0);
                anyChecked = true;
            }
        });

        if (!anyChecked && items.length > 0) {
            items[0].checked = true;
            moverCarrusel(0);
        }
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
