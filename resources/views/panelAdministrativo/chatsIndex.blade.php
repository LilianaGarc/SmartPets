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
    <h2>  |   Chats </h2>
    <hr>
    <form action="#"  class="" role="search" style="width: 160%; align-content: flex-end;">
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

    <div style="overflow-x: auto; margin-left: 1rem; margin-right: 1rem;">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">Usuario 1</th>
                <th scope="col">Usuario 2</th>
            </tr>
            </thead>
            <tbody>
            @foreach($chats as $chat)
                <tr>
                    <td>
                        {{ $chat->id_usuario_1 }}
                        @php
                            $user1 = \App\Models\User::find($chat->id_usuario_1);
                        @endphp
                        @if($user1 && $user1->en_linea)
                            <span class="badge bg-success ms-1">En línea</span>
                        @else
                            <span class="badge bg-secondary ms-1">Desconectado</span>
                        @endif
                    </td>
                    <td>
                        {{ $chat->id_usuario_2 }}
                        @php
                            $user2 = \App\Models\User::find($chat->id_usuario_2);
                        @endphp
                        @if($user2 && $user2->en_linea)
                            <span class="badge bg-success ms-1">En línea</span>
                        @else
                            <span class="badge bg-secondary ms-1">Desconectado</span>
                        @endif
                    </td>
                    <td>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$chat->id}}">
                            <i class="fas fa-trash"></i>
                        </button>


                        <!-- Modal -->
                        <div class="modal fade" id="modalEliminar{{$chat->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar chat</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Esta seguro de eliminar el chat?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <form method="post" action="{{ route('chats.paneldestroy' , ['id'=>$chat->id]) }}">
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
