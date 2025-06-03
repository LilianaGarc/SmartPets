@extends('productos.productos-layout') @extends('MenuPrincipal.Navbar')
@section('titulo', 'Lista de Productos')

@section('contenido')
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Productos</title>
</head>
<body>
@include('MenuPrincipal.Navbar')
<div class="container">
    <ul class="breadcrumb">
        <li class="breadcrumb__item">
            <a href="{{ route('index') }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">Inicio</span>
            </a>
        </li>
        <li class="breadcrumb__item breadcrumb__item-active">

            <a href="{{ route('productos.index') }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">Productos</span>
            </a>
        </li>
        <li class="breadcrumb__item">
            <a href="{{ route('productos.create') }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">Publicar Producto</span>
            </a>
        </li>
    </ul>

    <div class="filter-container">
        <form action="{{ route('productos.index') }}" method="GET" class="d-flex">
            <div class="select-wrapper">
                <select name="categoria_id" onchange="this.form.submit()" class="select-dropdown">
                    <option value="">Seleccionar categoría</option>
                    @foreach($categorias as $categoria)
                        <option
                            value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                            {{ $categoria->nombre }}
                        </option>
                    @endforeach
                </select>
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


<div class="productos-container">
    @if($productos->isEmpty())
        <div class="no-hay">
            <p class="no-hay-message">¡No hay productos disponibles por el momento! 🛒</p>
            <img src="{{ asset('images/vacio.svg') }}" alt="No hay productos" class="mx-auto d-block mt-2"
                 style="width: 150px; opacity: 0.7;">
        </div>
    @endif
    @foreach($productos as $producto)
        <div class="adopcion-card" style="position:relative; margin-left: 20px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <div class="perfil-usuario" style="display: flex; align-items: flex-start;">
                @php
                    $foto = $producto->imagen
                                   ? asset('storage/' . $producto->imagen) : asset('images/fotodeperfil.webp');
                @endphp
                <div class="foto-perfil"
                     style="background-image: url('{{ $foto }}'); background-size: cover; width: 70px; height: 70px; border-radius: 50%; margin-right: 10px;"></div>
                <div class="informacion-perfil" style="flex: 1;">
                    <p class="nombre-usuario" style="font-weight: bold; font-size: 1.2rem; margin: 0;">{{$producto->nombre}}</p>
                    <p class="fecha-publicacion" style="margin: 5px 0; font-size: 0.9rem; color: #555;">Publicado el {{ $producto->created_at->format('d/m/Y H:i') }}</p>
                </div>
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
</body>
</html>
@endsection
