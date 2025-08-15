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
        <h3 class="mb-0">| Publicaciones</h3>
        <a href="{{ route('publicaciones.panelcreate') }}" class="btn btn-primary ms-auto" role="button">
            Nueva publicación <i class="fas fa-plus"></i>
        </a>
    </div>
    <hr>

    <form action="{{ route('publicaciones.search') }}" role="search" class="mb-3">
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
        <table class="table table-striped table-bordered">
            <thead class="table-light">
            <tr>
                <th scope="col">Usuario</th>
                <th scope="col">Contenido</th>
                <th scope="col">Likes</th>
                <th scope="col">Compartida</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($publicaciones as $publicacion)
                <tr>
                    <td style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <div style="display: flex; align-items: center; gap: 8px;">
                            @php
                                $foto = $publicacion->user && $publicacion->user->fotoperfil
                                    ? asset('storage/' . $publicacion->user->fotoperfil)
                                    : asset('images/fotodeperfil.webp');
                            @endphp
                            <img src="{{ $foto }}" alt="Foto perfil" style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%; flex-shrink: 0;">
                            <span style="overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $publicacion->user->name ?? 'Usuario no disponible' }}</span>
                        </div>
                    </td>

                    <td style="max-width: 300px;">
                        <div style="
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        padding: 0.5rem;
    ">
                            {{ $publicacion->contenido }}
                        </div>
                    </td>

                    <td>{{ $publicacion->likes->count() }}</td>
                    <td>
                        @if ($publicacion->publicacion_original_id)
                            <span class="badge bg-success">Compartida</span>
                        @else
                            <span class="badge bg-secondary">Original</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" data-bs-display="dynamic" aria-expanded="false">
                                Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('publicaciones.detalles', ['id'=> $publicacion->id]) }}">Detalles</a></li>
                                <li><a class="dropdown-item" href="{{ route('publicaciones.paneledit', ['id'=> $publicacion->id]) }}">Editar</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$publicacion->id}}">Eliminar</a></li>
                            </ul>
                        </div>

                        <div class="modal fade" id="modalEliminar{{$publicacion->id}}" tabindex="-1" aria-labelledby="modalLabel{{$publicacion->id}}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel{{$publicacion->id}}">Eliminar publicación</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Estás seguro de que deseas eliminar esta publicación?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <form method="POST" action="{{ route('publicaciones.paneldestroy', ['id' => $publicacion->id]) }}">
                                            @csrf
                                            @method('DELETE')
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
