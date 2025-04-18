<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

</head>
<body>
@include('MenuPrincipal.Navbar')
<div class="perfil">
    <div class="cabecera">
        <img src="{{ $user->fotoperfil ? asset('storage/' . $user->fotoperfil) : asset('images/fotodeperfil.webp') }}" alt="Foto de perfil" class="foto-perfil"/>
        <div class="info">
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->email }}</p>
            <div class="acciones">
                <form action="{{ route('perfil.actualizarFoto') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="fotoInput" class="btn-actualizar-foto">Actualizar foto de perfil</label>
                    <input type="file" name="fotoperfil" id="fotoInput" accept="image/*" onchange="this.form.submit()" hidden>
                </form>
                <i data-lucide="settings" class="icono"></i>
            </div>
        </div>
    </div>

    <div class="tabs">
        <button class="tab activo" onclick="cambiarTab('publicaciones')">Publicaciones</button>
        <button class="tab" onclick="cambiarTab('adopciones')">Adopciones</button>
        <button class="tab" onclick="cambiarTab('veterinarias')">Veterinarias</button>
        <button class="tab" onclick="cambiarTab('eventos')">Eventos</button>
        <button class="tab" onclick="cambiarTab('mascota')">Mascota Ideal</button>
        <button class="tab" onclick="cambiarTab('petshop')">Petshop</button>
    </div>

    <div class="contenido">
        <div id="publicaciones" class="grid activo">
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
            <div class="card"></div>
        </div>

        <div id="adopciones" class="grid">
            @if($adopciones->isEmpty())
                <div class="no-hay" style="grid-column: 1 / -1; text-align: center; padding: 40px 10px;">
                    <p class="no-hay-message" style="font-size: 18px;">¡No has publicado adopciones aún! 😿</p>
                    <img src="{{ asset('images/vacio.svg') }}" alt="No hay adopciones" style="width: 150px; opacity: 0.7; margin-top: 10px;">
                </div>
            @else
                @foreach($adopciones as $adopcion)
                    @if($adopcion->imagen)
                        <div class="card">
                            <a href="{{ route('adopciones.show', $adopcion->id) }}">
                                <img src="{{ asset('storage/' . $adopcion->imagen) }}" alt="Adopción" class="img-card">
                            </a>
                            <p class="contador-visitas">
                                <i class="fas fa-eye"></i> {{ $adopcion->visibilidad }}
                            </p>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>


        <div id="veterinarias" class="grid"></div>
        <div id="eventos" class="grid"></div>
        <div id="mascota" class="grid"></div>
        <div id="petshop" class="grid"></div>
    </div>
</div>

<script>
    function cambiarTab(tabId) {
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('activo'));
        document.querySelectorAll('.grid').forEach(grid => grid.classList.remove('activo'));
        document.getElementById(tabId).classList.add('activo');
        event.target.classList.add('activo');
    }

    lucide.createIcons();
</script>
</body>
</html>
