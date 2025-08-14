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
            display: none;
        }
        .obligatorio {
            color: #dc3545;
            font-size: 0.875em;
            margin-bottom: 0.25rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .preview-image-container {
            position: relative;
            display: inline-block;
        }
        .remove-image-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            font-size: 12px;
        }
    </style>

    <div class="breadcrumb-container" style="margin-bottom: 4em;">
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
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const firstErrorField = document.querySelector('.error-border');
                            if (firstErrorField) {
                                firstErrorField.focus();
                            }
                        });
                    </script>
                @endif

                <form method="post" enctype="multipart/form-data" id="formularioProducto"
                      action="{{ isset($producto) ? route('productos.update', $producto->id) : route('productos.store') }}">
                    @csrf
                    @isset($producto)
                        @method('PUT')
                    @endisset

                    <div class="row g-3">
                        <div class="col-12 form-group">
                            <div class="form-floating position-relative">
                                <input type="text" class="form-control @error('nombre') error-border @enderror" id="nombre" placeholder="Nombre del Producto"
                                       name="nombre" value="{{ isset($producto) ? $producto->nombre : old('nombre') }}"
                                       maxlength="50">
                                <label for="nombre">Nombre del Producto</label>
                                <div class="error-message" id="error-nombre">
                                    @error('nombre') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <div class="form-floating position-relative">
                                <input type="text" class="form-control @error('precio') error-border @enderror" id="precio" placeholder="Precio"
                                       name="precio" value="{{ isset($producto) ? number_format($producto->precio, 2, '.', '') : old('precio', '0.00') }}">
                                <label for="precio">Precio</label>
                                <div class="error-message" id="error-precio">
                                    @error('precio') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <div class="form-floating position-relative">
                                <input type="number" class="form-control @error('stock') error-border @enderror" id="stock" min="1" placeholder="Cantidad disponible"
                                       name="stock" value="{{ isset($producto) ? $producto->stock : old('stock', 1) }}">
                                <label for="stock">Cantidad disponible</label>
                                <div class="error-message" id="error-stock">
                                    @error('stock') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <div class="form-floating position-relative">
                                <select class="form-select @error('categoria_id') error-border @enderror" id="categoria" name="categoria_id">
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ (isset($producto) && $producto->categoria_id == $categoria->id) || old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="categoria">Categoría</label>
                                <div class="error-message" id="error-categoria">
                                    @error('categoria_id') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <div class="form-floating position-relative">
                                <select class="form-select @error('subcategoria_id') error-border @enderror" id="subcategoria" name="subcategoria_id">
                                    <option value="">Seleccione una subcategoría</option>
                                    @foreach ($categorias as $categoria)
                                        <optgroup label="{{ $categoria->nombre }}" label-id="{{ $categoria->id }}">
                                            @foreach ($categoria->subcategorias as $subcategoria)
                                                <option value="{{ $subcategoria->id }}" {{ (isset($producto) && $producto->subcategoria_id == $subcategoria->id) || old('subcategoria_id') == $subcategoria->id ? 'selected' : '' }}>
                                                    {{ $subcategoria->nombre }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <label for="subcategoria">Subcategoría</label>
                                <div class="error-message" id="error-subcategoria">
                                    @error('subcategoria_id') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 form-group">
                            <div class="form-floating position-relative">
                                <textarea class="form-control @error('descripcion') error-border @enderror" id="descripcion" placeholder="Descripción"
                                          name="descripcion" style="height: 100px;" maxlength="255">{{ isset($producto) ? $producto->descripcion : old('descripcion') }}</textarea>
                                <label for="descripcion">Descripción</label>
                                <div class="error-message" id="error-descripcion">
                                    @error('descripcion') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="form-label">Imágenes del Producto</h5>
                            <hr>
                            <input type="file" class="form-control @error('imagenes.*') error-border @enderror" id="imagenes" name="imagenes[]" accept="image/*" multiple>
                            <small class="text-muted">Máximo 5 imágenes. Formato: JPG/JPEG, PNG, GIF, BMP, SVG, WEBP, TIFF. Tamaño máximo: 2MB</small>
                            <div class="error-message" id="error-imagenes">
                                @error('imagenes.*') {{ $message }} @enderror
                            </div>
                            <div id="previewImagenes"></div>
                            <input type="hidden" id="imagenes-eliminadas" name="imagenes_eliminadas" value="">
                        </div>
                    </div>

                    <br>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="button" class="btn btn-primary btn-sm" id="btnEnviar">
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
                    Solo puedes seleccionar un máximo de 5 imágenes en total (incluyendo las existentes).
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
            const formulario = document.getElementById('formularioProducto');
            const btnEnviar = document.getElementById('btnEnviar');
            const imagenesEliminadas = document.getElementById('imagenes-eliminadas');
            const imagenesParaEliminar = new Set();
            let imagenesExistentes = 0;

            @if($errors->any())
            @error('nombre')
            mostrarError(document.getElementById('nombre'), '{{ $message }}');
            @enderror
            @error('precio')
            mostrarError(document.getElementById('precio'), '{{ $message }}');
            @enderror
            @error('stock')
            mostrarError(document.getElementById('stock'), '{{ $message }}');
            @enderror
            @error('categoria_id')
            mostrarError(document.getElementById('categoria'), '{{ $message }}');
            @enderror
            @error('subcategoria_id')
            mostrarError(document.getElementById('subcategoria'), '{{ $message }}');
            @enderror
            @error('descripcion')
            mostrarError(document.getElementById('descripcion'), '{{ $message }}');
            @enderror
            @error('imagenes.*')
            mostrarError(document.getElementById('imagenes'), '{{ $message }}');
            @enderror
            @endif

            function mostrarError(elemento, mensajeError) {
                const errorElement = document.getElementById('error-' + elemento.id);
                elemento.classList.add('error-border');
                errorElement.textContent = mensajeError;
                errorElement.style.display = 'block';
            }

            function limpiarError(elemento) {
                elemento.classList.remove('error-border');
                document.getElementById('error-' + elemento.id).style.display = 'none';
            }

            function validarCampo(elemento, condicion, mensajeError) {
                if (condicion) {
                    mostrarError(elemento, mensajeError);
                    return false;
                }
                limpiarError(elemento);
                return true;
            }

            function validarPrecio(precio) {
                const regex = /^\d{1,10}(\.\d{1,2})?$/;
                return regex.test(precio);
            }

            function formatearPrecio(input) {
                let valor = input.value.replace(/[^0-9.]/g, '');
                if (valor === '') {
                    input.value = '0.00';
                    return;
                }

                if (!valor.includes('.')) {
                    valor += '.00';
                } else {
                    const partes = valor.split('.');
                    if (partes[1].length > 2) {
                        partes[1] = partes[1].substring(0, 2);
                    } else if (partes[1].length === 1) {
                        partes[1] += '0';
                    }
                    valor = partes.join('.');
                }

                input.value = valor;
            }

            function formatearCantidad(input) {
                let valor = input.value.replace(/[^0-9]/g, '');
                if (valor === '') {
                    input.value = '1';
                } else {
                    input.value = parseInt(valor) || 1;
                }
            }

            function contarImagenesExistentes() {
                return document.querySelectorAll('#previewImagenes .preview-image-container').length;
            }

            inputImagenes.addEventListener('change', function () {
                const imagenesActuales = contarImagenesExistentes();
                const nuevasImagenes = this.files.length;
                const totalImagenes = imagenesActuales + nuevasImagenes;

                if (totalImagenes > 5) {
                    this.value = '';
                    const modal = new bootstrap.Modal(document.getElementById('modalImagenes'));
                    modal.show();
                    return;
                }

                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const container = document.createElement('div');
                        container.className = 'preview-image-container';

                        const img = document.createElement('img');
                        img.src = e.target.result;

                        const removeBtn = document.createElement('button');
                        removeBtn.className = 'remove-image-btn';
                        removeBtn.innerHTML = '&times;';
                        removeBtn.onclick = function() {
                            container.remove();
                            const dt = new DataTransfer();
                            Array.from(inputImagenes.files).forEach(f => {
                                if (f !== file) {
                                    dt.items.add(f);
                                }
                            });
                            inputImagenes.files = dt.files;
                        };

                        container.appendChild(img);
                        container.appendChild(removeBtn);
                        previewContainer.appendChild(container);
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
                ['nombre', 'precio', 'stock', 'categoria', 'subcategoria', 'descripcion', 'imagenes'].forEach(id => {
                    limpiarError(document.getElementById(id));
                });
            });

            btnEnviar.addEventListener('click', function() {
                let valido = true;
                const campos = [
                    {id: 'nombre', validacion: (v) => !v.trim(), mensaje: 'El nombre del producto es obligatorio.'},
                    {id: 'precio', validacion: (v) => !v.trim() || !validarPrecio(v) || Number(v) <= 0, mensaje: 'Precio obligatorio, con formato válido y mayor a 0'},
                    {id: 'stock', validacion: (v) => !v.trim() || Number(v) < 1, mensaje: 'Cantidad disponible obligatoria, mínimo 1'},
                    {id: 'categoria', validacion: (v) => !v, mensaje: 'La categoría es obligatoria.'},
                    {id: 'subcategoria', validacion: (v) => !v, mensaje: 'La subcategoría es obligatoria.'},
                    {id: 'descripcion', validacion: (v) => !v.trim(), mensaje: 'La descripción es obligatoria.'}
                ];

                campos.forEach(campo => {
                    const elemento = document.getElementById(campo.id);
                    const valor = elemento.value;
                    if (campo.validacion(valor)) {
                        mostrarError(elemento, campo.mensaje);
                        if (valido) {
                            elemento.focus();
                            valido = false;
                        }
                    } else {
                        limpiarError(elemento);
                    }
                });

                if (valido) {
                    imagenesEliminadas.value = Array.from(imagenesParaEliminar).join(',');
                    formulario.submit();
                }
            });

            ['nombre', 'precio', 'stock', 'categoria', 'subcategoria', 'descripcion', 'imagenes'].forEach(id => {
                const elemento = document.getElementById(id);
                elemento.addEventListener('input', function() {
                    limpiarError(this);
                });
                if (id === 'categoria' || id === 'subcategoria') {
                    elemento.addEventListener('change', function() {
                        limpiarError(this);
                    });
                }
            });

            document.getElementById('precio').addEventListener('blur', function() {
                formatearPrecio(this);
            });

            document.getElementById('stock').addEventListener('blur', function() {
                formatearCantidad(this);
            });

            @if(isset($producto))
            @php
                $imagenesProducto = [
                    $producto->imagen,
                    $producto->imagen2,
                    $producto->imagen3,
                    $producto->imagen4,
                    $producto->imagen5
                ];
            @endphp

            @foreach($imagenesProducto as $index => $imagen)
            @if($imagen)
            const existingImgContainer{{ $index }} = document.createElement('div');
            existingImgContainer{{ $index }}.className = 'preview-image-container';

            const existingImg{{ $index }} = document.createElement('img');
            existingImg{{ $index }}.src = '{{ asset("storage/" . $imagen) }}';

            const removeExistingBtn{{ $index }} = document.createElement('button');
            removeExistingBtn{{ $index }}.className = 'remove-image-btn';
            removeExistingBtn{{ $index }}.innerHTML = '&times;';
            removeExistingBtn{{ $index }}.onclick = function() {
                existingImgContainer{{ $index }}.remove();
                imagenesParaEliminar.add('{{ $imagen }}');
                imagenesExistentes--;
            };

            existingImgContainer{{ $index }}.appendChild(existingImg{{ $index }});
            existingImgContainer{{ $index }}.appendChild(removeExistingBtn{{ $index }});
            previewContainer.appendChild(existingImgContainer{{ $index }});
            imagenesExistentes++;
            @endif
            @endforeach
            @endif
        });
    </script>

@endsection
