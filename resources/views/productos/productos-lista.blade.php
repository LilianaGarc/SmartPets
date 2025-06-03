@extends('productos.productos-layout')


@section('titulo', 'Lista de Productos')

@section('contenido')

    @include('MenuPrincipal.Navbar')
    <style>
        body{
            padding-top: 80px;
        }
    </style>

    <div class="container d-flex justify-content-center mt-4">
        <div class="card shadow-sm" style="max-width: 700px; width: 100%; ">
            <div class="card-body">
                <form class ="row g-2 align-items-center" action="{{route('productos.index')}}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Buscar productos..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @foreach($categorias as $categoria)
                            <button type="submit" name="categoria" value="{{ $categoria->id }}" class="btn btn-outline-secondary @if(request('$categoria')==$categoria->id) active @endif"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $categoria->nombre }}">
                            <i class="{{$categoria->icono??'fas fa-tag'}}"></i>
                            </button>

                        @endforeach
                    </div>
                </form>
            </div>
        </div>
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
    @auth
        <div class="container d-flex justify-content-center mt-4">
            <a href="{{ route('productos.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Crear Producto
            </a>
        </div>
    @endauth

    <div class="productos-container">
        @if($productos->isEmpty())
            <div class="no-hay">
                <p class="no-hay-message">¡No hay productos disponibles por el momento! 🛒</p>
                <img src="{{ asset('images/vacio.svg') }}" alt="No hay productos" class="mx-auto d-block mt-2"
                     style="width: 150px; opacity: 0.7;">
            </div>
        @endif

        @foreach($productos as $producto)
                <div class="adopcion-card" style="position:relative; margin: 20px auto; padding: 15px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); width: 80%; max-width: 400px; margin-top: 50px;">
                    <div class="perfil-usuario" style="display: flex; align-items: flex-start;">
                        @php
                            $foto = $producto->imagen
                                ? asset('storage/' . $producto->imagen)
                                : asset('images/fotodeperfil.webp');
                        @endphp

                        <div class="foto-perfil"
                             style="background-image: url('{{ $foto }}'); background-size: cover; width: 70px; height: 70px; border-radius: 50%; margin-right: 10px;"></div>

                        <div class="informacion-perfil" style="flex: 1;">
                            <p class="fecha-publicacion" style="font-weight: bold; font-size: 1rem; margin: 0;">{{ $producto->nombre }}</p>
                            <p class="usuario-nombre" style="margin: 0; font-weight:  bold; font-size: 0.9rem; color: #555;">{{ $producto->user->name }}</p>
                            <p class="fecha-publicacion" style="margin: 5px 0; font-size: 0.8rem; color: #555;">Publicado el {{ $producto->created_at->format('d/m/Y , H:i') }}</p>
                        </div>

                        @if(Auth::check() && Auth::id() === $producto->user_id)
                            <div class="acciones-producto" style="display: flex; flex-direction: column; align-items: flex-end; gap: 5px;">
                                <a href="{{ route('productos.show', $producto->id) }}" title="Ver">
                                    <i class="fas fa-eye text-primary"></i>
                                </a>
                                <a href="{{ route('productos.edit', $producto->id) }}" title="Editar">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: none; border: none; padding: 0;" title="Eliminar">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="producto-imagen" style="margin-top: 10px;">
                        <a href="{{ route('productos.show', $producto->id) }}">
                            <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : asset('images/img_PorDefecto.jpg') }}"
                                 alt="Imagen del producto"
                                 class="producto-img"
                                 style="width: 100%; height: auto; border-radius: 8px;">
                        </a>
                    </div>
                </div>
        @endforeach
    </div>

    <script src="{{ asset('js/Ascripts.js') }}"></script>
    <script src="{{ asset('js/alerts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
