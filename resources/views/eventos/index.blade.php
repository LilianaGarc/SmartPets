@extends('layout.plantilla')
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

    <h1 class="mb-4">Lista de Eventos
        <a class="btn btn-primary float-end" href="{{ route('eventos.create') }}">Nuevo Evento</a>
    </h1>

    <div class="row">
        @foreach ($eventos as $evento)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->titulo }}</h5>
                        <p class="card-text">{{ Str::limit($evento->descripcion, 100) }}</p>
                        <p><strong>Fecha:</strong> {{ $evento->fecha }}</p>
                        <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-warning">Editar</a>
                        <!-- Botón de eliminar con modal -->
                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $evento->id }}">
                            Eliminar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal de confirmación para eliminar -->
            <div class="modal fade" id="modalEliminar{{$evento->id}}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Eliminar {{ $evento->titulo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de eliminar este evento?
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

        @endforeach
    </div>
//Codigo para la paginacion
    <div class="d-flex justify-content-center">
        {{ $eventos->links('pagination::bootstrap-5') }}
    </div>
@endsection
