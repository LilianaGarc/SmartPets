@extends('productos.productos-layout') , @extends('MenuPrincipal.Navbar')
@section('titulo','Detalles del producto')
@section('contenido')
    <style>
        :root {
            --orange: #ED8119;
            --blue: #18478B;
            --cream: #FFF8F0;
            --dark: #1F1F1F;
        }

        body {
            background-color: var(--cream);
        }

        .product-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
    </head>
    <body>
    <div class="container py-5">
        <div class="product-container p-4">
            <!-- Producto Principal -->
            <div class="row mb-5">
                <!-- Galería de Imágenes -->
                <div class="col-md-6 mb-4">
                    <div class="main-image mb-3">
                        <img src="{{ isset($producto->imagen) ? url('storage/' . $producto->imagen) : asset('images/img_PorDefecto.jpg')}}" alt="
                            {{ $producto->nombre }}" class="img-fluid rounded">
                    </div>
                    <div class="thumbnails d-flex gap-2">
                        <img src="{{ isset($producto->imagen2) ? url('storage/' . $producto->imagen2) : asset('images/img_PorDefecto.jpg')}}" alt="
                            {{ $producto->nombre }}" class="thumbnail-image rounded" width="100px">
                        <img src="{{ isset($producto->imagen3) ? url('storage/' . $producto->imagen3) : asset('images/img_PorDefecto.jpg')}}" alt="
                            {{ $producto->nombre }}" class="thumbnail-image rounded" width="100px">
                        <img src="{{ isset($producto->imagen4) ? url('storage/' . $producto->imagen4) : asset('images/img_PorDefecto.jpg')}}" alt="
                            {{ $producto->nombre }}" class="thumbnail-image rounded" width="100px">
                        <img src="{{ isset($producto->imagen5) ? url('storage/' . $producto->imagen5) : asset('images/img_PorDefecto.jpg')}}" alt="
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
                            <span class="ms-2">(128 reseñas)</span>
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
                    </div>

                </div>
            </div>

            <!-- Tabs de Información -->
            <ul class="nav nav-tabs mb-4" id="productTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description">Descripción</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reviews-tab" data-bs-toggle="tab" href="#reviews">Reseñas</a>
                </li>
            </ul>

            <div class="tab-content" id="productTabsContent">
                <div class="tab-pane fade show active" id="description">
                    <h4 class="mb-3">Descripción del Producto</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
