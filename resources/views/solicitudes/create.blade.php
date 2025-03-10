<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="container">
    <h2>
        <a href="{{ route('adopciones.index') }}" class="btn-volver" style="text-decoration: none;">
            <i class="fas fa-arrow-left" style="color: #ff7f50; font-size: 24px;"></i>
        </a>
        Solicitud de Adopción de Mascota
    </h2>

    <form action="{{ route('solicitudes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="contenido">Motivo de la Solicitud</label>
            <textarea name="contenido" id="contenido" class="form-control" required maxlength="90"></textarea>
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

<script src="{{ asset('js/vistaprevia.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/alerts.js') }}"></script>

</body>
</html>
