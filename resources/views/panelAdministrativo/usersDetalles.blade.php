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
            <h4>
                <a href="{{ route('users.panel') }}" class="btn" role="button" >
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <strong>Detalles del usuario</strong>
            </h4>
            <hr>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" value="{{ isset($user) ? $user->name : old('name') }}" disabled>
                <label for="name">Nombre de usuario</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}" disabled>
                <label for="email">Correo electrónico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" disabled>
                <label for="password">Contraseña</label>
            </div>
            <div class="form-floating mb-3">
                <select class="form-select" name="usertype" id="usertype" disabled>
                    <option disabled {{ !isset($user) ? 'selected' : '' }}>Selecciona el tipo de usuario</option>
                    <option value="admin" {{ (isset($user) && $user->usertype == 'admin') ? 'selected' : '' }}>Administrador</option>
                    <option value="user" {{ (isset($user) && $user->usertype == 'user') ? 'selected' : '' }}>Usuario</option>
                </select>
                <label for="usertype">Tipo de usuario</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ isset($user) ? $user->telefono : old('telefono') }}" disabled>
                <label for="telefono">Teléfono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ isset($user) ? $user->direccion : old('direccion') }}" disabled>
                <label for="direccion">Dirección</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="descripción" name="descripción" value="{{ isset($user) ? $user->descripción : old('descripción') }}" disabled>
                <label for="descripción">Descripción</label>
            </div>
        </div>
    </form>
    <a href="{{ route('users.paneledit', ['id'=> $user->id]) }}" class="btn" role="button" style="margin-left: 2vw;"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
    <a href="#" class="btn" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$user->id}}"><i class="fa-solid fa-trash"></i> Eliminar</a>

    <!-- Modal -->
    <div class="modal fade" id="modalEliminar{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar el usuario?
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

