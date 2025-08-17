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
        <h2 class="mb-0">| Veterinarias</h2>
        <a href="{{ route('veterinarias.panelcreate') }}" class="btn ms-auto" role="button">
            <h7><i class="fas fa-plus"></i> Crear veterinaria</h7>
        </a>
    </div>

    <hr>

    <form action="{{ route('veterinarias.search') }}" class="" role="search" style="width: 100%; align-content: flex-end;">
        <div class="row">
            <div class="col">
                <input class="form-control me-2" maxlength="50" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre">
            </div>
            <div class="col">
                <button class="btn btn-outline-light " type="submit"><i class="fas fa-search"></i></button>
                <span class="glyphicon glyphicon-search"></span>
            </div>
        </div>
    </form>

    <hr>

    <div style="overflow-x: visible !important;">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">Nombre de la Veterinaria</th>
                <th scope="col">Nombre del Veterinario</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($veterinarias as $veterinaria)
                <tr>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $veterinaria->nombre }}
                    </td>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $veterinaria->nombre_veterinario }}
                    </td>
                    <td style="max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $veterinaria->telefono }}
                    </td>
                    <td style="text-align: center;">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('veterinarias.panelshow', ['id' => $veterinaria->id]) }}">Detalles</a></li>
                                <li><a class="dropdown-item" href="{{ route('veterinarias.paneledit', ['id' => $veterinaria->id]) }}">Editar</a></li>
                                <li><a class="dropdown-item" href="{{ route('veterinarias.paneldestroy', ['id' => $veterinaria->id]) }}" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$veterinaria->id}}">Eliminar</a></li>
                            </ul>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="modalEliminar{{$veterinaria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar veterinaria</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar la veterinaria?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form method="post" action="{{ route('veterinarias.paneldestroy', ['id' => $veterinaria->id]) }}">
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
