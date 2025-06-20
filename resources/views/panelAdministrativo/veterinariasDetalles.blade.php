@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    <form>
        <div class="card-body">
            <h4>
                <a href="{{ route('veterinarias.panel') }}" class="btn" role="button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <strong>Detalles de la veterinaria</strong>
            </h4>
            <hr>

            <div class="row">
                <div class="col-8">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                       value="{{ $veterinaria->nombre ?? '' }}" disabled>
                                <label for="nombre">Nombre de la veterinaria</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nombre_veterinario" name="nombre_veterinario"
                                       value="{{ $veterinaria->nombre_veterinario ?? '' }}" disabled>
                                <label for="nombre_veterinario">Propietario</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="telefono" name="telefono"
                                       value="{{ $veterinaria->telefono ?? '' }}" disabled>
                                <label for="telefono">Teléfono</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp"
                                       value="{{ $veterinaria->whatsapp ?? '' }}" disabled>
                                <label for="whatsapp">WhatsApp</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="horario_apertura" name="horario_apertura"
                                       value="{{ $veterinaria->horario_apertura ?? '' }}" disabled>
                                <label for="horario_apertura">Hora de Apertura</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="horario_cierre" name="horario_cierre"
                                       value="{{ $veterinaria->horario_cierre ?? '' }}" disabled>
                                <label for="horario_cierre">Hora de Cierre</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="departamento" name="departamento"
                                       value="{{ $veterinaria->ubicacion->departamento ?? '' }}" disabled>
                                <label for="departamento">Departamento</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="ciudad" name="ciudad"
                                       value="{{ $veterinaria->ubicacion->ciudad ?? '' }}" disabled>
                                <label for="ciudad">Ciudad</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="municipio" name="municipio"
                                       value="{{ $veterinaria->ubicacion->municipio ?? '' }}" disabled>
                                <label for="municipio">Municipio</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="direccion" name="direccion"
                               value="{{ $veterinaria->ubicacion->direccion ?? '' }}" disabled>
                        <label for="direccion">Dirección</label>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="latitud" name="latitud"
                                       value="{{ $veterinaria->ubicacion->latitud ?? '' }}" disabled>
                                <label for="latitud">Latitud</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="longitud" name="longitud"
                                       value="{{ $veterinaria->ubicacion->longitud ?? '' }}" disabled>
                                <label for="longitud">Longitud</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Redes Sociales</label>
                        @if($veterinaria->redes && count($veterinaria->redes))
                            @foreach($veterinaria->redes as $red)
                                <div class="row mb-2">
                                    <div class="col-md-5">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ $red->tipo_red_social }}" disabled>
                                            <label>Tipo</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" value="{{ $red->nombre_usuario }}" disabled>
                                            <label>Usuario</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <span>No hay redes sociales</span>
                        @endif
                    </div>
                </div>
                <div class="col-4 d-flex flex-column align-items-center">
                    @if($veterinaria->imagenes && count($veterinaria->imagenes))
                        <div class="mb-3" style="border-radius: 10px; overflow: hidden; display: flex; flex-direction: column; align-items: center;">
                            <img src="{{ asset('storage/' . $veterinaria->imagenes[0]->path) }}" alt="Imagen principal" style="border-radius: 10px; width: 15vw; height: auto; max-width: 250px;">
                            <div class="image-caption" style="width: 200px; margin-top: 1vw; text-align: center;">
                                <strong>Imagen principal</strong>
                            </div>
                        </div>
                        @if(count($veterinaria->imagenes) > 1)
                            <div class="d-flex flex-wrap justify-content-center">
                                @foreach($veterinaria->imagenes->slice(1) as $imagen)
                                    <img src="{{ asset('storage/' . $imagen->path) }}" alt="Imagen secundaria" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; margin: 3px;">
                                @endforeach
                            </div>
                        @endif
                    @else
                        <span>No hay imágenes</span>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <a href="{{ route('veterinarias.paneledit', ['id'=> $veterinaria->id]) }}" class="btn btn-warning" role="button" style="margin-left: 2vw;">
        <i class="fa-solid fa-pen-to-square"></i> Editar
    </a>
    <a href="#" class="btn btn-danger" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$veterinaria->id}}">
        <i class="fa-solid fa-trash"></i> Eliminar
    </a>

    <!-- Modal -->
    <div class="modal fade" id="modalEliminar{{$veterinaria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar veterinaria</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar la veterinaria?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <form method="post" action="{{ route('veterinarias.paneldestroy' , ['id'=>$veterinaria->id]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection