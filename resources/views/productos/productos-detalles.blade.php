@extends('productos.productos-layout') , @extends('MenuPrincipal.Navbar')
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
        transition: opacity 0.3s ease, transform 0.3s ease, max-height 0.3s ease;
        overflow: hidden;
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
</style>

@section('contenido')

    <div class="container py-5">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
            </div>
        @endif
        <div class="product-container p-4">
            <!-- Producto Principal -->
            <div class="row mb-5">
                <!-- Galería de Imágenes -->
                <div class="col-md-6 mb-4">
                    <div class="main-image mb-3">
                        <img
                            src="{{ isset($producto->imagen) ? url('storage/' . $producto->imagen) : asset('images/img_PorDefecto.jpg')}}"
                            alt="
                            {{ $producto->nombre }}" class="img-fluid rounded">
                    </div>
                    <div class="thumbnails d-flex gap-2">
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

                <!-- Información del Producto -->
                <div class="col-md-6">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" style="color: var(--blue)">Inicio</a></li>
                            <li class="breadcrumb-item"><a href="#" style="color: var(--blue)">Perros</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Alimentos</li>
                        </ol>
                    </nav>

                    <h1 class="mb-3">{{$producto->nombre}}</h1>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="price">L.{{$producto->precio}}</span>
                        <span class="stock-badge">En Stock</span>
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

                    <p class="mb-4">{{$producto->descripcion}}</p>

                    <!-- Selector de Cantidad -->
                    <div class="mb-4">
                        <label class="form-label">{{$producto->stock}} unidades disponibles</label>
                        <div class="d-flex align-items-center gap-3">
                            <button class="btn btn-outline-secondary">-</button>
                            <input type="number" class="form-control quantity-input" value="1" min="1">
                            <button class="btn btn-outline-secondary">+</button>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg">Añadir al Carrito</button>
                        <form id="delete-form-{{$producto->id}}"
                              action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalProducto">
                                Eliminar Producto
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="ModalProducto" tabindex="-1" aria-labelledby="ModalProductoLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="ModalProductoLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancelar"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de que deseas eliminar este producto?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                <!-- ACORDEON -->
                <div class="">

                    <div class="review-system">
                        <!-- Circular Toggle Button -->
                        <button id="review-toggle-btn" class="review-toggle-btn">
                            <span class="review-toggle-icon">+</span>
                        </button>

                        <!-- Review Form Container -->
                        <div id="review-container" class="review-container review-hidden">
                            <div class="review-header">
                                <h3 class="review-title-header">Nueva Reseña</h3>
                            </div>
                            <div class="review-body">
                                <form id="review-form" class="review-form" action="{{ route('productos.agregarResenia', $producto->id) }}"
                                      method="POST">
                                    @csrf
                                    <div class="review-form-group">
                                        <label for="review-title" class="review-label">Título</label>
                                        <input type="text" class="review-input" id="review-title" name="titulo"
                                               placeholder="Escribe un título para tu reseña">
                                    </div>

                                    <div class="review-form-group">
                                        <label for="review-content" class="review-label">Contenido</label>
                                        <textarea class="review-textarea" id="review-content" rows="4" name="contenido"
                                                  placeholder="Escribe tu reseña aquí..."></textarea>
                                    </div>

                                    <div class="review-actions">
                                        <button type="submit" class="review-button review-button-publish">Publicar
                                        </button>
                                        <button type="button" class="review-button review-button-cancel">Cancelar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <h1 class="mb-4">Reseñas</h1>
                    <div class="accordion" id="accordionExample">
                        @foreach($resenias as $index => $resenia)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                            aria-controls="collapse{{ $index }}">
                <span class="accordion-title">
                    <span class="username">{{ $resenia->user->name }}</span>
                </span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}"
                                     aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>{{ $resenia->titulo }}</strong>
                                        <p>{{ $resenia->contenido }}</p>

                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalResenia{{$resenia->id}}">
                                            Eliminar
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="ModalResenia{{$resenia->id}}" tabindex="-1" aria-labelledby="ModalReseniaLabel{{$resenia->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="ModalReseniaLabel{{$resenia->id}}">Eliminar Reseña</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Estás seguro de que deseas eliminar esta reseña?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('productos.eliminarResenia', ['producto' => $producto->id, 'resenia' => $resenia->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
        function toggleDeleteButton(id) {
            let checkbox = document.getElementById(`confirm-checkbox-${id}`);
            let button = document.getElementById(`delete-button-${id}`);
            button.disabled = !checkbox.checked;
        }

        // Toggle form visibility
        const toggleBtn = document.getElementById('review-toggle-btn');
        const reviewContainer = document.getElementById('review-container');
        const cancelBtn = document.querySelector('.review-button-cancel');

        toggleBtn.addEventListener('click', function () {
            toggleForm();
        });

        cancelBtn.addEventListener('click', function () {
            toggleForm(false);
        });

        function toggleForm(show) {
            if (show === undefined) {
                // Toggle based on current state
                toggleBtn.classList.toggle('active');
                reviewContainer.classList.toggle('review-hidden');
                reviewContainer.classList.toggle('review-visible');
            } else if (show === false) {
                // Force hide
                toggleBtn.classList.remove('active');
                reviewContainer.classList.add('review-hidden');
                reviewContainer.classList.remove('review-visible');
            } else {
                // Force show
                toggleBtn.classList.add('active');
                reviewContainer.classList.remove('review-hidden');
                reviewContainer.classList.add('review-visible');
            }
        }

        // Form submission
        document.getElementById('review-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const title = document.getElementById('review-title').value;
            const content = document.getElementById('review-content').value;

            // Aquí normalmente enviarías los datos a tu servidor
            console.log('Review submitted:', {title, content});

            // Recargar la página después de enviar la reseña
            location.reload();
        });
    </script>
@endsection
