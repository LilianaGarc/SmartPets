@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          enctype="multipart/form-data"
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
            @if(isset($evento))
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Editar información del evento</strong></h4>
            @else
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Crear un nuevo evento</strong></h4>
            @endif
            <hr>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo"
                                   placeholder="Título" inputmode="text" autocomplete="off"
                                   value="{{ old('titulo', $evento->titulo ?? '') }}" required aria-label="Título">
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
                                   required aria-label="Fecha">
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
                                   value="{{ old('telefono', $evento->telefono ?? '') }}" required aria-label="Teléfono">
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
                                   placeholder="Hora de inicio" value="{{ old('hora_inicio', isset($evento) ? \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') : '') }}" required aria-label="Hora de inicio">
                            <label for="hora_inicio">Hora inicio <span style="color:red">*</span></label>
                            @error('hora_inicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="time" class="form-control @error('hora_fin') is-invalid @enderror" id="hora_fin" name="hora_fin"
                                   placeholder="Hora de fin" value="{{ old('hora_fin', isset($evento) ? \Carbon\Carbon::parse($evento->hora_fin)->format('H:i') : '') }}" required aria-label="Hora de fin">
                            <label for="hora_fin">Hora fin <span style="color:red">*</span></label>
                            @error('hora_fin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-select" id="modalidad_evento" name="modalidad_evento" required aria-label="Acceso al evento" onchange="mostrarCampoPrecio()">
                                <option value="gratis" {{ old('modalidad_evento', $evento->modalidad_evento ?? '') == 'gratis' ? 'selected' : '' }}>Gratuito</option>
                                <option value="pago" {{ old('modalidad_evento', $evento->modalidad_evento ?? '') == 'pago' ? 'selected' : '' }}>De pago</option>
                            </select>
                            <label for="modalidad_evento">¿El evento es gratuito o de pago? <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-3" id="campo_precio" style="display: none;">
                        <div class="form-floating">
                            <input type="number" min="0" step="0.01" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio"
                                   placeholder="Precio del evento" value="{{ old('precio', $evento->precio ?? '') }}" aria-label="Precio del evento">
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
                                   placeholder="Ubicación" value="{{ old('ubicacion', $evento->ubicacion ?? '') }}" required aria-label="Ubicación">
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
                            >{{ old('descripcion', $evento->descripcion ?? '') }}</textarea>
                            <label for="descripcion">Descripción <span style="color:red">*</span></label>
                            @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="contadorDescripcion" class="form-text text-end" style="margin-top: 2px; margin-bottom: 10px;">
                            0/250
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label for="imagen" class="form-label">Imagen del Evento</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/*" aria-label="Imagen del evento" {{ isset($evento) ? '' : 'required' }}>
                            @if(isset($evento) && $evento->imagen)
                                <span class="input-group-text bg-white">
                                    <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen actual" style="max-width: 60px; max-height: 60px; object-fit: cover;">
                                </span>
                            @endif
                        </div>
                        @if(isset($evento) && $evento->imagen)
                            <div class="form-text">Si no seleccionas una nueva imagen, se mantendrá la actual.</div>
                        @endif
                        <div id="preview-container" class="preview-container" style="margin-top: 10px;"></div>
                        @error('imagen')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <br>
            <button type="submit" class="btn">Guardar</button>
            <button type="reset" class="btn">Cancelar</button>
        </div>
    </form>

@endsection
