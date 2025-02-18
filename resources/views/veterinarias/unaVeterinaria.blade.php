@extends('layout.plantilla')
@section('titulo', 'Detalles de Veterinaria')
@section('contenido')
<a href="{{ route('veterinarias.index') }}" class="btn btn-success">
   <i class="fas fa-arrow-left"></i> Volver
</a>
<br>
<br>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">Datos de {{ $veterinaria->nombre }}</h5>
        <h6 class="card-subtitle mb-2 text-body-secondary">Propietario:{{ $veterinaria->nombre_veterinario }}</h6>
        <p class="card-text">Horario de Apertura: {{ $veterinaria->horario_apertura }}
            <br>Horario de Cierre: {{ $veterinaria->horario_cierre }}
            <br>Telefono: {{ $veterinaria->telefono }}
            <br>Dirección: {{ $veterinaria->direccion }}, 
            <br>Evaluación: {{ $veterinaria->evaluacion }}
        </p>
        <a href="#" class="card-link">Card link</a>
        <a href="#" class="card-link">Another link</a>
    </div>
@endsection