@extends('layout.plantillaSaid')
@section('titulo', 'Detalles de Veterinaria')
@section('contenido')

<div class="card shadow-sm p-4 mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="card-title fw-bold">{{ $veterinaria->nombre }}</h2>
            <a href="{{ route('veterinarias.index') }}" class="btn btn-success" role="button" style="font-size: 150%;">
                <i class="fa-solid fa-circle-arrow-left"></i>
            </a>
        </div>
        <h5 class="card-subtitle mb-3 text-muted"><b>Propietario:</b> {{ $veterinaria->nombre_veterinario }}</h5>
        <p class="card-text">
            <b>Horario:</b> {{ $veterinaria->horario_apertura }} - {{ $veterinaria->horario_cierre }}<br>
            <b>Teléfono:</b> {{ $veterinaria->telefono }}<br>
            <b>Ubicación:</b> {{ $veterinaria->ubicacion->departamento }}, {{ $veterinaria->ubicacion->municipio }}, {{ $veterinaria->ubicacion->ciudad }}<br>
            <b>Dirección:</b> {{ $veterinaria->ubicacion->direccion }}<br>
            <b>Evaluación:</b> 
            @for ($i = 0; $i < 5; $i++)
                <i class="fas fa-star {{ $i < $veterinaria->calificacion_promedio ? 'text-warning' : 'text-muted' }}"></i>
            @endfor
            <span class="text-secondary">({{ $veterinaria->numero_calificaciones }} valoraciones)</span>
        </p>
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
                        <input type="radio" id="star{{ $i }}" name="calificacion" value="{{ $i }}">
                        <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                    @endfor
                </div>
            </div>
            <div class="mb-3">
                <label for="opinion" class="form-label fw-bold">Opinión</label>
                <textarea class="form-control" id="opinion" value="{{ isset($calificaciones) }}" name="opinion" rows="3" placeholder="Escribe tu opinión aquí..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary" href>Enviar</button>
            <input class="btn btn-danger" type="reset" value="Limpiar">
        </form>
    </div>
</div>

<div class="card shadow-sm p-4">
    <div class="card-body">
        <h3 class="card-title mb-3 fw-bold">Calificaciones</h3>
        <ul class="list-none flex flex-col w-full divide-y divide-gray-200 divide-gray-700">
            @if ($veterinaria->calificaciones->isEmpty())
                    <div class="flex items-center flex-1 p-4 cursor-pointer select-none w-full">
                        <div class="flex items-center justify-center w-10 h-10 mr-4">
                            <p class="text-muted text-center">No hay calificaciones</p>
                            <br>
                            <img src="images//vacio.svg" alt="No hay califcaciones" class="mx-auto d-block mt-2" style="width: 150px; opacity: 0.7;">
                        </div>
                    </div>
            @else
                @foreach ($veterinaria->calificaciones as $calificacion)
                    <li class="flex flex-row w-full">
                        <div class="flex items-center flex-1 p-4 cursor-pointer select-none w-full">
                            <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                                <a href="#" class="relative block">
                                    <img alt="perfil" src="#" class="mx-auto object-cover rounded-full h-25 w-25" />
                                </a>
                            </div>
                            <div class="flex-1 pl-1">
                                <div class="font-medium">{{ $calificacion->user->name }}</div>
                                <div class="text-sm text-gray-600">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star {{ $i < $calificacion->calificacion ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>
                                <p class="text-sm text-gray-700">{{ $calificacion->opinion }}</p>
                            </div>
                            <div class="text-xs text-gray-600">
                                {{ $calificacion->created_at->diffForHumans() }}
                            </div>

                            @if(auth()->check() && (auth()->user()->id == $calificacion->user_id || auth()->user()->is_admin))
                                <div class="flex space-x-2">
                                    <!-- Botón Editar -->
                                    <a href="{{ route('calificaciones.edit', $calificacion->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                    <!-- Botón Eliminar -->
                                    <form action="{{ route('calificaciones.destroy', $calificacion->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta calificación?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</div>


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
    document.querySelectorAll('.star-rating label').forEach(star => {
        star.addEventListener('click', function() {
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
    });
</script>

@endsection
