@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('solicitudes.panelstore') }}">
        @csrf

        <div class="card-body">
            <h4>
                <a href="{{ route('solicitudes.panel') }}" class="btn" role="button">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <strong>Crear nueva solicitud</strong>
            </h4>
            <hr>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título de la solicitud" value="{{ old('titulo') }}" required>
                <label for="titulo">Título de la solicitud</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="solicitante" name="solicitante" placeholder="Nombre del solicitante" value="{{ old('solicitante') }}" required>
                <label for="solicitante">Nombre del solicitante</label>
            </div>

            <div class="form-floating mb-3">
                <select class="form-select" id="tipo" name="tipo" required>
                    <option value="" disabled selected>Selecciona el tipo</option>
                    <option value="adopcion" {{ old('tipo') == 'adopcion' ? 'selected' : '' }}>Adopción</option>
                    <option value="consulta" {{ old('tipo') == 'consulta' ? 'selected' : '' }}>Consulta</option>
                    <option value="otro" {{ old('tipo') == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
                <label for="tipo">Tipo de solicitud</label>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
    </form>

@endsection
