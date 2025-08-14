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
    <h3>  |   Mensajes </h3>
    <hr>
    <form action="{{ route('mensajes.search') }}"  class="" role="search" style="width: 160%; align-content: flex-end;">
        <div class="row">
            <div class="col">
                <input class="form-control me-2" maxlength="50" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre">
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
                <th scope="col">Chat</th>
                <th scope="col">Contenido</th>
                <th scope="col">Fecha</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mensajes as $mensaje)
                <tr>
                    <td>{{  $mensaje->id_chat}}</td>
                    <td>{{  $mensaje->texto}}</td>
                    <td>{{  $mensaje->fecha}}</td>
                    <td style="text-align: center;">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Detalles</a></li>
                                <li><a class="dropdown-item" href="#">Editar</a></li>
                                <li><a class="dropdown-item" href="# " data-bs-toggle="modal" data-bs-target="#modalEliminar{{$mensaje->id}}">Eliminar</a></li>
                            </ul>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="modalEliminar{{$mensaje->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar mensaje</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Esta seguro de eliminar el mensaje?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="post" action="{{ route('mensajes.paneldestroy' , ['id'=>$mensaje->id]) }}">
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
