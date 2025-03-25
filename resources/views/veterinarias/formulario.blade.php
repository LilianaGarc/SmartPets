@extends('layout.plantillaSaid')

@section('titulo', 'Creación de Veterinaria')

@section('contenido')
<br>

<div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-0">
        @if(isset($veterinaria))
        Editar Veterinaria
        @else
        Creación de Veterinaria
        @endif
    </h1>
    <a href="{{ route('veterinarias.index') }}" class="btn btn-success" role="button" style="font-size: 150%;">
        <h7><i class="fa-solid fa-circle-arrow-left"></i></h7>
    </a>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="post"
    @if (isset($veterinaria))
    action="{{ route('veterinarias.update', ['id'=>$veterinaria->id]) }}"
    @else
    action="{{ route('veterinarias.store') }}"
    @endif>
    @isset($veterinaria)
    @method('put')
    @endisset
    @csrf
    <br>

    <div class="col">
        <div class="form-floating">
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="{{ isset($veterinaria) ? $veterinaria->nombre : old('nombre') }}">
            <label for="nombre">Nombre</label>
        </div>
    </div>
    <br>
    <div class="col">
        <div class="form-floating">
            <input type="text" class="form-control" id="nombre_veterinario" placeholder="Nombre del Veterinario" name="nombre_veterinario" value="{{ isset($veterinaria) ? $veterinaria->nombre_veterinario : old('nombre_veterinario') }}">
            <label for="nombre_veterinario">Propietario</label>
        </div>
    </div>
    <br>
    <div class="row g-3">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="telefono" placeholder="Número de teléfono" name="telefono"
                    value="{{ isset($veterinaria) ? $veterinaria->telefono : old('telefono') }}">
                <label for="telefono">Número de teléfono</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="tel" class="form-control" id="whatsapp" placeholder="Número de WhatsApp" name="whatsapp" value="{{ isset($veterinaria) ? $veterinaria->whatsapp : old('whatsapp') }}">
                <label for="whatsapp">Número de WhatsApp</label>
            </div>
        </div>
    </div>
    @php
    $departamentos = [
    'Atlántida', 'Choluteca', 'Colón', 'Comayagua', 'Copán', 'Cortés',
    'El Paraíso', 'Francisco Morazán', 'Gracias a Dios', 'Intibucá',
    'Islas de la Bahía', 'La Paz', 'Lempira', 'Ocotepeque', 'Olancho',
    'Santa Bárbara', 'Valle', 'Yoro'
    ];
    @endphp
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="form-floating mb-3">
                <input type="time" class="form-control" id="horario_apertura" placeholder="Horario" name="horario_apertura"
                    value="{{ isset($veterinaria) ? $veterinaria->horario_apertura : old('horario_apertura') }}" step="1800">
                <label for="horario_apertura">Hora de Apertura</label>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="form-floating mb-3">
                <input type="time" class="form-control" id="horario_cierre" placeholder="Horario" name="horario_cierre"
                    value="{{ isset($veterinaria) ? $veterinaria->horario_cierre : old('horario_cierre') }}" step="1800">
                <label for="horario_cierre">Hora de Cierre</label>
            </div>
        </div>
        <div class="col-md-6 mb-6">
            <div class="form-floating mb-3">
                <select class="form-select" id="departamento" name="departamento">
                    <option value="">Seleccione un departamento</option>
                    @foreach ($departamentos as $dep)
                    <option value="{{ $dep }}"
                        @if(isset($veterinaria->ubicacion))
                        {{ $veterinaria->ubicacion->departamento == $dep ? 'selected' : '' }}
                        @else
                        {{ old('departamento') == $dep ? 'selected' : '' }}
                        @endif>
                        {{ $dep }}
                    </option>
                    @endforeach
                </select>
                <label for="departamento">Departamento</label>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-3">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="ciudad" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->ciudad : old('ciudad') }}">
                <label for="ciudad">Ciudad</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="municipio" placeholder="Municipio" name="municipio" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->municipio : old('municipio') }}">
                <label for="municipio">Municipio</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="direccion" placeholder="Dirección" name="direccion" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->direccion : old('direccion') }}">
                <label for="direccion">Dirección</label>
            </div>
        </div>
    </div>
    <div class="mb-3">
            <label for="imagen" class="form-label">Imagenes de la Veterinaria</label>
            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
        </div>
    <br>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <input class="btn btn-danger" type="reset" value="Limpiar">
</form>
@endsection