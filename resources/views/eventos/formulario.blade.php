@extends('layout.plantillaSaid')
@section('titulo', 'Crear Evento')

@section('contenido')

<div class="container">
    <div class="breadcrumb-container">
        <ul class="breadcrumb">
            <li class="breadcrumb__item">
                <a href="{{ route('index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Inicio</span>
                </a>
            </li>
            <li class="breadcrumb__item">
                <a href="{{ route('eventos.index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Eventos</span>
                </a>
            </li>
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('eventos.create') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Crear Evento</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
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

    <div class="mb-3">
        <label for="imagen" class="form-label">Imagen del Evento</label>
        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
    </div>

    <button type="submit" class="btn btn-success">Crear Evento</button>
    <a href="{{ route('eventos.index') }}" class="btn btn-secondary">Regresar</a>
</form>

@endsection