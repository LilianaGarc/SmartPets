@extends('layout.plantillaSaid')
@section('titulo', 'Detalles de Veterinaria')
@section('contenido')

<div class="card shadow-sm p-4 mb-4">
    <!-- Datos de la Veterinaria -->
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="card-title fw-bold">{{ $veterinaria->nombre }}</h2>
            <a href="{{ route('veterinarias.index') }}"
                class="btn btn-success" role="button" style="font-size: 150%;">
                <i class="fa-solid fa-circle-arrow-left "></i>
            </a>
        </div>
        <hr>

        <div class="row">
            <!-- INFORMACIÓN DE LA VETERINARIA -->
            <div class="col-md-6">
                <h5 class="card-subtitle mb-3 text-muted"><b>Propietario:</b> {{ $veterinaria->nombre_veterinario }}</h5>
                <div class="card-text">
                    <div class="mt-1"><b>Horario:</b> {{ $veterinaria->horario_apertura }} - {{ $veterinaria->horario_cierre }}</div>
                    <div class="mt-1"><b>Teléfono:</b> {{ $veterinaria->telefono }}</div>
                    @if (!empty($veterinaria->whatsapp))
                        <div class="mt-1">
                        <b>WhatsApp:</b> 
                        <a href="https://wa.me/504{{ $veterinaria->whatsapp }}" 
                        target="_blank" 
                        class="text-decoration-none">
                        <i class="fab fa-whatsapp text-success"></i>
                        {{ $veterinaria->whatsapp }}
                        </a>
                        </div>
                    @endif
                    <div class="mt-1"><b>Dirección:</b> {{ $veterinaria->ubicacion->departamento }}, {{ $veterinaria->ubicacion->municipio }}, {{ $veterinaria->ubicacion->ciudad }}</div>
                    <div class="mt-1">{{ $veterinaria->ubicacion->direccion }}</div>
                    <div class="mt-1 d-flex align-items-start"><b>Redes Sociales: </b> 
                    @if($veterinaria->redes->isNotEmpty())
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($veterinaria->redes as $red)
                            @php
                                $icono = '';
                                $color = '';
                                switch(strtolower($red->tipo_red_social)) {
                                    case 'facebook':
                                        $icono = 'fa-facebook';
                                        $color = '#1877f2';
                                        $url = 'https://facebook.com/';
                                        break;
                                    case 'instagram':
                                        $icono = 'fa-instagram';
                                        $color = '#e4405f';
                                        $url = 'https://instagram.com/';
                                        break;
                                }
                            @endphp
                            
                            <a href="{{ $url . $red->nombre_usuario }}" 
                            target="_blank" 
                            class="btn btn-light border-0 d-flex align-items-center gap-2"
                            style="color: {{ $color }}; padding: 4px 12px;">
                                <i class="fab {{ $icono }}"></i>
                                <span class="text-dark">{{ $red->nombre_usuario }}</span>
                            </a>
                        @endforeach
                    </div>
                    @else
                        <span class="text-muted ms-2">No hay redes sociales registradas</span>
                    @endif 
                </div>

                    <div class="mt-1">
                    <b>Evaluación: </b>
                        @if ($veterinaria->numero_calificaciones > 0)
                            <div class="d-flex align-items-center">
                                    <div class="d-flex align-items-center">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star {{ $i < $veterinaria->calificacion_promedio ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <span class="text-secondary ms-2">({{ $veterinaria->numero_calificaciones }} valoraciones)</span>
                            </div>
                            @else
                                <span class="text-muted">Sin calificaciones</span>
                            @endif
                    </div>

                </div>
            </div>

                <div class="col-md-6 mt-1">
                    @if ($veterinaria->ubicacion && $veterinaria->ubicacion->latitud && $veterinaria->ubicacion->longitud)
                        <div id="map"  style="height: 300px; width: 100%; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"></div>
                    @else
                        <img src="{{ asset('images/no_hay_ubicacion.webp') }}" 
                             alt="No hay ubicación" class="mx-auto d-block img-fluid  mb-3" 
                             style="width: 150px; max-width: 200px; opacity: 0.7;">
                            <p class="text-muted text-center">Los datos de ubicación son insuficientes</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Imágenes de la Veterinaria -->
    <div class="card shadow-sm p-4 mb-4">
        <div class="card-body">
            <h3 class="card-title mb-3 fw-bold">Imágenes de la Veterinaria</h3>
            @if ($veterinaria->imagenes->isNotEmpty())
            <div class="d-none d-md-block">
                <div class="d-flex wrap gap-3" style="overflow-x: auto; scrollbar-width: thin; padding-bottom: 10px;">
                    @foreach ($veterinaria->imagenes as $imagen)
                    <div class="image-preview-item">
                        <img src="{{ asset('storage/' . $imagen->path) }}"
                            alt="Imagen de la veterinaria" class="img-thumbnail"
                            style="max-width: 300px; max-height: 232px;">
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="d-md-none position-relative">
                <div id="carouselImagenes" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach ($veterinaria->imagenes as $index => $imagen)
                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $imagen->path) }}"
                                class="d-block w-100 rounded"
                                alt="Imagen de la veterinaria"
                                style="height: 300px; object-fit: cover;">
                        </div>
                        @endforeach
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselImagenes" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#carouselImagenes" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>

                    <div class="position-absolute bottom-0 end-0 bg-dark bg-opacity-75 text-white px-3 py-2 rounded-pill m-3">
                        <small>Imagen <span class="carousel-current">1</span> de {{ $veterinaria->imagenes->count() }}</small>
                    </div>

                </div>
            </div>
            @else
            <div>
                <img src="{{ asset('images/vacio.svg') }}" 
                     alt="No hay imágenes" class="mx-auto d-block img-fluid  mb-3" 
                     style="width: 150px; max-width: 200px; opacity: 0.7;">
                <p class="text-muted text-center">No hay imágenes disponibles</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Formulario para calificar y opinar -->
    <div class="card shadow-sm p-4 mb-4">
        <div class="card-body">
            <h3 class="card-title mb-3 fw-bold">Calificar y Opinar</h3>
            <form action="{{ route('calificaciones.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_veterinaria" value="{{ $veterinaria->id }}">
                <div class="mb-3">
                    <label for="calificacion" class="form-label fw-bold">Calificación:</label>
                    <div class="star-rating">
                        @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="calificacion" value="{{ $i }}" />
                        <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                        @endfor
                    </div>
                </div>

                <div class="mb-3">
                    <label for="opinion" class="form-label fw-bold">Opinión</label>
                    <textarea class="form-control" id="opinion" name="opinion" rows="3" placeholder="Escribe tu opinión aquí..."></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
                <input class="btn btn-danger" type="reset" value="Limpiar">
            </form>
        </div>
    </div>

    <!-- Calificaciones -->
    <div class="card shadow-sm p-4 mb-4">
        <div class="card-body">
            <h3 class="card-title mb-3 fw-bold">Calificaciones</h3>
            @if ($veterinaria->calificaciones->isEmpty())
            <div class="text-center p-4">
                <p class="text-muted">No hay calificaciones</p>
                <img src="{{ asset('images/vacio.svg') }}" alt="No hay calificaciones" class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
            </div>
            @else
                @foreach ($veterinaria->calificaciones as $calificacion)
                    <div class="card mb-3 p-3 border-0 shadow-sm">
                        <div class="d-flex align-items-center">
                            @php
                            $foto = null;
                            if ($calificacions->user && $calificacion->user->fotoperfil) {
                                $foto = asset('storage/' . $calificacion->user->fotoperfil);
                            } else {
                                $foto = asset('images/fotodeperfil.webp');
                            }
                                $foto = $veterinaria->usuario->fotoperfil
                                    ? asset('storage/' . $veterinaria->usuario->fotoperfil)
                                    : asset('images/fotodeperfil.webp');
                            @endphp
                            <img src="{{ $foto }}" class="rounded-circle me-3" style="width: 80px; height: 80px; object-fit: cover;">
                             <div>
                                <h5 class="mb-1 fw-bold">{{ $calificacion->user->name }}</h5>
                                    <div class="text-warning">
                                        @for ($i = 0; $i < 5; $i++)
                                            <i class="fas fa-star {{ $i < $calificacion->calificacion ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                        <p class="mt-2 text">{{ $calificacion->opinion }}</p>
                            </div>
                        </div>

                        <div class="text-end text-secondary">
                            <small>{{ $calificacion->created_at->diffForHumans() }}</small>
                        </div>

                        <!-- Botones para editar y eliminar -->
                        <!-- Solo mostrar si el usuario está autenticado y es el propietario de la calificación -->
                        @if (auth()->check() && auth()->user()->id == $calificacion->user_id)
                            <div class="text-end mt-2">
                                <!-- Botón para editar -->
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $calificacion->id }}">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </button>
                                
                                <!-- Botón para eliminar -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $calificacion->id }}">
                                    <i class="fas fa-trash me-1"></i>Eliminar
                                </button>
                        
                            </div>
                        @endif
                    </div>
            @endforeach
            @endif
        </div>
    </div>

    <!-- Modales para editar y eliminar calificaciones -->
    @foreach ($veterinaria->calificaciones as $calificacion)
    <div class="modal fade" id="modalEditar{{ $calificacion->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Calificación</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('calificaciones.update', $calificacion->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                 <label class="form-label fw-bold">Calificación:</label>
                                    <div class="star-rating">
                                       @for ($i = 5; $i >= 1; $i--) 
                                        <input type="radio" id="starEdit{{ $calificacion->id }}_{{ $i }}" name="calificacion" value="{{ $i }}" 
                                                {{ $calificacion->calificacion == $i ? 'checked' : '' }}/>
                                        <label for="starEdit{{ $calificacion->id }}_{{ $i }}">
                                            <i class="fas fa-star"></i>
                                       </label>
                                       @endfor
                                    </div>
                            </div>
                                <div class="mb-3">
                                    <label for="opinion{{ $calificacion->id }}" class="form-label fw-bold">Opinión:</label>
                                        <textarea class="form-control" 
                                            id="opinion{{ $calificacion->id }}" 
                                            name="opinion" 
                                            rows="3">{{ $calificacion->opinion }}
                                        </textarea>
                                </div>
                        </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>                                    
                            </div>
                    </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEliminar{{ $calificacion->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">¿Desea eliminar esta calificación?
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('calificaciones.destroy', $calificacion->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                    </div> 
            </div>
        </div>
    </div>
    @endforeach

    <style>
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: start;
            gap: 5px;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 24px;
            color: #ddd;
            cursor: pointer;
            transition: color 0.3s;
        }

        .star-rating input:checked~label,
        .star-rating label:hover,
        .star-rating label:hover~label {
            color: #ffc107;
        }
    </style>

    <script>
        // Actualizar el contador de imágenes en el carousel
        document.addEventListener('DOMContentLoaded', function() {
            const carousel = document.getElementById('carouselImagenes');
            if (carousel) {
                const currentIndicator = carousel.querySelector('.carousel-current');
                carousel.addEventListener('slid.bs.carousel', function(event) {
                    currentIndicator.textContent = event.to + 1;
                });
            }
        });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        if (document.getElementById('map')) {
            var map = L.map('map').setView([{{ $veterinaria->ubicacion->latitud }},{{ $veterinaria->ubicacion->longitud }}], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([{{ $veterinaria->ubicacion->latitud }},{{ $veterinaria->ubicacion->longitud }}]).addTo(map);
            marker.bindPopup("<b>{{ $veterinaria->nombre }}</b><br>{{ $veterinaria->ubicacion->direccion }}").openPopup();
        }
    });
    </script>

    @endsection