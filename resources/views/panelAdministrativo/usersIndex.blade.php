@extends('panelAdministrativo.plantillaPanel')
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

    <div class="d-flex align-items-center mb-2">
        <h3 class="mb-0">| Usuarios</h3>
        <a href="{{ route('users.panelcreate') }}" class="btn ms-auto" role="button">
            <h7>Nuevo usuario <i class="fas fa-plus"></i></h7>
        </a>
    </div>
    <hr>

    <form action="{{ route('users.search') }}" class="" role="search" style="align-content: flex-end;">
        <div class="row">
            <div class="col">
                <input class="form-control me-2" maxlength="50" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre">
            </div>
            <div class="col">
                <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
                <span class="glyphicon glyphicon-search"></span>
            </div>
        </div>
    </form>
    <hr>

    <div style="overflow-x: visible !important;">
        <table class="table table-striped table-bordered align-middle">
            <thead>
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">Tipo de Usuario</th>
                <th scope="col">Estado</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            @php
                                $foto = $user->fotoperfil
                                    ? asset('storage/' . $user->fotoperfil)
                                    : asset('images/fotodeperfil.webp');
                            @endphp
                            <img src="{{ $foto }}" alt="Foto perfil"
                                 style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%; flex-shrink: 0;">
                            <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
            {{ $user->name }}
        </span>
                        </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->usertype === 'admin')
                            <span class="badge" style="background-color:#1E293B; color:white;">Administrador</span>
                        @elseif($user->usertype === 'moderator')
                            <span class="badge" style="background-color:#F59E0B; color:#1E1E1E;">Moderador</span>
                        @else
                            <span class="badge" style="background-color:#0EA5E9; color:white;">Usuario</span>
                        @endif
                    </td>
                    <td>
                        @if($user->en_linea ?? false)
                            <span class="badge" style="background-color:#10B981; color:white;">En línea</span>
                        @else
                            <span class="badge" style="background-color:#94A3B8; color:white;">Desconectado</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('users.show', ['id'=>$user->id]) }}">Detalles</a></li>
                                <li><a class="dropdown-item" href="{{ route('users.paneledit', ['id'=>$user->id]) }}">Editar</a></li>
                                @if($user->email != 'smartpetsunah@gmail.com')
                                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$user->id}}">Eliminar</a></li>
                                @endif
                            </ul>
                        </div>

                        @if($user->usertype != 'admin')
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
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <form method="post" action="{{ route('users.paneldestroy', ['id'=>$user->id]) }}">
                                                @csrf
                                                @method('delete')
                                                <input type="submit" value="Eliminar" class="btn btn-danger">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


@endsection
