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

    <div class="d-flex align-items-center mb-3">
        <h3 class="mb-0">| Adopciones</h3>
        <a href="{{ route('adopciones.panelcreate') }}" class="btn btn-primary ms-auto" role="button">
            Crear adopción <i class="fas fa-plus"></i>
        </a>
    </div>

    <hr>

    <form action="{{ route('adopciones.search') }}" role="search" class="mb-3">
        <div class="row">
            <div class="col">
                <input class="form-control me-2" maxlength="50" type="search" placeholder="Buscar" aria-label="Search" id="nombre" name="nombre">
            </div>
            <div class="col">
                <button class="btn btn-outline-light" type="submit"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>

    <hr>

    <div style="overflow-x: visible !important;">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Nombre</th>
                <th scope="col">Tipo</th>
                <th scope="col">Nacimiento</th>
                <th scope="col" style="width: 52%;">Mensaje</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($adopciones as $adopcion)
                <tr>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            @php
                                $fotoUsuario = $adopcion->usuario && $adopcion->usuario->fotoperfil
                                    ? asset('storage/' . $adopcion->usuario->fotoperfil)
                                    : asset('images/fotodeperfil.webp');
                            @endphp
                            <img src="{{ $fotoUsuario }}" alt="Foto perfil" style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%; flex-shrink: 0;">
                            <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                            {{ $adopcion->usuario->name ?? 'Sin usuario' }}
                        </span>
                        </div>
                    </td>
                    <td>{{ $adopcion->nombre_mascota }}</td>
                    <td>{{ $adopcion->tipo_mascota }}</td>
                    <td>{{ \Carbon\Carbon::parse($adopcion->fecha_nacimiento)->format('d/m/Y') }}</td>

                    <td style="max-width: 300px;">
                        <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $adopcion->contenido }}
                        </div>
                    </td>

                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-display="dynamic" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('adopciones.panelshow', ['id' => $adopcion->id]) }}">Detalles</a></li>
                                <li><a class="dropdown-item" href="{{ route('adopciones.paneledit', ['id' => $adopcion->id]) }}">Editar</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $adopcion->id }}">Eliminar</a></li>
                            </ul>
                        </div>

                        <div class="modal fade" id="modalEliminar{{ $adopcion->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $adopcion->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{ $adopcion->id }}">Eliminar adopción</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar la adopción?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form method="post" action="{{ route('adopciones.paneldestroy', ['id' => $adopcion->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
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
