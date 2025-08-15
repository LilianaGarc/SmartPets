@include('MenuPrincipal.Navbar')
@extends('layout.plantilla')
@section('titulo','Crear publicacion')
@section('contenido')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="breadcrumb-container">
            <ul class="breadcrumb">
                <li class="breadcrumb__item">
                    <a href="{{ route('index') }}" class="breadcrumb__inner">
                        <span class="breadcrumb__title">Inicio</span>
                    </a>
                </li>
                <li class="breadcrumb__item">
                    <a href="{{ route('publicaciones.index') }}" class="breadcrumb__inner">
                        <span class="breadcrumb__title">Publicaciones</span>
                    </a>
                </li>
                <li class="breadcrumb__item breadcrumb__item-active">
                    <a href="{{ route('publicaciones.create') }}" class="breadcrumb__inner">
                        <span class="breadcrumb__title">Compartir publicación</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-11">
            <div class="card">
                <form method="post" enctype="multipart/form-data" action="{{ route('publicaciones.guardar.compartida') }}" >
                    @csrf

                    <div class="card-body" style="align-items: center;">
                        <h5><strong>{{ isset($publicacion) ? 'Editar publicación' : 'Crear publicación' }}</strong></h5>
                        <hr>
                        @php
                            $fotoPerfil = auth()->user()->fotoperfil
                                ? asset('storage/' . auth()->user()->fotoperfil)
                                : asset('images/fotodeperfil.webp');
                        @endphp

                        <div class="d-flex align-items-center mb-2">
                            <div class="foto-perfil" style="width: 50px; height: 50px; border-radius: 50%; background-size: cover; background-position: center; background-image: url('{{ $fotoPerfil }}'); margin-right: 10px;"></div>
                            <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                        </div>


                        <div class="col" style="display: none;">
                            <select class="form-select" name="visibilidad" style="width: 20%; margin: 1.5%;">
                                <option value="publico" {{ old('visibilidad', $publicacion->visibilidad ?? '') == 'publico' ? 'selected' : '' }}>Público</option>
                                <option value="privado" {{ old('visibilidad', $publicacion->visibilidad ?? '') == 'privado' ? 'selected' : '' }}>Privado</option>
                            </select>
                        </div>

                        <div class="col">
                            <textarea class="form-control" required name="contenido" id="contenido" maxlength="250" placeholder="¿Qué quieres compartir?" style="margin: 1.5%; width: 95%; height: 200px;">{{ old('contenido', $publicacion->contenido ?? '') }}</textarea>
                        </div>

                        <input type="hidden" name="publicacion_original_id" value="{{ $publicacionOriginal->id }}">

                        <div class=" card shared-post-card" style="margin: 1.5%; width: 95%; height: 200px;">
                            <div class="row">
                                @if($publicacionOriginal->imagen)
                                    <div class="col">
                                        <div class="form-group image-preview-container"
                                             style="margin: 2vw; border-radius: 10px; overflow: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                                            <img id="image-preview" src="{{ asset('storage/'.$publicacionOriginal->imagen) }}" alt="Vista previa de la imagen" style="border-radius: 10px; width: 5vw; height: auto;">
                                            <div class="image-caption" style="width: 200px; margin-top: 1vw; text-align: center;">
                                                <strong>Vista Previa</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="col" style="margin: 5px">
                                    <strong>
                                        <h6 class="bold-text">Original de: {{ $publicacionOriginal->user->name }}</h6>
                                        <h6>{{ $publicacionOriginal->contenido }}</h6>
                                    </strong>

                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-light">Publicar</button>
                        <button type="reset" class="btn btn-light">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @section('footer')
    @endsection
@endsection
