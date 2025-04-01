@extends('panelAdministrativo.administrativePanel')
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
            @if(isset($user))
                <h5>Editar informacion de usuario</h5>
            @else
                <h5>Crear usuario</h5>
            @endif
            <hr>

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre de usuario</label>
                    <input type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{ isset($user) ? $user->name : old('name') }}">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electronico</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ isset($user) ? $user->email : old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ isset($user) ? $user->password : old('password') }}">
                </div>

                <select class="form-select form-select-sm" aria-label="Small select example" name="usertype" id="usetype">
                    <option selected>Selecciona el tipo de usuario</option>
                    <option value="1">Administrador</option>
                    <option value="2">Usuario</option>
                    @if(isset($user))
                        <option selected>{{ $user->usertype }}</option>
                    @endif
                </select>

            <br>
            <button type="submit" class="btn">Guardar</button>
            <button type="reset" class="btn">Cancelar</button>
        </div>
    </form>

@endsection
