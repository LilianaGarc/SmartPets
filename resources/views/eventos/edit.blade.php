@extends('layout.plantillaSaid')

@section('titulo', 'Editar Evento')

@section('contenido')

    

    <div class="container mt-4">
        <h2>Editar Evento</h2>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('eventos.update', $evento->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="{{ $evento->titulo }}" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $evento->descripcion }}</textarea>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ $evento->fecha }}" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $evento->telefono }}" required>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen del Evento</label>
                <input type="file" class="form-control" id="imagen" name="imagen">
            </div>

            @if($evento->imagen)
                <div class="mb-3">
                    <label>Imagen Actual:</label>
                    <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen del evento" class="img-fluid" style="max-width: 200px;">
                </div>
            @endif

            <button type="submit" class="btn btn-warning">Actualizar Evento</button>
            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
