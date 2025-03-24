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
            <li class="breadcrumb__item">
                <a href="{{ route('solicitudes.show', $adopcion->id) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Solicitudes</span>
                </a>
            </li>
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('solicitudes.edit', [$adopcion->id, $solicitud->id]) }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Editar solicitud</span>
                </a>
            </li>
        </ul>
    </div>
</div>
<div class="container4">

    <form action="{{ route('solicitudes.update', [$adopcion->id, $solicitud->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="contenido">Motivo de la Solicitud</label>
            <textarea name="contenido" id="contenido" class="form-control" required maxlength="90">{{ old('contenido', $solicitud->contenido) }}</textarea>
        </div>

        <div class="form-group">
            <label for="experiencia">¿Tiene experiencia previa con mascotas?</label>
            <select name="experiencia" id="experiencia" class="form-control" required>
                <option value="Sí" {{ $solicitud->experiencia == 'Sí' ? 'selected' : '' }}>Sí</option>
                <option value="No" {{ $solicitud->experiencia == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="vivienda">¿Vive en una casa o en un departamento?</label>
            <select name="vivienda" id="vivienda" class="form-control" required>
                <option value="Casa" {{ $solicitud->vivienda == 'Casa' ? 'selected' : '' }}>Casa</option>
                <option value="Departamento" {{ $solicitud->vivienda == 'Departamento' ? 'selected' : '' }}>Departamento</option>
            </select>
        </div>

        <div class="form-group">
            <label for="espacio">¿Tiene suficiente espacio para la mascota?</label>
            <select name="espacio" id="espacio" class="form-control" required>
                <option value="Sí" {{ $solicitud->espacio == 'Sí' ? 'selected' : '' }}>Sí</option>
                <option value="No" {{ $solicitud->espacio == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="otros_animales">¿Hay otros animales en su hogar?</label>
            <select name="otros_animales" id="otros_animales" class="form-control" required>
                <option value="Sí" {{ $solicitud->otros_animales == 'Sí' ? 'selected' : '' }}>Sí</option>
                <option value="No" {{ $solicitud->otros_animales == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>


        <div class="form-group">
            <label for="gastos_veterinarios">¿Está dispuesto a cubrir los gastos veterinarios?</label>
            <select name="gastos_veterinarios" id="gastos_veterinarios" class="form-control" required>
                <option value="Sí" {{ $solicitud->gastos_veterinarios == 'Sí' ? 'selected' : '' }}>Sí</option>
                <option value="No" {{ $solicitud->gastos_veterinarios == 'No' ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="form-group">
            <label for="comprobante">Comprobante: Identidad (opcional)</label>
            <div class="input-file-wrapper">
                <input type="file" name="comprobante" id="comprobante" accept="image/*" onchange="previewComprobante()">
                <label for="comprobante">Seleccionar archivo</label>
            </div>
            <div class="file-info">
                <span>Máximo tamaño: 2MB. Archivos permitidos: .jpeg, .png, .pdf</span>
            </div>

            @if ($solicitud->comprobante)
                <div class="image-preview-container">
                    <img id="comprobante-preview" src="{{ asset('storage/' . $solicitud->comprobante) }}" alt="Vista previa del comprobante">
                    <p class="image-caption">Imagen actual</p>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-success">Actualizar Solicitud</button>
    </form>
</div>

<script src="{{ asset('js/vistapreviaS.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/alerts.js') }}"></script>

</body>
</html>
