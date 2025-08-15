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
                    @auth
                        <li class="breadcrumb__item">
                            <a href="{{ route('publicaciones.create') }}" class="breadcrumb__inner">
                                <span class="breadcrumb__title">Crear publicación</span>
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>

            <div class="col">
                <hr>
                <div class="row row-container">
                    @if($publicaciones->isEmpty())
                        <div class="card-publicacion mb-3" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                            <p class="no-hay-message" style="font-size: 18px;">¡No hay publicaciones aún! 😿</p>
                            <img src="{{ asset('images/vacio.svg') }}" alt="No hay publicaciones" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                        </div>
                    @else
                    @foreach($publicaciones as $publicacion)
                        <div class="card-publicacion mb-3" style="height: auto;">
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
                                        @auth
                                            @if (auth()->id() === $publicacion->id_user)
                                                <div class="dropdown ms-auto">
                                                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa-solid fa-angle-down"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="{{ route('publicaciones.edit' , ['id'=>$publicacion->id]) }}"><i class="fa-solid fa-pen-to-square"></i> Editar publicación</a></li>
                                                        <li><a class="dropdown-item" href="# " data-bs-toggle="modal" data-bs-target="#modalEliminar{{$publicacion->id}}"><i class="fa-solid fa-trash"></i> Eliminar publicación</a></li>
                                                    </ul>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                </h3>
                                <p class="card-text"><small class="text-body-secondary">{{$publicacion->updated_at->diffForHumans()}}</small></p>
                            </div>

                            @if ($publicacion->publicacionOriginal)
                                <h6>
                                    <p class="card-text" style="margin-top: 1.5vh; word-wrap: break-word; white-space: normal;">
                                        {{ $publicacion->contenido }}
                                    </p>
                                </h6>
                                <div class="shared-original-card" style="margin-top: 1rem; padding: 1rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; background-color: #f9fafb;">
                                    <p style="font-weight: bold; word-wrap: break-word; white-space: normal;">
                                        Original de: {{ $publicacion->publicacionOriginal->user->name }}
                                    </p>
                                    <p style="word-wrap: break-word; white-space: normal;">
                                        {{ $publicacion->publicacionOriginal->contenido }}
                                    </p>
                                    @if($publicacion->publicacionOriginal->imagen)
                                        <img src="{{ asset('storage/' . $publicacion->publicacionOriginal->imagen) }}" class="img-fluid mt-2" alt="Imagen de la publicación original" style="max-width: 100%; height: auto;">
                                    @endif
                                </div>
                            @else
                                <h6>
                                    <p class="card-text" style="margin-top: 1.5vh; word-wrap: break-word; white-space: normal;">
                                        {{ $publicacion->contenido }}
                                    </p>
                                </h6>
                                <div class="card-footer text-body-secondary">
                                    @if($publicacion->imagen)
                                        <img src="{{ asset('storage/' . $publicacion->imagen) }}" class="card-img-top footer-img" alt="Img publicacion" style="max-width: 100%; height: auto;">
                                    @endif
                                </div>
                            @endif



                            <div class="col align-items-center">
                                <h6 style="margin-top: 8px;">
                                    <i class="fa-solid fa-heart" style="color: darkred;"></i>
                                    <span class="likes-count">{{ $publicacion->likes_count }}</span>
                                </h6>
                            </div>

                            <hr>
                            <div class="interacciones" style="margin-top: 1vh;">
                                <div class="reactions" id="reactions-{{ $publicacion->id }}">
                                    <div class="col align-items-center">
                                        @auth
                                            <button
                                                class="btn like-button"
                                                role="button"
                                                style="margin: 1px;"
                                                data-publicacion-id="{{ $publicacion->id }}"
                                                data-is-liked="{{ $publicacion->user_has_liked ? 'true' : 'false' }}"
                                            >
                                                <i class="{{ $publicacion->user_has_liked ? 'fa-solid' : 'fa-regular' }} fa-heart {{ $publicacion->user_has_liked ? 'text-red-500' : 'text-gray-400' }}"></i>
                                                <span class="like-text">Me gusta</span>
                                            </button>


                                            <a href="{{ route('publicaciones.show', ['id'=> $publicacion->id]) }}" class="btn" role="button" style="margin: 1px;">
                                                <i class="fa-regular fa-comment"></i> <span class="btn-text">Comentar</span>
                                            </a>

                                            @if(!$publicacion->publicacionOriginal)
                                                <a href="{{ route('publicaciones.compartir', $publicacion->id) }}" class="btn" role="button" style="margin: 1px;">
                                                    <i class="fa-regular fa-share-from-square"></i> <span class="btn-text">Compartir</span>
                                                </a>
                                            @endif


                                        @else
                                            <a href="{{ route('login') }}" class="btn" role="button" style="margin: 1px;">
                                                <i class="fa-regular fa-heart text-gray-400"></i> Me gusta
                                            </a>

                                            <a href="{{ route('login') }}" class="btn" role="button" style="margin: 1px;">
                                                <i class="fa-regular fa-comment"></i> Comentar
                                            </a>
                                            <a href="{{ route('login') }}" class="btn" role="button" style="margin: 1px;">
                                                <i class="fa-regular fa-share-from-square"></i> Compartir
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>

                        @auth
                            @if (auth()->id() === $publicacion->id_user)
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
                        @endauth
                    @endforeach
                    @endif
                </div>
            </div>
    </div>


    @push('scripts')
        <script>
            document.querySelectorAll('.like-button').forEach(button => {
                if (button.dataset.isLiked === 'true') {
                    button.classList.add('liked');
                }

                button.addEventListener('click', async function(event) {
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
                    this.dataset.isLiked = (!isLiked).toString();

                    try {
                        const response = await fetch(url, {
                            method: method,
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                        });

                        if (!response.ok) {
                            throw new Error('Respuesta no OK');
                        }

                        const responseData = await response.json();
                        if (responseData.likes_count !== undefined) {
                            likesCountElement.textContent = responseData.likes_count;
                        }

                    } catch (error) {
                        alert('Ocurrió un error al procesar tu acción.');

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
                        this.dataset.isLiked = isLiked.toString();
                    }
                });
            });
        </script>
    @endpush
@endsection
