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
    <h2>  |   Mensajes </h2>


    <table class="table table-striped table-bordered" style="margin: 15px;  ">
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
                <td>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$mensaje->id}}">
                        <i class="fas fa-trash"></i>
                    </button>


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


@endsection
