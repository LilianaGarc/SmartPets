<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="container">
    <h2>
        <a href="{{ route('adopciones.index') }}" class="btn-volver" style="text-decoration: none;">
            <i class="fas fa-arrow-left" style="color: #ff7f50; font-size: 24px;"></i>
        </a>
        Editar Publicación de Adopción
    </h2>

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
            <label for="contenido">Contenido</label>
            <textarea name="contenido" id="contenido" class="form-control" required maxlength="255">{{ old('contenido', $adopcion->contenido) }}</textarea>
        </div>

        <div class="form-group">
            <label for="imagen">Imagen</label>
            <div class="input-file-wrapper">
                <input type="file" name="imagen" id="imagen" accept="image/*" onchange="previewImage()">
                <label for="imagen">Seleccionar Imagen</label>
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

        <button type="submit" class="btn btn-success">Actualizar Adopción</button>
    </form>
</div>

<script src="{{ asset('js/vistaprevia.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/alerts.js') }}"></script>
</body>
</html>
