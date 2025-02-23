@extends('plantilla')
@section('titulo', 'Proyectos')
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

    <span><H3>| Publicaciones</H3></span><br>

    <div class="row">
        @foreach($publicaciones as $publicacion)
            <div class="col-6">
                <div class="card text-center" style="margin: 10px; width: 96%;">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-10" style="text-align: left;">
                                Estado:
                            </div>
                            <div class="col-2">
                                <a href="#" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $publicacion->nombre }}</h5>
                        <p class="card-text">| Contenido: {{ $publicacion->contenido }} |</p>
                    </div>
                    <div class="card-footer text-body-secondary">
                        Reacciones
                    </div>
                </div>
            </div>

        @endforeach
    </div>

@endsection
