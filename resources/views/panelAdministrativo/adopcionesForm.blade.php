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
                <h4>
                    <a href="{{ url()->previous() }}" class="btn" role="button">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <strong>Editar la adopción</strong>
                </h4>
            @else
                <h4>
                    <a href="{{ url()->previous() }}" class="btn" role="button">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <strong>Crear una nueva adopción</strong>
                </h4>
            @endif
            <hr>

            @php
                if (isset($adopcion)) {
                    $usuarioAdopcion = $adopcion->usuario ?? null;
                } else {
                    $usuarioAdopcion = auth()->user();
                }

                $fotoPerfil = $usuarioAdopcion && $usuarioAdopcion->fotoperfil
                    ? asset('storage/' . $usuarioAdopcion->fotoperfil)
                    : asset('images/fotodeperfil.webp');
            @endphp

            <div class="d-flex align-items-center mb-3">
                <div class="foto-perfil" style="
                width: 50px;
                height: 50px;
                border-radius: 50%;
                background-size: cover;
                background-position: center;
                background-image: url('{{ $fotoPerfil }}');
                margin-right: 10px;">
                </div>
                <h5 class="mb-0">{{ $usuarioAdopcion ? $usuarioAdopcion->name : 'Usuario no asignado' }}</h5>
            </div>


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
                <input type="text" name="ubicacion_mascota" id="ubicacion_mascota" required maxlength="60" class="form-control"
                       value="{{ old('ubicacion_mascota', isset($adopcion) ? $adopcion->ubicacion_mascota : '') }}">
                <label for="ubicacion_mascota">Ubicación de la Mascota</label>
            </div>

            <div class="form-floating mb-3">
                <textarea name="contenido" id="contenido" class="form-control" required maxlength="250" style="height: 100px;">{{ old('contenido', isset($adopcion) ? $adopcion->contenido : '') }}</textarea>
                <label for="contenido">Contenido</label>
            </div>

            <div class="mb-3">
                <label for="imagen">Imagen</label>
                <input type="file" class="form-control" name="imagen" id="imagen" accept="image/*" onchange="previewImage()" @if(!isset($adopcion)) required @endif>
                <div class="mb-3">
                    <span style="color: #18478b;">Máximo tamaño: 2MB. Archivos permitidos: .jpeg, .png, .pdf</span>
                </div>
            </div>

            {{-- Vista previa de la imagen seleccionada --}}
            <div class="form-group text-center mb-3" style="display: none;" id="preview-container">
                <img id="vista-previa-imagen" src="" alt="Vista previa de la imagen" style="border-radius: 10px; max-width: 200px; height: auto;">
                <p class="mt-2"><strong>Vista Previa</strong></p>
            </div>

            {{-- Vista previa si ya hay imagen guardada --}}
            @if (isset($adopcion) && $adopcion->imagen)
                <div class="form-group text-center mb-3" id="imagen-actual-container">
                    <img src="{{ asset('storage/'.$adopcion->imagen) }}" alt="Imagen guardada" style="border-radius: 10px; max-width: 200px; height: auto;">
                    <p class="mt-2"><strong>Imagen actual</strong></p>
                </div>
            @endif

            <br>
            <button type="submit" class="btn">Guardar</button>
            <a href="{{ route('adopciones.panel') }}" class="btn" role="button">Cancelar</a>
        </div>
    </form>

    <script>
        function previewImage() {
            const input = document.getElementById('imagen');
            const previewContainer = document.getElementById('preview-container');
            const previewImage = document.getElementById('vista-previa-imagen');
            const actualContainer = document.getElementById('imagen-actual-container');

            const file = input.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.style.display = 'block';
                    if (actualContainer) actualContainer.style.display = 'none';
                };
                reader.readAsDataURL(file);
            } else {
                previewImage.src = '';
                previewContainer.style.display = 'none';
                if (actualContainer) actualContainer.style.display = 'block';
            }
        }
    </script>

@endsection
