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
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="confirm-checkbox-{{$producto->id}}"
                                       onchange="toggleDeleteButton({{$producto->id}})">
                                <label class="form-check-label" for="confirm-checkbox-{{$producto->id}}">Confirmar
                                    eliminación</label>
                            </div>
                            <button class="btn btn-danger btn-lg" type="submit" id="delete-button-{{$producto->id}}"
                                    disabled>Eliminar Producto
                            </button>
                        </form>
                    </div>
                </div>
                <!-- ACORDEON -->
                <div class="">
                    <h1 class="mb-4">Reseñas</h1>

                    <div class="accordion" id="accordionExample">
                        @foreach($resenias as $index => $resenia)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                        <span class="accordion-title">
                            <div class="user-info">
                                <span class="username">{{ $resenia->user->name }}</span>
                            </div>
                        </span>
                                    </button>
                                </h2>
                                <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>{{ $resenia->titulo }}</strong>
                                        <p>{{ $resenia->contenido }}</p>
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
       </script>
@endsection
