@extends('layout.plantilla')
@section('titulo', 'Detalles del Evento')

@section('contenido')
    <a href="{{ route('eventos.index') }}" class="btn btn-success">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
    <br><br>

    <div class="row">
        <div class="col-md-6">
            <div class="card" style="width: 100%;">
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
        </div>


        <div class="col-md-6">
            <h3>Eventos Similares</h3>
            <div class="row">
                @foreach ($eventosRecomendados as $eventoRec)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            @if ($eventoRec->imagen)
                                <img src="{{ asset('storage/' . $eventoRec->imagen) }}" class="card-img-top" alt="Imagen del evento">
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $eventoRec->titulo }}</h6>
                                <h6 class="card-body"> fecha: {{$eventoRec->fecha}}</h6>
                                <a href="{{ route('eventos.show', $eventoRec->id) }}" class="btn btn-sm btn-info">Ver</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
