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
        Solicitudes para la adopción
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

    @if(session('fracaso'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: '{{ session('fracaso') }}',
                    confirmButtonColor: '#ff7f50',
                });
            });
        </script>
    @endif

    <div class="solicitudes-container">
        @foreach($solicitudes as $solicitud)
            <div class="solicitud-card">
                <div class="content-wrapper">
                    <p class="solicitud-text">{{ $solicitud->contenido }}</p>
                    <div class="tooltip">
                        <a href="{{ route('solicitudes.showDetails', [$adopcion->id, $solicitud->id]) }}" class="btn-view">
                            <i class="fas fa-eye"></i>
                        </a>
                        <span class="tooltiptext">Ver solicitud</span>
                    </div>

                    <div class="tooltip">
                        <a href="{{ route('solicitudes.edit', [$adopcion->id, $solicitud->id]) }}" class="btn-editar">
                            <i class="fas fa-edit"></i>
                        </a>
                        <span class="tooltiptext">Editar solicitud</span>
                    </div>

                    <div class="tooltip">
                        <form action="{{ route('solicitudes.destroy', [$adopcion->id, $solicitud->id]) }}" method="POST" id="delete-form-{{$solicitud->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn-eliminar" onclick="confirmDeleteSolicitud({{$adopcion->id}}, {{$solicitud->id}})">
                                <i class="fas fa-trash"></i>
                            </button>
                            <span class="tooltiptext">Eliminar solicitud</span>
                        </form>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="{{ asset('js/alerts.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
