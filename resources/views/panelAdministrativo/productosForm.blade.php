@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

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
                <div class="col">
                    <div class="form-floating mb-3">
                        <input type="text" maxlength="50" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" value="{{ old('nombre', $producto->nombre ?? '') }}" required>
                        <label for="nombre">Nombre del producto</label>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" maxlength="255" rows="3">{{ isset($producto) ? $producto->descripcion : old('descripcion') }}</textarea>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="precio" name="precio" placeholder="Precio" value="{{ isset($producto) ? number_format($producto->precio, 2, '.', '') : old('precio', '0.00') }}" required>
                        <label for="precio">Precio</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{ isset($producto) ? $producto->stock : old('stock', 1) }}" required>
                        <label for="stock">Stock</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select @error('categoria_id') error-border @enderror" id="categoria" name="categoria_id">
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

                    <div class="error-message" id="error-subcategoria">
                        @error('subcategoria_id') {{ $message }} @enderror
                    </div>
                    <br>

                    <div class="mb-3">
                        <input type="file" class="form-control" id="imagenes" name="imagenes[]" multiple>
                    </div>
                </div>

                @if (isset($producto) && $producto->imagen)
                    <div class="col">
                        <div class="form-group image-preview-container"
                             style="margin: 2vw; border-radius: 10px; overflow: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
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
                @endif
            </div>

            <button type="submit" class="btn btn-light">Guardar</button>
            <button type="reset" class="btn btn-light">Cancelar</button>
        </div>
    </form>

@endsection
