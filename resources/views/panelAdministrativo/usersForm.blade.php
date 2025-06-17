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
        @csrf
        <div class="card-body">
            @if(isset($user))
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Editar información de usuario</strong></h4>
            @else
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Crear un nuevo usuario</strong></h4>
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
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                @if (isset($user))
                    <input type="hidden" name="current_password_hashed" value="{{ $user->password }}">
                @endif
                <div class="mb-3">
                    <label for="usertype" class="form-label">Tipo de usuario</label>
                    <select class="form-select" name="usertype" id="usertype">
                        <option disabled {{ !isset($user) ? 'selected' : '' }}>Selecciona el tipo de usuario</option>
                        <option value="admin" {{ (isset($user) && $user->usertype == 'admin') ? 'selected' : '' }}>Administrador</option>
                        <option value="user" {{ (isset($user) && $user->usertype == 'user') ? 'selected' : '' }}>Usuario</option>
                    </select>
                </div>

            <br>
            <button type="submit" class="btn">Guardar</button>
            <button type="reset" class="btn">Cancelar</button>
        </div>
    </form>

@endsection
