<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Solicitudes</title>
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="container">
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
            <li class="breadcrumb__item">
                <a href="{{ route('adopciones.show', $adopcion->id) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Ver Adopción</span>
                </a>
            </li>
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('solicitudes.create', ['id_adopcion' => $adopcion->id]) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Solicitar</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="container2">
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
    <form action="{{ route('solicitudes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="contenido">Motivo de la Solicitud</label>
            <textarea name="contenido" id="contenido" class="form-control" required maxlength="90">{{ old('contenido') }}</textarea>
        </div>

        <div class="form-group">
            <label for="experiencia">¿Tiene experiencia previa con mascotas?</label>
            <select name="experiencia" id="experiencia" class="form-control" required>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="vivienda">¿Vive en una casa o en un departamento?</label>
            <select name="vivienda" id="vivienda" class="form-control" required>
                <option value="Casa">Casa</option>
                <option value="Departamento">Departamento</option>
            </select>
        </div>

        <div class="form-group">
            <label for="espacio">¿Tiene suficiente espacio para la mascota?</label>
            <select name="espacio" id="espacio" class="form-control" required>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="otros_animales">¿Hay otros animales en su hogar?</label>
            <select name="otros_animales" id="otros_animales" class="form-control" required>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>


        <div class="form-group">
            <label for="gastos_veterinarios">¿Está dispuesto a cubrir los gastos veterinarios?</label>
            <select name="gastos_veterinarios" id="gastos_veterinarios" class="form-control" required>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comprobante">Comprobante: Identidad</label>
            <div class="input-file-wrapper">
                <input type="file" name="comprobante" id="comprobante" accept="image/*" onchange="previewComprobante()">
                <label for="comprobante">Seleccionar archivo</label>
            </div>
            <div class="file-info">
                <span>Máximo tamaño: 2MB. Archivos permitidos: .jpeg, .png, .pdf</span>
            </div>
        </div>

        <div class="form-group image-preview-container" id="comprobante-preview-container" style="display: none;">
            <img id="comprobante-preview" src="" alt="Vista previa del comprobante">
            <div class="image-caption">Vista Previa</div>
        </div>

        <input type="hidden" name="id_adopcion" value="{{ $adopcion->id }}">

        <button type="submit" class="btn btn-success">Enviar Solicitud</button>
    </form>
</div>

<script src="{{ asset('js/vistaprevias.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/alerts.js') }}"></script>

</body>
</html>
