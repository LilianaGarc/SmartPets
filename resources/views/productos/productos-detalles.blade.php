@extends('layout.plantillaSaid')
@section('titulo', 'Detalles del Producto')
@section('contenido')
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
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .titulo-evento-responsive {
            min-width: 0;
            max-width: 100%;
        }
        @media (max-width: 767.98px) {
            .titulo-evento-responsive {
                font-size: 1.1rem !important;
                padding-right: 60px;
            }
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .profile-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .username {
            font-weight: bold;
        }
        .review-system {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
        }
        .review-toggle-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: none;
            background-color: #1e4183;
            color: white;
            border-radius: 50%;
            font-size: 24px;
            cursor: pointer;
            transition: transform 0.3s ease;
            margin-bottom: 1rem;
        }
        .review-toggle-btn:hover {
            transform: rotate(90deg);
        }
        .review-container {
            overflow: hidden;
            transition: max-height 0.5s ease-in-out;
        }
        .review-hidden {
            max-height: 0;
            padding: 0;
            visibility: hidden;
        }
        .review-visible {
            max-height: 500px;
            padding-top: 1rem;
            visibility: visible;
        }
        .review-header {
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
        .review-title-header {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .review-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        .review-form-group {
            display: flex;
            flex-direction: column;
        }
        .review-label {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .review-input, .review-textarea {
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .review-input:focus, .review-textarea:focus {
            border-color: #1e4183;
            outline: none;
        }
        .review-textarea {
            resize: vertical;
            min-height: 100px;
        }
        .review-actions {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }
        .review-button {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .review-button-publish {
            background-color: #1e4183;
        }
        .review-button-publish:hover {
            background-color: #173264;
        }
        .review-button-cancel {
            background-color: #6c757d;
        }
        .review-button-cancel:hover {
            background-color: #5a6268;
        }
        .main-image-container {
            width: 100%;
            max-width: 480px;
            height: 480px;
            min-height: 220px;
            border: 3px solid #1e4183;
            overflow: hidden; /* Esto es para que las imágenes más grandes no se desborden del contenedor */
            display: flex; /* Centra la imagen dentro del contenedor */
            align-items: center;
            justify-content: center;
        }
        #mainProductImage {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .thumbnail-image-container {
            width: 80px;
            height: 80px;
            border: 2px solid transparent;
            cursor: pointer;
            transition: border-color 0.3s;
        }
        .thumbnail-image-container.active-thumbnail {
            border-color: #1e4183;
        }
        .thumbnail-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>

    <div class="breadcrumb-container">
        <ul class="breadcrumb">
            <li class="breadcrumb__item">
                <a href="{{ route('index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Inicio</span>
                </a>
            </li>
            <li class="breadcrumb__item">
                <a href="{{ route('productos.index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Productos</span>
                </a>
            </li>
            <li class="breadcrumb__item breadcrumb__item-active">
            <span class="breadcrumb__inner">
                <span class="breadcrumb__title">Ver Producto</span>
            </span>
            </li>
        </ul>
    </div>

    @if(session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm p-4 mb-4 mt-4">
        <div class="card-body">
            <div class="d-flex align-items-center mb-3 flex-nowrap gap-2" style="min-height: 56px;">
                <h2 class="card-title fw-bold flex-grow-1 mb-0 titulo-evento-responsive"
                    style="white-space: normal; overflow: visible; text-overflow: unset; font-size:clamp(1.3rem, 3vw, 2.2rem);">
                    {{ $producto->nombre }}
                </h2>
                <a href="{{ route('productos.index') }}" class="btn btn-success btn-volver-evento ms-2" role="button" style="font-size: 150%;">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                </a>
            </div>
            <hr>
            <div class="row g-4">
                <div class="col-12 col-lg-7 d-flex flex-column justify-content-center">
                    <div class="card-text w-100" style="font-size: 1.15rem;">
                        <div class="mb-2">
                            <span style="font-size:1.3em;">🏷️</span> <b>Precio:</b>
                            <span class="text-secondary">L.{{ number_format($producto->precio, 2) }}</span>
                        </div>
                        <div class="mb-2">
                            <span style="font-size:1.3em;">📦</span> <b>Estado:</b>
                            <span class="badge @if($producto->activo) bg-success @else bg-danger @endif" style="font-size: 1rem;">
            @if($producto->activo)
                                    En Stock
                                @else
                                    No Disponible
                                @endif
        </span>
                        </div>
                        <div class="mb-2">
                            <span style="font-size:1.3em;">📝</span> <b>Descripción:</b>
                            <span class="text-secondary">{{ $producto->descripcion }}</span>
                        </div>
                        <div class="mb-2">
                            <span style="font-size:1.3em;">🛒</span> <b>Categoría:</b>
                            <a href="{{ route('productos.index', ['categoria' => $producto->categoria_id]) }}" class="text-secondary" style="text-decoration: underline;">
                                {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                            </a>
                        </div>
                        @if($producto->subcategoria)
                            <div class="mb-2">
                                <span style="font-size:1.3em;">🛍️</span> <b>Subcategoría:</b>
                                <a href="{{ route('productos.index', ['categoria' => $producto->categoria_id, 'subcategoria' => $producto->subcategoria_id]) }}" class="text-secondary" style="text-decoration: underline;">
                                    {{ $producto->subcategoria->nombre ?? 'Sin subcategoría' }}
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="d-flex align-items-center gap-3 mt-3">
                        @auth
                            @php
                                $favorito = \App\Models\ProdFavorito::where('user_id', auth()->id())
                                        ->where('producto_id', $producto->id)
                                        ->first();
                            @endphp
                            <form id="favorito-form-{{$producto->id}}" method="POST" style="display: inline-block;">
                                @csrf
                                @if($favorito)
                                    <input type="hidden" name="producto_id" value="{{$producto->id}}">
                                    <button type="submit"
                                            formaction="{{route('productos.eliminarGuardado', $producto->id)}}"
                                            class="btn btn-link p-0 m-0" title="eliminar producto guardado"
                                            style="width: 32px; height: 32px;">
                                        <img src="{{ asset('images/marcador.png') }}" alt="Guardado" class="img-fluid"
                                             style="width: 32px; height: 32px; animation: marcadorAnim 0.5s ease-in-out;">
                                    </button>
                                @else
                                    <input type="hidden" name="producto_id" value="{{$producto->id}}">
                                    <button type="submit" formaction="{{route('productos.guardar', $producto->id)}}"
                                            class="btn btn-link p-0 m-0" title="guardar producto"
                                            style="width: 32px; height: 32px;">
                                        <img src="{{ asset('images/marcadorVacio.png') }}" alt="No guardado"
                                             class="img-fluid"
                                             style="width: 32px; height: 32px; animation: marcadorAnim 0.5s ease-in-out;">
                                    </button>
                                @endif
                            </form>
                        @endauth
                        @auth
                            @if(auth()->id() === $producto->user_id || auth()->user()->is_admin)
                                <form action="{{ route('productos.toggleActivo', $producto->id) }}" method="POST" style="display: inline-block; margin-left: 10px;">
                                    @csrf
                                    @method('PATCH')
                                    <div class="form-check form-switch" style="display: inline-flex; align-items: center;">
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            id="switchActivo{{$producto->id}}"
                                            name="activo"
                                            onchange="this.form.submit()"
                                            {{ $producto->activo ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label ms-1" for="switchActivo{{$producto->id}}" title="Cambiar estado de disponibilidad">
                                            {{ $producto->activo ? 'Disponible' : 'No disponible' }}
                                        </label>
                                    </div>
                                </form>
                            @endif
                        @endauth
                    </div>

                    <div class="mt-4">
                        @auth
                            <div class="d-flex align-items-center gap-3">
                                @php
                                    $mensaje = 'Estoy interesado en el producto "' . $producto->nombre . " "  . route('productos.show', $producto->id);
                                @endphp

                                @if(auth()->id() !== $producto->user_id)
                                    <a href="{{ route('chats.iniciar', $producto->user_id) }}?mensaje={{ rawurlencode($mensaje) }}"
                                       class="btn btn-primary text-white">
                                        <i class="fas fa-comment-dots"></i> Enviar Mensaje
                                    </a>
                                @endif

                                @if(auth()->check() && auth()->id() === $producto->user_id)
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-warning text-white"
                                                onclick="window.location.href='{{ route('productos.edit', $producto->id) }}'">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                                data-bs-target="#ModalProducto">
                                            <i class="fas fa-trash-alt"></i> Eliminar
                                        </button>
                                    </div>
                                @endif
                            </div>
                        @endauth
                    </div>
                </div>

                <div class="col-12 col-lg-5 d-flex flex-column align-items-center">
                    <div class="main-image-container mb-3">
                        <img
                            id="mainProductImage"
                            src="{{ isset($producto->imagen) ? url('storage/' . $producto->imagen) : asset('images/img_PorDefecto.jpg')}}"
                            alt="{{ $producto->nombre }}" class="img-fluid rounded"
                        >
                    </div>
                    <div class="thumbnails d-flex justify-content-center mb-4 gap-2">
                        @if(isset($producto->imagen))
                            <div class="thumbnail-image-container active-thumbnail" onclick="changeMainImage(this)"
                                 data-full-src="{{ url('storage/' . $producto->imagen) }}">
                                <img src="{{ url('storage/' . $producto->imagen) }}" alt="Thumbnail 1" class="thumbnail-image rounded">
                            </div>
                        @endif
                        @if(isset($producto->imagen2))
                            <div class="thumbnail-image-container" onclick="changeMainImage(this)"
                                 data-full-src="{{ url('storage/' . $producto->imagen2) }}">
                                <img src="{{ url('storage/' . $producto->imagen2) }}" alt="Thumbnail 2" class="thumbnail-image rounded">
                            </div>
                        @endif
                        @if(isset($producto->imagen3))
                            <div class="thumbnail-image-container" onclick="changeMainImage(this)"
                                 data-full-src="{{ url('storage/' . $producto->imagen3) }}">
                                <img src="{{ url('storage/' . $producto->imagen3) }}" alt="Thumbnail 3" class="thumbnail-image rounded">
                            </div>
                        @endif
                        @if(isset($producto->imagen4))
                            <div class="thumbnail-image-container" onclick="changeMainImage(this)"
                                 data-full-src="{{ url('storage/' . $producto->imagen4) }}">
                                <img src="{{ url('storage/' . $producto->imagen4) }}" alt="Thumbnail 4" class="thumbnail-image rounded">
                            </div>
                        @endif
                        @if(isset($producto->imagen5))
                            <div class="thumbnail-image-container" onclick="changeMainImage(this)"
                                 data-full-src="{{ url('storage/' . $producto->imagen5) }}">
                                <img src="{{ url('storage/' . $producto->imagen5) }}" alt="Thumbnail 5" class="thumbnail-image rounded">
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm p-4 mb-4 mt-4">
        <div class="card-body">
            <h2 class="card-title fw-bold">Reseñas</h2>
            <hr>
            @auth
                <div class="review-system mb-4">
                    <button id="review-toggle-btn" class="review-toggle-btn">
                        <span class="review-toggle-icon">+</span>
                    </button>
                    <div id="review-container"
                         class="review-container {{ isset($mostrarFormulario) ? 'review-visible' : 'review-hidden' }}">
                        <div class="review-header">
                            <h2 class="review-title-header">{{ isset($resenia) ? 'Editar Reseña' : 'Escribir Reseña' }}</h2>
                        </div>
                        <div class="review-body">
                            <form id="review-form" class="review-form"
                                  action="{{ isset($resenia) ? route('productos.editarResenia', ['producto' => $producto->id, 'resenia' => $resenia->id]) : route('productos.agregarResenia', $producto->id) }}"
                                  method="POST">
                                @csrf
                                @if(isset($resenia))
                                    @method('PUT')
                                @endif
                                <div class="review-form-group">
                                    <label for="review-title" class="review-label">Título</label>
                                    <input type="text" class="review-input" id="review-title" name="titulo" maxlength="50"
                                           value="{{ old('titulo', $resenia->titulo ?? '') }}"
                                           placeholder="Escribe un título para tu reseña">
                                    <span id="titulo-error" class="text-danger" style="display: none;"></span>
                                </div>
                                <div class="review-form-group">
                                    <label for="review-content" class="review-label">Contenido</label>
                                    <textarea class="review-textarea" id="review-content" maxlength="255"
                                              name="contenido"
                                              placeholder="Escribe tu reseña aquí...">{{ old('contenido', $resenia->contenido ?? '') }}</textarea>
                                    <span id="contenido-error" class="text-danger" style="display: none;"></span>
                                </div>
                                <div class="review-actions">
                                    <button type="submit" class="review-button review-button-publish">
                                        {{ isset($resenia) ? 'Actualizar' : 'Publicar' }}
                                    </button>
                                    <button type="button" class="review-button review-button-cancel">Cancelar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endauth
            <div class="accordion" id="accordionExample">
                @foreach($resenias as $index => $resenia)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $index }}">
                            <button class="accordion-button collapsed"
                                    type="button"
                                    data-bs-target="#collapse{{$index}}" data-bs-toggle="collapse"
                                    aria-expanded="false"
                                    aria-controls="collapse{{ $index }}">
                                <div class="user-info">
                                    @php
                                        $foto = $resenia->user->fotoperfil
                                                ? asset('storage/' . $resenia->user->fotoperfil)
                                                : asset('images/fotodeperfil.webp');
                                    @endphp
                                    <img src="{{ $foto }}" alt="Foto de perfil" class="profile-image">

                                    <div>
                                        <span class="username">{{ $resenia->user->name ?? 'Usuario eliminado' }}</span>
                                        <small class="d-block" >Publicado el {{ $resenia->created_at->format('d/m/Y H:i') }}</small>
                                    </div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapse{{ $index }}"
                             class="accordion-collapse collapse"
                             aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <strong>{{ $resenia->titulo }}</strong>
                                <p class="textoAjustado">{{ $resenia->contenido }}</p>
                                @auth
                                    @if( auth()->check() && auth()->id()===$resenia->user_id)
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#ModalResenia{{$resenia->id}}">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning"
                                                onclick="location.href='{{ route('productos.mostrarFormularioEdicion', ['producto' => $producto->id, 'resenia' => $resenia->id]) }}'">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>

                                        <div class="modal fade" id="ModalResenia{{$resenia->id}}"
                                             tabindex="-1"
                                             aria-labelledby="ModalReseniaLabel{{$resenia->id}}"
                                             aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="ModalReseniaLabel{{$resenia->id}}">Eliminar
                                                            Reseña</h1>
                                                        <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas eliminar esta reseña?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form
                                                            action="{{ route('productos.eliminarResenia', ['producto' => $producto->id, 'resenia' => $resenia->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancelar
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalProducto" tabindex="-1" aria-labelledby="ModalProductoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalProductoLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este producto? Esta acción no se puede deshacer.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" form="delete-form-{{$producto->id}}" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('review-toggle-btn');
            const reviewContainer = document.getElementById('review-container');
            const cancelBtn = document.querySelector('.review-button-cancel');
            const reviewForm = document.getElementById('review-form');

            function toggleForm(show) {
                if (show === undefined) {
                    const isVisible = reviewContainer.classList.contains('review-visible');
                    toggleForm(!isVisible);
                } else {
                    if (show) {
                        reviewContainer.classList.add('review-visible');
                        reviewContainer.classList.remove('review-hidden');
                        toggleBtn.querySelector('.review-toggle-icon').textContent = '-';
                    } else {
                        reviewContainer.classList.add('review-hidden');
                        reviewContainer.classList.remove('review-visible');
                        toggleBtn.querySelector('.review-toggle-icon').textContent = '+';
                    }
                }
            }

            if (toggleBtn) {
                toggleBtn.addEventListener('click', () => toggleForm());
            }

            if (cancelBtn) {
                cancelBtn.addEventListener('click', () => {
                    toggleForm(false);
                    if (window.location.href.includes('/editar')) {
                        window.location.href = '{{ route("productos.show", $producto->id) }}';
                    }
                });
            }

            if (reviewForm) {
                reviewForm.addEventListener('submit', function(event) {
                    const titulo = document.getElementById('review-title').value;
                    const contenido = document.getElementById('review-content').value;
                    const tituloError = document.getElementById('titulo-error');
                    const contenidoError = document.getElementById('contenido-error');
                    let isValid = true;

                    // Limpiar errores previos
                    tituloError.textContent = '';
                    contenidoError.textContent = '';
                    tituloError.style.display = 'none';
                    contenidoError.style.display = 'none';

                    if (titulo.trim() === '') {
                        tituloError.textContent = 'El título no puede estar vacío.';
                        tituloError.style.display = 'block';
                        isValid = false;
                    }

                    if (contenido.trim() === '') {
                        contenidoError.textContent = 'El contenido de la reseña no puede estar vacío.';
                        contenidoError.style.display = 'block';
                        isValid = false;
                    }

                    if (!isValid) {
                        event.preventDefault();
                    }
                });
            }
        });

        function changeMainImage(thumbnail) {
            const mainImage = document.getElementById('mainProductImage');
            const thumbnails = document.querySelectorAll('.thumbnail-image-container');
            mainImage.src = thumbnail.getAttribute('data-full-src');
            thumbnails.forEach(t => t.classList.remove('active-thumbnail'));
            thumbnail.classList.add('active-thumbnail');
        }
    </script>
@endsection
