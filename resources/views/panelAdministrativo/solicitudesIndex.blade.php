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
<h3> | Solicitudes </h3>

    <hr>
    <form action="{{ route('solicitudes.search') }}"  class="" role="search" style="align-content: flex-end;">
        <div class="row">
            <div class="col">
                <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre">
            </div>
            <div class="col">
                <button class="btn btn-outline-light " type="submit"><i class="fas fa-search"></i></button>
                <span class="glyphicon glyphicon-search"></span>
            </div>
            <div class="col">
                <a href="#" class="btn" role="button"><h7><i class="fas fa-plus"></i>
                        Nueva solicitud</h7></a>
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
                <th scope="col"># Adopcion</th>
                <th scope="col">Contenido</th>
            </tr>
        </thead>
        <tbody>
            @foreach($solicitudes as $solicitud)
            <tr>
                <td>{{ $solicitud->usuario->name ?? 'Sin usuario' }}</td>
                <td>
                    <a href="{{ route('adopciones.show', $solicitud->adopcion->id) }}">
                        {{ $solicitud->adopcion->titulo ?? $solicitud->id_adopcion }}
                    </a>
                </td>

                <td>{{ $solicitud->contenido}}</td>
                <td style="text-align: center;">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Actions
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('solicitudes.show', [$solicitud->adopcion->id, $solicitud->id]) }}">Detalles</a></li>
                            <li><a class="dropdown-item" href="{{ route('solicitudes.edit', [$solicitud->id_adopcion, $solicitud->id]) }}">Editar</a></li>
                            <li><a class="dropdown-item" href="# " data-bs-toggle="modal" data-bs-target="#modalEliminar{{$solicitud->id}}">Eliminar</a></li>
                        </ul>
                    </div>


                    <!-- Modal -->
                    <div class="modal fade" id="modalEliminar{{$solicitud->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar solicitud</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Esta seguro de eliminar la solicitud?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form method="post" action="{{ route('solicitudes.paneldestroy' , ['id'=>$solicitud->id]) }}">
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
