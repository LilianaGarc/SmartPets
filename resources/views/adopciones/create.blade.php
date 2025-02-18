<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
@include('MenuPrincipal.Navbar')

<div class="container">
    <h2>Crear una Publicación de Adopción</h2>

    <form action="{{ route('adopciones.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="contenido">Contenido</label>
            <textarea name="contenido" id="contenido" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control" accept="image/*">
        </div>

        <button type="submit" class="btn btn-success">Crear Publicación</button>
    </form>

</div>

</body>
</html>
