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

        <div class="stories-container">
            <h2 style="text-align: center;">Historias</h2>

            <div class="swiper-container">
                <div class="swiper-wrapper" id="stories-carousel-wrapper">
                    @auth
                        <div class="swiper-slide create-story-card" id="create-story-btn">
                            <span class="icon">+</span>
                            <span>Crear Historia</span>
                        </div>
                    @endauth
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>

        @auth
            <div id="createStoryModal" class="modal">
                <div class="modal-content">
                    <span class="close-button">&times;</span>
                    <h2>Crear Nueva Historia</h2>
                    <form id="createStoryForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="files">Seleccionar Fotos/Videos:</label>
                            <input type="file" id="files" name="files[]" multiple accept="image/*,video/*" class="form-control">
                        </div>
                        <div class="file-preview" id="file-preview-container">
                        </div>
                        <button type="submit" class="upload-button" id="upload-story-btn" disabled>
                            Subir Historia
                            <span class="loading-spinner" id="upload-loading-spinner"></span>
                        </button>
                    </form>
                </div>
            </div>
        @endauth


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
                            <h6><p class="card-text" style="margin-top: 1.5vh;">{{ $publicacion->contenido }}</p></h6>
                            <p class="card-text"><small class="text-body-secondary">{{$publicacion->updated_at->diffForHumans()}}</small></p>
                        </div>
                        <div class="card-footer text-body-secondary">
                            @if($publicacion->imagen)
                                <img src="{{ asset('storage/' . $publicacion->imagen) }}" class="card-img-top footer-img" alt="Img publicacion">
                            @endif
                        </div>

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
                                            Me gusta
                                        </button>

                                        <a href="{{ route('publicaciones.show', ['id'=> $publicacion->id]) }}" class="btn" role="button" style="margin: 1px;">
                                            <i class="fa-regular fa-comment"></i> Comentar
                                        </a>
                                        <a href="#" class="btn" role="button" style="margin: 1px;">
                                            <i class="fa-regular fa-share-from-square"></i> Compartir
                                        </a>
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
            </div>
        </div>
    </div>


    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const createStoryModal = document.getElementById('createStoryModal');
                const filesInput = document.getElementById('files');
                const filePreviewContainer = document.getElementById('file-preview-container');
                const uploadStoryForm = document.getElementById('createStoryForm');
                const uploadStoryBtn = document.getElementById('upload-story-btn');
                const uploadLoadingSpinner = document.getElementById('upload-loading-spinner');
                let selectedFiles = [];
                let storiesSwiper;
                let initialGroupedStories = @json($historiasGrouped);

                function initializeStoriesSwiper() {
                    if (storiesSwiper) {
                        storiesSwiper.destroy(true, true);
                    }
                    storiesSwiper = new Swiper('.stories-swiper-container', {
                        slidesPerView: 'auto',
                        spaceBetween: 10,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                    });
                    console.log('Swiper inicializado.');
                }

                const closeButtons = document.querySelectorAll('.close-button');
                closeButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const modalElement = button.closest('.modal.show');
                        if (modalElement) {
                            const modalInstance = bootstrap.Modal.getInstance(modalElement);
                            if (modalInstance) {
                                modalInstance.hide();
                            }
                        }
                    });
                });

                window.addEventListener('click', function(event) {
                    if (event.target.classList.contains('modal') && event.target.classList.contains('show')) {
                        const modalInstance = bootstrap.Modal.getInstance(event.target);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }
                });

                if (filesInput && uploadStoryForm) {
                    filesInput.addEventListener('change', function() {
                        selectedFiles = Array.from(filesInput.files);
                        displayFilePreviews();
                    });

                    uploadStoryForm.addEventListener('submit', async function(event) {
                        event.preventDefault();

                        if (selectedFiles.length === 0) {
                            alert('Por favor, selecciona al menos una imagen o video para tu historia.');
                            return;
                        }

                        const formData = new FormData();
                        selectedFiles.forEach(file => {
                            formData.append('files[]', file);
                        });

                        uploadStoryBtn.disabled = true;
                        uploadLoadingSpinner.classList.remove('hidden');

                        try {
                            const response = await fetch('/historias', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                },
                                body: formData
                            });

                            uploadStoryBtn.disabled = false;
                            uploadLoadingSpinner.classList.add('hidden');

                            if (!response.ok) {
                                const errorData = await response.json();
                                throw new Error(errorData.message || 'Error al subir la historia.');
                            }

                            const responseData = await response.json();
                            alert(responseData.message);
                            resetCreateStoryModal();

                            // Recargar y renderizar las historias actualizadas
                            const updatedStoriesResponse = await fetch('/historias/grouped');
                            if (!updatedStoriesResponse.ok) {
                                throw new Error('No se pudieron cargar las historias actualizadas.');
                            }
                            const updatedGroupedStories = await updatedStoriesResponse.json();
                            loadAndRenderStories(updatedGroupedStories);

                        } catch (error) {
                            console.error('Error:', error);
                            alert('Ocurrió un error al subir la historia: ' + error.message);
                            uploadStoryBtn.disabled = false;
                            uploadLoadingSpinner.classList.add('hidden');
                        }
                    });
                }

                function displayFilePreviews() {
                    filePreviewContainer.innerHTML = '';
                    selectedFiles.forEach((file, index) => {
                        const previewItem = document.createElement('div');
                        previewItem.classList.add('relative', 'w-24', 'h-24', 'rounded-lg', 'overflow-hidden', 'mr-2', 'mb-2');

                        if (file.type.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.src = URL.createObjectURL(file);
                            img.classList.add('w-full', 'h-full', 'object-cover');
                            previewItem.appendChild(img);
                        } else if (file.type.startsWith('video/')) {
                            const video = document.createElement('video');
                            video.src = URL.createObjectURL(file);
                            video.classList.add('w-full', 'h-full', 'object-cover');
                            video.muted = true;
                            video.play();
                            previewItem.appendChild(video);
                        }

                        const removeBtn = document.createElement('button');
                        removeBtn.classList.add('absolute', 'top-1', 'right-1', 'bg-red-500', 'text-white', 'rounded-full', 'w-5', 'h-5', 'flex', 'items-center', 'justify-center', 'text-xs');
                        removeBtn.textContent = 'X';
                        removeBtn.addEventListener('click', () => {
                            selectedFiles.splice(index, 1);
                            displayFilePreviews();
                        });
                        previewItem.appendChild(removeBtn);
                        filePreviewContainer.appendChild(previewItem);
                    });
                }

                function resetCreateStoryModal() {
                    uploadStoryForm.reset();
                    selectedFiles = [];
                    filePreviewContainer.innerHTML = '';
                    if (createStoryModal) {
                        const modalInstance = bootstrap.Modal.getInstance(createStoryModal);
                        if (modalInstance) {
                            modalInstance.hide();
                        }
                    }
                }

                async function loadAndRenderStories(storiesToRender) {
                    const storiesContainer = document.querySelector('.stories-container .swiper-wrapper');
                    if (!storiesContainer) return;
                    storiesContainer.innerHTML = '';

                    const createSlide = document.createElement('div');
                    createSlide.classList.add('swiper-slide', 'story-card', 'create-story-card');
                    createSlide.dataset.userId = 'create';
                    createSlide.innerHTML = `
            <div class="story-image-wrapper">
                <img src="/img/crear-historia.jpg" alt="Crear Historia" class="story-image">
                <div class="add-story-icon">
                    <i class="fa-solid fa-plus"></i>
                </div>
            </div>
            <p class="story-username">Crear</p>
        `;
                    createSlide.addEventListener('click', function() {
                        if (createStoryModal) {
                            const modalInstance = new bootstrap.Modal(createStoryModal);
                            modalInstance.show();
                        }
                    });
                    storiesContainer.appendChild(createSlide);

                    storiesToRender.forEach(group => {
                        const storyCard = document.createElement('div');
                        storyCard.classList.add('swiper-slide', 'story-card');
                        storyCard.dataset.userId = group.user_id;
                        storyCard.dataset.userName = group.user_name;
                        storyCard.dataset.userAvatar = group.user_avatar;

                        let borderClass = 'border-2 border-primary';
                        if (group.all_viewed) {
                            borderClass = 'border-2 border-gray-400';
                        }

                        storyCard.innerHTML = `
                <div class="story-image-wrapper ${borderClass}">
                    <img src="${group.user_avatar}" alt="${group.user_name}" class="story-image">
                </div>
                <p class="story-username">${group.user_name}</p>
            `;
                        storiesContainer.appendChild(storyCard);
                    });

                    initializeStoriesSwiper();
                }

                loadAndRenderStories(initialGroupedStories);


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
@endsection
