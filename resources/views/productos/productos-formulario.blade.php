@extends('layout.plantillaSaid')

@section('titulo', isset($producto) ? 'Editar Producto' : 'Crear Producto')

@section('contenido')

    <style>
        body {
            background-color: #FFF8F0;
        }
        .btn-naranja {
            background-color: #ed8119;
            color: white;
            border: none;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .btn-naranja:hover {
            background-color: #18478b;
            color: white;
            transform: rotate(-10deg);
        }

    </style>

    <div class="breadcrumb-container">
        <ul class="breadcrumb">
            <li class="breadcrumb__item">
                <a href="{{ route('index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Inicio</span>
                </a>
            </li>
            <li class="breadcrumb__item">
                <a href="{{ route('productos.index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Productos</span>
                </a>
            </li>
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('productos.create') }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">
                    @if (isset($producto))
                        Editar Producto
                    @else
                        Crear Producto
                    @endif
                </span>
                </a>
            </li>
        </ul>
    </div>

    <div class="container mt-4">
        <div class="card fade-in">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                    <h1 class="mb-0 card-title fw-bold">
                        @if(isset($producto))
                            Editar Producto
                        @else
                            Crear Producto
                        @endif
                    </h1>
                    <a href="{{ route('productos.index') }}" class="btn btn-naranja" style="font-size: 150%;" role="button">
                        <i class="fa-solid fa-circle-arrow-left"></i>
                    </a>
                </div>
                <hr>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" enctype="multipart/form-data" id="formularioProducto"
                      action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}">
                    @csrf
                    @isset($producto)
                        @method('PUT')
                    @endisset

                    <div class="row g-3">
                        <!-- Nombre del Producto -->
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre del Producto" name="nombre" value="{{ isset($producto) ? $producto->nombre : old('nombre') }}" maxlength="50" required>
                                <label for="nombre">Nombre del Producto</label>
                            </div>
                        </div>

                        <!-- Precio -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="precio" placeholder="Precio" name="precio" value="{{ isset($producto) ? $producto->precio : old('precio') }}" step="0.01" required>
                                <label for="precio">Precio</label>
                            </div>
                        </div>

                        <!-- Stock -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <input type="number" class="form-control" id="stock" min="0" placeholder="Cantidad disponible" name="stock" value="{{ isset($producto) ? $producto->stock : old('stock') }}" required>
                                <label for="stock">Cantidad disponible</label>
                            </div>
                        </div>

                        <!-- Categoría -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="categoria" name="categoria_id" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ isset($producto) && $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Subcategoría -->
                        <div class="col-12 col-md-6">
                            <div class="form-floating">
                                <select class="form-select" id="subcategoria" name="subcategoria_id" required>
                                    <option value="">Seleccione una subcategoría</option>
                                    @foreach ($categorias as $categoria)
                                        <optgroup label="{{ $categoria->nombre }}" label-id="{{ $categoria->id }}">
                                            @foreach ($categoria->subcategorias as $subcategoria)
                                                <option value="{{ $subcategoria->id }}" {{ isset($producto) && $producto->subcategoria_id == $subcategoria->id ? 'selected' : '' }}>
                                                {{ $subcategoria->nombre }}
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <label for="subcategoria">Subcategoría</label>
                            </div>
                        </div>


                        <!-- Descripción -->
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" id="descripcion" placeholder="Descripción" name="descripcion" style="height: 100px;" maxlength="255" required>{{ isset($producto) ? $producto->descripcion : old('descripcion') }}</textarea>
                                <label for="descripcion">Descripción</label>
                            </div>
                        </div>

                        <!-- Imágenes -->
                        <div class="col-12">
                            <h5 class="form-label">Imágenes del Producto</h5>
                            <hr>
                            <div class="dropdown">
                                <button class="btn btn-primary btn-sm dropdown-toggle w-100" type="button" id="addImageButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-plus me-2"></i> Agregar Imágenes
                                </button>
                                <div class="dropdown-menu p-3 w-100" aria-labelledby="addImageButton">
                                    <input type="file" class="form-control mb-2" id="imagenes" name="imagenes[]" accept="image/*" multiple>
                                </div>
                            </div>
                            <small class="text-muted">Máximo 5 imágenes. Formato: JPG/JPEG, PNG, GIF, BMP, SVG, WEBP, TIFF. Tamaño máximo: 2MB</small>
                        </div>
                    </div>

                    <br>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-save"></i>
                            {{ isset($producto) ? 'Actualizar' : 'Crear' }}
                        </button>
                        <button type="reset" class="btn btn-primary btn-sm" title="Borrar todos los campos">
                            <i class="fa-solid fa-broom"></i> Limpiar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputImagenes = document.getElementById('imagenes');
            inputImagenes.addEventListener('change', function () {
                if (this.files.length > 5) {
                    alert('Solo puedes seleccionar un máximo de 5 imágenes.');
                    this.value = '';
                }
            });

            const selectCategoria = document.getElementById('categoria');
            const selectSubcategoria = document.getElementById('subcategoria');
            const opcionesOriginales = Array.from(selectSubcategoria.options);

            selectCategoria.addEventListener('change', function () {
                const categoriaId = this.value;
                selectSubcategoria.innerHTML = '<option value="">Seleccione una subcategoría</option>';
                opcionesOriginales.forEach(option => {
                    const optgroup = option.closest('optgroup');
                    if (optgroup && optgroup.label) {
                        if (optgroup.getAttribute('label-id') == categoriaId) {
                            selectSubcategoria.appendChild(option.cloneNode(true));
                        }
                    }
                });
            });
        });
    </script>


@endsection
