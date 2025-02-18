@extends('layout.plantilla')
@section('titulo', 'Lista de veterinarias')

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
<body>
    <h1>Lista de Veterinarias <a class="btn btn-primary" href="{{ route('veterinarias.create') }}">Nuevo</a></h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Propietario</th>
                <th scope="col">Hora de Apertura</th>
                <th scope="col">Hora de Cierre</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($veterinarias as $veterinaria)
            <tr>
                <td>{{ $veterinaria->id }}</td>
                <td>{{ $veterinaria->nombre }}</td>
                <td>{{ $veterinaria->nombre_veterinario }}</td>
                <td>{{ $veterinaria->horario_apertura }}</td>
                <td>{{ $veterinaria->horario_cierre }}</td>
                <td>{{ $veterinaria->telefono }}</td>
                <td>
                    <a href="{{ route('veterinarias.show', ['id' => $veterinaria->id]) }}" class="btn btn-success btn-sm">Ver</a>
                    <a href="{{ route('veterinarias.edit', ['id' => $veterinaria->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $veterinaria->id }}">Eliminar</button>
                    <div class="modal fade" id="modalEliminar{{$veterinaria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar {{ $veterinaria->nombre }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    ¿De verdad quiere eliminar la veterinaria {{ $veterinaria->nombre}}?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form method="post" action="{{ route('veterinarias.destroy', ['id'=>$veterinaria->id]) }}" class="form-inline">
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
    {{ $veterinarias->links() }}
    @endsection