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
        {{-- Mascota virtual igual que en tu perfil --}}
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
                            <p class="contador-visitas">
                                <i class="fas fa-eye"></i> {{ $adopcion->visibilidad }}
                            </p>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>

        <div id="publicaciones" class="grid">
           @if(isset($publicaciones) && $publicaciones->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡No ha publicado publicaciones aún! 😿</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay publicaciones" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @elseif(isset($publicaciones))
                @foreach($publicaciones as $publicacion)
                    <div class="card">
                        <a href="{{ route('publicaciones.show', $publicacion->id) }}">
                            <img src="{{ asset('storage/' . $publicacion->imagen) }}" alt="Publicación" class="img-card">
                        </a>
                        <div class="overlay-info">
                            <p><strong>{{ $publicacion->titulo }}</strong></p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div id="veterinarias" class="grid">
            @if(isset($veterinarias) && $veterinarias->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡No ha publicado veterinarias aún! 😿</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay veterinarias" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @elseif(isset($veterinarias))
                @foreach($veterinarias as $veterinaria)
                    <div class="card">
                        <a href="{{ route('veterinarias.show', $veterinaria->id) }}">
                            <img src="{{ asset('storage/' . $veterinaria->imagen) }}" alt="Veterinaria" class="img-card">
                        </a>
                        <div class="overlay-info">
                            <p><strong>{{ $veterinaria->nombre }}</strong></p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        
        <div id="eventos" class="grid">
            @if(isset($eventos) && $eventos->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡No ha publicado eventos aún! 😿</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay eventos" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @elseif(isset($eventos))
                @foreach($eventos as $evento)
                    <div class="card">
                        <a href="{{ route('eventos.show', $evento->id) }}">
                            <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Evento" class="img-card">
                        </a>
                        <div class="overlay-info">
                            <p><strong>{{ $evento->titulo }}</strong></p>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div id="petshop" class="grid">
            @if(isset($productosUsuario) && $productosUsuario->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡Aún no ha publicado productos! 😿</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay productos" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @elseif(isset($productosUsuario))
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