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
        <div class="col-11">
            <div class="card">
                <div class="card-body">
                    <div class="container-md" style="display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center;">
                        <button class="round-button">
                            <img src="{{ asset('images/amorperrito.webp') }}" alt="Imagen" class="button-img">
                        </button>
                        <a href="#" class="btn-user" role="button"><h7><i class="fas fa-plus"></i> Crea una nueva publicacion </h7></a>

                    </div>
                    <hr>
                    <div class="row">
                        @foreach($publicaciones as $publicacion)
                            <div class="card-publicacion mb-3">
                                <div class="card-body">
                                    <h3 class="card-title">
                                        <button class="round-button-2">
                                            <img src="{{ asset('images/huella.webp') }}" alt="Imagen" class="button-img-2">
                                        </button>
                                        @if($publicacion->user)
                                            {{ $publicacion->user->name }}
                                        @else
                                            Usuario no disponible
                                        @endif</h3>
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
                                        <p class="card-text"><small class="text-body-secondary">Cantidad de Reacciones: {{$publicacion->reacciones_count}}</small></p>

                                        <img src="{{ asset('images/amorperrito.webp') }}" id="amor" data-hover="{{ asset('images/perritoamor2.webp') }}" class="imagen-publicacion-reaccion">
                                        <img src="{{ asset('images/risaperrito.webp') }}" id="risa" data-hover="{{ asset('images/perritorisa2.webp') }}" class="imagen-publicacion-reaccion">
                                        <img src="{{ asset('images/llorandoperrito.webp') }}" id="triste" data-hover="{{ asset('images/perritollorando2.webp') }}" class="imagen-publicacion-reaccion">
                                        <img src="{{ asset('images/enojadoperrito.webp') }}" id="enojado" data-hover="{{ asset('images/perritoenojado2.webp') }}" class="imagen-publicacion-reaccion">
                                        <a href="{{ route('publicaciones.show', ['id'=> $publicacion->id]) }}" class="btn" role="button" style="margin: 5px;"><h7><i class="fas fa-comment"></i> Comentar</h7></a>
                                    </div>

                                </div>

                            </div>

                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <a href="{{ route('publicaciones.index') }}" class="btn" role="button" style="background-color: #18478b !important; margin-top: 42% !important; position: fixed; font-size: 150%"><h7><i class="fa-solid fa-circle-arrow-up"></i></h7></a>
        </div>
    </div>

    <script>
        const images = document.querySelectorAll('.imagen-publicacion-reaccion');

        images.forEach(image => {
            const originalSrc = image.src;

            image.addEventListener('mouseover', function() {
                const hoverSrc = image.getAttribute('data-hover');
                image.src = hoverSrc;
            });

            image.addEventListener('mouseout', function() {
                image.src = originalSrc;
            });
        });

@endsection
