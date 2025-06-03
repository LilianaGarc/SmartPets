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
    <a href="{{ route('publicaciones.paneledit', ['id'=> $publicacion->id]) }}" class="btn" role="button" id="btnComentarios"><i class="fa-solid fa-comment"></i> Comentarios</a>
    <a href="# " class="btn" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$publicacion->id}}"><i class="fa-solid fa-trash"></i> Eliminar</a>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <p></p>
                @if (isset($comentarios))
                    @foreach($comentarios as $comentario)
                        <div class="row">
                            <div class="col-1">
                                @php
                                    $fotoComentario = $comentario->user && $comentario->user->fotoperfil
                                        ? asset('storage/' . $comentario->user->fotoperfil)
                                        : asset('images/fotodeperfil.webp');
                                @endphp
                                <img src="{{ $fotoComentario }}" alt="Foto de perfil" class="img-fluid rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            </div>
                            <div class="col">
                                <div class="card" style="padding: 1vw; background-color: rgba(3,45,129,0.17)">
                                    <h6 class="card-title mb-0">
                                        {{ $comentario->user ? $comentario->user->name : 'Usuario no disponible' }}
                                    </h6>
                                    <p class="card-text"><small class="text-body-secondary">{{ $comentario->updated_at->diffForHumans() }}</small></p>
                                    <p class="card-text">{{ $comentario->contenido }}</p>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                @endif
                <form method="POST" action="{{ route('comentarios.panelstore', ['id' => $publicacion->id]) }}" id="formComentario">
                    @csrf
                    <div class="card-nuevo-comentario">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <textarea class="form-control" placeholder="Escribe un comentario..." name="comentario" id="comentario" rows="1" style="resize: none;"></textarea>
                            </div>
                            <div class="col-2 d-flex justify-content-around">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

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
    <script>
        document.getElementById('btnComentarios').addEventListener('click', function (e) {
            e.preventDefault();

            const collapseElement = document.getElementById('flush-collapseOne');
            const formComentario = document.getElementById('formComentario');

            if (collapseElement.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(collapseElement, { toggle: true });
                formComentario.style.display = 'none';
            } else {
                const bsCollapse = new bootstrap.Collapse(collapseElement, { toggle: true });
                formComentario.style.display = 'block';
            }
        });

        const collapseElement = document.getElementById('flush-collapseOne');
        collapseElement.addEventListener('hidden.bs.collapse', function () {
            document.getElementById('formComentario').style.display = 'none';
        });

        collapseElement.addEventListener('shown.bs.collapse', function () {
            document.getElementById('formComentario').style.display = 'block';
        });
    </script>





@endsection
