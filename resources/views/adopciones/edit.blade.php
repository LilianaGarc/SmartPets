<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Editar Adopción</title>
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="container">
    <div class="page-title">
        <h1 class="page-title__text">Mascotas en Adopción</h1>
    </div>
    <div class="breadcrumb-container">
        <ul class="breadcrumb">
            <li class="breadcrumb__item">
                <a href="{{ route('index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Inicio</span>
                </a>
            </li>
            <li class="breadcrumb__item">
                <a href="{{ route('adopciones.index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Adopciones</span>
                </a>
            </li>
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('adopciones.edit', $adopcion->id) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Editar publicación</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="container5">
    @if(session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '¡Éxito!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    draggable: true,
                    confirmButtonColor: '#ff7f50',
                });
            });
        </script>
    @endif

    <form action="{{ route('adopciones.update', $adopcion->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre_mascota">🐕 Nombre de la Mascota</label>
            <input type="text" name="nombre_mascota" id="nombre_mascota" required maxlength="15" class="form-control" required value="{{ old('nombre_mascota', $adopcion->nombre_mascota) }}">
        </div>

        <div class="form-group">
            <label for="tipo_mascota">📋 Tipo de Mascota</label>
            <select name="tipo_mascota" id="tipo_mascota" class="form-control" required>
                <option value="Perro" {{ old('tipo_mascota', $adopcion->tipo_mascota) == 'Perro' ? 'selected' : '' }}>Perro</option>
                <option value="Gato" {{ old('tipo_mascota', $adopcion->tipo_mascota) == 'Gato' ? 'selected' : '' }}>Gato</option>
                <option value="Conejo" {{ old('tipo_mascota', $adopcion->tipo_mascota) == 'Conejo' ? 'selected' : '' }}>Conejo</option>
                <option value="Tortuga" {{ old('tipo_mascota', $adopcion->tipo_mascota) == 'Tortuga' ? 'selected' : '' }}>Tortuga</option>
                <option value="Peces" {{ old('tipo_mascota', $adopcion->tipo_mascota) == 'Peces' ? 'selected' : '' }}>Peces</option>
                <option value="Otro" {{ old('tipo_mascota', $adopcion->tipo_mascota) == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">📅 Fecha de Nacimiento de la Mascota</label>
            <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control"
                   value="{{ old('fecha_nacimiento', isset($adopcion) ? \Carbon\Carbon::parse($adopcion->fecha_nacimiento)->format('Y-m-d') : '') }}"
                   required>
        </div>

        <div class="form-group">
            <label for="raza_mascota">🔎 Raza de la Mascota</label>
            <input type="text" name="raza_mascota" id="raza_mascota" required maxlength="20" class="form-control" required value="{{ old('raza_mascota', $adopcion->raza_mascota) }}">
        </div>

        <div class="form-group">
            <label for="ubicacion_mascota">📍 Ubicación de la Mascota</label>
            <input type="text" name="ubicacion_mascota" id="ubicacion_mascota" required maxlength="60" class="form-control" required value="{{ old('ubicacion_mascota', $adopcion->ubicacion_mascota) }}">
        </div>

        <div class="form-group">
            <label for="contenido">🖊️ Mensaje</label>
            <textarea name="contenido" id="contenido" class="form-control" required maxlength="250">{{ old('contenido', $adopcion->contenido) }}</textarea>
        </div>


        <div class="form-group">
            <label for="imagen_principal">🖼️ Imagen Principal</label>
            <div class="input-file-wrapper">
                <input type="file" name="imagen_principal" id="imagen_principal" accept="image/*" onchange="previewImage()">
                <label for="imagen_principal">Seleccionar Imagen</label>
            </div>

            <div class="file-info">
                <span>Máximo tamaño: 2MB. Archivos permitidos: .jpeg, .png, .pdf</span>
            </div>
        </div>

        @if($adopcion->imagen)
            <div class="form-group image-preview-container">
                <img id="image-preview" src="{{ asset('storage/'.$adopcion->imagen) }}" alt="Vista previa de la imagen">
                <div class="image-caption">Vista Previa</div>
            </div>
        @endif

        <div class="form-group">
            <label for="imagenes_secundarias">Agregar Imágenes Secundarias</label>
            <div class="input-file-wrapper">
                <input type="file" name="imagenes_secundarias[]" id="imagenes_secundarias" accept="image/*" multiple>
                <label for="imagenes_secundarias">Seleccionar Imágenes</label>
            </div>
            <p id="info-cupo" style="margin-top: 10px; font-weight: bold;"></p>
            <div id="preview-nuevas-imagenes" style="margin-top: 10px; display: flex; gap: 10px; flex-wrap: wrap;"></div>
        </div>

        @if($adopcion->imagenes_secundarias)
            @php
                $imagenesSecundarias = json_decode($adopcion->imagenes_secundarias, true);
            @endphp

            <div class="form-group">
                <label>Imágenes Secundarias Actuales (selecciona para eliminar)</label>
                <div class="secondary-images-edit">
                    @foreach($imagenesSecundarias as $index => $imagen)
                        <div class="secondary-image-item">
                            <img src="{{ asset('storage/'.$imagen) }}" alt="Imagen secundaria {{ $index }}">
                            <label class="checkbox-label">
                                <input type="checkbox" name="imagenes_secundarias_eliminar[]" value="{{ $imagen }}" class="checkbox-eliminar">
                                <span></span> Eliminar
                            </label>

                        </div>
                    @endforeach
                </div>
            </div>
        @endif


        <button type="submit" class="btn btn-success">🚀 Actualizar Adopción</button>
    </form>
</div>

<script>
</script>
<span id="total-imagenes-secundarias" style="display:none;">{{ isset($imagenesSecundarias) ? count($imagenesSecundarias) : 0 }}</span>
<script src="{{ asset('js/adopcioneditar.js') }}"></script>
<script src="{{ asset('js/vistaprevia.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/alerts.js') }}"></script>
</body>
</html>
