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

    <div class="swiper mySwiper px-4">
        <div class="swiper-wrapper">

            <div class="swiper-slide">
                <a href="{{ route('historias.create') }}" class="story-card create-story">
                    <div class="story-create">+</div>
                    <span class="story-username">Tu historia</span>
                </a>
            </div>

            @foreach ($historias->groupBy('user_id') as $userHistorias)
                @php $story = $userHistorias->first(); @endphp
                <div class="swiper-slide">
                    <div class="story-card"
                        data-historias='@json($userHistorias)'
                        onclick="handleStoryClick(this)">
                        <img src="{{ asset('storage/' . $story->image_path) }}" alt="story" class="story-avatar">
                        <span class="story-username">{{ $story->user->name }}</span>
                    </div>
                </div>
            @endforeach

        </div>
    </div>


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

                                        @foreach(['triste', 'feliz', 'enojado', 'wow'] as $tipo)
                                            @php
                                                $src = asset("images/{$tipo}perrito.png");
                                                $hover = asset("images/perrito{$tipo}.gif");
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
    let storyImages = [];
    let currentStoryIndex = 0;
    let storyTimer;

    function handleStoryClick(element) {
        const historias = JSON.parse(element.getAttribute('data-historias'));
        if (!Array.isArray(historias) || historias.length === 0) return;

        storyImages = historias.map(item => `/storage/${item.image_path}`);
        currentStoryIndex = 0;
        showStory(currentStoryIndex);

        const modal = new bootstrap.Modal(document.getElementById('storyModal'));
        modal.show();
    }

    function showStory(index) {
        if (index >= storyImages.length) {
            const modal = bootstrap.Modal.getInstance(document.getElementById('storyModal'));
            modal.hide();
            return;
        }

        document.getElementById('storyImage').src = storyImages[index];
        updateProgressBar(0);
        let progress = 0;

        clearInterval(storyTimer);
        storyTimer = setInterval(() => {
            progress += 1;
            updateProgressBar(progress);
            if (progress >= 100) {
                currentStoryIndex++;
                showStory(currentStoryIndex);
            }
        }, 50);

        document.getElementById('storyImage').onclick = () => {
            clearInterval(storyTimer);
            currentStoryIndex++;
            showStory(currentStoryIndex);
        };
    }

    function updateProgressBar(percent) {
        document.getElementById('storyProgress').style.width = percent + '%';
    }

    document.getElementById('storyModal').addEventListener('hidden.bs.modal', () => {
        clearInterval(storyTimer);
        storyImages = [];
        currentStoryIndex = 0;
        updateProgressBar(0);
    });
</script>




    @include('chats.chat-float')
@endsection

<!-- Modal Historia -->
<div class="modal fade" id="storyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content bg-black text-white">
            <div class="modal-body p-0">
                <div class="story-container d-flex flex-column justify-content-center align-items-center h-100">
                    <img id="storyImage" src="" class="img-fluid story-view-img" alt="Historia">
                    <div class="story-progress-container">
                        <div id="storyProgress" class="story-progress-bar"></div>
                    </div>
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
            </div>
        </div>
    </div>
</div>

