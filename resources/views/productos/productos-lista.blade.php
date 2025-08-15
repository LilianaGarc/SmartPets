@extends('productos.productos-layout')

@section('titulo', 'Lista de Productos')

@section('contenido')

    @include('MenuPrincipal.Navbar')

    <style>
        body {
            padding-top: 100px;
        }
        .producto-img {
            width: 100% !important;
            height: 200px !important;
            object-fit: cover !important;
            border-radius: 8px !important;
        }
        .textoAjustado {
            overflow-wrap: break-word;
            word-break: break-word;
            white-space: normal;
        }
        .btn-naranja {
            background-color: #ed8119;
            color: white;
            border: none;
        }
        .btn-naranja:hover {
            background-color: #18478b;
            color: white;
        }
        .out-of-stock {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="{{ asset(path: 'css/all.min.css') }}">
    <div class="container d-flex justify-content-center mt-4">
        <div class="card shadow-sm" style="max-width: 700px; width: 100%;">
            <div class="card-body">
                <form class="row g-2 align-items-center" action="{{ route('productos.index') }}" method="GET" id="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Buscar productos..."
                               value="{{ request('search') }}">
                        <button class="btn btn-naranja" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex flex-column align-items-center justify-content-center mx-auto mt-4">
        <div class="d-flex flex-wrap justify-content-center"
             style="min-width: 220px; max-width: fit-content; align-items: center;">
            @foreach($categorias as $categoria)
                @php
                    $queryParams = request()->query();
                    $queryParams['categoria'] = $categoria->id;
                    unset($queryParams['subcategoria']);
                @endphp
                <a href="{{ route('productos.index', $queryParams) }}"
                   class="btn btn-outline-secondary @if(request('categoria') == $categoria->id) active @endif"
                   data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $categoria->nombre }}"
                   style="width: 85px; height: 85px; padding: 0; margin: 0.5em; border-radius: 0; display: flex; align-items: center; justify-content: center; flex-direction: column">
                    <img src="{{ asset('images/icono' . $categoria->nombre . '.png') }}"
                         alt="{{ $categoria->nombre }}"
                         style="width: 75%; height: 75%; object-fit: contain;">
                    <span style="font-size: 0.6rem; margin-top: 0.2em; ">
                        {{ $categoria->nombre }}
                    </span>
                </a>
            @endforeach
        </div>

        @if(isset($categoriaId) && $subcategorias->count() > 0)
            <div class="d-flex flex-wrap justify-content-center mt-1"
                 style="min-width: 220px; max-width: fit-content; align-items: center;">
                @foreach($subcategorias as $subcategoria)
                    @php
                        $queryParams = request()->query();
                        $queryParams['categoria'] = $categoriaId;
                        $queryParams['subcategoria'] = $subcategoria->id;
                    @endphp
                    <a href="{{ route('productos.index', $queryParams) }}"
                       class="btn btn-outline-secondary @if(request('subcategoria') == $subcategoria->id) active @endif"
                       data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $subcategoria->nombre }}"
                       style="width: 70px; height: 70px; padding: 0; margin: 0.5em; border-radius: 0; display: flex; align-items: center; justify-content: center; flex-direction: column">
                        <img src="{{ asset('images/icono' . $subcategoria->nombre . '.png') }}"
                             alt="{{ $subcategoria->nombre }}"
                             style="width: 50%; height: 50%; object-fit: contain;">
                        <span style="font-size: 0.6rem; margin-top: 0.2em; ">
                    {{ $subcategoria->nombre }}
                </span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#ff7f50',
                });
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#ff7f50',
                });
            });
        </script>
    @endif
    @guest
    <div class="container d-flex justify-content-center mt-4">
        <div class="alert alert-warning" role="alert">
            <strong>¡Atención!</strong> Para crear o guardar productos, debes iniciar sesión o registrarte.
            <a href="{{ route('login') }}" class="alert-link">Iniciar sesión</a>
        </div>
    </div>
    @endguest

    @auth
        <div class="container d-flex justify-content-center mt-4">
            <a href="{{ route('productos.create') }}" class="btn btn-naranja me-2">
                <i class="fas fa-plus"></i> Crear Producto
            </a>
            <a href="{{ route('productos.guardados') }}" class="btn btn-link p-0 me-2" title="Ver productos guardados"
               style="width: 32px; height: 32px;">
                <img src="{{ asset('images/marcadorAzul.png') }}" alt="Productos Guardados" class="img-fluid"
                     style="width: 32px; height: 32px;">
            </a>
            @if(request()->has('categoria') || request()->has('subcategoria') || request()->has('search'))
                <a href="{{ route('productos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-times-circle"></i> Limpiar
                </a>
            @endif
        </div>
    @endauth

    <div class="productos-container d-flex flex-wrap justify-content-center">
        @if($productos->isEmpty())
            <div class="no-hay">
                <p class="no-hay-message justify-center">¡No hay productos disponibles por el momento! 🛒</p>
                <img src="{{ asset('images/vacio.svg') }}" alt="No hay productos" class="mx-auto d-block mt-2"
                     style="width: 150px; opacity: 0.7;">
            </div>
        @endif

        @foreach($productos as $producto)
            <a href="{{ route('productos.show', $producto->id) }}" class="text-decoration-none text-dark">
                <div class="adopcion-card"
                     style="margin: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 300px;">
                    <div class="perfil-usuario" style="display: flex; align-items: flex-start;">
                        @php
                            $foto = $producto->user->fotoperfil
                                ? asset('storage/' . $producto->user->fotoperfil)
                                : asset('images/fotodeperfil.webp');
                        @endphp

                        <div class="foto-perfil"
                             style="background-image: url('{{ $foto }}'); background-size: cover; width: 70px; height: 70px; border-radius: 50%; margin-right: 10px;"></div>

                        <div class="informacion-perfil" style="flex: 1;">
                            <p class="fecha-publicacion textoAjustado"
                               style="
       font-weight: bold;
       font-size: 1rem;
       margin: 0;
       display: -webkit-box;
       -webkit-line-clamp: 1;
       max-lines: 1;
       -webkit-box-orient: vertical;
       overflow: hidden;
       text-overflow: ellipsis;
   ">
                                {{ $producto->nombre }}
                            </p>
                            <p class="usuario-nombre"
                               style="margin: 0; font-weight:  bold; font-size: 0.9rem; color: #555;">{{ $producto->user->name }}</p>
                            <p class="fecha-publicacion" style="margin: 5px 0; font-size: 0.8rem; color: #555;">
                                Publicado
                                el {{ $producto->created_at->setTimezone('America/Tegucigalpa')->format('d/m/Y , H:i') }}</p>
                        </div>

                        @if(Auth::check() && Auth::id() === $producto->user_id)
                            <div class="acciones-producto"
                                 style="display: flex; flex-direction: column; align-items: flex-end; gap: 5px;">
                                <a href="{{ route('productos.show', $producto->id) }}" title="Ver">
                                    <i class="fas fa-eye text-primary"></i>
                                </a>
                                <a href="{{ route('productos.edit', $producto->id) }}" title="Editar">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este producto?');"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; padding: 0;"
                                            title="Eliminar">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="producto-imagen" style="margin-top: 10px; position: relative;">
                        <img
                            src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('images/img_PorDefecto.jpg') }}"
                            alt="Imagen del producto"
                            class="producto-img"
                            style="width: 100%; height: auto; border-radius: 8px;">
                        @if(!$producto->activo)
                            <div class="out-of-stock">
                                No disponible
                            </div>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="paginacion-mascotas">
        {{ $productos->links('vendor.pagination.mascotas') }}
    </div>

    <script src="{{ asset('js/Ascripts.js') }}"></script>
    <script src="{{ asset('js/alerts.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@11.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    @include('chats.chat-float')
@endsection
