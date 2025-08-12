@extends('productos.productos-layout')
@extends('MenuPrincipal.Navbar')
@section('titulo','Detalles del producto')

<style>
    :root {
        --orange: #ED8119;
        --blue: #18478B;
        --cream: #FFF8F0;
        --dark: #1F1F1F;
        --primary-color: #ED8119;
        --secondary-color: #18478B;
        --light-bg: #f8f9fa;
        --border-color: #dee2e6;
    }

    body {
        background-color: var(--cream);
        overflow-x: hidden;
    }

    .product-container {
        background-color: white;
        border-radius: 15px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .thumbnail-image {
        border: 2px solid transparent;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .thumbnail-image:hover,
    .thumbnail-image.active {
        border-color: var(--orange);
    }

    .price {
        color: var(--orange);
        font-size: 2rem;
        font-weight: bold;
    }

    .btn-primary {
        background-color: var(--blue);
        border-color: var(--blue);
    }

    .btn-primary:hover {
        background-color: #133c75;
        border-color: #133c75;
    }

    .btn-outline-primary {
        color: var(--blue);
        border-color: var(--blue);
    }

    .btn-outline-primary:hover {
        background-color: var(--blue);
        border-color: var(--blue);
    }

    .quantity-input {
        width: 80px;
        text-align: center;
        border: 1px solid #ddd;
    }

    .quantity-input:focus {
        border-color: var(--orange);
        box-shadow: none;
    }

    .product-features {
        background-color: var(--cream);
        border-radius: 10px;
    }

    .nav-tabs .nav-link {
        color: var(--dark);
        border: none;
        padding: 1rem 2rem;
    }

    .nav-tabs .nav-link.active {
        color: var(--orange);
        border-bottom: 3px solid var(--orange);
        background: none;
    }

    .stock-badge {
        background-color: var(--orange);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.9rem;
    }

    .related-product-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .related-product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    /* Accordion styling */
    .accordion-item {
        border-color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }

    .accordion-button {
        background-color: var(--secondary-color) !important;
        color: white !important;
        padding: 1rem 1.25rem;
        box-shadow: none !important;
        display: flex;
        justify-content: space-between;
        width: 100%; /* Ensure the button takes full width */
    }

    .accordion-button::after {
        margin-left: 1rem;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e") !important;
        flex-shrink: 0;
    }

    .accordion-button.collapsed {
        border-bottom-width: 0;
    }

    .accordion-button:not(.collapsed) {
        background-color: var(--primary-color) !important;
        color: white !important;
    }

    .accordion-body {
        background-color: #f8f9fa;
        border: 1px solid var(--secondary-color);
        border-top: none;
        padding: 1rem 1.25rem;
    }

    /* Ensure consistent title width */
    .accordion-button {
        position: relative;
    }

    .accordion-button::after {
        position: absolute;
        right: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
    }

    /* Profile image and username styling */
    .profile-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 12px;
        border: 2px solid white;
    }

    .user-info {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;

    }

    .username {
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* Review system container */
    .review-system {
        position: relative;
        max-width: 800px;
        margin: 2rem auto;
    }

    /* Toggle button */
    .review-toggle-btn {
        position: relative;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: var(--primary-color);
        color: white;
        border: none;
        font-size: 24px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: background-color 0.3s ease, transform 0.3s ease;
        z-index: 10;
        margin-bottom: 1rem;
    }

    .review-toggle-btn:hover {
        transform: scale(1.05);
    }

    .review-toggle-btn.active {
        background-color: var(--secondary-color);
    }

    .review-toggle-icon {
        transition: transform 0.3s ease;
    }

    .review-toggle-btn.active .review-toggle-icon {
        transform: rotate(45deg);
    }

    /* Review container */
    .review-container {
        max-width: 100%;
        border: 1px solid var(--secondary-color);
        border-radius: 0.25rem;
        margin-bottom: 1rem;
        width: 100%;
        opacity: 1;
        transform: translateY(0);
        max-height: 1000px;
        transition: all 0.3s ease;
    }

    .review-hidden {
        opacity: 0;
        transform: translateY(-20px);
        max-height: 0;
        margin: 0;
        border: none;
        pointer-events: none;
    }

    .review-visible {
        opacity: 1;
        transform: translateY(0);
        max-height: 1000px; /* Arbitrary large value */
        pointer-events: auto;
    }

    /* Review header */
    .review-header {
        background-color: var(--secondary-color);
        color: white;
        padding: 1rem 1.25rem;
        border-radius: 0.25rem 0.25rem 0 0;
    }

    .review-title-header {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 500;
    }

    /* Review body */
    .review-body {
        background-color: white;
        padding: 1.5rem;
        border-radius: 0 0 0.25rem 0.25rem;
    }

    /* Form elements */
    .review-form {
        width: 100%;
    }

    .review-form-group {
        margin-bottom: 1rem;
        width: 100%;
    }

    .review-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: var(--secondary-color);
    }

    .review-input,
    .review-textarea {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid var(--border-color);
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        max-width: 100%;
    }

    .review-input:focus,
    .review-textarea:focus {
        border-color: var(--primary-color);
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(237, 129, 25, 0.25);
    }

    .review-textarea {
        resize: vertical;
    }

    /* Buttons */
    .review-actions {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .review-button {
        display: inline-block;
        font-weight: 400;
        line-height: 1.5;
        text-align: center;
        text-decoration: none;
        vertical-align: middle;
        cursor: pointer;
        user-select: none;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out,
        border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .review-button-publish {
        color: #fff;
        background-color: var(--primary-color);
        border: 1px solid var(--primary-color);
    }

    .review-button-publish:hover {
        background-color: #d67316;
        border-color: #d67316;
    }

    .review-button-cancel {
        color: #fff;
        background-color: var(--secondary-color);
        border: 1px solid var(--secondary-color);
    }

    .review-button-cancel:hover {
        background-color: #143d77;
        border-color: #143d77;
    }

    /* Responsive adjustments */
    @media (max-width: 576px) {
        .review-body {
            padding: 1rem;
        }

        .review-actions {
            flex-direction: column;
            width: 100%;
        }

        .review-button {
            width: 100%;
        }
    }

    @keyframes marcadorAnim {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.3) rotate(15deg);
        }
        100% {
            transform: scale(1) rotate(0deg);
        }

    }

    .main-image {
        width: 80%;
        height: 300px; /* Altura fija, puedes ajustarla */
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 10px;
    }

    .main-image img {
        max-width: 80%;
        max-height: 100%;
        object-fit: contain;
    }

    .thumbnails {
        display: flex;
        justify-content: center; /* Mueve las miniaturas hacia la derecha */
        gap: 10px; /* Espaciado entre las miniaturas */
        margin-top: 10px; /* Espaciado superior */
        margin-left: 2em;
        flex-wrap: wrap;
    }
    .accordion-button:not(.collapsed) .user-info small {
        color: #4a4a4a;
    }
    .accordion-button.collapsed .user-info small {
        color: #d3d3d3;
    }
    .textoAjustado {
        overflow-wrap: break-word;
        word-break: break-word;
        white-space: normal;
    }
</style>
@section('contenido')
    <div class="container-fluid mx-2  py-5">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <div class="product-container p-4">
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <div class="main-image mb-3">
                        <img
                            src="{{ isset($producto->imagen) ? url('storage/' . $producto->imagen) : asset('images/img_PorDefecto.jpg')}}"
                            alt="
                            {{ $producto->nombre }}" class="img-fluid rounded">
                    </div>
                    <div class="thumbnails d-flex justify-content-center mb-4 gap-2">
                        <img
                            src="{{ isset($producto->imagen2) ? url('storage/' . $producto->imagen2) : asset('images/img_PorDefecto.jpg')}}"
                            alt="
                            {{ $producto->nombre }}" class="thumbnail-image rounded" width="100px">
                        <img
                            src="{{ isset($producto->imagen3) ? url('storage/' . $producto->imagen3) : asset('images/img_PorDefecto.jpg')}}"
                            alt="
                            {{ $producto->nombre }}" class="thumbnail-image rounded" width="100px">
                        <img
                            src="{{ isset($producto->imagen4) ? url('storage/' . $producto->imagen4) : asset('images/img_PorDefecto.jpg')}}"
                            alt="
                            {{ $producto->nombre }}" class="thumbnail-image rounded" width="100px">
                        <img
                            src="{{ isset($producto->imagen5) ? url('storage/' . $producto->imagen5) : asset('images/img_PorDefecto.jpg')}}"
                            alt="
                            {{ $producto->nombre }}" class="thumbnail-image rounded" width="100px">
                    </div>
                </div>
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('productos.index') }}" style="color: var(--blue)">Productos</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('productos.index', ['categoria_id' => $producto->categoria_id]) }}" style="color: var(--blue)">
                                    {{ $producto->categoria->nombre }}
                                </a>
                            </li>
                            @if($producto->subcategoria)
                                <li class="breadcrumb-item">
                                    <a href="{{ route('productos.index', ['subcategoria_id' => $producto->subcategoria_id]) }}" style="color: var(--blue)">
                                        {{ $producto->subcategoria->nombre }}
                                    </a>
                                </li>
                            @endif
                        </ol>
                    </nav>
                    <h1 class="mb-3 textoAjustado">{{$producto->nombre}}</h1>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="price">L.{{$producto->precio}}</span>
                        <span class="badge
                        @if($producto->activo)
                        stock-badge
                        @else
                        bg-danger
                        @endif " style="font-size: 1rem; padding: 0.5em 1em;">
                            @if($producto->activo)
                                En Stock
                            @else
                                No Disponible
                            @endif
                        </span>
                        @auth
                            @php
                                $favorito = \App\Models\ProdFavorito::where('user_id', auth()->id())
                                        ->where('producto_id', $producto->id)
                                        ->first();
                            @endphp

                            <form id="favorito-form-{{$producto->id}}" method="POST"
                                  style="display: inline-block; margin-top: 1em">
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
                    <div class="mb-4">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-star-fill" style="color: var(--orange)"></i>
                            <i class="bi bi-star-fill" style="color: var(--orange)"></i>
                            <i class="bi bi-star-fill" style="color: var(--orange)"></i>
                            <i class="bi bi-star-fill" style="color: var(--orange)"></i>
                            <i class="bi bi-star-half" style="color: var(--orange)"></i>
                        </div>
                    </div>
                    <p class="mb-4 textoAjustado">{{$producto->descripcion}}</p>
                    <!-- Botones de Acción -->
                    @auth
                        <div class="d-flex align-items-center gap-3 mt-3">
                            @php
                                $mensaje = 'Estoy interesado en el producto "' . $producto->nombre . '". <a href="' . route('productos.show', $producto->id) . '">Más info</a>';
                            @endphp

                            @if(auth()->id() !== $producto->user_id)
                                <a href="{{ route('chats.iniciar', $producto->user_id) }}?mensaje={{ rawurlencode($mensaje) }}"
                                   class="btn btn-primary text-white">
                                    <i class="fas fa-comment-dots"></i> Enviar Mensaje
                                </a>
                            @endif

                            @if(auth()->check() && auth()->id() === $producto->user_id)
                                <div class="d-grid gap-2">
                                    <div class="row d-flex justify-content-center mt-3">
                                        <div class="col-auto">
                                            <button class="btn btn-warning text-white"
                                                    onclick="window.location.href='{{ route('productos.edit', $producto->id) }}'">
                                                <i class="fas fa-edit"></i> Editar
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <form id="delete-form-{{$producto->id}}"
                                                  action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger text-white" data-bs-toggle="modal"
                                                        data-bs-target="#ModalProducto">
                                                    <i class="fas fa-trash-alt"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endauth



                </div>
                </div>
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h1 class="mb-4">Reseñas</h1>
                @auth
                    <div class="">
                        <div class="review-system">
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
                                            <input type="text" class="review-input" id="review-title" name="titulo"
                                                   value="{{ old('titulo', $resenia->titulo ?? '') }}"
                                                   placeholder="Escribe un título para tu reseña">
                                        </div>
                                        <div class="review-form-group">
                                            <label for="review-content" class="review-label">Contenido</label>
                                            <textarea class="review-textarea" id="review-content" maxlength="255"
                                                      name="contenido"
                                                      placeholder="Escribe tu reseña aquí...">{{ old('contenido', $resenia->contenido ?? '') }}</textarea>
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
                                                    <span class="username">{{ $resenia->user->name }}</span>
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
                                            <!-- Button trigger modal -->
                                            <!-- Eliminar Reseña -->
                                            @auth
                                                @if( auth()->check() && auth()->id()===$resenia->user_id)
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#ModalResenia{{$resenia->id}}">
                                                        <i class="fa fa-trash-alt"></i>
                                                    </button>
                                                    <!-- Editar Reseña -->
                                                    <button type="button" class="btn btn-warning"
                                                            onclick="location.href='{{ route('productos.mostrarFormularioEdicion', ['producto' => $producto->id, 'resenia' => $resenia->id]) }}'">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>

                                                    <!-- Modal -->
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
                                    @endforeach
                                </div>
                        </div>
                        <!-- FIN ACORDEON -->
                    </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Botones y contenedor del formulario de reseña
                const toggleBtn = document.getElementById('review-toggle-btn');
                const reviewContainer = document.getElementById('review-container');
                const cancelBtn = document.querySelector('.review-button-cancel');

                // Función para mostrar/ocultar el formulario de reseñas
                function toggleForm(show) {
                    if (show === undefined) {
                        reviewContainer.classList.toggle('review-hidden');
                        reviewContainer.classList.toggle('review-visible');
                        toggleBtn.classList.toggle('active');
                    } else {
                        reviewContainer.classList.remove(show ? 'review-hidden' : 'review-visible');
                        reviewContainer.classList.add(show ? 'review-visible' : 'review-hidden');
                        toggleBtn.classList.toggle('active', show);
                    }
                }

                // Mostrar el formulario automáticamente si estamos en modo edición
                if (@json(isset($mostrarFormulario) && $mostrarFormulario)) {
                    toggleForm(true);
                }

                // Eventos de clic
                toggleBtn.addEventListener('click', () => toggleForm());

                cancelBtn.addEventListener('click', () => {
                    toggleForm(false);
                    // Redirigir solo si estamos editando
                    if (window.location.href.includes('/editar')) {
                        window.location.href = '{{ route("productos.show", $producto->id) }}';
                    }
                });

                // Código para cambiar las imágenes miniaturas
                const mainImage = document.querySelector('.main-image img');
                const thumbnails = document.querySelectorAll('.thumbnail-image');

                thumbnails.forEach(thumbnail => {
                    thumbnail.addEventListener('click', () => {
                        const tempSrc = mainImage.src;
                        mainImage.src = thumbnail.src;
                        thumbnail.src = tempSrc;
                    });
                });

                // Función para habilitar/deshabilitar botón de eliminar con checkbox (si usas esa función)
                window.toggleDeleteButton = function (id) {
                    let checkbox = document.getElementById(`confirm-checkbox-${id}`);
                    let button = document.getElementById(`delete-button-${id}`);
                    button.disabled = !checkbox.checked;
                }
            });
        </script>

@endsection
