@extends('productos.productos-layout') @extends('MenuPrincipal.Navbar')
@section('titulo', 'Lista de Productos')

@section('contenido')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --orange: #ED8119;
            --blue: #18478B;
            --cream: #FFF8F0;
            --dark: #1F1F1F;
        }
        .bg-gradient-hero {
            background: linear-gradient(135deg, #00BCD4 50%, #FFAB76 50%);
        }
        .pet-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid var(--orange);
            padding: 5px;
        }
        .pet-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .btn-shop {
            background-color: var(--cream);
            color: var(--dark);
            border: none;
            padding: 10px 30px;
            border-radius: 25px;
        }
        .category-pill {
            border: 2px solid var(--orange);
            color: var(--dark);
            background: transparent;
            border-radius: 25px;
            padding: 8px 20px;
        }
        .category-pill.active {
            background-color: var(--orange);
            color: white;
        }
        .offer-card {
            border: 2px solid var(--orange);
            border-radius: 15px;
            overflow: hidden;
        }
    </style>

</head>
<body>

    @section('nav') @endsection

    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="py-1 mt-0">
        <div class="container">


            <!-- BARRA DE BUSQUEDA -->
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid mx-3 px-3 my-2">
                    <form id="search-form" class="d-flex" role="search" action="{{ route('productos.index') }}" method="GET"
                    onsubmit="return document.getElementById('search-query').value.trim() !== '';">
                        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Buscar" name="query" value="{{ old('query',$query ?? '') }}" id="search-query">
                        <button class="btn btn-outline-primary" type="submit">Buscar</button>
                    </form>
                </div>
            </nav>

            <h2 class="text-center mb-4"></h2>
            <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                <!-- CATEGORIAS -->
                @forelse($categorias as $categoria)
                    <form action="{{ route('productos.index') }}" method="GET">
                        <input type="hidden" name="query" value="{{ request('query') }}">
                        <input type="hidden" name="categoria_id" value="{{ $categoria->id }}">
                        <button class="category-pill {{ request('categoria_id') == $categoria->id ? 'active' : '' }}" type="submit">
                            {{ $categoria->nombre }}
                        </button>
                    </form>
                @empty
                    <p class="text-center">No se han encontrado categorías.</p>
                @endforelse
            </div>
            <h2 class="text-center mb-4"></h2>
            <button class="btn btn-primary mb-3" onclick="window.location.href='{{ route('productos.create') }} '" >Publicar Producto</button>
            <div class="row g-4">
                @forelse($productos as $producto)
                    <div class="col-6 col-md-3">
                        <div class="offer-card h-80">
                            <img src="{{ isset($producto->imagen) ? url('storage/' . $producto->imagen) : asset('images/img_PorDefecto.jpg')}}" alt="
                            {{ $producto->nombre }}" class="w-100">
                            <div class="detalles p-1 mx-2 d-flex justify-content-center">
                                <button class="category-pill active mx-1" onclick=window.location.href='{{ route('productos.show',$producto->id)}}'>Ver</button>
                            </div>
                            <div class="p-3">
                                <h6>{{$producto->nombre}}</h6>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center">No se han encontrado productos.</p>
                    </div>
                @endforelse

                {{$productos->links()}}

                <!-- Repeat for other offers -->
            </div>
        </div>
    </section>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@include('chats.chat-float')
@endsection
