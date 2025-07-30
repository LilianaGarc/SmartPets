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
        <h3 class="mb-0">| Eventos</h3>
        <a href="{{ route('eventos.panelcreate') }}" class="btn ms-auto" role="button">
            <h8>Nuevo evento <i class="fas fa-plus"></i></h8>
        </a>
    </div>
    <hr>
    <form action="{{ route('eventos.search') }}"  class="" role="search" style="width: 160%; align-content: flex-end;">
        <div class="row">
            <div class="col">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre">
            </div>
            <div class="col">
                <button class="btn btn-outline-light " type="submit"><i class="fas fa-search"></i></button>
                <span class="glyphicon glyphicon-search"></span>
            </div>
        </div>
        </div>
    </form>
    <hr>

    <div style="overflow-x: visible; margin-left: 1rem; margin-right: 1rem;">
        <table class="table table-striped table-bordered" >
            <thead>
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora de Inicio</th>
                <th scope="col">Hora de Fin</th>
            </tr>
            </thead>
            <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td>{{  $evento->titulo}}</td>
                    <td>{{  $evento->fecha}}</td>
                    <td>{{  $evento->hora_inicio}}</td>
                    <td>{{  $evento->hora_fin}}</td>
                    <td style="text-align: center;">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Actions
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('eventos.panelshow', ['id'=> $evento->id]) }}">Detalles</a></li>
                                <li><a class="dropdown-item" href="{{ route('eventos.paneledit', ['id'=> $evento->id]) }}">Editar</a></li>
                                <li><a class="dropdown-item" href="# " data-bs-toggle="modal" data-bs-target="#modalEliminar{{$evento->id}}">Eliminar</a></li>
                            </ul>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="modalEliminar{{$evento->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar evento</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Esta seguro de eliminar El evento?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="post" action="{{ route('eventos.paneldestroy' , ['id'=>$evento->id]) }}">
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
