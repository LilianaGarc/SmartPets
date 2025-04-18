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

    <div class="row">
        <div class="col-11">
            <div class="card">
                <form method="post"
                      @if (isset($publicacion))
                          action="{{ route('publicaciones.update', ['id'=>$publicacion->id]) }}"
                      @else
                          action="{{ route('publicaciones.store') }}"
                       @endif>
                    @isset($publicacion)
                        @method('put')
                    @endisset
                    @csrf
                        <div class="card-body">
                            @if(isset($publicacion))
                                <h5>Editar publicacion</h5>
                            @else
                                <h5>Crear publicacion</h5>
                            @endif
                            <hr>
                            <h5 class="card-title">
                                <button class="round-button-2">
                                    <img src="{{ asset('images/huella.webp') }}" alt="Imagen" class="button-img-2">
                                </button>
                                User name</h5>
                            <div class="col">
                                <select class="form-select" id="visibilidad" aria-label="visibilidad" name="visibilidad" style="width: 11%; height: 8%; margin: 1.5%; font-size: 80%;">

                                    @if(isset($publicacion))
                                        {{ $publicacion->visibilidad ? "selected" : "" }}>
                                    @else
                                        <option selected><i class="fa-solid fa-earth-americas"></i> publico</option>
                                    @endif
                                    <option>privado</option>
                                </select>
                            </div>

                            <div class="col">
                                <div class="form-floating">
                                    <div class="col-10">
                                        <textarea class="form-control" placeholder="¿Que quieres compartir?" name="contenido" id="contenido" style="width: 116%; margin: 1.5%; height: 200px !important;" value="{{ isset($publicacion) ? $publicacion->contenido : old('contenido') }}"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <input type="file" class="form-control" id="imagen" name="imagen"  accept="image/png, image/jpeg, image/jpg, image/gif, image/webp" style="width: 96%; margin: 1.5%">
                            </div>

                            <br>
                            <button type="submit" class="btn">Publicar</button>
                            <button type="reset" class="btn">Cancelar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>

@endsection
