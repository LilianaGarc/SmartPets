@extends('productos.productos-layout')@extends('MenuPrincipal.Navbar')
@section('title', 'Productos Guardados')
@section('contenido')

@section('nav')@endsection

    <style>
        .text-orange { color: #fd7e14; }
        .bg-orange { background-color: #fd7e14; }
        .bg-orange:hover { background-color: #e46b10; }
        .line-through { text-decoration: line-through; }
        .rating-star { font-size: 0.9rem; }
        .out-of-stock {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: bold;
        }
    </style>

<div class="container py-5">
    <h1 class="mb-3 fw-bold">Ver más tarde</h1>
    <p class="text-secondary">
        Tienes 15 productos guardados para revisar después
        <span class="ms-2 small">• Mostrando 1-5 de 15</span>
    </p>

    <!-- PRODUCTO -->
    @forelse($prod_favoritos as $favorito)
        @if($favorito -> producto)
            <div class="card mb-4 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-3 position-relative">
                        <img src="{{ isset($favorito->producto->imagen) ? url('storage/' . $favorito->producto->imagen): asset('images/img_PorDefecto.jpg') }}" class=" object-fit-cover" alt="Producto" style="height: 200px; width: 200px">
                        <!-- Si está agotado -->
                        <!-- <div class="out-of-stock"><span class="badge bg-danger">Agotado</span></div> -->
                    </div>
                    <div class="col-md-9 p-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h5 class="mb-1">{{ $favorito->producto->nombre }}</h5>
                                <small class="text-muted d-block mb-2">{{ $favorito->producto->categoria->nombre }}</small>
                                <p class="mb-3">{{ $favorito->producto->descripcion}}</p>
                            </div>
                        </div>

                        <!-- Precio y botones -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="h5 text-orange me-2">{{ $favorito->producto->precio }}</span>
                            </div>
                            <div>
                                <button class="btn btn-outline-primary btn-sm me-2">Agregar al carrito</button>
                                <a href="/producto/1" class="btn btn-sm bg-orange text-white">Ver producto</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @empty
        <div class="text-center">
            <h3>
                No tienes productos guardados
            </h3>
        </div>
    @endforelse


    <!-- Más productos iguales al anterior aquí… (copia y pega el bloque) -->

    <!-- Paginación -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <small class="text-muted">Página 1 de 3</small>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#">Anterior</a>
                </li>
                <li class="page-item active">
                    <a class="page-link bg-orange border-0" href="#">1</a>
                </li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Siguiente</a></li>
            </ul>
        </nav>
    </div>

    <!-- Continuar comprando -->
    <div class="text-center mt-5">
        <a href="/productos" class="btn btn-outline-primary">Continuar comprando</a>
    </div>
</div>

@endsection
