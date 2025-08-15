@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    <form method="post"
          @if (isset($adopcion))
              action="{{ route('adopciones.panelupdate', ['id'=>$adopcion->id]) }}"
          @else
              action="{{ route('adopciones.panelstore') }}"
        @endif>
        @isset($adopcion)
            @method('put')
        @endisset
        @csrf
        <div class="card-body">
            <h4>
                <a href="{{ route('adopciones.panel') }}" class="btn" role="button" >
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <strong>Detalles de la adopción</strong>
            </h4>
            <hr>

            @php
                $usuarioAdopcion = $adopcion->usuario;
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
                <h5 class="mb-0">{{ $usuarioAdopcion->name }}</h5>
            </div>



            <div class="row">
                <div class="col-8">
                    <div class="form-floating mb-3">
                        <input type="text" name="nombre_mascota" id="nombre_mascota" required maxlength="15" class="form-control"
                               value="{{ old('nombre_mascota', isset($adopcion) ? $adopcion->nombre_mascota : '') }}" disabled>
                        <label for="nombre_mascota">Nombre de la Mascota</label>
                    </div>

                    <div class="form-floating mb-3">
                        @php
                            $tipo = old('tipo_mascota', isset($adopcion) ? $adopcion->tipo_mascota : '');
                        @endphp
                        <select name="tipo_mascota" id="tipo_mascota" class="form-select" required disabled>
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
                               max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" disabled>
                        <label for="fecha_nacimiento">Fecha de Nacimiento de la Mascota</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="raza_mascota" id="raza_mascota" required maxlength="20" class="form-control"
                               value="{{ old('raza_mascota', isset($adopcion) ? $adopcion->raza_mascota : '') }}" disabled>
                        <label for="raza_mascota">Raza de la Mascota</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="ubicacion_mascota" id="ubicacion_mascota" required maxlength="40" class="form-control"
                               value="{{ old('ubicacion_mascota', isset($adopcion) ? $adopcion->ubicacion_mascota : '') }}" disabled>
                        <label for="ubicacion_mascota">Ubicación de la Mascota</label>
                    </div>

                    <div class="form-floating mb-3">
                        <textarea name="contenido" id="contenido" class="form-control" required maxlength="120" disabled style="height: 150px;">{{ old('contenido', isset($adopcion) ? $adopcion->contenido : '') }}</textarea>
                        <label for="contenido">Contenido</label>
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

        </div>
    </form>
    <a href="{{ route('adopciones.paneledit', ['id'=> $adopcion->id]) }}" class="btn" role="button" style="margin-left: 2vw;"><i class="fa-solid fa-pen-to-square"></i> Editar</a>
    <a href="#" class="btn" role="button" data-bs-toggle="modal" data-bs-target="#modalEliminar{{$adopcion->id}}"><i class="fa-solid fa-trash"></i> Eliminar</a>

    <!-- Modal -->
    <div class="modal fade" id="modalEliminar{{$adopcion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar adopcion</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Esta seguro de eliminar la adopcion?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form method="post" action="{{ route('adopciones.paneldestroy' , ['id'=>$adopcion->id]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="Eliminar" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

