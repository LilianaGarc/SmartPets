@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    <form method="post"
          enctype="multipart/form-data"
          @if (isset($publicacion))
              action="{{ route('publicaciones.panelupdate', ['id'=>$publicacion->id]) }}"
          @else
              action="{{ route('publicaciones.panelstore') }}"
        @endif>
        @isset($publicacion)
            @method('put')
        @endisset
        @csrf
        <div class="card-body">
            @if(isset($publicacion))
                <h4><a href="{{ route('publicaciones.panel') }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Editar la publicación</strong></h4>
            @else
                <h4><a href="{{ route('publicaciones.panel') }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Crear una nueva publicación</strong></h4>
            @endif
            <hr>
            <div class="row">
                <div class="col-8">
                    @php
                        $fotoPerfil = auth()->user()->fotoperfil
                            ? asset('storage/' . auth()->user()->fotoperfil)
                            : asset('images/fotodeperfil.webp');
                    @endphp

                    <div class="d-flex align-items-center mb-2">
                        <div class="foto-perfil" style="width: 50px; height: 50px; border-radius: 50%; background-size: cover; background-position: center; background-image: url('{{ $fotoPerfil }}'); margin-right: 10px;"></div>
                        <h5 class="mb-0">{{ auth()->user()->name }}</h5>
                    </div>

                    <div class="form-floating mb-3" style="width: 50%;">
                        <select class="form-select" name="visibilidad" id="visibilidad">
                            <option value="publico" {{ old('visibilidad', $publicacion->visibilidad ?? '') == 'publico' ? 'selected' : '' }}>Público</option>
                            <option value="privado" {{ old('visibilidad', $publicacion->visibilidad ?? '') == 'privado' ? 'selected' : '' }}>Privado</option>
                        </select>
                        <label for="visibilidad">Visibilidad</label>
                    </div>

                    <div class="form-floating mb-3 col-11">
                        <textarea class="form-control" name="contenido" id="contenido" placeholder="¿Qué quieres compartir?" style="height: 200px;">{{ old('contenido', $publicacion->contenido ?? '') }}</textarea>
                        <label for="contenido">Contenido</label>
                    </div>

                    <div class="mb-3 col-11">
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/png, image/jpeg, image/jpg, image/gif, image/webp" style="margin: 1%;">
                    </div>
                </div>

                @if (isset($publicacion) && $publicacion->imagen)
                    <div class="col">
                        <div class="form-group image-preview-container"
                             style="margin: 2vw; border-radius: 10px; overflow: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                            <img id="image-preview" src="{{ asset('storage/'.$publicacion->imagen) }}" alt="Vista previa de la imagen" style="border-radius: 10px; width: 15vw; height: auto;">
                            <div class="image-caption" style="width: 200px; margin-top: 1vw; text-align: center;">
                                <strong>Vista Previa</strong>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <button type="submit" class="btn btn-light">Publicar</button>
            <button type="reset" class="btn btn-light">Cancelar</button>
        </div>
    </form>

@endsection
