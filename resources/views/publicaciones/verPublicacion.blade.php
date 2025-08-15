@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    <form method="post"
          @if (isset($publicacion))
              action="{{ route('publicaciones.update', ['id'=>$publicacion->id]) }}"
          @else
              action="{{ route('publicaciones.panelstore') }}"
        @endif>
        @isset($publicacion)
            @method('put')
        @endisset
        @csrf
        <div class="card-body">
            <h4>
                <a href="{{ route('publicaciones.panel') }}" class="btn" role="button"><i class="fa-solid fa-arrow-left"></i></a>
                <strong>Detalles de la publicación</strong>
            </h4>
            <hr>

            @php
                $usuarioPublicacion = $publicacion->user;
                $fotoPerfil = $usuarioPublicacion && $usuarioPublicacion->fotoperfil
                    ? asset('storage/' . $usuarioPublicacion->fotoperfil)
                    : asset('images/fotodeperfil.webp');
                $esCompartida = $publicacion->publicacion_original_id !== null;
            @endphp

            <div class="d-flex align-items-center mb-3">
                <div class="foto-perfil" style="width: 50px; height: 50px; border-radius: 50%; background-size: cover; background-position: center; background-image: url('{{ $fotoPerfil }}'); margin-right: 10px;"></div>
                <h5 class="mb-0">{{ $usuarioPublicacion->name }}</h5>
            </div>

            <div class="row">
                <div class="{{ (isset($publicacion) && $publicacion->imagen && !$esCompartida) ? 'col-8' : 'col-12' }}">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" name="contenido" id="contenido" placeholder="¿Qué quieres compartir?" style="height: 200px;" disabled>{{ old('contenido', $publicacion->contenido ?? '') }}</textarea>
                        <label for="contenido">Contenido</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height: 3.5rem; resize: none; overflow: hidden;" disabled>{{ $publicacion->likes->count() ?? 0 }}</textarea>
                        <label>Likes</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height: 3.5rem; resize: none; overflow: hidden;" disabled>{{ $esCompartida ? 'Compartida' : 'Original' }}</textarea>
                        <label>Estado</label>
                    </div>
                </div>

                @if (isset($publicacion) && $publicacion->imagen && !$esCompartida)
                    <div class="col-4 d-flex flex-column align-items-center justify-content-center">
                        <img id="image-preview" src="{{ asset('storage/'.$publicacion->imagen) }}" alt="Vista previa de la imagen" style="border-radius: 10px; max-width: 15vw; width: 100%; height: auto;">
                        <p class="mt-2"><strong>Vista Previa</strong></p>
                    </div>
                @endif
            </div>

        </div>
    </form>

    <a href="{{ route('publicaciones.paneledit', ['id'=> $publicacion->id]) }}" class="btn" role="button" style="margin-left: 2vw;"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
    <a href="#" class="btn" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$publicacion->id}}"><i class="fa-solid fa-trash"></i> Eliminar</a>

    <div class="modal fade" id="modalEliminar{{$publicacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar publicación</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar la publicación?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form method="post" action="{{ route('publicaciones.paneldestroy' , ['id'=>$publicacion->id]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('footer')
    @endsection

@endsection
