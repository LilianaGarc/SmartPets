@extends('layout.plantilla')
@section('titulo', 'Crear Evento')

@section('contenido')
    <div class="container mt-4">
        <h2>Crear Evento</h2>

        <form action="{{ route('eventos.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" required>
            </div>

            <button type="submit" class="btn btn-success">Crear Evento</button>
            <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Regresar</a>
        </form>
    </div>
@endsection
