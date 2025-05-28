@extends('layout.plantillaSaid')
@section('titulo', 'Lista de Eventos')

@section('contenido')
    @if(session('exito'))
        <div class="alert alert-success" role="alert">
            {{ session('exito') }}
        </div>
    @endif

    @if(session('fracaso'))
        <div class="alert alert-danger" role="alert">
            {{ session('fracaso') }}
        </div>
    @endif

    <h1 class="mb-8"> Eventos
        <a class="btn btn-primary float-end" href="{{ route('eventos.create') }}">Nuevo Evento</a>
        <br>
    </h1>

    <form method="GET" action="{{ route('eventos.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Buscar eventos..." value="{{ request('q') }}">
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </div>
    </form>

    <div class="row">
        @forelse ($eventos as $evento)
            <div class="col-md-4">
                <div class="card mb-4">
                    @if ($evento->imagen)
                        <img src="{{ asset('storage/' . $evento->imagen) }}" class="card-img-top" alt="Imagen del evento">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($evento->descripcion, 100) }}</p>
                        <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
                        <p><strong>Teléfono:</strong> {{ $evento->telefono }}</p>
                        <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-info">Ver</a>
                        <div class="d-flex justify-content-start mt-2">
                            <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-warning me-2">Editar</a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $evento->id }}">
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="modalEliminar{{ $evento->id }}" tabindex="-1" aria-labelledby="modalEliminarLabel{{ $evento->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEliminarLabel{{ $evento->id }}">Eliminar Evento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar el evento "{{ $evento->titulo }}"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form method="POST" action="{{ route('eventos.destroy', $evento->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">No se encontraron eventos.</div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center">
        {{ $eventos->links('pagination::bootstrap-5') }}
    </div>
    @include('chats.chat-float')
@endsection
