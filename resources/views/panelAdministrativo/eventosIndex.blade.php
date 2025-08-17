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



    <div class="d-flex align-items-center mb-3">
        <h3 class="mb-0">| Eventos</h3>
        <a href="{{ route('eventos.panelcreate') }}" class="btn ms-auto" role="button">
            <h8>Nuevo evento <i class="fas fa-plus"></i></h8>
        </a>
    </div>
    <hr>
    <form action="{{ route('eventos.search') }}"  class="mb-3">
        <div class="row">
            <div class="col">
                <input class="form-control me-2" maxlength="50" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre">
            </div>
            <div class="col">
                <button class="btn btn-outline-light " type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>

    <hr>


    <div style="overflow-x: visible !important;">
        <table class="table table-striped table-bordered" >
            <thead>
            <tr>
                <th scope="col">Titulo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora de Inicio</th>
                <th scope="col">Hora de Fin</th>
                <th scope="col">Estado</th>
            </tr>
            </thead>
            <tbody>
            @foreach($eventos as $evento)
                <tr>
                    <td>{{ $evento->titulo }}</td>
                    <td>{{ $evento->fecha }}</td>
                    <td>{{ $evento->hora_inicio }}</td>
                    <td>{{ $evento->hora_fin }}</td>
                    <td>
                        @if($evento->estado === 'pendiente')
                            <form method="POST" action="{{ route('eventos.aceptar', $evento->id) }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Aceptar</button>
                            </form>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalRechazar{{$evento->id}}">
                                Rechazar
                            </button>
                            <!-- Modal Rechazar -->
                            <div class="modal fade" id="modalRechazar{{$evento->id}}" tabindex="-1" aria-labelledby="modalRechazarLabel{{$evento->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form method="POST" action="{{ route('eventos.rechazar', $evento->id) }}">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalRechazarLabel{{$evento->id}}">Motivo del rechazo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="motivo{{$evento->id}}" class="form-label">Motivo</label>
                                                <textarea name="motivo" id="motivo{{$evento->id}}" class="form-control" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger btn-sm">Rechazar evento</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @elseif($evento->estado === 'aceptado')
                            <span class="badge bg-success">Aceptado</span>
                        @elseif($evento->estado === 'rechazado')
                            <span class="badge bg-danger">Rechazado</span>
                        @else
                            <span class="badge bg-secondary">Sin estado</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('eventos.panelshow', ['id'=> $evento->id]) }}">Detalles</a></li>
                                <li><a class="dropdown-item" href="{{ route('eventos.paneledit', ['id'=> $evento->id]) }}">Editar</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$evento->id}}">Eliminar</a></li>
                            </ul>
                        </div>

                        <!-- Modal Eliminar -->
                        <div class="modal fade" id="modalEliminar{{$evento->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar evento</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar el evento?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
