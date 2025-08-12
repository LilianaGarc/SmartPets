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
        #previewImagenes {
            margin-top: 10px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        #previewImagenes img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .error-border {
            border-color: #dc3545 !important;
            box-shadow: 0 0 5px #dc3545 !important;
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
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
                        <div class="col-12">
                            <div class="form-floating position-relative">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre del Producto"
                                       name="nombre" value="{{ isset($producto) ? $producto->nombre : old('nombre') }}"
                                       maxlength="50" required>
                                <label for="nombre">Nombre del Producto</label>
                                <div class="error-message" id="error-nombre" style="display:none;">Nombre del Producto (obligatorio)</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating position-relative">
                                <input type="number" class="form-control" id="precio" placeholder="Precio"
                                       name="precio" value="{{ isset($producto) ? $producto->precio : old('precio') }}"
                                       step="0.01" required>
                                <label for="precio">Precio</label>
                                <div class="error-message" id="error-precio" style="display:none;">Precio (obligatorio)</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating position-relative">
                                <input type="number" class="form-control" id="stock" min="1" placeholder="Cantidad disponible"
                                       name="stock" value="{{ isset($producto) ? $producto->stock : old('stock') }}"
                                       required>
                                <label for="stock">Cantidad disponible</label>
                                <div class="error-message" id="error-stock" style="display:none;">Cantidad disponible (obligatorio, mínimo 1)</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating position-relative">
                                <select class="form-select" id="categoria" name="categoria_id" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ isset($producto) && $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="categoria">Categoría</label>
                                <div class="error-message" id="error-categoria" style="display:none;">Categoría (obligatorio)</div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="form-floating position-relative">
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
                                <div class="error-message" id="error-subcategoria" style="display:none;">Subcategoría (obligatorio)</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating position-relative">
                                <textarea class="form-control" id="descripcion" placeholder="Descripción"
                                          name="descripcion" style="height: 100px;" maxlength="255" required>{{ isset($producto) ? $producto->descripcion : old('descripcion') }}</textarea>
                                <label for="descripcion">Descripción</label>
                                <div class="error-message" id="error-descripcion" style="display:none;">Descripción (obligatorio)</div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="form-label">Imágenes del Producto</h5>
                            <hr>
                            <input type="file" class="form-control" id="imagenes" name="imagenes[]" accept="image/*" multiple>
                            <small class="text-muted">Máximo 5 imágenes. Formato: JPG/JPEG, PNG, GIF, BMP, SVG, WEBP, TIFF. Tamaño máximo: 2MB</small>
                            <div id="previewImagenes"></div>
                        </div>
                    </div>

                    <br>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="submit" class="btn btn-primary btn-sm" id="btnEnviar">
                            <i class="fa-solid fa-save"></i>
                            {{ isset($producto) ? 'Actualizar' : 'Crear' }}
                        </button>
                        <button type="reset" class="btn btn-primary btn-sm" title="Borrar todos los campos" id="btnLimpiar">
                            <i class="fa-solid fa-broom"></i> Limpiar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalImagenes" tabindex="-1" aria-labelledby="modalImagenesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title" id="modalImagenesLabel">Error en selección de imágenes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Solo puedes seleccionar un máximo de 5 imágenes.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputImagenes = document.getElementById('imagenes');
            const previewContainer = document.getElementById('previewImagenes');
            const selectCategoria = document.getElementById('categoria');
            const selectSubcategoria = document.getElementById('subcategoria');
            const opcionesOriginales = Array.from(selectSubcategoria.querySelectorAll('option')).filter(opt => opt.value !== '');

            function showError(element, errorId) {
                element.classList.add('error-border');
                document.getElementById(errorId).style.display = 'block';
            }
            function clearError(element, errorId) {
                element.classList.remove('error-border');
                document.getElementById(errorId).style.display = 'none';
            }

            inputImagenes.addEventListener('change', function () {
                if (this.files.length > 5) {
                    this.value = '';
                    previewContainer.innerHTML = '';
                    const modal = new bootstrap.Modal(document.getElementById('modalImagenes'));
                    modal.show();
                    return;
                }
                previewContainer.innerHTML = '';
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                });
            });

            selectCategoria.addEventListener('change', function () {
                const categoriaId = this.value;
                const subcategoriaSeleccionada = selectSubcategoria.value;
                selectSubcategoria.innerHTML = '<option value="">Seleccione una subcategoría</option>';
                opcionesOriginales.forEach(option => {
                    const optgroup = option.closest('optgroup');
                    if (optgroup && optgroup.getAttribute('label-id') == categoriaId) {
                        const nuevaOpcion = option.cloneNode(true);
                        selectSubcategoria.appendChild(nuevaOpcion);
                        if (option.value === subcategoriaSeleccionada) {
                            nuevaOpcion.selected = true;
                        }
                    }
                });
            });

            if (selectCategoria.value) {
                selectCategoria.dispatchEvent(new Event('change'));
            }

            selectSubcategoria.addEventListener('change', function () {
                const optgroup = this.options[this.selectedIndex]?.closest('optgroup');
                if (optgroup) {
                    selectCategoria.value = optgroup.getAttribute('label-id');
                    selectCategoria.dispatchEvent(new Event('change'));
                }
            });

            document.getElementById('btnLimpiar').addEventListener('click', () => {
                previewContainer.innerHTML = '';
                inputImagenes.value = '';
                ['nombre', 'precio', 'stock', 'categoria', 'subcategoria', 'descripcion'].forEach(id => {
                    clearError(document.getElementById(id), 'error-' + id);
                });
            });

            document.getElementById('formularioProducto').addEventListener('submit', function (e) {
                e.preventDefault();
                let valid = true;

                const nombre = document.getElementById('nombre');
                const precio = document.getElementById('precio');
                const stock = document.getElementById('stock');
                const categoria = document.getElementById('categoria');
                const subcategoria = document.getElementById('subcategoria');
                const descripcion = document.getElementById('descripcion');

                if (!nombre.value.trim()) {
                    showError(nombre, 'error-nombre');
                    valid = false;
                } else {
                    clearError(nombre, 'error-nombre');
                }
                if (!precio.value.trim() || Number(precio.value) <= 0) {
                    showError(precio, 'error-precio');
                    valid = false;
                } else {
                    clearError(precio, 'error-precio');
                }
                if (!stock.value.trim() || Number(stock.value) < 1) {
                    showError(stock, 'error-stock');
                    valid = false;
                } else {
                    clearError(stock, 'error-stock');
                }
                if (!categoria.value) {
                    showError(categoria, 'error-categoria');
                    valid = false;
                } else {
                    clearError(categoria, 'error-categoria');
                }
                if (!subcategoria.value) {
                    showError(subcategoria, 'error-subcategoria');
                    valid = false;
                } else {
                    clearError(subcategoria, 'error-subcategoria');
                }
                if (!descripcion.value.trim()) {
                    showError(descripcion, 'error-descripcion');
                    valid = false;
                } else {
                    clearError(descripcion, 'error-descripcion');
                }

                if (valid) {
                    this.submit();
                }
            });

            ['nombre', 'precio', 'stock', 'categoria', 'subcategoria', 'descripcion'].forEach(id => {
                const el = document.getElementById(id);
                el.addEventListener('input', () => clearError(el, 'error-' + id));
                el.addEventListener('blur', () => {
                    if (el.value.trim()) {
                        clearError(el, 'error-' + id);
                    }
                });
            });
        });
    </script>

@endsection
