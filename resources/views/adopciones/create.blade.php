<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Adopciones</title>
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
                <a href="{{ route('adopciones.create') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Crear publicación</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="container3">
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

    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let errorMessage = '';
                @foreach ($errors->all() as $error)
                    errorMessage += '{{ $error }}\n';
                @endforeach

                showErrorAlert(errorMessage);
            });
        </script>
    @endif

    <div class="form-container">
        <div class="form-column">
            <form action="{{ route('adopciones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nombre_mascota">🐕 Nombre de la Mascota</label>
                    <input type="text" name="nombre_mascota" id="nombre_mascota" required maxlength="15" class="form-control" value="{{ old('nombre_mascota') }}" placeholder="Ingresa el nombre de tu mascota">
                </div>

                <div class="form-group">
                    <label for="tipo_mascota">📋 Tipo de Mascota</label>
                    <select name="tipo_mascota" id="tipo_mascota" class="form-control" required>
                        <option value="Perro" {{ old('tipo_mascota') == 'Perro' ? 'selected' : '' }}>Perro</option>
                        <option value="Gato" {{ old('tipo_mascota') == 'Gato' ? 'selected' : '' }}>Gato</option>
                        <option value="Conejo" {{ old('tipo_mascota') == 'Conejo' ? 'selected' : '' }}>Conejo</option>
                        <option value="Tortuga" {{ old('tipo_mascota') == 'Tortuga' ? 'selected' : '' }}>Tortuga</option>
                        <option value="Peces" {{ old('tipo_mascota') == 'Peces' ? 'selected' : '' }}>Peces</option>
                        <option value="Otro" {{ old('tipo_mascota') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_nacimiento">📅 Fecha de Nacimiento de la Mascota</label>
                    <input type="date"
                           name="fecha_nacimiento"
                           id="fecha_nacimiento"
                           class="form-control"
                           value="{{ old('fecha_nacimiento', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                           required
                           max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                </div>

                <div class="form-group">
                    <label for="raza_mascota">🔎 Raza de la Mascota</label>
                    <input type="text" name="raza_mascota" id="raza_mascota" required maxlength="20" class="form-control" value="{{ old('raza_mascota') }}" placeholder="Ingresa la raza de tu mascota">
                </div>

                <div class="form-group">
                    <label for="ubicacion_mascota">📍 Ubicación de la Mascota</label>
                    <input type="text" name="ubicacion_mascota" id="ubicacion_mascota" required maxlength="60" class="form-control"  value="{{ old('ubicacion_mascota') }}" placeholder="Ingresa la ubicación de tu mascota">
                </div>

                <div class="form-group">
                    <label for="contenido">🖊️ Mensaje</label>
                    <textarea name="contenido" id="contenido" class="form-control" required maxlength="250" placeholder="Ingresa una breve descripción de tu mascota">{{ old('contenido') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="imagen_principal">🖼️ Imagen Principal</label>
                    <div class="input-file-wrapper">
                        <input type="file" name="imagen_principal" id="imagen_principal" accept="image/*" onchange="previewImage()" required>
                        <label for="imagen_principal">Seleccionar Imagen Principal</label>
                    </div>
                    <div class="file-info">
                        <span>Máximo tamaño: 2MB. Archivos permitidos: .jpeg, .png, .webp</span>
                    </div>
                </div>

                <div class="form-group image-preview-container" id="image-preview-container" style="display: none;">
                    <img id="image-preview" src="" alt="Vista previa de la imagen">
                    <div class="image-caption">Vista Previa</div>
                </div>


                <div class="form-group">
                    <label for="imagenes_secundarias[]">📸 Imágenes Adicionales (4)</label>
                    <div class="input-file-wrapper">
                        <input type="file" name="imagenes_secundarias[]" id="imagenes_secundarias" accept="image/*" multiple>
                        <label for="imagenes_secundarias">Seleccionar Imágenes adicionales</label>
                    </div>
                    <div class="file-info">
                        <span>Máximo 4 imágenes adicionales. Archivos permitidos: .jpeg, .png, .webp</span>
                    </div>
                </div>


                <div class="form-group" id="secondary-preview-container" style="display: none;">
                    <label>Vista previa de imágenes adicionales</label>
                    <div id="secondary-images-preview" class="image-preview-grid"></div>
                </div>


                <button type="submit" class="btn btn-success">🚀 Crear Adopción</button>
            </form>
        </div>


        <div class="image-column">
            <img src="{{ asset('images/form.webp') }}" alt="formulario">
        </div>
    </div>
</div>

<script src="{{ asset('js/vistaprevia.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/alerts.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputNombre    = document.getElementById('nombre_mascota');
        const inputRaza      = document.getElementById('raza_mascota');
        const inputUbicacion = document.getElementById('ubicacion_mascota');

        if (inputNombre) {
            inputNombre.addEventListener('input', function () {
                const original = this.value;
                const limpio = original.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
                if (limpio !== original) {
                    this.value = limpio;
                }
            });
        }

        if (inputRaza) {
            inputRaza.addEventListener('input', function () {
                const original = this.value;
                const limpio = original.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
                if (limpio !== original) {
                    this.value = limpio;
                }
            });
        }

        if (inputUbicacion) {
            inputUbicacion.addEventListener('input', function () {
                const original = this.value;
                const limpio = original.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s#.,-]/g, '');
                if (limpio !== original) {
                    this.value = limpio;
                }
            });
        }
    });
</script>

</body>
</html>
