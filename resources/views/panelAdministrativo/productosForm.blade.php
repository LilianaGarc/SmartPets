@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    <form method="post"
          enctype="multipart/form-data"
         >
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
                <div class="col-8">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del producto</label>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $producto->stock ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <select class="form-select" id="categoria_id" name="categoria_id" required>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="imagenes" class="form-label">Imágenes</label>
                        <input type="file" class="form-control" id="imagenes" name="imagenes[]" multiple>
                    </div>
                </div>

                @if (isset($producto) && $producto->imagen)
                    <div class="col">
                        <div class="form-group image-preview-container"
                             style="margin: 2vw; border-radius: 10px; overflow: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                            <img id="image-preview" src="{{ asset('storage/' . $producto->imagen) }}" alt="Vista previa de la imagen" style="border-radius: 10px; width: 15vw; height: auto;">
                            <div class="image-caption" style="width: 200px; margin-top: 1vw; text-align: center;">
                                <strong>Vista Previa</strong>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-light">Guardar</button>
            <button type="reset" class="btn btn-light">Cancelar</button>
        </div>
    </form>

@endsection
