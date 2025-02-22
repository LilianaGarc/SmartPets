@extends('panelAdministrativo.administrativePanel')
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
    <h2>  |   Usuarios </h2>

    <table class="table table-striped table-bordered" style="margin: 15px;  ">
        <thead>
        <tr>
            <th scope="col">Nombre de la Veterinaria</th>
            <th scope="col">Nombre del Veterinario</th>
            <th scope="col">Telefono</th>
        </tr>
        </thead>
        <tbody>
        @foreach($veterinarias as $veterinaria)
            <tr>
                <td>{{  $veterinaria->nombre}}</td>
                <td>{{  $veterinaria->nombre_veterinario}}</td>
                <td>{{  $veterinaria->telefono}}</td>
                <td>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$veterinaria->id}}">
                        <i class="fas fa-trash"></i>
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="modalEliminar{{$veterinaria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar veterinaria</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Esta seguro de eliminar la veterinaria?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form method="post" action="{{ route('veterinarias.paneldestroy' , ['id'=>$veterinaria->id]) }}">
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


@endsection
