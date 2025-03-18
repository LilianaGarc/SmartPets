@extends('layout.plantilla')
@section('titulo', 'Detalles de Veterinaria')
@section('contenido')
<a href="{{ route('veterinarias.index') }}" class="btn btn-success">
    <i class="fas fa-arrow-left"></i> Volver
</a>
<br>
<br>
<div class="card shadow-sm p-4 mn-4">
    <div class="card-body">
        <h3 class="card-title fw-bold">{{ $veterinaria->nombre }}</h3>
        <h6 class="card-subtitle mb-3 text-muted"><b>Propietario:</b>{{ $veterinaria->nombre_veterinario }}</h6>
        <p class="card-text">
            <b>Horario:</b> {{ $veterinaria->horario_apertura }} - {{ $veterinaria->horario_cierre }}<br>
            <b>Telefono:</b> {{ $veterinaria->telefono }}<br>
            <b>Ubicacion:</b> {{ $veterinaria->ubicacion->departamento }}, {{ $veterinaria->ubicacion->municipio }}, {{ $veterinaria->ubicacion->ciudad }}<br>
            <b>Dirección:</b> {{ $veterinaria->ubicacion->direccion }}<br>
            <b>Evaluación:</b>
            @for ($i = 0; $i < 5; $i++)
                <i class="fas fa-star {{ $i < $veterinaria->calificacion_promedio ? 'text-warning' : 'text-muted' }}"></i>
                @endfor
                <span class="text-secondary">({{ $veterinaria->numero_calificaciones }} valoraciones)</span>
        </p>
    </div>
</div>
<br>
<div class="card shadow-sm p-4">
    <div class="card-body">
        <h3 class="card-title mb-3 fw-bold">Calificar y Opinar</h3>
        <form action="{{ route('calificaciones.store') }}" method="POST">
            @csrf
            <input type="hidden" name="id_veterinaria" value="{{ $veterinaria->id }}">
            <div class="mb-0">
                <label for="calificacion" class="form-label fw-bold">Calificación:</label>
            </div>
            <div class="star-rating">
                @for ($i = 5; $i >= 1; $i--)
                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}">
                <label for="star{{ $i }}" class="bi bi-star-fill"></label>
                @endfor
            </div>
            <div class="mb-3">
                <label for="opinion" class="form-label fw-bold">Opinión</label>
                <textarea class="form-control" id="opinion" name="opinion" rows="3" placeholder="Escribe tu opinión aquí..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</div>
<br>
<div class="card shadow-sm p-4">
    <div class="card-body">
        <h3 class="card-title mb-3 fw-bold">Calificaciones</h3>
        <ul class="liste-none flex flex-col w-full divide-y divide-gray-200 dark:divide-gray-700">
            <li class="flex flex-row w-full">
                <div class="flex items-center flex-1 p-4 cursor-pointer select-none w-full">
                    @if ($veterinaria->calificaciones->isEmpty())
                    <div class="flex items
                    -center justify-center w-10 h-10 mr-4">
                        <i class="fas fa-info-circle text-warning"></i>
                    </div>
                    <div class="flex-1 pl-1">
                        <div class="font-medium">
                            No hay calificaciones
                        </div>
                    </div>
                    @endif
                    <div class="flex flex-col items-center justify-center w-10 h-10 mr-4">
                        @foreach ($veterinaria->calificaciones as $calificacion)
                        <a href="#" class="relative block">
                            <img alt="profil" src="#" class="mx-auto object-cover rounded-full h-25 w-25" />
                        </a>
                    </div>
                    <div class="flex-1 pl-1">
                        <div class="font-medium">
                            {{ $calificacion->user->name }}
                        </div>
                        <div class="text-sm text-gray-600">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fas fa-star {{ $i < $veterinaria->evaluacion ? 'text-warning' : 'text-muted' }}"></i>
                                @endfor
                        </div>
                    </div>
                    <div class="text-xs text-gray-600">
                        {{ $calificacion->created_at->diffForHumans() }}
                    </div>
                    <button class="flex justify-end w-24 text-right">
                    </button>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>

<style>
    .star-rating {
        direction: rtl;
        display: inline-block;
        cursor: pointer;
    }

    .star-rating input {
        display: none;
    }

    .star-rating label {
        color: #ddd;
        font-size: 24px;
        padding: 0 2px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .star-rating label:hover,
    .star-rating label:hover~label,
    .star-rating input:checked~label {
        color: #ffc107;
    }
</style>

<script>
    document.querySelectorAll('.star-rating:not(.readonly) label').forEach(star => {
        star.addEventListener('click', function() {
            this.style.transform = 'scale(1.2)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 200);
        });
    });
</script>
@endsection