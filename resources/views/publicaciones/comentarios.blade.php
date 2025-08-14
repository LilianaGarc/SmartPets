@include('MenuPrincipal.Navbar')
@extends('layout.plantilla')
@section('titulo','Comentarios')
@section('contenido')

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('exito'))
        <div class="alert alert-success" role="alert">
            {{ session('exito') }}
        </div>
    @endif
    @if(session('fracaso'))
        <div class="alert alert-danger" role="alert" style="z-index: 15;">
            {{ session('fracaso') }}
        </div>
    @endif
    <div>

        <div class="row">
            <div class="container">
                <div class="breadcrumb-container">
                    <ul class="breadcrumb">
                        <li class="breadcrumb__item">
                            <a href="{{ route('index') }}" class="breadcrumb__inner">
                                <span class="breadcrumb__title">Inicio</span>
                            </a>
                        </li>
                        <li class="breadcrumb__item ">
                            <a href="{{ route('publicaciones.index') }}" class="breadcrumb__inner">
                                <span class="breadcrumb__title">Publicaciones</span>
                            </a>
                        </li>
                        <li class="breadcrumb__item breadcrumb__item-active">
                            <a href="{{ route('publicaciones.show', ['id'=> $publicacion->id]) }}" class="breadcrumb__inner">
                                <span class="breadcrumb__title">Comentarios</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <hr>

            <form method="POST"action="{{ route('comentarios.store', ['id_publicacion' => $publicacion->id]) }}" id="form-comentario" class="fixed-bottom bg-white border-top p-3 shadow-sm">
                @csrf
                <input type="hidden" name="comentario_id" id="comentario_id" value="">

                <div class="container d-flex align-items-center gap-2">
        <textarea
            class="form-control rounded-pill flex-grow-1"
            placeholder="Escribe un comentario..."
            name="comentario"
            id="comentario"
            rows="1"
            maxlength="100"
            style="resize: none; max-height: 100px; overflow-y: auto;"></textarea>

                    <button type="submit" class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center" title="Enviar" style="width: 42px; height: 42px;" id="btn-submit">
                        <i class="fas fa-paper-plane"></i>
                    </button>

                    <button type="reset" class="btn btn-secondary rounded-circle p-2 d-flex align-items-center justify-content-center" title="Cancelar" style="width: 42px; height: 42px;" id="btn-cancelar">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
            </form>

        </div>
        <div class="row row-container">
            <div class="card-publicacion mb-3">
                <div class="card-body">
                    <h3 class="card-title">
                        @php
                            $foto = $publicacion->user && $publicacion->user->fotoperfil
                                ? asset('storage/' . $publicacion->user->fotoperfil)
                                : asset('images/fotodeperfil.webp');
                        @endphp
                        <div class="row">
                            <div class="d-flex align-items-center mb-2">
                                <div class="foto-perfil" style="width: 50px; height: 50px; border-radius: 50%; background-size: cover; background-position: center; background-image: url('{{ $foto }}'); margin-right: 10px;"></div>

                                <h5 class="mb-0">
                                    <strong>{{ $publicacion->user ? $publicacion->user->name : 'Usuario no disponible' }}</strong>
                                </h5>

                                @if (auth()->check() && auth()->id() === $publicacion->id_user)
                                    <div class="dropdown ms-auto">
                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown">
                                            <i class="fa-solid fa-list"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item small" href="{{ route('publicaciones.edit' , ['id'=>$publicacion->id]) }}">Editar</a></li>
                                            <li><a class="dropdown-item small" href="# " data-bs-toggle="modal" data-bs-target="#modalEliminar{{$publicacion->id}}">Eliminar</a></li>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </h3>
                    <p class="card-text"><small class="text-body-secondary">{{$publicacion->updated_at->diffForHumans()}}</small></p>

                </div>
                @if ($publicacion->publicacionOriginal)
                    <h6><p class="card-text" style="margin-top: 1.5vh;">{{ $publicacion->contenido }}</p></h6>
                    <div class="shared-original-card" style="margin-top: 1rem; padding: 1rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; background-color: #f9fafb;">
                        <p style="font-weight: bold;">Original de: {{ $publicacion->publicacionOriginal->user->name }}</p>
                        <p>{{ $publicacion->publicacionOriginal->contenido }}</p>
                        @if($publicacion->publicacionOriginal->imagen)
                            <img src="{{ asset('storage/' . $publicacion->publicacionOriginal->imagen) }}" class="img-fluid mt-2" alt="Imagen de la publicación original">
                        @endif
                    </div>
                @else
                    <h6><p class="card-text" style="margin-top: 1.5vh;">{{ $publicacion->contenido }}</p></h6>
                    <div class="card-footer text-body-secondary">
                        @if($publicacion->imagen)
                            <img src="{{ asset('storage/' . $publicacion->imagen) }}" class="card-img-top footer-img" alt="Img publicacion">
                        @endif
                    </div>
                @endif
                <div class="col align-items-center">
                    <h6 style="margin-top: 8px;">
                        <i class="fa-solid fa-heart" style="color: darkred;"></i>
                        <span class="likes-count">{{ $publicacion->likes_count }}</span>
                    </h6>
                </div>

                <div class="interacciones" style="margin-top: 1vh;">
                    <div class="reactions" id="reactions-{{ $publicacion->id }}">
                    </div>
                </div>
                <hr>
                <div>
                    <div class="col">
                        @foreach($comentarios as $comentario)
                            @php
                                $fotoComentario = $comentario->user && $comentario->user->fotoperfil
                                    ? asset('storage/' . $comentario->user->fotoperfil)
                                    : asset('images/fotodeperfil.webp');
                            @endphp

                            <div class="row mb-3">
                                <div class="d-flex align-items-start gap-3">
                                    <img src="{{ $fotoComentario }}" alt="Foto de perfil"
                                         class="rounded-circle"
                                         style="width: 45px; height: 45px; object-fit: cover;">

                                    <div class="card flex-grow-1 px-3 py-2"
                                         style="background-color: rgba(3, 45, 129, 0.08); border: none; position: relative;">
                                        <h6 class="card-title mb-0 d-flex align-items-center">
                                            {{ $comentario->user ? $comentario->user->name : 'Usuario no disponible' }}

                                            @if (auth()->check() && auth()->id() === $comentario->id_user)
                                                <div class="dropdown ms-auto">
                                                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-bs-toggle="dropdown">
                                                        <i class="fa-solid fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <a href="#" class="dropdown-item small btn-editar-comentario"
                                                               data-id="{{ $comentario->id }}"
                                                               data-contenido="{{ e($comentario->contenido) }}">Editar</a>
                                                        </li>
                                                        <li>
                                                            <a href="#" class="dropdown-item small" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $comentario->id }}">
                                                                Eliminar
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endif
                                        </h6>

                                        <p class="card-text mb-1">
                                            <small class="text-muted">{{ $comentario->updated_at->diffForHumans() }}</small>
                                        </p>
                                        <p class="card-text mb-0 comentario-contenido" data-id="{{ $comentario->id }}">{{ $comentario->contenido }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                </div>

            </div>
            <div class="col-11">
                @section('footer')
                @endsection
            </div>
        </div>
        <p style="height: 2%;"></p>
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
        {{-- MODALES DE ELIMINACIÓN DE COMENTARIOS --}}
        @foreach($comentarios as $comentario)
            @if (auth()->check() && auth()->id() === $comentario->id_user)
                <div class="modal fade" id="modalEliminar{{ $comentario->id }}" tabindex="-1" aria-labelledby="modalEliminarLabel{{ $comentario->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEliminarLabel{{ $comentario->id }}">Eliminar comentario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro de eliminar este comentario?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form method="POST" action="{{ route('comentarios.destroy', ['id' => $comentario->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="publicacion_id" value="{{ $publicacion->id }}">
                                    <input type="submit" class="btn btn-danger" value="Eliminar">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach



    @push('scripts')
            <script>
                const COMENTARIO_STORE_URL = "{{ route('comentarios.store', ['id_publicacion' => $publicacion->id]) }}";

                const urlUpdateTemplate = "{{ url('comentarios') }}/";

                window.onload = function() {
                    var alert = document.querySelector('.alert');
                    if (alert) {
                        setTimeout(function() {
                            alert.style.display = 'none';
                        }, 2000);
                    }
                };

                document.addEventListener('DOMContentLoaded', function () {
                    const form = document.getElementById('form-comentario');
                    const textarea = document.getElementById('comentario');
                    const hiddenId = document.getElementById('comentario_id');
                    const submitBtn = document.getElementById('btn-submit');
                    const cancelarBtn = document.getElementById('btn-cancelar');
                    const PUBLICACION_ID = {{ $publicacion->id }};

                    form.addEventListener('submit', function (e) {
                        const comentario = textarea.value.trim();
                        if (comentario.length > 2800) {
                            e.preventDefault();
                            alert("El comentario no puede exceder los 280 caracteres.");
                        }
                    });

                    document.querySelectorAll('.btn-editar-comentario').forEach(btn => {
                        btn.addEventListener('click', (e) => {
                            e.preventDefault();

                            const id = btn.getAttribute('data-id');
                            const contenido = btn.getAttribute('data-contenido');

                            hiddenId.value = id;
                            textarea.value = contenido;
                            textarea.focus();

                            submitBtn.innerHTML = '<i class="fas fa-save"></i>';
                            submitBtn.title = 'Actualizar';

                            form.action = urlUpdateTemplate + id;

                            let methodInput = form.querySelector('input[name="_method"]');
                            if (!methodInput) {
                                methodInput = document.createElement('input');
                                methodInput.type = 'hidden';
                                methodInput.name = '_method';
                                form.appendChild(methodInput);
                            }
                            methodInput.value = 'PUT';
                        });
                    });

                    cancelarBtn.addEventListener('click', () => {
                        hiddenId.value = '';
                        textarea.value = '';
                        submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i>';
                        submitBtn.title = 'Enviar';

                        form.action = `/comentarios/${PUBLICACION_ID}`;
                        const methodInput = form.querySelector('input[name="_method"]');
                        if (methodInput) methodInput.remove();
                    });
                });
            </script>
    @endpush




@endsection
