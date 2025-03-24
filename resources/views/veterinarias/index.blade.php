@extends('layout.plantillaSaid')
@section('titulo', 'Veterinarias')
@section('contenido')
<div class="container-fluid">

    @if(session('exito'))
    <div class="alert alert-success p-2" role="alert">
        {{ session('exito') }}
    </div>
    @endif

    @if(session('fracaso'))
    <div class="alert alert-danger p-2" role="alert">
        {{ session('fracaso') }}
    </div>
    @endif

    <h1 class="d-flex justify-content-between align-items-center mb-2 text-center"><b>Veterinarias</b>
        <a class="btn btn-primary py-1 px-2 d-flex align-items-center" href="{{ route('veterinarias.create') }}" style="font-size: 65%;">
            <img src="images/Crear_Veterinaria.svg" alt="Crear Veterinaria" width="20px" class="me-1">Nuevo
        </a>
    </h1>

    <div class="container-fluid p-0">
        <div class="table-responsive border border-2 rounded-3">
            <table class="table table-hover table-bordered w-100 text-center align-middle">
                <thead class="table-light">
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
                
                <tbody class="table-group-divider">
                    @if($veterinarias->isEmpty())
                    <tr>
                        <td colspan="7" class="text-center p-2">
                            <p class="text-muted text-center">No hay veterinarias registradas</p>
                            <img src="images//vacio.svg" alt="No hay veterinarias" class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
                        </td>
                    </tr>
                    @endif

                    @foreach ($veterinarias as $veterinaria)
                    <tr>
                        <td>{{ $veterinaria->id }}</td>
                        <td>{{ $veterinaria->nombre }}</td>
                        <td>{{ $veterinaria->nombre_veterinario }}</td>
                        <td>{{ $veterinaria->horario_apertura }}</td>
                        <td>{{ $veterinaria->horario_cierre }}</td>
                        <td>{{ $veterinaria->telefono }}</td>
                        <td>
                            <div class="btn-group d-flex">
                                <a href="{{ route('veterinarias.show', ['id' => $veterinaria->id]) }}" class="btn btn-success btn-sm"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('veterinarias.edit', ['id' => $veterinaria->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil"></i></a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $veterinaria->id }}"><i class="fas fa-trash"></i></button>
                                <div class="modal fade" id="modalEliminar{{$veterinaria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{ $veterinaria->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content bg-light">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold" id="modalLabel{{$veterinaria->id}}">
                                                    <i class="fas fa-exclamation-triangule text-danger"></i>Eliminar {{ $veterinaria->nombre }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cancelar"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿De verdad quiere eliminar la veterinaria <strong>{{ $veterinaria->nombre}}</strong>?
                                            </div>
                                            <div class="modal-footer d-flex">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <form method="post" action="{{ route('veterinarias.destroy', ['id'=>$veterinaria->id]) }}" class="form-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="submit" value="eliminar" class="btn btn-danger">
                                                </form>
                                            </div>
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
    </div>
    <div class="d-flex justify-content-center">
        {{ $veterinarias->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection