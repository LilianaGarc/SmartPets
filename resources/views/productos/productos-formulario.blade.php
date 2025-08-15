@extends('layout.plantillaSaid')

@section('titulo', isset($producto) ? 'Editar Producto' : 'Crear Producto')

@section('contenido')

    <style>
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
        #previewPrincipal, #previewAdicionales {
            margin-top: 10px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        #previewPrincipal img, #previewAdicionales img {
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
                                       maxlength="50" required>
                                <label for="nombre">Nombre del Producto</label>
                                <div class="error-message" id="error-nombre">
                                    @error('nombre') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <div class="form-floating position-relative">
                                <input type="text" class="form-control @error('precio') error-border @enderror" id="precio" placeholder="Precio"
                                       name="precio" value="{{ isset($producto) ? number_format($producto->precio, 2, '.', '') : old('precio', '0.00') }}"
                                       oninput="formatPrice(this);"
                                       onblur="this.value = parseFloat(this.value).toFixed(2);" required>
                                <label for="precio">Precio</label>
                                <div class="error-message" id="error-precio">
                                    @error('precio') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <div class="form-floating position-relative">
                                <input type="number" class="form-control @error('stock') error-border @enderror" id="stock" min="1" max="10000" maxlength="6" placeholder="Cantidad disponible"
                                       name="stock" value="{{ isset($producto) ? $producto->stock : old('stock', 1) }}" required>
                                <label for="stock">Cantidad disponible</label>
                                <div class="error-message" id="error-stock">
                                    @error('stock') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 form-group">
                            <div class="form-floating position-relative">
                                <select class="form-select @error('categoria_id') error-border @enderror" id="categoria" name="categoria_id" required>
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
                            <textarea required class="form-control @error('descripcion') error-border @enderror" id="descripcion" placeholder="Descripción"
                                      name="descripcion" style="height: 100px;" maxlength="255">{{ isset($producto) ? $producto->descripcion : old('descripcion') }}</textarea>
                                <label for="descripcion">Descripción</label>
                                <div class="error-message" id="error-descripcion">
                                    @error('descripcion') {{ $message }} @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="form-label">Imagen Principal</h5>
                            <hr>
                            <input type="file" class="form-control @error('imagen_principal') error-border @enderror" id="imagen_principal" name="imagen_principal" accept="image/*" {{ isset($producto) && $producto->imagen ? '' : 'required' }}>
                            <small class="text-muted">Formato: JPG/JPEG, PNG, GIF, BMP, SVG, WEBP, TIFF. Tamaño máximo: 2MB</small>
                            <div class="error-message" id="error-imagen_principal">
                                @error('imagen_principal') {{ $message }} @enderror
                            </div>
                            <div id="previewPrincipal">
                                @if(isset($producto) && $producto->imagen)
                                    <div class="preview-image-container">
                                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen Principal">
                                        <button type="button" class="remove-image-btn" onclick="eliminarImagenExistente('{{ $producto->imagen }}', 'principal')">&times;</button>
                                        <input type="hidden" name="imagen_principal_existente" value="{{ $producto->imagen }}">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <h5 class="form-label">Imágenes Adicionales</h5>
                            <hr>
                            <input type="file" class="form-control @error('imagenes_adicionales') error-border @enderror" id="imagenes_adicionales" name="imagenes_adicionales[]" accept="image/*" multiple>
                            <small class="text-muted">Máximo 4 imágenes. Formato: JPG/JPEG, PNG, GIF, BMP, SVG, WEBP, TIFF. Tamaño máximo: 2MB</small>
                            <div class="error-message" id="error-imagenes_adicionales">
                                @error('imagenes_adicionales') {{ $message }} @enderror
                            </div>
                            <div id="previewAdicionales">
                                @if(isset($producto))
                                    @foreach([$producto->imagen2, $producto->imagen3, $producto->imagen4, $producto->imagen5] as $imagenAdicional)
                                        @if($imagenAdicional)
                                            <div class="preview-image-container" data-path="{{ $imagenAdicional }}">
                                                <img src="{{ asset('storage/' . $imagenAdicional) }}" alt="Imagen Adicional">
                                                <button type="button" class="remove-image-btn" onclick="eliminarImagenExistente('{{ $imagenAdicional }}', 'adicional')">&times;</button>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <input type="hidden" id="imagenes-eliminadas" name="imagenes_eliminadas" value="">
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
                    Solo puedes seleccionar un máximo de 4 imágenes adicionales.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
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
                    Solo puedes seleccionar un máximo de 4 imágenes adicionales.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const formularioProducto = document.getElementById('formularioProducto');
            const inputPrincipal = document.getElementById('imagen_principal');
            const previewPrincipal = document.getElementById('previewPrincipal');
            const inputAdicionales = document.getElementById('imagenes_adicionales');
            const previewAdicionales = document.getElementById('previewAdicionales');
            const selectCategoria = document.getElementById('categoria');
            const selectSubcategoria = document.getElementById('subcategoria');
            const opcionesOriginales = Array.from(selectSubcategoria.querySelectorAll('option')).filter(opt => opt.value !== '');
            const imagenesEliminadas = document.getElementById('imagenes-eliminadas');
            let imagenesParaEliminar = new Set();
            let archivosAdicionales = new DataTransfer();

            // Limpia el mensaje de error y el borde al escribir
            function limpiarError(elemento) {
                elemento.classList.remove('error-border');
                const errorElement = document.getElementById('error-' + elemento.id);
                if (errorElement) {
                    errorElement.textContent = '';
                    errorElement.style.display = 'none';
                }
            }

            // Muestra el mensaje de error y el borde
            function mostrarError(elemento, mensajeError) {
                const errorElement = document.getElementById('error-' + elemento.id);
                elemento.classList.add('error-border');
                if (errorElement) {
                    errorElement.textContent = mensajeError;
                    errorElement.style.display = 'block';
                }
            }

            const formInputs = formularioProducto.querySelectorAll('input:not([type="hidden"]), select, textarea');
            formInputs.forEach(input => {
                input.addEventListener('input', function() {
                    limpiarError(this);
                });
            });

            // Lógica de actualización de imágenes
            function updateNewImagesPreview() {
                document.querySelectorAll('#previewAdicionales .preview-image-container:not([data-path])').forEach(el => el.remove());
                Array.from(archivosAdicionales.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const container = document.createElement('div');
                        container.className = 'preview-image-container';
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        container.appendChild(img);
                        const removeBtn = document.createElement('button');
                        removeBtn.className = 'remove-image-btn';
                        removeBtn.innerHTML = '&times;';
                        removeBtn.onclick = function() {
                            const fileName = file.name;
                            for (let i = 0; i < archivosAdicionales.items.length; i++) {
                                if (archivosAdicionales.items[i].getAsFile().name === fileName) {
                                    archivosAdicionales.items.remove(i);
                                    break;
                                }
                            }
                            inputAdicionales.files = archivosAdicionales.files;
                            updateNewImagesPreview();
                        };
                        container.appendChild(removeBtn);
                        previewAdicionales.appendChild(container);
                    };
                    reader.readAsDataURL(file);
                });
            }

            function previewImage(input, previewContainer) {
                previewContainer.innerHTML = '';
                if (input.files && input.files[0]) {
                    const file = input.files[0];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const container = document.createElement('div');
                        container.className = 'preview-image-container';
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        container.appendChild(img);
                        const removeBtn = document.createElement('button');
                        removeBtn.className = 'remove-image-btn';
                        removeBtn.innerHTML = '&times;';
                        removeBtn.onclick = function() {
                            input.value = '';
                            previewContainer.innerHTML = '';
                        };
                        container.appendChild(removeBtn);
                        previewContainer.appendChild(container);
                    }
                    reader.readAsDataURL(file);
                }
            }

            window.eliminarImagenExistente = function(path, tipo) {
                imagenesParaEliminar.add(path);
                imagenesEliminadas.value = Array.from(imagenesParaEliminar).join(',');
                if (tipo === 'principal') {
                    previewPrincipal.innerHTML = '';
                    document.getElementById('imagen_principal').required = true;
                } else {
                    const container = document.querySelector(`.preview-image-container[data-path="${path}"]`);
                    if (container) {
                        container.remove();
                    }
                }
            };

            inputPrincipal.addEventListener('change', function() {
                previewImage(this, previewPrincipal);
            });

            inputAdicionales.addEventListener('change', function() {
                const existingDbImagesCount = document.querySelectorAll('#previewAdicionales .preview-image-container[data-path]').length;
                const newFiles = Array.from(this.files);
                newFiles.forEach(file => archivosAdicionales.items.add(file));
                const totalImages = archivosAdicionales.files.length + existingDbImagesCount;
                if (totalImages > 4) {
                    const modal = new bootstrap.Modal(document.getElementById('modalImagenes'));
                    modal.show();
                    newFiles.forEach(file => {
                        const fileName = file.name;
                        for (let i = 0; i < archivosAdicionales.items.length; i++) {
                            if (archivosAdicionales.items[i].getAsFile().name === fileName) {
                                archivosAdicionales.items.remove(i);
                                break;
                            }
                        }
                    });
                    this.value = '';
                    return;
                }
                this.files = archivosAdicionales.files;
                updateNewImagesPreview();
            });

            const precioInput = document.getElementById('precio');


            precioInput.addEventListener('input', function() {
                limpiarError(this);

                formatPrice(this);
            });

            function validarInputPrecio(event) {
                const char = event.key;
                const isNumber = /^\d$/.test(char);
                const isDot = char === '.';
                const isComma = char === ',';
                const isControl = event.ctrlKey || event.metaKey; // Permite copiar/pegar
                const isNavigation = ['Backspace', 'Delete', 'ArrowLeft', 'ArrowRight', 'Tab'].includes(char);
                const currentValue = this.value;

                // Permite solo un punto o coma
                const hasDecimal = currentValue.includes('.') || currentValue.includes(',');

                if (!isNumber && !isNavigation && !isControl && !(isDot && !hasDecimal) && !(isComma && !hasDecimal)) {
                    event.preventDefault();
                }
            }

            precioInput.addEventListener('keydown', validarInputPrecio);

            function validarCamposPersonalizados() {
                let valido = true;

                // Validar el precio, ya que ahora es un campo de texto
                const precioRegex = /^\d{1,5}([,.]\d{1,2})?$/;
                let precioValue = precioInput.value.replace(',', '.');

                if (precioValue.trim() === '' || !precioRegex.test(precioValue) || parseFloat(precioValue) <= 0) {
                    mostrarError(precioInput, 'El precio debe ser un número positivo, con hasta 5 enteros y 2 decimales.');
                    valido = false;
                } else {
                    limpiarError(precioInput);
                }

                // Se mantienen las validaciones de los demás campos
                const nombreInput = document.getElementById('nombre');
                if(nombreInput.value.trim() === '') {
                    mostrarError(nombreInput, 'El nombre del producto es obligatorio.');
                    valido = false;
                } else {
                    limpiarError(nombreInput);
                }

                const stockInput = document.getElementById('stock');
                if(stockInput.value.trim() === '' || Number(stockInput.value) < 1 || Number(stockInput.value) > 10000) {
                    mostrarError(stockInput, 'La cantidad debe ser un número entero entre 1 y 10000.');
                    valido = false;
                } else {
                    limpiarError(stockInput);
                }

                const categoria = document.getElementById('categoria');
                if (categoria.value.trim() === '') {
                    mostrarError(categoria, 'La categoría es obligatoria.');
                    valido = false;
                } else {
                    limpiarError(categoria);
                }

                const subcategoria = document.getElementById('subcategoria');
                if (selectSubcategoria.options.length > 1 && subcategoria.value.trim() === '') {
                    mostrarError(subcategoria, 'La subcategoría es obligatoria.');
                    valido = false;
                } else {
                    limpiarError(subcategoria);
                }

                const descripcionInput = document.getElementById('descripcion');
                if(descripcionInput.value.trim() === '') {
                    mostrarError(descripcionInput, 'La descripción es obligatoria.');
                    valido = false;
                } else {
                    limpiarError(descripcionInput);
                }

                return valido;
            }

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
                limpiarError(selectCategoria);
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
                limpiarError(selectSubcategoria);
            });

            document.getElementById('btnLimpiar').addEventListener('click', () => {
                previewPrincipal.innerHTML = '';
                previewAdicionales.innerHTML = '';
                inputPrincipal.value = '';
                inputAdicionales.value = '';
                archivosAdicionales = new DataTransfer();
                imagenesParaEliminar.clear();
                imagenesEliminadas.value = '';
                document.getElementById('imagen_principal').required = true;
                ['nombre', 'precio', 'stock', 'categoria', 'subcategoria', 'descripcion', 'imagen_principal', 'imagenes_adicionales'].forEach(id => {
                    const el = document.getElementById(id);
                    if(el) limpiarError(el);
                });
            });

            formularioProducto.addEventListener('submit', function(e) {
                if (!validarCamposPersonalizados()) {
                    e.preventDefault();
                    // Encuentra el primer campo con error para enfocarlo
                    const firstErrorField = document.querySelector('.error-border');
                    if (firstErrorField) {
                        firstErrorField.focus();
                    }
                }
            });

            @if(isset($producto) && !$producto->imagen)
            document.getElementById('imagen_principal').required = true;
            @endif
        });

        function formatPrice(input) {
            let value = input.value;
            value = value.replace(/,/g, '.');
            const parts = value.split('.');
            if (parts[0].length > 5) {
                parts[0] = parts[0].slice(0, 5);
            }
            if (parts.length > 1 && parts[1].length > 2) {
                parts[1] = parts[1].slice(0, 2);
            }
            input.value = parts.join('.');
        }
    </script>
@endsection
