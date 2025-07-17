@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ isset($user) ? route('users.update', ['id' => $user->id]) : route('users.store') }}">
        @csrf
        @isset($user)
            @method('PUT')
        @endisset

        <div class="card-body">
            @if(isset($user))
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Editar información de usuario</strong></h4>
            @else
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Crear un nuevo usuario</strong></h4>
            @endif
            <hr>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de usuario" value="{{ isset($user) ? $user->name : old('name') }}">
                <label for="name">Nombre de usuario</label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="{{ isset($user) ? $user->email : old('email') }}">
                <label for="email">Correo electrónico</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                <label for="password">Contraseña</label>
            </div>
            @if (isset($user))
                <input type="hidden" name="current_password_hashed" value="{{ $user->password }}">
            @endif
            <div class="form-floating mb-3">
                <select class="form-select" name="usertype" id="usertype" aria-label="Tipo de usuario">
                    <option disabled {{ !isset($user) ? 'selected' : '' }}>Selecciona el tipo de usuario</option>
                    <option value="admin" {{ (isset($user) && $user->usertype == 'admin') ? 'selected' : '' }}>Administrador</option>
                    <option value="user" {{ (isset($user) && $user->usertype == 'user') ? 'selected' : '' }}>Usuario</option>
                </select>
                <label for="usertype">Tipo de usuario</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="{{ isset($user) ? $user->telefono : old('telefono') }}">
                <label for="telefono">Teléfono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="{{ isset($user) ? $user->direccion : old('direccion') }}">
                <label for="direccion">Dirección</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="descripcion" name="descripcion"
                placeholder="Descripción" value="{{ isset($user) ? $user->descripcion : old ('descripcion') }}">
                <label for="descripcion">Descripción</label>
            </div>
            <br>
            <button type="submit" class="btn">Guardar</button>
            <button type="reset" class="btn">Cancelar</button>
        </div>
    </form>

@endsection
