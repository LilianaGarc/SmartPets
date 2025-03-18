@extends('productos.productos-layout'), @extends('MenuPrincipal.Navbar')
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
            <h2 class="text-center mb-4">CATEGORIAS</h2>
            <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                @forelse($categorias as $categoria)
                    <button class="category-pill active">{{$categoria->nombre}}</button>
                @empty
                    <p class="text-center">No se han encontrado categorias.</p>
                @endforelse

            </div>
            <h2 class="text-center mb-4">PRODUCTOS</h2>
            <button class="btn btn-primary mb-3" onclick="window.location.href='{{ route('productos.create') }} '" >Publicar Producto</button>
            <div class="row g-4">
                @forelse($productos as $producto)
                    <div class="col-6 col-md-3">
                        <div class="offer-card h-100">
                            <img src="{{ isset($producto->imagen) ? url('storage/' . $producto->imagen) : asset('images/img_PorDefecto.jpg')}}" alt="
                            {{ $producto->nombre }}" class="w-100">
                            <div class="detalles p-2">
                                <button class="category-pill active" onclick=window.location.href='{{ route('productos.show',$producto->id)}}'>Ver</button>
                                <button class="category-pill active" onclick=window.location.href='{{ route('productos.edit',$producto->id)}}'>Editar</button>
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
@endsection
