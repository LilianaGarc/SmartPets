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
            <h4><a href="{{ route('publicaciones.panel') }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Detalles de la publicación</strong></h4>
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


                    <div class="col">
                        <select class="form-select" name="visibilidad" style="width: 20%; margin: 1%;" disabled>
                            <option value="publico" {{ old('visibilidad', $publicacion->visibilidad ?? '') == 'publico' ? 'selected' : '' }}>Público</option>
                            <option value="privado" {{ old('visibilidad', $publicacion->visibilidad ?? '') == 'privado' ? 'selected' : '' }}>Privado</option>
                        </select>
                    </div>

                    <div class="col-11">
                        <textarea class="form-control" name="contenido" id="contenido" placeholder="¿Qué quieres compartir?" style="margin: 1%; height: 200px;" disabled>{{ old('contenido', $publicacion->contenido ?? '') }}</textarea>
                    </div>

                    <div class="mb-3 col-11">
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/png, image/jpeg, image/jpg, image/gif, image/webp" style="margin: 1%;" disabled>
                    </div>
                </div>

                @if (isset($publicacion))
                    @if($publicacion->imagen)
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
                @endif
            </div>
        </div>
    </form>
    <a href="{{ route('publicaciones.paneledit', ['id'=> $publicacion->id]) }}" class="btn" role="button" style="margin-left: 2vw;"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
    <a href="# " class="btn" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$publicacion->id}}"><i class="fa-solid fa-trash"></i> Eliminar</a>

    <!-- Modal -->
    <div class="modal fade" id="modalEliminar{{$publicacion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar publicacion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Esta seguro de eliminar la publicacion?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('publicaciones.paneldestroy' , ['id'=>$publicacion->id]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
