@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    <form method="POST"
          @if (isset($evento))
              action="{{ route('eventos.panelupdate', ['id'=>$evento->id]) }}"
          @else
              action="{{ route('eventos.panelstore') }}"
        @endif>
        @isset($evento)
            @method('put')
        @endisset
        @csrf
        <div class="card-body">
            <h4>
                <a href="javascript:history.back()" class="btn" role="button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>

                <strong>Detalles del evento</strong>
            </h4>
            <hr>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo"
                               placeholder="Título" inputmode="text" autocomplete="off"
                               value="{{ old('titulo', $evento->titulo ?? '') }}" required aria-label="Título" disabled>
                        <label for="titulo">Título <span style="color:red">*</span></label>
                        @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha"
                               placeholder="Fecha"
                               value="{{ old('fecha', $evento->fecha ?? '') }}"
                               min="{{ date('Y-m-d') }}"
                               required aria-label="Fecha" disabled>
                        <label for="fecha">Fecha <span style="color:red">*</span></label>
                        @error('fecha')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono"
                               placeholder="Teléfono" inputmode="tel" autocomplete="tel"
                               value="{{ old('telefono', $evento->telefono ?? '') }}" required aria-label="Teléfono" disabled>
                        <label for="telefono">Teléfono <span style="color:red">*</span></label>
                        @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" id="hora_inicio" name="hora_inicio"
                               placeholder="Hora de inicio" value="{{ old('hora_inicio', isset($evento) ? \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') : '') }}" required aria-label="Hora de inicio" disabled>
                        <label for="hora_inicio">Hora inicio <span style="color:red">*</span></label>
                        @error('hora_inicio')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <input type="time" class="form-control @error('hora_fin') is-invalid @enderror" id="hora_fin" name="hora_fin"
                               placeholder="Hora de fin" value="{{ old('hora_fin', isset($evento) ? \Carbon\Carbon::parse($evento->hora_fin)->format('H:i') : '') }}" required aria-label="Hora de fin" disabled>
                        <label for="hora_fin">Hora fin <span style="color:red">*</span></label>
                        @error('hora_fin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-floating">
                        <select class="form-select" id="modalidad_evento" name="modalidad_evento" required aria-label="Acceso al evento" onchange="mostrarCampoPrecio()" disabled>
                            <option value="gratis" {{ old('modalidad_evento', $evento->modalidad_evento ?? '') == 'gratis' ? 'selected' : '' }}>Gratuito</option>
                            <option value="pago" {{ old('modalidad_evento', $evento->modalidad_evento ?? '') == 'pago' ? 'selected' : '' }}>De pago</option>
                        </select>
                       <label for="modalidad_evento">Tipo de acceso <span style="color:red">*</span></label>
                    </div>
                </div>
                <div class="col-md-3" id="campo_precio" style="display: none;">
                    <div class="form-floating">
                        <input type="number" min="0" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio"
                               placeholder="Precio del evento" value="{{ old('precio', $evento->precio ?? '') }}" aria-label="Precio del evento" disabled>
                        <label for="precio">Precio</label>
                        @error('precio')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" id="ubicacion" name="ubicacion"
                               placeholder="Ubicación" value="{{ old('ubicacion', $evento->ubicacion ?? '') }}" required aria-label="Ubicación" disabled>
                        <label for="ubicacion">Ubicación <span style="color:red">*</span></label>
                        @error('ubicacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12">
                    <div class="form-floating">
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion"
                                      placeholder="Descripción" style="height: 100px" required aria-label="Descripción"
                                      maxlength="250"
                                      oninput="actualizarContadorDescripcion()"
                                      disabled>{{ old('descripcion', $evento->descripcion ?? '') }}</textarea>
                        <label for="descripcion">Descripción <span style="color:red">*</span></label>
                        @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-2">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    @if(isset($evento) && $evento->imagen)
                        <div class="form-group image-preview-container text-center" style="border-radius:8px; overflow:hidden; display:inline-block; padding:6px;">
                            <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Vista previa de la imagen"
                                 style="border-radius:8px; width:200px; height:200px; object-fit:cover; display:block;">
                            <div class="image-caption mt-2" style="width:200px; text-align:center; font-size:.95rem;">
                                <strong>Vista Previa</strong>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-secondary mb-0">Sin imagen disponible</div>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <a href="{{ route('eventos.paneledit', ['id'=> $evento->id]) }}" class="btn" role="button" style="margin-left: 2vw;"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
    <a href="#" class="btn" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$evento->id}}"><i class="fa-solid fa-trash"></i> Eliminar</a>

    <!-- Modal -->
    <div class="modal fade" id="modalEliminar{{$evento->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar el evento?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('eventos.paneldestroy' , ['id'=>$evento->id]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
