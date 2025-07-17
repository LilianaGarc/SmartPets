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
                <!-- Botón para abrir el modal -->
                <button type="button" class="btn-actualizar-foto" id="abrirModalFoto">
                    Actualizar foto de perfil
                </button>

                <a href="{{ route('profile.edit') }}" title="Editar perfil">
                    <i data-lucide="settings" class="icono"></i>
                </a>

            </div>
            <div class="contador-general">
                <p><strong>Mascotas:</strong> <span class="contador-numero" data-numero="{{ $adopciones->count() }}">0</span></p>
                <p><strong>Solicitudes enviadas:</strong> <span class="contador-numero" data-numero="{{ $adopcionesSolicitadas->count() }}">0</span></p>
            </div>

            <div class="productos-guardados">
                <img  class="marcador" id="icono-marcador" src="{{ asset('images/marcadorAzul.png') }}" alt="Guardados" title="Productos Guardados" style="width: 20px; height: 20px;">
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
</body>
</html>
