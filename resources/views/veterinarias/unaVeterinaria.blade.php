@extends('layout.plantillaSaid')
@section('titulo', 'Detalles de Veterinaria')
@section('contenido')

<div class="breadcrumb-container">
    <ul class="breadcrumb">
        <li class="breadcrumb__item">
            <a href="{{ route('index') }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">Inicio</span>
            </a>
        </li>
        <li class="breadcrumb__item">
            <a href="{{ route('veterinarias.index') }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">Veterinarias</span>
            </a>
        </li>
        <li class="breadcrumb__item breadcrumb__item-active">
            <a href="{{ route('veterinarias.show', $veterinaria->id) }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">Ver Veterinaria</span>
            </a>
        </li>
    </ul>
</div>

    <div class="card shadow-sm p-4 mb-4 mt-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3 flex-nowrap gap-2" style="min-height: 56px;">
                <h2 class="card-title fw-bold flex-grow-1 mb-0 .titulo-nombre-veterinaria-responsive"
                    style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size:clamp(1.3rem, 3vw, 2.2rem); min-width:0;">
                    {{ $veterinaria->nombre }}
                </h2>
                <a href="{{ route('veterinarias.index') }}" class="btn btn-success btn-volver-evento ms-2" role="button" style="font-size: 150%;">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                </a>
            </div>
            <hr>

            <div class="row">
                <div class="col-12 col-md-6 mb-3 mb-md-0">
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
                        <div class="mt-1"><b>Dirección:</b> {{ $veterinaria->ubicacion->departamento }}, {{ $veterinaria->ubicacion->municipio }}, {{ $veterinaria->ubicacion->ciudad }}, {{ $veterinaria->ubicacion->direccion }}</div>
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

                        <div class="mt-1 d-flex align-items-center flex-wrap">
                            <b class="me-2">Evaluación:</b>
                            @if ($veterinaria->numero_calificaciones > 0)
                            <div class="d-flex align-items-center">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star {{ $i < $veterinaria->calificacion_promedio ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                    <span class="text-secondary ms-2">({{ $veterinaria->numero_calificaciones }} valoraciones)</span>
                            </div>
                            @else
                            <span class="text-muted ms-2">Sin calificaciones</span>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-12 col-md-6 mt-1 text-center">
                    @if ($veterinaria->ubicacion && $veterinaria->ubicacion->latitud && $veterinaria->ubicacion->longitud)
                    <div id="map" style="height: 300px; width: 100%; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);"></div>
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

    <div class="card shadow-sm p-4 mb-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-body">
            <h3 class="card-title mb-3 fw-bold">Calificar y Opinar</h3>
    
            @auth
            <form action="{{ route('calificaciones.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_veterinaria" value="{{ $veterinaria->id }}">
                <input type="hidden" name="id_usuario" value="{{ auth()->id() }}">
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
                    <textarea class="form-control" id="opinion" name="opinion" rows="3"
                        maxlength="200" placeholder="Escribe tu opinión aquí..."></textarea>
                    <div class="text-end">
                        <small id="caracteresRestantes" class="text-muted">0/200</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
                <input class="btn btn-danger" type="reset" value="Limpiar">
            </form>
            @else
            <div class="card-body py-5 d-flex flex-column align-items-center justify-content-center">
                <p class="mb-3 text-muted fw-semibold" style="font-size:1rem;">
                    Inicia sesión para poder calificar u opinar.
                </p>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 py-2 rounded-pill d-inline-flex align-items-center">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> Iniciar sesión
                </a>
            </div>
            @endauth
        </div>
    </div>

    <div class="card shadow-sm p-4 mb-4">
        <div class="card-body">
            <h3 class="card-title mb-3 fw-bold">Calificaciones</h3>

            {{-- Mensajes de éxito/error SOLO para acciones de calificaciones --}}
            @if (session('exito'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('exito') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <i class="fas fa-times-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
            @endif

            @if ($veterinaria->calificaciones->isEmpty())
            <div class="text-center p-4">
                <p class="text-muted">No hay calificaciones</p>
                <img src="{{ asset('images/vacio.svg') }}" alt="No hay calificaciones" class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
            </div>
            @else
            <div class="row g-3">
                @foreach ($veterinaria->calificaciones as $calificacion)
                <div class="col-12">
                    <div class="card border-0 shadow h-100 calificacion-card">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                @php
                                $fotoPerfil = $calificacion->user && $calificacion->user->fotoperfil
                                ? asset('storage/' . $calificacion->user->fotoperfil)
                                : asset('images/fotodeperfil.webp');
                                @endphp
                                <img src="{{ $fotoPerfil }}" class="rounded-circle me-3 border border-2" style="width: 60px; height: 60px; object-fit: cover;">
                                <div>
                                    <h5 class="mb-1 fw-bold">{{ $calificacion->user->name }}</h5>
                                </div>
                            </div>
                            <div class="mb-2 ms-2">
                                <div class="star-rating-static mb-2">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star {{ $i < $calificacion->calificacion ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                </div>
                                <p class="mb-0 text-dark" style="font-size: 1.1rem;">{{ $calificacion->opinion }}</p>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <small class="text-secondary">{{ $calificacion->created_at->diffForHumans() }}</small>
                                @if (auth()->check() && auth()->id() == $calificacion->id_user)
                                <div>
                                    <button type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $calificacion->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $calificacion->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>

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
                    <input type="hidden" name="id_veterinaria" value="{{ $veterinaria->id }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Calificación:</label>
                            <div class="star-rating">
                                @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="starEdit{{ $calificacion->id }}_{{ $i }}" name="calificacion" value="{{ $i }}"
                                    {{ $calificacion->calificacion == $i ? 'checked' : '' }} />
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
                                      rows="3"
                                      maxlength="500"
                                      required
                                      oninput="actualizarContador(this, 'contador{{ $calificacion->id }}')">{{ old('opinion', trim($calificacion->opinion)) }}</textarea>

                            <div class="text-end">
                                <small id="contador{{ $calificacion->id }}" class="text-muted">0/500</small>
                            </div>
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

</div>
</div>



<style>
    .breadcrumb-container {
        display: flex;
        align-items: start;
        gap: 20px;
        width: 100%;
        justify-content: space-between;
    }

    .breadcrumb {
        display: flex;
        border-radius: 10px;
        text-align: center;
        height: 40px;
        z-index: 1;
        justify-content: flex-start;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .breadcrumb__item {
        height: 100%;
        background-color: white;
        color: #252525;
        font-family: 'Oswald', sans-serif;
        border-radius: 7px;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        position: relative;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        transform: skew(-21deg);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
        margin: 5px;
        padding: 0 40px;
    }

    .breadcrumb__item:hover {
        background: #1e4183;
        color: #FFF;
    }

    .breadcrumb__inner {
        display: flex;
        flex-direction: column;
        margin: auto;
        z-index: 2;
        transform: skew(21deg);
    }

    .breadcrumb__title {
        font-size: 16px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .breadcrumb__item a {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
    }

    .breadcrumb__item-active {
        background-color: #1e4183;
        color: #FFF;
    }

    /* Responsive para breadcrumb */
    @media (max-width: 768px) {
        .breadcrumb-container {
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .breadcrumb {
            display: flex;
            flex-direction: row;
            align-items: start;
            flex-wrap: wrap;
        }

        .breadcrumb__item {
            width: 5px;
            flex-shrink: 0;
        }

        .breadcrumb__item .breadcrumb__title {
            font-size: 9px;
            white-space: normal;
            word-wrap: break-word;
            max-width: 100px;
            line-height: 1.2;
        }
    }

    @media (min-width: 768px) and (max-width: 1024px) {
        .breadcrumb-container {
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .breadcrumb {
            display: flex;
            flex-direction: row;
            align-items: start;
            flex-wrap: wrap;
        }

        .breadcrumb__item {
            width: 80px;
            flex-shrink: 0;
        }

        .breadcrumb__item .breadcrumb__title {
            font-size: 11px;
            white-space: normal;
            word-wrap: break-word;
            max-width: 100px;
            line-height: 1.2;
        }
    }

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

    .card-text,
    .card-title,
    .card-subtitle,
    .mt-1,
    .mb-1,
    .fw-bold,
    .form-label,
    .form-control,
    .btn,
    .alert,
    .star-rating label {
        font-size: 1.15rem !important;
    }

    .card-title {
        font-size: 2rem !important;
    }

    .card-subtitle {
        font-size: 1.25rem !important;
    }

    .calificacion-card {
        border-radius: 1rem;
        transition: box-shadow 0.2s, transform 0.2s;
        background: linear-gradient(135deg, #f8fafc 80%, #e9f7ef 100%);
    }

    .calificacion-card:hover {
        box-shadow: 0 8px 32px rgba(40, 167, 69, 0.12), 0 1.5px 8px rgba(40, 167, 69, 0.10);
        transform: translateY(-4px) scale(1.02);
    }

    .star-rating-static .fa-star {
        font-size: 1.2rem;
        margin-right: 2px;
    }

    .star-rating-static .fa-star.text-warning {
        text-shadow: 0 2px 8px rgba(255, 193, 7, 0.15);
    }

    @media (max-width: 767.98px) {

        .card-text>div,
        .card-text>b,
        .card-text>span {
            display: block !important;
            margin-bottom: 0.5rem;
        }

        .d-flex.align-items-start {
            flex-direction: column !important;
            align-items: flex-start !important;
        }
    }

    .titulo-nombre-veterinaria-responsive {
        min-width: 0;
        max-width: 100%;
    }
    @media (max-width: 767.98px) {
        .titulo-nombre-veterinaria-responsive {
            font-size: 1.1rem !important;
            padding-right: 60px;
        }
    }
</style>

<script>
    function actualizarContador(textarea, idContador = null) {
        const maxLength = textarea.getAttribute('maxlength');
        const currentLength = textarea.value.length;
        let contador;
        if (idContador) {
            contador = document.getElementById(idContador);
        } else {
            contador = textarea.parentElement.querySelector('small');
        }
        if (contador) {
            contador.textContent = `${currentLength}/${maxLength}`;
        }
    }

    // Para inicializar el contador al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
        // Para el formulario principal
        const opinion = document.getElementById('opinion');
        if (opinion) {
            actualizarContador(opinion);
            opinion.addEventListener('input', function() {
                actualizarContador(this);
            });
        }
        // Para los modales de edición
        @foreach($veterinaria->calificaciones as $calificacion)
        const textareaEdit{{ $calificacion->id }} = document.getElementById('opinion{{ $calificacion->id }}');
        if (textareaEdit{{ $calificacion->id }}) {
            actualizarContador(textareaEdit{{ $calificacion->id }}, 'contador{{ $calificacion->id }}');
            textareaEdit{{ $calificacion->id }}.addEventListener('input', function() {
                actualizarContador(this, 'contador{{ $calificacion->id }}');
            });
        }
        @endforeach
    });
</script>

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
            var map = L.map('map').setView([{{ $veterinaria->ubicacion->latitud }}, {{ $veterinaria->ubicacion->longitud }}], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var marker = L.marker([{{ $veterinaria->ubicacion->latitud }}, {{ $veterinaria->ubicacion->longitud }}]).addTo(map);
            marker.bindPopup("<b>{{ $veterinaria->nombre }}</b><br>{{ $veterinaria->ubicacion->direccion }}").openPopup();
        }
    });
</script>
@endsection
