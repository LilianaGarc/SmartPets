@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    @if(session('exito'))
        <div class="alert alert-success" role="alert">
            {{ session('exito') }}
        </div>
    @endif
    @if(session('fracaso'))
        <div class="alert alert-danger" role="alert">
            {{ session('fracaso') }}
        </div>
    @endif
    <div class="d-flex align-items-center mb-2">
        <h3 class="mb-0">| Productos</h3>
        <a href="{{ route('productos.panelcreate') }}" class="btn ms-auto" role="button">
            <h8>Nuevo producto <i class="fas fa-plus"></i></h8>
        </a>
    </div>
    <hr>
    <form action="{{ route('productos.search') }}" method="GET" role="search" style="width: 100%; align-content: flex-end;">
        <div class="row">
            <div class="col">
                <input class="form-control me-2" maxlength="50" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre" value="{{ request('nombre') }}">
            </div>
            <div class="col">
                <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>

    <hr>


    <div style="overflow-x: visible !important;">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
            </tr>
            </thead>
            <tbody>
            @foreach($productos as $producto)
                <tr>
                    <td class="truncate-cell">{{  $producto->nombre}}</td>
                    <td class="truncate-cell">{{  $producto->descripcion}}</td>
                    <td class="truncate-cell">{{  $producto->precio}}</td>
                    <td class="truncate-cell">{{  $producto->stock}}</td>
                    <td style="text-align: center;">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('productos.panelshow', $producto->id) }}">Detalles</a></li>
                                <li><a class="dropdown-item" href="{{ route('productos.paneledit', $producto->id)}}">Editar</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$producto->id}}">Eliminar</a></li>
                            </ul>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalEliminar{{$producto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar producto</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Esta seguro de eliminar el producto?
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

                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



@endsection
