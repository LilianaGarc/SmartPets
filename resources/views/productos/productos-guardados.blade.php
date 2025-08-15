@extends('productos.productos-layout')@extends('MenuPrincipal.Navbar')
@section('title', 'Productos Guardados')
@section('contenido')

@section('nav')@endsection


    <style>

        :root {
            --orange: #ED8119;
            --blue: #18478B;
            --cream: #FFF8F0;
            --dark: #1F1F1F;
        }


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

        .textoAjustado {
            overflow-wrap: break-word;
            word-break: break-word;
            white-space: normal;
        }

        .btn-naranja {
            background-color: #18478b;
            color: white;
            border: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-naranja:hover {
            background-color: #ed8119;
            color: white;
        }

        .pagination .showing {
            display: none !important;
        }

    </style>


<div class="container py-5">
    <h1 class="mb-3 fw-bold d-flex align-items-center">
        <a href="{{ route('productos.index') }}" class="btn btn-naranja" style="font-size: 45%; margin-right: 15px" role="button">
            <i class="fa-solid fa-circle-arrow-left"></i>
        </a>
        PRODUCTOS GUARDADOS</h1>
    <p class="text-secondary">
        Tienes {{ $prod_favoritos->count() }} productos guardados
        <span class="ms-2 small">• Mostrando 1-{{ min($prod_favoritos->count(), 10) }}</span>
    </p>

    <div class="row">
        @forelse($prod_favoritos as $favorito)
            @if($favorito->producto)
                <!-- Cada producto ocupa la mitad del ancho (2 por fila) -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100 d-flex flex-row">
                        <!-- Imagen fija, sin recorte -->

                        <div class="p-2 d-flex align-items-center" style="position: relative; z-index: 1;">
                            <img src="{{ isset($favorito->producto->imagen) ? url('storage/' . $favorito->producto->imagen): asset('images/img_PorDefecto.jpg') }}"
                                 alt="Producto"
                                 class="img-fluid"
                                 style="width: 160px; height: auto; max-height: 160px; object-fit: contain;">
                            @if(!$favorito->producto->activo)
                                <div class="out-of-stock" style="z-index:2;">No disponible</div>
                            @endif
                        </div>

                        <!-- Contenido textual a la derecha de la imagen -->
                        <div class="p-3 flex-grow-1 d-flex flex-column justify-content-between">
                            <div>
                                <!-- Título más grande -->
                                <h4 class="mb-1 textoAjustado">{{ $favorito->producto->nombre }}</h4>

                                <!-- Categoría -->
                                <small class="text-muted d-block">{{ $favorito->producto->categoria->nombre }}</small>

                                <!-- Precio debajo de la categoría -->
                                <span class="h5 text-orange d-block mt-2">L.{{ $favorito->producto->precio }}</span>
                            </div>

                            <!-- Botones -->
                            <div class="d-flex align-items-center gap-2 mt-3">
                                <a href="{{ route('productos.show', $favorito->producto->id) }}" class="btn btn-sm bg-orange text-white">Ver producto</a>
                                <a href="{{ route('chats.iniciar', $favorito->producto->user_id) }}?mensaje={{ urlencode('Hola, estoy interesado en el producto: "' . $favorito->producto->nombre . '", este es el enlace: ' . route('productos.show', $favorito->producto->id)) }}"
                                   class="btn btn-sm bg-orange text-white">Enviar mensaje</a>

                                @auth
                                    @php
                                        $guardado = \App\Models\ProdFavorito::where('user_id', auth()->id())
                                            ->where('producto_id', $favorito->producto->id)
                                            ->first();
                                    @endphp

                                    <form id="favorito-form-{{ $favorito->producto->id }}" method="POST" style="display: inline-block; position: relative; z-index: 3;">
                                        @csrf
                                        <input type="hidden" name="producto_id" value="{{ $favorito->producto->id }}">
                                        @if($guardado)
                                            <button type="submit" formaction="{{ route('productos.eliminarGuardado', $favorito->producto->id) }}"
                                                    class="btn btn-link p-0 m-0 ms-5" title="Eliminar producto guardado" style="width: 32px; height: 32px;">
                                                <img src="{{ asset('images/marcadorAzul.png') }}" alt="Guardado" class="img-fluid" style="width: 32px; height: 32px;">
                                            </button>
                                        @else
                                            <button type="submit" formaction="{{ route('productos.guardar', $favorito->producto->id) }}"
                                                    class="btn btn-link p-0 m-0" title="Guardar producto" style="width: 32px; height: 32px;">
                                                <img src="{{ asset('images/marcadorVacio.png') }}" alt="No guardado" class="img-fluid" style="width: 32px; height: 32px;">
                                            </button>
                                        @endif
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-12 text-center">
                <h3>No tienes productos guardados</h3>
            </div>
        @endforelse
    </div>

    <div class="paginacion-mascotas">
        {{ $prod_favoritos->links('vendor.pagination.mascotas') }}
    </div>

    <!-- Continuar comprando -->
    <div class="text-center mt-5">
        <a href="/productos" class="btn btn-naranja">Continuar comprando</a>
    </div>
</div>


@endsection
