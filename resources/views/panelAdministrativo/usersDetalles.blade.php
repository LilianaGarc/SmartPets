@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    <form method="post"
          @if (isset($user))
              action="{{ route('users.update', ['id'=>$user->id]) }}"
          @else
              action="{{ route('users.store') }}"
        @endif>
        @isset($user)
            @method('put')
        @endisset
        @csrf
        <div class="card-body">
            <h4><a href="{{ route('users.panel') }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Detalles del usuario</strong></h4>
            <hr>

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{ isset($user) ? $user->name : old('name') }}" disabled>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ isset($user) ? $user->email : old('email') }}" disabled>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" value="{{ isset($user) ? $user->password : old('password') }}" disabled>
            </div>
            <div class="mb-3">
                <label for="usertype" class="form-label">Tipo de usuario</label>
                <select class="form-select" name="usertype" id="usertype" disabled>
                    <option disabled {{ !isset($user) ? 'selected' : '' }}>Selecciona el tipo de usuario</option>
                    <option value="admin" {{ (isset($user) && $user->usertype == 'admin') ? 'selected' : '' }}>Administrador</option>
                    <option value="user" {{ (isset($user) && $user->usertype == 'user') ? 'selected' : '' }}>Usuario</option>
                </select>
            </div>

        </div>
    </form>
    <a href="{{ route('users.paneledit', ['id'=> $user->id]) }}" class="btn" role="button" style="margin-left: 2vw;"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
    <a href="# " class="btn" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$user->id}}"><i class="fa-solid fa-trash"></i> Eliminar</a>

    <!-- Modal -->
    <div class="modal fade" id="modalEliminar{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Esta seguro de eliminar el usuario?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('users.paneldestroy' , ['id'=>$user->id]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

