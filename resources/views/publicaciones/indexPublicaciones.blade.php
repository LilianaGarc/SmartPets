@include('MenuPrincipal.Navbar')
@extends('layout.plantilla')
@section('titulo','Publicaciones')
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

    <div class="row">
        <div class="container">
            <div class="breadcrumb-container">
                <ul class="breadcrumb">
                    <li class="breadcrumb__item">
                        <a href="{{ route('index') }}" class="breadcrumb__inner">
                            <span class="breadcrumb__title">Inicio</span>
                        </a>
                    </li>
                    <li class="breadcrumb__item breadcrumb__item-active">
                        <a href="{{ route('publicaciones.index') }}" class="breadcrumb__inner">
                            <span class="breadcrumb__title">Publicaciones</span>
                        </a>
                    </li>
                    <li class="breadcrumb__item">
                        <a href="{{ route('publicaciones.create') }}" class="breadcrumb__inner">
                            <span class="breadcrumb__title">Crear publicación</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col">
            <hr>
            <div class="row row-container">
                @foreach($publicaciones as $publicacion)
                    <div class="card-publicacion mb-3">
                        <div class="card-body">
                            <h3 class="card-title">
                                @php
                                    $foto = $publicacion->user && $publicacion->user->fotoperfil
                                        ? asset('storage/' . $publicacion->user->fotoperfil)
                                        : asset('images/fotodeperfil.webp');
                                @endphp

                                <div class="d-flex align-items-center">
                                    <div class="foto-perfil" style="width: 50px; height: 50px; border-radius: 50%; background-size: cover; background-position: center; background-image: url('{{ $foto }}'); margin-right: 10px;"></div>
                                    <h4 class="mb-0">
                                        <strong>{{ $publicacion->user ? $publicacion->user->name : 'Usuario no disponible' }}</strong>
                                    </h4>
                                </div>
                            </h3>
                            <h6><p class="card-text" style="margin-top: 1.5vh;">{{ $publicacion->contenido }}</p></h6>
                            <p class="card-text"><small class="text-body-secondary">{{$publicacion->updated_at->diffForHumans()}}</small></p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            @if($publicacion->imagen)
                                <img src="{{ asset('storage/' . $publicacion->imagen) }}" class="card-img-top footer-img" alt="Img publicacion">
                            @endif
                        </div>
                        <div class="interacciones" style="margin-top: 1vh;">
                            <div class="reactions" id="reactions-{{ $publicacion->id }}">
                                <p class="card-text"><small class="text-body-secondary">Cantidad de Reacciones: {{$publicacion->reacciones_count}}</small></p>

                                <div class="row align-items-center">
                                    <div class="col">
                                        @php
                                            $reaccionUsuario = $publicacion->reaccionesUsuarioActual;
                                        @endphp

                                        @foreach(['amor', 'risa', 'triste', 'enojado'] as $tipo)
                                            @php
                                                $src = asset("images/{$tipo}perrito.webp");
                                                $hover = asset("images/perrito{$tipo}2.webp");
                                                $active = $reaccionUsuario && $reaccionUsuario->tipo === $tipo;
                                            @endphp
                                            <img src="{{ $src }}"
                                                 data-hover="{{ $hover }}"
                                                 data-tipo="{{ $tipo }}"
                                                 data-publicacion="{{ $publicacion->id }}"
                                                 class="imagen-publicacion-reaccion {{ $active ? 'reaccion-activa' : '' }}">
                                        @endforeach
                                    </div>
                                    <div class="col text-end">
                                        <a href="{{ route('publicaciones.show', ['id'=> $publicacion->id]) }}" class="btn" role="button" style="margin: 1px;">
                                            <i class="fas fa-comment"></i> Comentar
                                        </a>

                                        @if (auth()->check() && auth()->id() === $publicacion->id_user)
                                            <a href="{{ route('publicaciones.edit', ['id'=> $publicacion->id]) }}" class="btn" role="button" style="margin: 1px;">
                                                <i class="fa-solid fa-pen-to-square"></i> Editar
                                            </a>
                                            <a href="#" class="btn" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$publicacion->id}}" style="margin: 1px;">
                                                <i class="fa-solid fa-trash"></i> Eliminar
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal fuera de la card, se colocó fuera del ciclo foreach -->
                    @if (auth()->check() && auth()->id() === $publicacion->id_user)
                        <div class="modal fade" id="modalEliminar{{$publicacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar publicación</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar esta publicación?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <form method="post" action="{{ route('publicaciones.destroy', ['id'=> $publicacion->id]) }}">
                                            @csrf
                                            @method('delete')
                                            <input type="submit" value="Eliminar" class="btn btn-danger">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.imagen-publicacion-reaccion').forEach(img => {
            const originalSrc = img.src;

            img.addEventListener('mouseover', () => {
                img.src = img.dataset.hover;
            });

            img.addEventListener('mouseout', () => {
                if (!img.classList.contains('reaccion-activa')) {
                    img.src = originalSrc;
                }
            });

            img.addEventListener('click', () => {
                const tipo = img.dataset.tipo;
                const publicacionId = img.dataset.publicacion;
                const isActive = img.classList.contains('reaccion-activa');

                if (isActive) {
                    fetch(`/reacciones/${publicacionId}`, {
                        method: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    }).then(res => res.json())
                        .then(data => {
                            if (data.status === 'deleted') {
                                document.querySelectorAll(`[data-publicacion="${publicacionId}"]`).forEach(el => {
                                    el.classList.remove('reaccion-activa');
                                    el.src = el.src.replace("2.webp", ".webp");
                                });
                            }
                        });
                } else {
                    fetch("/reacciones", {
                        method: "POST",
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            tipo,
                            publicacion_id: publicacionId
                        })
                    }).then(res => res.json())
                        .then(data => {
                            document.querySelectorAll(`[data-publicacion="${publicacionId}"]`).forEach(el => {
                                el.classList.remove('reaccion-activa');
                                el.src = el.src.replace("2.webp", ".webp");
                            });

                            img.classList.add('reaccion-activa');
                            img.src = img.dataset.hover;
                        });
                }
            });
        });
    </script>

@endsection
