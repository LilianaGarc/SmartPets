@extends('panelAdministrativo.plantillaPanel')
@section('titulo','Publicaciones')
@section('contenido')

    <div class="card-body">
        <h3 class="card-title">
            <button class="round-button-2">
                <img src="{{ asset('images/huella.webp') }}" alt="Imagen" class="button-img-2">
            </button>
            Usuario:
            @if($publicacion->user)
                {{ $publicacion->user->name }}
            @else
                Usuario no disponible
            @endif</h3>
        <p class="card-text">Contenido: {{ $publicacion->contenido }}</p>
        <p class="card-text">ID de usuario: {{ $publicacion->id_user }}</p>
        <p class="card-text">ID de publicacion: {{ $publicacion->id}}</p>
        <p class="card-text">Cantidad de Reacciones: {{$reac}}</p>
        <p class="card-text">Cantidad de Comentarios: {{$comen}}</p>
        <p class="card-text"><small class="text-body-secondary">Ultima actualizacion: {{$publicacion->updated_at->diffForHumans()}}</small></p>

    </div>
    <div class="card-footer text-body-secondary">
        @if($publicacion->imagen)
            <img src="{{ asset('storage/' . $publicacion->imagen) }}" class="card-img-top" alt="Img publicacion">
        @endif
    </div>
    <hr>
    <div>
        <h4 style="margin: 1% 0% 1% 1%">Comentarios</h4>
        @foreach($comentarios as $comentario)
            <div class="row" style="margin-left: 2%">
                <div class="col-1">
                    <button class="round-button-comentario">
                        <img src="{{ asset('images/huella.webp') }}" alt="Imagen" class="button-img-comentario">
                    </button>
                </div>
                <div class="col-10">
                    <div class="card-comentario mb-3">
                        <div class="card-body">
                            <h6 class="card-title">
                                @if($comentario->user)
                                    {{ $comentario->user->name }}
                                @else
                                    Usuario no disponible
                                @endif

                            </h6>
                            <h10><p class="card-text"><small class="text-body-secondary">{{$comentario->updated_at->diffForHumans()}}</small></p></h10>
                            <h7><p class="card-text">{{ $comentario->contenido }}</p></h7>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    </div>


@endsection
