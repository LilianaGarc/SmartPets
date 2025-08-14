<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Perfil de {{ $user->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <link rel="stylesheet" href="{{ asset(path: 'css/all.min.css') }}">
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="perfil">
    <div class="cabecera">
        <img src="{{ $user->fotoperfil ? asset('storage/' . $user->fotoperfil) : asset('images/fotodeperfil.webp') }}" alt="Foto de perfil" class="foto-perfil"/>
        <div class="info">
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
            @if($user->telefono)
                <p>📞 {{ $user->telefono }}</p>
            @endif
            @if($user->direccion)
                <p>📍 {{ $user->direccion }}</p>
            @endif
            @if($user->descripción)
                <p>📝 {{ $user->descripción }}</p>
            @endif
            <div style="margin-top: 8px;">
                @if($user->en_linea)
                    <span style="width: 12px; height: 12px; background: #28a745; border-radius: 50%; display: inline-block; vertical-align: middle;" title="Activo"></span>
                    <span style="color: #28a745; font-weight: 500; margin-left: 6px;">Activo</span>
                @else
                    <span style="width: 12px; height: 12px; background: #888; border-radius: 50%; display: inline-block; vertical-align: middle;" title="Desconectado"></span>
                    <span style="color: #888; font-weight: 500; margin-left: 6px;">Desconectado</span>
                @endif
            </div>

        </div>
        <div class="mascota-virtual" style="width: 100%; text-align: center;">
            @if(!$user->fotoperfil)
                <h3 class="titulo-mascota">Mascota Virtual</h3>
                <p>Este usuario no tiene foto de perfil, por lo tanto no tiene mascota virtual.</p>
            @elseif(!$user->mascota_virtual)
                <h3 class="titulo-mascota">Mascota Virtual</h3>
                <p>Este usuario no ha seleccionado mascota virtual.</p>
            @else
                <div class="mascota-seleccionada">
                    <div class="contenedor-mascota-y-botones" style="position: relative;">
                        <div class="mascota-con-animaciones" style="position: relative; width: 220px; height: 220px;">
                            <img src="{{ asset('images/' . $user->mascota_virtual) }}" alt="Mascota seleccionada" class="mascota-centro">
                            <p><strong>{{ $user->nombre_mascota_virtual }}</p></strong>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="tabs">
        <button class="tab activo" onclick="cambiarTab('adopciones')" title="Adopciones">
            <i class="fas fa-paw"></i>
            <span class="tab-text">Mascotas en adopción</span>
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
                    <p class="no-hay-message" style="font-size: 18px;">¡No ha publicado adopciones aún! 😿</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay adopciones" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @else
                @foreach($adopciones as $adopcion)
                    @if($adopcion->imagen)
                        <div class="card">
                            <a href="{{ route('adopciones.show', $adopcion->id) }}">
                                <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Adopción" class="img-card">
                            </a>

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

                    </div>
                @endforeach
            @endif
        </div>

        <div id="veterinarias" class="grid">
    @if($veterinarias->isEmpty())
        <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
            <p class="no-hay-message" style="font-size: 18px;">¡No ha publicado veterinarias aún 😿!</p>
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


            </div>
        @endforeach
    @endif
</div>


        <div id="eventos" class="grid">
            @if($eventos->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡No ha publicado eventos aún! 😿</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay eventos" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @else
                @foreach($eventos as $evento)
                    <div class="card">
                        <a href="{{ route('eventos.show', $evento->id) }}">
                            <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Evento" class="img-card">
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
        <div id="petshop" class="grid">
            @if($productosUsuario->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡Aún no ha publicado productos! 😿</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay productos" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @else
                @foreach($productosUsuario as $producto)
                    <div class="card">
                        <a href="{{ route('productos.show', $producto->id) }}">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Producto" class="img-card">
                        </a>

                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<script src="{{ asset('js/perfil.js') }}"></script>
<script>
document.querySelectorAll('.tabs .tab').forEach(function(btn, idx) {
    btn.addEventListener('click', function() {
        // Oculta todos los grids
        document.querySelectorAll('.contenido .grid').forEach(function(div) {
            div.style.display = 'none';
            div.classList.remove('activo');
        });
        // Quita activo a todos los tabs
        document.querySelectorAll('.tabs .tab').forEach(function(tabBtn) {
            tabBtn.classList.remove('activo');
        });
        // Muestra el grid correspondiente y activa el tab
        document.getElementById(btn.getAttribute('onclick').split("'")[1]).style.display = 'grid';
        btn.classList.add('activo');
    });
});
</script>
</body>
</html>
