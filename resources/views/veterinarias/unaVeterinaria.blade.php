@extends('layout.plantillaSaid')
@section('titulo', 'Detalles de Veterinaria')
@section('contenido')

<div class="card shadow-sm p-4 mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <!-- Título de la veterinaria -->
            <h2 class="card-title fw-bold">{{ $veterinaria->nombre }}</h2>
            <!-- Botón verde -->
            <a href="{{ route('veterinarias.index') }}" class="btn btn-success" role="button" style="font-size: 150%;">
                <i class="fa-solid fa-circle-arrow-left"></i>
            </a>
        </div>
        <div class="row">
            <!-- Información de la veterinaria -->
            <div class="col-md-6">
                <h5 class="card-subtitle mb-3 text-muted"><b>Propietario:</b> {{ $veterinaria->nombre_veterinario }}</h5>
                <p class="card-text">
                    <b>Horario:</b> {{ $veterinaria->horario_apertura }} - {{ $veterinaria->horario_cierre }}<br>
                    <b>Teléfono:</b> {{ $veterinaria->telefono }}<br>
                    <b>Ubicación:</b> {{ $veterinaria->ubicacion->departamento }}, {{ $veterinaria->ubicacion->municipio }}, {{ $veterinaria->ubicacion->ciudad }}<br>
                    <b>Dirección:</b> {{ $veterinaria->ubicacion->direccion }}<br>
                    <b>Evaluación:</b> 
                    @if ($veterinaria->numero_calificaciones > 0)
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fas fa-star {{ $i < $veterinaria->calificacion_promedio ? 'text-warning' : 'text-muted' }}"></i>
                        @endfor
                        <span class="text-secondary">({{ $veterinaria->numero_calificaciones }} valoraciones)</span>
                    @else
                        <span>Sin calificaciones</span>
                    @endif
                </p>
            </div>

            <!-- Mapa -->
            <div class="col-md-6">
                <div id="map" style="height: 320px;"></div>
            </div>
        </div>
    </div>
</div>

<!-- Imágenes de la veterinaria -->
<div class="card shadow-sm p-4 mb-4">
    <div class="card-body">
        <h3 class="card-title mb-3 fw-bold">Imágenes de la Veterinaria</h3>
        <div class="d-flex flex-wrap gap-3">
            @if ($veterinaria->imagenes->isNotEmpty())
                @foreach ($veterinaria->imagenes as $imagen)
                    <div class="image-preview-item">
                        <img src="{{ asset('storage/' . $imagen->path) }}" alt="Imagen de la veterinaria" class="img-thumbnail" style="max-width: 200px; max-height: 200px;">
                    </div>
                @endforeach
            @else
                <p class="text-muted">No hay imágenes disponibles.</p>
            @endif
        </div>
    </div>
</div>
<div class="card shadow-sm p-4 mb-4">
    <div class="card-body">
        <h3 class="card-title mb-3 fw-bold">Calificar y Opinar</h3>
        <form action="{{ route('calificaciones.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_veterinaria" value="{{ $veterinaria->id }}">
            <div class="mb-3">
                <label for="calificacion" class="form-label fw-bold">Calificación:</label>
                <div class="star-rating">
                    @for ($i = 5; $i >= 1; $i--)
                        <input type="radio" id="star{{ $i }}" name="calificacion" value="{{ $i }}" />
                        <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                    @endfor
                </div>
            </div>
            <div class="mb-3">
                <label for="opinion" class="form-label fw-bold">Opinión</label>
                <textarea class="form-control" id="opinion" name="opinion" rows="3" placeholder="Escribe tu opinión aquí..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
            <input class="btn btn-danger" type="reset" value="Limpiar">
        </form>
    </div>
</div>

<div class="card shadow-sm p-4">
    <div class="card-body">
        <h3 class="card-title mb-3 fw-bold">Calificaciones</h3>
        @if ($veterinaria->calificaciones->isEmpty())
            <div class="text-center p-4">
                <p class="text-muted">No hay calificaciones</p>
                <img src="{{ asset('images/vacio.svg') }}" alt="No hay calificaciones" class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
            </div>
        @else
            @foreach ($veterinaria->calificaciones as $calificacion)
                <div class="card mb-3 p-3 border-0 shadow-sm">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/perfil_icon2.jpg') }}" class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                        <div>
                            <h5 class="mb-1 fw-bold">{{ $calificacion->user->name }}</h5>
                            <div class="text-warning">
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star {{ $i < $calificacion->calificacion ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 text-muted">"{{ $calificacion->opinion }}"</p>
                    <div class="text-end text-secondary">
                        <small>{{ $calificacion->created_at->diffForHumans() }}</small>
                    </div>
                        <div class="text-end mt-2">
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $calificacion->id }}">Editar</button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $calificacion->id }}">Eliminar</button>
                        </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@foreach ($veterinaria->calificaciones as $calificacion)
    <div class="modal fade" id="modalEliminar{{ $calificacion->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">¿Desea eliminar esta calificación?</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <form action="{{ route('calificaciones.destroy', $calificacion->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach

<style>
    .star-rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: start;
        gap: 5px;
    }
    .star-rating input {
        display: none;
    }
    .star-rating label {
        font-size: 24px;
        color: #ddd;
        cursor: pointer;
        transition: color 0.3s;
    }
    .star-rating input:checked ~ label,
    .star-rating label:hover,
    .star-rating label:hover ~ label {
        color: #ffc107;
    }
</style>



<script>
    var map = L.map('map').setView([51.505, -0.09], 13); // Coordenadas iniciales (ejemplo en Londres)

    // Cargar los mapas de OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Agregar un marcador
    var marker = L.marker([51.5, -0.09]).addTo(map);

    marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

    // Actualizar las coordenadas al hacer clic en el mapa
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        document.getElementById('latitud').value = lat;
        document.getElementById('longitud').value = lng;
    });
</script>

@endsection