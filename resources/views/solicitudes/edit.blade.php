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
        <a href="{{ route('solicitudes.show', ['id_adopcion' => $adopcion->id]) }}" class="btn-volver" style="text-decoration: none;">
            <i class="fas fa-arrow-left" style="color: #ff7f50; font-size: 24px;"></i>
        </a>
        Editar Solicitud
    </h2>

    <form action="{{ route('solicitudes.update', [$adopcion->id, $solicitud->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="contenido">Contenido:</label>
            <textarea name="contenido" id="contenido" rows="4">{{ old('contenido', $solicitud->contenido) }}</textarea>
        </div>

        <div class="form-group">
            <label for="comprobante">Comprobante:</label>

            <input type="file" name="comprobante" id="comprobante">
            <div class="file-info">
                <span>Maximo tamaño: 2MB. Archivos permitidos: .jpeg, .png, .pdf</span>
            </div>
            @if ($solicitud->comprobante)
                <a href="{{ asset('storage/' . $solicitud->comprobante) }}" target="_blank" class="">Ver comprobante actual</a>
            @endif

        </div>


        <button type="submit" class="btn-enviar">Actualizar Solicitud</button>
    </form>
</div>

</body>
</html>
