
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
    <h3 class="mb-0">| Publicaciones</h3>
    <a href="{{ route('publicaciones.panelcreate') }}" class="btn ms-auto" role="button">
        <h8>Nueva publicación <i class="fas fa-plus"></i></h8>
    </a>
</div>
<hr>

<form action="{{ route('publicaciones.search') }}" class="" role="search" style="width: 100%; align-content: flex-end;">
    <div class="row" style="justify-content: space-between;">
        <div class="col">
            <input class="form-control flex-grow-1" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre">
        </div>
        <div class="col">
            <button class="btn btn-outline-light " type="submit"><i class="fas fa-search"></i></button>
            <span class="glyphicon glyphicon-search"></span>
        </div>
    </div>
    </div>
</form>
<hr>

<div style="overflow-x: auto; margin-left: 1rem; margin-right: 1rem;">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Contenido</th>
                <th scope="col">Visibilidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($publicaciones as $publicacion)
                <tr>
                    <td>
                        @if($publicacion->user)
                            {{ $publicacion->user->name }}
                        @else
                            Usuario no disponible
                        @endif
                    </td>
                    <td>{{  $publicacion->contenido  }}</td>
                    <td>{{  $publicacion->visibilidad  }}</td>
                    <td style="text-align: center;">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('publicaciones.paneldetalles', ['id'=> $publicacion->id]) }}">Detalles</a></li>
                                <li><a class="dropdown-item" href="{{ route('publicaciones.paneledit', ['id'=> $publicacion->id]) }}">Editar</a></li>
                                <li><a class="dropdown-item" href="# " data-bs-toggle="modal" data-bs-target="#modalEliminar{{$publicacion->id}}">Eliminar</a></li>
                            </ul>
                        </div>


                    <!-- Modal -->
                    <div class="modal fade" id="modalEliminar{{$publicacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar publicacion</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Esta seguro de eliminar la publicacion?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form method="post" action="{{ route('publicaciones.paneldestroy' , ['id'=>$publicacion->id]) }}">
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
