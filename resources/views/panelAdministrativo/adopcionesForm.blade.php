@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    <form method="post"
          @if (isset($adopcion))
              enctype="multipart/form-data"
              action="{{ route('adopciones.panelupdate', ['id'=>$adopcion->id]) }}"
          @else
              enctype="multipart/form-data"
              action="{{ route('adopciones.panelstore') }}"
          @endif>
        @isset($adopcion)
            @method('put')
        @endisset
        @csrf

        {{-- Validación de errores --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="list-unstyled mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-body">
            @if(isset($adopcion))
                <h4><a href="{{ route('adopciones.panel') }}" class="btn" role="button"><i class="fa-solid fa-arrow-left"></i></a> <strong>Editar la adopción</strong></h4>
            @else
                <h4><a href="{{ route('adopciones.panel') }}" class="btn" role="button"><i class="fa-solid fa-arrow-left"></i></a> <strong>Crear una nueva adopción</strong></h4>
            @endif
            <hr>
            <div class="row">
                <div class="col-8">
                    <div class="form-floating mb-3">
                        <input type="text" name="nombre_mascota" id="nombre_mascota" required maxlength="15" class="form-control"
                               value="{{ old('nombre_mascota', isset($adopcion) ? $adopcion->nombre_mascota : '') }}">
                        <label for="nombre_mascota">Nombre de la Mascota</label>
                    </div>

                    <div class="form-floating mb-3">
                        @php
                            $tipo = old('tipo_mascota', isset($adopcion) ? $adopcion->tipo_mascota : '');
                        @endphp
                        <select name="tipo_mascota" id="tipo_mascota" class="form-select" required>
                            <option value="Perro" {{ $tipo == 'Perro' ? 'selected' : '' }}>Perro</option>
                            <option value="Gato" {{ $tipo == 'Gato' ? 'selected' : '' }}>Gato</option>
                            <option value="Conejo" {{ $tipo == 'Conejo' ? 'selected' : '' }}>Conejo</option>
                            <option value="Tortuga" {{ $tipo == 'Tortuga' ? 'selected' : '' }}>Tortuga</option>
                            <option value="Peces" {{ $tipo == 'Peces' ? 'selected' : '' }}>Peces</option>
                            <option value="Otro" {{ $tipo == 'Otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                        <label for="tipo_mascota">Tipo de Mascota</label>
                    </div>

                    <div class="form-floating mb-3">
                        @php
                            $fecha = old('fecha_nacimiento', isset($adopcion) ? \Carbon\Carbon::parse($adopcion->fecha_nacimiento)->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d'));
                        @endphp
                        <input type="date"
                               name="fecha_nacimiento"
                               id="fecha_nacimiento"
                               class="form-control"
                               value="{{ $fecha }}"
                               required
                               max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                        <label for="fecha_nacimiento">Fecha de Nacimiento de la Mascota</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="raza_mascota" id="raza_mascota" required maxlength="20" class="form-control"
                               value="{{ old('raza_mascota', isset($adopcion) ? $adopcion->raza_mascota : '') }}">
                        <label for="raza_mascota">Raza de la Mascota</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="ubicacion_mascota" id="ubicacion_mascota" required maxlength="40" class="form-control"
                               value="{{ old('ubicacion_mascota', isset($adopcion) ? $adopcion->ubicacion_mascota : '') }}">
                        <label for="ubicacion_mascota">Ubicación de la Mascota</label>
                    </div>

                    <div class="mb-3">
                        <label for="contenido">Contenido</label>
                        <textarea name="contenido" id="contenido" class="form-control" required maxlength="120">{{ old('contenido', isset($adopcion) ? $adopcion->contenido : '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="imagen">Imagen</label>
                        <div class="input-file-wrapper">
                            <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*" onchange="previewImage()">
                        </div>
                        <div class="mb-3">
                            <span style="color: #18478b;">Máximo tamaño: 2MB. Archivos permitidos: .jpeg, .png, .pdf</span>
                        </div>
                    </div>

                    <div class="form-group image-preview-container" id="image-preview-container" style="display: none;">
                        <img id="image-preview" src="" alt="Vista previa de la imagen">
                        <div class="image-caption">Vista Previa</div>
                    </div>
                </div>

                @if (isset($adopcion) && $adopcion->imagen)
                    <div class="col">
                        <div class="form-group image-preview-container"
                             style="margin: 2vw; border-radius: 10px; overflow: hidden; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%;">
                            <img id="image-preview" src="{{ asset('storage/'.$adopcion->imagen) }}" alt="Vista previa de la imagen" style="border-radius: 10px; width: 15vw; height: auto;">
                            <div class="image-caption" style="width: 200px; margin-top: 1vw; text-align: center;">
                                <strong>Vista Previa</strong>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <br>
            <button type="submit" class="btn">Guardar</button>
            <button type="reset" class="btn">Cancelar</button>
        </div>
    </form>

@endsection
