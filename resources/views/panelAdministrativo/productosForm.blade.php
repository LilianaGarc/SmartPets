@extends('panelAdministrativo.plantillaPanel')
@section('contenido')
  <style>
        #previewPrincipal, #previewAdicionales {
            margin-top: 10px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        #previewPrincipal img {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        #previewAdicionales img {
            width: 96px;
            height: 96px;
            object-fit: cover;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .preview-image-container {
            position: relative;
            display: inline-block;
            overflow: visible; 
        }
        .remove-image-btn {
            position: absolute;
            top: 6px;
            right: 6px;
            background-color: rgba(220,53,69,0.95);
            color: white;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: none;
            font-size: 14px;
            line-height: 1;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
            z-index: 5;
        }
        .remove-image-btn:hover {
            transform: scale(1.05);
        }
    </style>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post"
          enctype="multipart/form-data"
          action="{{ isset($producto) ? route('productos.panelupdate', $producto->id) : route('productos.panelstore') }}">
        @isset($producto)
            @method('put')
        @endisset
        @csrf
        <div class="card-body">
            @if(isset($producto))
                <h4><a href="{{ route('productos.panel') }}" class="btn" role="button"><i class="fa-solid fa-arrow-left"></i></a> <strong>Editar el producto</strong></h4>
            @else
                <h4><a href="{{ route('productos.panel') }}" class="btn" role="button"><i class="fa-solid fa-arrow-left"></i></a> <strong>Crear un nuevo producto</strong></h4>
            @endif
            <hr>
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="form-floating mb-3">
                        <input type="text" maxlength="50" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" value="{{ old('nombre', $producto->nombre ?? '') }}" required title="Ingrese el nombre del producto (máx. 50 caracteres)">
                        <label for="nombre">Nombre del producto</label>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" required name="descripcion" maxlength="255" rows="3" title="Describa brevemente el producto (máx. 255 caracteres)">{{ isset($producto) ? $producto->descripcion : old('descripcion') }}</textarea>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" value="{{ isset($producto) ? number_format($producto->precio, 2, '.', '') : old('precio', '0.00') }}" required title="Ingrese el precio del producto (ej. 19.99)">
                        <label for="precio">Precio</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{ isset($producto) ? $producto->stock : old('stock', 1) }}" required title="Ingrese la cantidad disponible en stock">
                        <label for="stock">Stock</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('categoria_id') error-border @enderror" id="categoria" required name="categoria_id" title="Seleccione la categoría del producto">
                            <option value="">Seleccione una categoría</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ (isset($producto) && $producto->categoria_id == $categoria->id) || old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <div class="error-message" id="error-categoria">
                            @error('categoria_id') {{ $message }} @enderror
                        </div>
                    </div>

                    <select class="form-select @error('subcategoria_id') error-border @enderror" id="subcategoria" required name="subcategoria_id" title="Seleccione una subcategoría del producto">
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

                    <div class="error-message" id="error-subcategoria">
                        @error('subcategoria_id') {{ $message }} @enderror
                    </div>
                    <br>

                </div>

                <div class="col-12 col-md-4 d-flex justify-content-center">
                    <div style="width:100%;max-width:320px;display:flex;flex-direction:column;align-items:center;">
                        <label class="form-label text-center w-100">Imagen principal (requerida)</label>
                        <div id="previewPrincipal" style="width:160px;height:160px;border-radius:8px;border:1px solid #eee;overflow:hidden;display:flex;align-items:center;justify-content:center;background:#fff;margin-bottom:10px;">
                            @if(isset($producto) && $producto->imagen)
                                <div class="preview-image-container" data-path="{{ $producto->imagen }}" style="width:100%;height:100%;position:relative;">
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="principal" style="width:100%;height:100%;object-fit:cover;display:block;">
                                    <button type="button" class="remove-image-btn" onclick="eliminarImagenExistente('{{ $producto->imagen }}','principal')">&times;</button>
                                    <input type="hidden" name="imagen_principal_existente" value="{{ $producto->imagen }}">
                                </div>
                            @else
                                <span class="text-muted">Sin imagen principal</span>
                            @endif
                        </div>

                        <input type="file" class="form-control mb-2 @error('imagen_principal') error-border @enderror"
                               id="imagen_principal" name="imagen_principal" accept="image/*" {{ isset($producto) && $producto->imagen ? '' : 'required' }}>
                        <small class="text-muted d-block mb-2">JPG/JPEG, PNG, GIF, WEBP — Máx 2MB</small>

                        <hr style="width:100%;">

                        <label class="form-label text-center w-100">Imágenes adicionales (opcionales)</label>
                        <div id="previewAdicionales" style="display:flex;flex-wrap:wrap;gap:8px;justify-content:center;margin:8px 0;">
                            @if(isset($producto))
                                @foreach([$producto->imagen2, $producto->imagen3, $producto->imagen4, $producto->imagen5] as $imagenAdicional)
                                    @if($imagenAdicional)
                                        <div class="preview-image-container" data-path="{{ $imagenAdicional }}" style="width:96px;height:96px;overflow:hidden;border-radius:6px;border:1px solid #eee;position:relative;">
                                            <img src="{{ asset('storage/' . $imagenAdicional) }}" alt="adicional" style="width:100%;height:100%;object-fit:cover;display:block;">
                                            <button type="button" class="remove-image-btn" onclick="eliminarImagenExistente('{{ $imagenAdicional }}','adicional')">&times;</button>
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>

                        <input type="file" class="form-control mt-1" id="imagenes_adicionales" name="imagenes_adicionales[]" accept="image/*" multiple>
                        <small class="text-muted d-block mt-1">Máx 4 imágenes adicionales — tamaño fijo 96×96</small>

                        <input type="hidden" id="imagenes-eliminadas" name="imagenes_eliminadas" value="">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-light">Guardar</button>
            <a href="{{ route('productos.panel') }}" class="btn btn-danger" role="button">Cancelar</a>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputPrincipal = document.getElementById('imagen_principal');
        const inputAdicionales = document.getElementById('imagenes_adicionales');
        const previewPrincipal = document.getElementById('previewPrincipal');
        const previewAdicionales = document.getElementById('previewAdicionales');
        const imagenesEliminadas = document.getElementById('imagenes-eliminadas');
        let dataAdicionales = new DataTransfer();

        function crearPreview(src, path=null, tipo='adicional') {
            const wrapper = document.createElement('div');
            wrapper.className = 'preview-image-container';
            wrapper.style.cssText = 'width:96px;height:96px;overflow:hidden;border-radius:6px;border:1px solid #eee;position:relative;margin:6px;display:inline-block;';
            if (path) wrapper.setAttribute('data-path', path);
            const img = document.createElement('img');
            img.src = src;
            img.style.cssText = 'width:100%;height:100%;object-fit:cover;display:block;';
            wrapper.appendChild(img);
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'remove-image-btn';
            btn.innerHTML = '&times;';
            btn.style.cssText = 'position:absolute;top:6px;right:6px;background:#dc3545;color:#fff;border-radius:50%;width:28px;height:28px;border:none;cursor:pointer;font-size:14px;line-height:1;';
            btn.onclick = function() {
                if (path) {
                    eliminarImagenExistente(path, tipo);
                } else {
                    wrapper.remove();
                    for (let i = 0; i < dataAdicionales.items.length; i++) {
                        if (dataAdicionales.items[i].getAsFile().name === img.dataset.name) {
                            dataAdicionales.items.remove(i);
                            break;
                        }
                    }
                    if (inputAdicionales) inputAdicionales.files = dataAdicionales.files;
                }
            };
            wrapper.appendChild(btn);
            return wrapper;
        }

        function previewFile(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const el = crearPreview(e.target.result, null, 'adicional');
                el.querySelector('img').dataset.name = file.name;
                previewAdicionales.appendChild(el);
            };
            reader.readAsDataURL(file);
        }

        if (inputPrincipal) {
            inputPrincipal.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const existing = previewPrincipal.querySelector('.preview-image-container[data-path]');
                    if (existing) existing.remove();
                    const fr = new FileReader();
                    fr.onload = function(e) {
                        const cont = document.createElement('div');
                        cont.className = 'preview-image-container';
                        cont.style.cssText = 'width:100%;height:100%;position:relative;';
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.cssText = 'width:100%;height:100%;object-fit:cover;display:block;';
                        cont.appendChild(img);
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'remove-image-btn';
                        btn.innerHTML = '&times;';
                        btn.style.cssText = 'position:absolute;top:6px;right:6px;background:#dc3545;color:#fff;border-radius:50%;width:28px;height:28px;border:none;cursor:pointer;font-size:14px;line-height:1;';
                        btn.onclick = function() {
                            cont.remove();
                            inputPrincipal.value = '';
                        };
                        cont.appendChild(btn);
                        previewPrincipal.innerHTML = '';
                        previewPrincipal.appendChild(cont);
                    };
                    fr.readAsDataURL(this.files[0]);
                }
            });
        }

        if (inputAdicionales) {
            inputAdicionales.addEventListener('change', function() {
                Array.from(this.files).forEach(f => dataAdicionales.items.add(f));
                const existingCount = previewAdicionales.querySelectorAll('.preview-image-container[data-path]').length;
                if (dataAdicionales.files.length + existingCount > 4) {
                    alert('Solo puedes tener hasta 4 imágenes adicionales.');
                    dataAdicionales = new DataTransfer();
                    this.value = '';
                    return;
                }
                this.files = dataAdicionales.files;
                Array.from(dataAdicionales.files).forEach(f => previewFile(f));
            });
        }

        window.eliminarImagenExistente = function(path, tipo) {
            const arr = imagenesEliminadas.value ? imagenesEliminadas.value.split(',') : [];
            if (!arr.includes(path)) arr.push(path);
            imagenesEliminadas.value = arr.filter(Boolean).join(',');
            const el = document.querySelector(`[data-path="${path}"]`);
            if (el) el.remove();
            if (tipo === 'principal' && inputPrincipal) inputPrincipal.required = true;
        };

        document.querySelectorAll('button[type="reset"]').forEach(btn => {
            btn.addEventListener('click', function() {
                if (previewPrincipal) previewPrincipal.innerHTML = '';
                if (previewAdicionales) previewAdicionales.innerHTML = '';
                if (inputPrincipal) inputPrincipal.value = '';
                if (inputAdicionales) inputAdicionales.value = '';
                dataAdicionales = new DataTransfer();
                if (imagenesEliminadas) imagenesEliminadas.value = '';
                if (inputPrincipal) inputPrincipal.required = true;
            });
        });
    });
    </script>

@endsection
