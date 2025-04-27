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
                        <span class="breadcrumb__title">Crear publicación</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <div class="col-11">
            <div class="card">
                <form method="post" enctype="multipart/form-data"
                      @if (isset($publicacion))
                          action="{{ route('publicaciones.update', ['id'=>$publicacion->id]) }}"
                      @else
                          action="{{ route('publicaciones.store') }}"
                    @endif>
                    @csrf
                    @isset($publicacion)
                        @method('put')
                    @endisset

                    <div class="card-body">
                        <h5>{{ isset($publicacion) ? 'Editar publicación' : 'Crear publicación' }}</h5>
                        <hr>
                        <h5 class="card-title">
                            <button class="round-button-2">
                                <img src="{{ asset('images/huella.webp') }}" alt="Imagen" class="button-img-2">
                            </button>
                            {{ auth()->user()->name }}
                        </h5>

                        <div class="col">
                            <select class="form-select" name="visibilidad" style="width: 20%; margin: 1.5%;">
                                <option value="publico" {{ old('visibilidad', $publicacion->visibilidad ?? '') == 'publico' ? 'selected' : '' }}>Público</option>
                                <option value="privado" {{ old('visibilidad', $publicacion->visibilidad ?? '') == 'privado' ? 'selected' : '' }}>Privado</option>
                            </select>
                        </div>

                        <div class="col">
                            <textarea class="form-control" name="contenido" id="contenido" placeholder="¿Qué quieres compartir?" style="margin: 1.5%; height: 200px;">{{ old('contenido', $publicacion->contenido ?? '') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/png, image/jpeg, image/jpg, image/gif, image/webp" style="margin: 1.5%;">
                        </div>

                        <button type="submit" class="btn btn-primary">Publicar</button>
                        <button type="reset" class="btn btn-secondary">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
