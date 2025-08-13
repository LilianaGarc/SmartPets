@include('MenuPrincipal.Navbar')
@extends('layout.plantilla')
@section('titulo','Comentarios')
@section('contenido')
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

            <form method="POST" action="{{ route('comentarios.store', ['id' => $publicacion->id]) }}" class="fixed-bottom bg-white border-top p-3 shadow-sm">
                @csrf
                <div class="container d-flex align-items-center gap-2">
        <textarea
            class="form-control rounded-pill flex-grow-1"
            placeholder="Escribe un comentario..."
            name="comentario"
            id="comentario"
            rows="1"
            style="resize: none; max-height: 100px; overflow-y: auto;"></textarea>

                    <button type="submit" class="btn btn-primary rounded-circle p-2 d-flex align-items-center justify-content-center" title="Enviar" style="width: 42px; height: 42px;">
                        <i class="fas fa-paper-plane"></i>
                    </button>

                    <button type="reset" class="btn btn-secondary rounded-circle p-2 d-flex align-items-center justify-content-center" title="Cancelar" style="width: 42px; height: 42px;">
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

                        <div class="d-flex align-items-center mb-2">
                            <div class="foto-perfil" style="width: 50px; height: 50px; border-radius: 50%; background-size: cover; background-position: center; background-image: url('{{ $foto }}'); margin-right: 10px;"></div>
                            <h5 class="mb-0">
                                <strong>{{ $publicacion->user ? $publicacion->user->name : 'Usuario no disponible' }}</strong>
                            </h5>
                        </div>
                    </h3>

                    <p class="card-text">{{ $publicacion->contenido }}</p>
                    <p class="card-text"><small class="text-body-secondary">{{$publicacion->updated_at->diffForHumans()}}</small></p>

                </div>
                <div class="card-footer text-body-secondary">
                    @if($publicacion->imagen)
                        <img src="{{ asset('storage/' . $publicacion->imagen) }}" class="card-img-top" alt="Img publicacion">
                    @endif
                </div>
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
                                         style="background-color: rgba(3, 45, 129, 0.08); border: none;">
                                        <h6 class="card-title mb-0">
                                            {{ $comentario->user ? $comentario->user->name : 'Usuario no disponible' }}
                                        </h6>
                                        <p class="card-text mb-1">
                                            <small class="text-muted">{{ $comentario->updated_at->diffForHumans() }}</small>
                                        </p>
                                        <p class="card-text mb-0">{{ $comentario->contenido }}</p>
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
                <script>
                    window.onload = function() {
                        var alert = document.querySelector('.alert');

                        if (alert) {
                            setTimeout(function() {
                                alert.style.display = 'none';
                            }, 2000);
                        }
                    };
                </script>
                @if(Auth::check())
                    @push('scripts')
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                document.querySelectorAll('.like-button').forEach(button => {
                                    if (button.dataset.isLiked === 'true') {
                                        button.classList.add('liked');
                                    }

                                    button.addEventListener('click', async function (event) {
                                        event.preventDefault();

                                        const publicacionId = this.dataset.publicacionId;
                                        let isLiked = this.dataset.isLiked === 'true';

                                        const likeIcon = this.querySelector('i');
                                        const likesCountElement = this.closest('.card-publicacion').querySelector('.likes-count');
                                        let currentLikes = parseInt(likesCountElement.textContent);

                                        const method = isLiked ? 'DELETE' : 'POST';
                                        const url = `/publicaciones/${publicacionId}/${isLiked ? 'unlike' : 'like'}`;

                                        if (isLiked) {
                                            likeIcon.classList.remove('fa-solid', 'text-red-500');
                                            likeIcon.classList.add('fa-regular', 'text-gray-400');
                                            button.classList.remove('liked');
                                            currentLikes--;
                                        } else {
                                            likeIcon.classList.remove('fa-regular', 'text-gray-400');
                                            likeIcon.classList.add('fa-solid', 'text-red-500');
                                            button.classList.add('liked');
                                            currentLikes++;
                                        }
                                        likesCountElement.textContent = currentLikes;
                                        this.dataset.isLiked = !isLiked;

                                        try {
                                            const response = await fetch(url, {
                                                method: method,
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                },
                                            });

                                            if (!response.ok) {
                                                const errorData = await response.json();
                                                alert(`Error: ${errorData.message || 'No se pudo realizar la acción.'}`);

                                                if (isLiked) {
                                                    likeIcon.classList.remove('fa-regular', 'text-gray-400');
                                                    likeIcon.classList.add('fa-solid', 'text-red-500');
                                                    button.classList.add('liked');
                                                    currentLikes++;
                                                } else {
                                                    likeIcon.classList.remove('fa-solid', 'text-red-500');
                                                    likeIcon.classList.add('fa-regular', 'text-gray-400');
                                                    button.classList.remove('liked');
                                                    currentLikes--;
                                                }
                                                likesCountElement.textContent = currentLikes;
                                                this.dataset.isLiked = isLiked;
                                            } else {
                                                const responseData = await response.json();
                                                if (responseData.likes_count !== undefined) {
                                                    likesCountElement.textContent = responseData.likes_count;
                                                }
                                            }

                                        } catch (error) {
                                            console.error('Error al comunicarse con la API:', error);
                                            alert('Hubo un problema de conexión. Inténtalo de nuevo.');

                                            if (isLiked) {
                                                likeIcon.classList.remove('fa-regular', 'text-gray-400');
                                                likeIcon.classList.add('fa-solid', 'text-red-500');
                                                button.classList.add('liked');
                                                currentLikes++;
                                            } else {
                                                likeIcon.classList.remove('fa-solid', 'text-red-500');
                                                likeIcon.classList.add('fa-regular', 'text-gray-400');
                                                button.classList.remove('liked');
                                                currentLikes--;
                                            }
                                            likesCountElement.textContent = currentLikes;
                                            this.dataset.isLiked = isLiked;
                                        }
                                    });
                                });
                            });
                        </script>
                    @endpush
                @endif


            </div>
        </div>
        <p style="height: 2%;"></p>


@endsection
