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
    <h2 class="mb-0">| Adopciones</h2>
    <a href="{{ route('adopciones.panelcreate') }}" class="btn ms-auto" role="button">
        <h7><i class="fas fa-plus"></i> Crear adopcion</h7>
    </a>
</div>

<hr>

<form action="{{ route('adopciones.search') }}" class="" role="search" style="align-content: flex-end;">
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

<div style="overflow-x: visible !important; margin-left: 1rem; margin-right: 1rem;">
    <table class="table table-striped table-bordered" style="margin: 15px;  ">
        <thead>
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Nombre de la mascota</th>
                <th scope="col">Tipo de mascota</th>
                <th scope="col">Contenido</th>
            </tr>
        </thead>
        <tbody>
            @foreach($adopciones as $adopcion)
            <tr>
                <td>{{ $adopcion->usuario->name ?? 'Sin usuario' }}</td>
                <td>{{ $adopcion->nombre_mascota}}</td>
                <td>{{ $adopcion->tipo_mascota}}</td>
                <td>{{ $adopcion->contenido}}</td>
                <td style="text-align: center;">
                    <div class="dropdown">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Acciones
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('adopciones.panelshow' , ['id'=>$adopcion->id]) }}">Detalles</a></li>
                            <li><a class="dropdown-item" href="{{ route('adopciones.paneledit' , ['id'=>$adopcion->id]) }}">Editar</a></li>
                            <li><a class="dropdown-item" href="# " data-bs-toggle="modal" data-bs-target="#modalEliminar{{$adopcion->id}}">Eliminar</a></li>
                        </ul>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="modalEliminar{{$adopcion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar adopcion</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Esta seguro de eliminar la adopcion?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form method="post" action="{{ route('adopciones.paneldestroy' , ['id'=>$adopcion->id]) }}">
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
