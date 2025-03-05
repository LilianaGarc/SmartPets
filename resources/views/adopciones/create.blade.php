<!doctype html>
<html lang="en">
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
        Crear una Publicación de Adopción
    </h2>

    <form action="{{ route('adopciones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="contenido">Contenido</label>
            <textarea name="contenido" id="contenido" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
            <div class="file-info">
                <span>Maximo tamaño: 2MB. Archivos permitidos: .jpeg, .png, .pdf</span>
            </div>
        </div>


        <button type="submit" class="btn btn-success">Crear Publicación</button>
    </form>

</div>

</body>
</html>
