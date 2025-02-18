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
    <h2>  |   Comentarios </h2>


    <table class="table table-striped table-bordered" style="margin: 15px;  ">
        <thead>
        <tr>
            <th scope="col">Usuario</th>
            <th scope="col">Publicacion</th>
            <th scope="col">Comentario</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comentarios as $comentario)
            <tr>
                <td>{{  $comentario->id_usuario}}</td>
                <td>{{  $comentario->id_publicacion}}</td>
                <td>{{  $comentario->contenido  }}</td>
                <td>

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$comentario->id}}">
                        <i class="fas fa-trash"></i>
                    </button>


                    <!-- Modal -->
                    <div class="modal fade" id="modalEliminar{{$comentario->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar comentario</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Esta seguro de eliminar el comentario?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <form method="post" action="{{ route('comentarios.destroy' , ['id'=>$comentario->id]) }}">
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
