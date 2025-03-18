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
        <form method="post" action="{{ route('comentarios.store', ['id'=> $publicacion->id]) }}">
            @csrf
            <div class="card-nuevo-comentario mb-3">
                <div class="form-floating">
                    <div class="row">
                        <div class="col-10">
                            <textarea class="form-control" placeholder="Escribe un comentario..." name="comentario" id="comentario" style="width: 100%; margin: 1.5%"></textarea>
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn" style="margin: 16% 1% 0 5%; font-size: 120%; width: 35%;">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                            <button type="reset" class="btn" style="margin: 16% 1% 0 5%; font-size: 130%; width: 35%;">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <div class="row">
        <div class="col-11">
            <div class="card">
                <div class="card-body">
                    <div class="row">
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
                                    <img src="{{ asset('images/amorperrito.webp') }}" id="amor" data-hover="{{ asset('images/perritoamor2.webp') }}" class="imagen-publicacion-reaccion">
                                    <img src="{{ asset('images/risaperrito.webp') }}" id="risa" data-hover="{{ asset('images/perritorisa2.webp') }}" class="imagen-publicacion-reaccion">
                                    <img src="{{ asset('images/llorandoperrito.webp') }}" id="triste" data-hover="{{ asset('images/perritollorando2.webp') }}" class="imagen-publicacion-reaccion">
                                    <img src="{{ asset('images/enojadoperrito.webp') }}" id="enojado" data-hover="{{ asset('images/perritoenojado2.webp') }}" class="imagen-publicacion-reaccion"></div>
                            </div>
                            <hr>
                            <div>
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

                        </div>
                    </div>
                </div>
            </div>
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
