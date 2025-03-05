@extends('layout.plantilla')
@section('titulo', 'Detalles del Evento')

@section('contenido')
    <a href="{{ route('eventos.index') }}" class="btn btn-success">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
    <br><br>

    <div class="card" style="width: 25rem;">
        @if ($evento->imagen)
            <img src="{{ asset('storage/' . $evento->imagen) }}" class="card-img-top" alt="Imagen del evento">
        @endif
        <div class="card-body">
            <h5 class="card-title">{{ $evento->titulo }}</h5>
            <p class="card-text">
                <strong>Descripción:</strong> {{ $evento->descripcion }} <br>
                <strong>Fecha:</strong> {{ $evento->fecha }} <br>
                <strong>Teléfono:</strong> {{ $evento->telefono }}
            </p>

            <form action="{{ route('eventos.participar', $evento->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Participar</button>
            </form>
        </div>
    </div>
@endsection
