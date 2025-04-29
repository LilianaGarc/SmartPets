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

            <form method="POST" action="{{ route('comentarios.store', ['id' => $publicacion->id]) }}">
                @csrf
                <div class="card-nuevo-comentario">
                    <div class="row align-items-center">
                        <div class="col-10">
                            <textarea class="form-control" placeholder="Escribe un comentario..." name="comentario" id="comentario" rows="1" style="resize: none;"></textarea>
                        </div>
                        <div class="col-2 d-flex justify-content-around">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
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
            <div class="interacciones" style="margin-left: 2%">
                <div class="reactions" id="reactions-{{ $publicacion->id }}">
                    <img src="{{ asset('images/amorperrito.webp') }}" id="amor" data-hover="{{ asset('images/perritoamor2.webp') }}" class="imagen-publicacion-reaccion">
                    <img src="{{ asset('images/risaperrito.webp') }}" id="risa" data-hover="{{ asset('images/perritorisa2.webp') }}" class="imagen-publicacion-reaccion">
                    <img src="{{ asset('images/tristeperrito.webp') }}" id="triste" data-hover="{{ asset('images/perritotriste2.webp') }}" class="imagen-publicacion-reaccion">
                    <img src="{{ asset('images/enojadoperrito.webp') }}" id="enojado" data-hover="{{ asset('images/perritoenojado2.webp') }}" class="imagen-publicacion-reaccion"></div>
            </div>
            <hr>
            <div>
                <div class="col">
                    @foreach($comentarios as $comentario)
                        <div class="row">
                            <div class="col-1">
                                @php
                                    $fotoComentario = $comentario->user && $comentario->user->fotoperfil
                                        ? asset('storage/' . $comentario->user->fotoperfil)
                                        : asset('images/fotodeperfil.webp');
                                @endphp
                                <img src="{{ $fotoComentario }}" alt="Foto de perfil" class="img-fluid rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            </div>
                            <div class="col">
                                <div class="card" style="padding: 1vw; background-color: rgba(3,45,129,0.17)">
                                    <h6 class="card-title mb-0">
                                        {{ $comentario->user ? $comentario->user->name : 'Usuario no disponible' }}
                                    </h6>
                                    <p class="card-text"><small class="text-body-secondary">{{ $comentario->updated_at->diffForHumans() }}</small></p>
                                    <p class="card-text">{{ $comentario->contenido }}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="col-11">

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


        </div>
    </div>
    <p style="height: 2%;"></p>


@endsection
