@extends('panelAdministrativo.plantillaPanel')
@section('contenido')
<style>
    .pd-main-image {
        width: 100%;
        max-width: 280px;
        height: 220px;
        border-radius: 10px;
        overflow: hidden;
        border: 2px solid #e6e6e6;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
    }
    .pd-main-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .pd-thumbs {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 12px;
    }
    .pd-thumb {
        width: 64px;
        height: 64px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        position: relative;
        border: 2px solid transparent;
        flex: 0 0 auto;
    }
    .pd-thumb img { width:100%; height:100%; object-fit:cover; display:block; }
    .pd-thumb.active { border-color: #1e4183; }
</style>
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
                    <label class="form-label"><strong>Imagen principal</strong></label>

                    <div class="pd-main-image mb-2">
                        @if($producto->imagen)
                            <img id="mainDetalleImg" src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen principal">
                        @else
                            <div class="text-muted">Sin imagen principal</div>
                        @endif
                    </div>
                    <hr style="width:100%;">
                    <label class="form-label mt-2"><strong>Miniaturas</strong></label>
                    <div id="pdThumbnails" class="pd-thumbs">
                        @if(isset($producto))
                            @if($producto->imagen)
                                <div class="pd-thumb active" data-full="{{ asset('storage/' . $producto->imagen) }}" data-path="{{ $producto->imagen }}">
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="principal-mini">
                                </div>
                            @endif

                            @for($i = 2; $i <= 5; $i++)
                                @php $img = $producto->{'imagen'.$i} ?? null; @endphp
                                @if($img)
                                    <div class="pd-thumb" data-full="{{ asset('storage/' . $img) }}" data-path="{{ $img }}">
                                        <img src="{{ asset('storage/' . $img) }}" alt="sec-{{$i}}">
                                    </div>
                                @endif
                            @endfor
                        @endif
                    </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mainImg = document.getElementById('mainDetalleImg');
            const thumbs = document.getElementById('pdThumbnails');
            if (!thumbs) return;
            thumbs.querySelectorAll('.pd-thumb').forEach(t => {
                t.addEventListener('click', function(e) {
                    const full = this.dataset.full || this.querySelector('img')?.src;
                    if (!full) return;
                    if (mainImg) mainImg.src = full;
                    thumbs.querySelectorAll('.pd-thumb').forEach(x => x.classList.remove('active'));
                    this.classList.add('active');
                });
            });
        });
    </script>

@endsection