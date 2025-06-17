@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    <form>
        <div class="card-body">
            <h4>
                <a href="{{ route('productos.panel') }}" class="btn" role="button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <strong>Detalles del producto</strong>
            </h4>
            <hr>

            <div class="row">
                <div class="col-8">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre"
                               value="{{ $producto->nombre ?? '' }}" disabled>
                        <label for="nombre">Nombre del producto</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="precio" name="precio"
                               value="{{ $producto->precio ?? '' }}" disabled>
                        <label for="precio">Precio</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="stock" name="stock"
                               value="{{ $producto->stock ?? '' }}" disabled>
                        <label for="stock">Stock</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="categoria_id" name="categoria_id" disabled>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}" {{ isset($producto) && $producto->categoria_id == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                        <label for="categoria_id">Categoría</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="descripcion" name="descripcion" style="height: 100px" disabled>{{ $producto->descripcion ?? '' }}</textarea>
                        <label for="descripcion">Descripción</label>
                    </div>
                </div>
                <div class="col-4 d-flex flex-column align-items-center">
                    @if($producto->imagen)
                        <div class="mb-3" style="border-radius: 10px; overflow: hidden; display: flex; flex-direction: column; align-items: center;">
                            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen principal" style="border-radius: 10px; width: 15vw; height: auto; max-width: 250px;">
                            <div class="image-caption" style="width: 200px; margin-top: 1vw; text-align: center;">
                                <strong>Imagen principal</strong>
                            </div>
                        </div>
                    @else
                        <span>No hay imagen</span>
                    @endif
                    @for($i = 2; $i <= 5; $i++)
                        @php $img = $producto->{'imagen'.$i} ?? null; @endphp
                        @if($img)
                            <img src="{{ asset('storage/' . $img) }}" alt="Imagen secundaria" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; margin: 3px;">
                        @endif
                    @endfor
                </div>
            </div>
        </div>
    </form>
    <a href="{{ route('productos.paneledit', ['id'=> $producto->id]) }}" class="btn btn-warning" role="button" style="margin-left: 2vw;">
        <i class="fa-solid fa-pen-to-square"></i> Editar
    </a>
    <a href="#" class="btn btn-danger" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$producto->id}}">
        <i class="fa-solid fa-trash"></i> Eliminar
    </a>

    <!-- Modal -->
    <div class="modal fade" id="modalEliminar{{$producto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar producto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar el producto?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form method="post" action="{{ route('productos.paneldestroy' , ['id'=>$producto->id]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection