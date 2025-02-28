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
            <i class="fas fa-arrow-left" style="color: #ff7f50; font-size: 24px; "></i>
        </a>
        Solicitud de Adopción de Mascota
    </h2>

    <form action="{{ route('solicitudes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="contenido">Motivo de la Solicitud</label>
            <textarea name="contenido" id="contenido" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="comprobante">Comprobante: Identidad (opcional)</label>
            <input type="file" name="comprobante" id="comprobante" class="form-control" accept="image/*">
        </div>

        <input type="hidden" name="id_adopcion" value="{{ $adopcion->id }}">

        <button type="submit" class="btn btn-success">Enviar Solicitud</button>
    </form>





</div>

</body>
</html>
