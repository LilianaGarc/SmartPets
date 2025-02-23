@extends('layout.plantilla')

@section('titulo', 'Creación de Veterinaria')

@section('contenido')
<br>
<a href="{{ route('veterinarias.index') }}" class="btn btn-success">
   <i class="fas fa-arrow-left"></i> Volver
</a>
<br>
@if(isset($veterinaria))
<h1>Editar Veterinaria</h1>
@else
<h1>Creación de Veterinaria</h1>
@endif

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
                <input type="time" class="form-control" id="horario_apertura" placeholder="Horario" name="horario_apertura"
                    value="{{ isset($veterinaria) ? $veterinaria->horario_apertura : old('horario_apertura') }}" step="1800">
                <label for="horario_apertura">Hora de Apertura</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="time" class="form-control" id="horario_cierre" placeholder="Horario" name="horario_cierre"
                    value="{{ isset($veterinaria) ? $veterinaria->horario_cierre : old('horario_cierre') }}" step="1800">
                <label for="horario_cierre">Hora de Cierre</label>
            </div>
        </div>
    </div>
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
    <div class="row g-3">
        <div class="col">
            <div class="form-floating mb-3">
                <select class="form-select" id="departamento" name="departamento">
                    <option value="">Seleccione un departamento</option>
                    @foreach ($departamentos as $dep)
                    <option value="{{ $dep }}"
                        @if(isset($veterinaria))
                        {{ $veterinaria->departamento == $dep ? 'selected' : '' }}
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
                <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="ciudad" value="{{ isset($veterinaria) ? $veterinaria->ciudad : old('ciudad') }}">
                <label for="ciudad">Ciudad</label>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="municipio" placeholder="Municipio" name="municipio" value="{{ isset($veterinaria) ? $veterinaria->municipio : old('municipio') }}">
                <label for="municipio">Municipio</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="direccion" placeholder="Dirección" name="direccion" value="{{ isset($veterinaria) ? $veterinaria->direccion : old('direccion') }}">
                <label for="direccion">Dirección</label>
            </div>
        </div>
    </div>
    <div id="redes-sociales-container" class="row g-3">
        <!-- Aquí se agregarán dinámicamente las redes -->
    </div>
    <br>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-primary" onclick="agregarRed()">+ Agregar Red Social</button>
    </div>
    <br>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <input class="btn btn-danger" type="reset" value="Limpiar">
</form>

<!-- Script para manejar las redes sociales -->
<script>
    /*let redesGuardadas = @json(old('redes_sociales', $veterinaria->redes_sociales ?? []));*/
    function agregarRed(red = '', usuario = '') {
        let container = document.getElementById('redes-sociales-container');


        let div = document.createElement('div');
        div.classList.add('d-flex', 'gap-2', 'mb-2', 'align-items-center');

        let select = document.createElement('select');
        select.classList.add('form-select');
        select.name = "redes_sociales[][red]";
        select.innerHTML = `
            <option value="">Seleccione una red</option>
            <option value="facebook" ${red === 'facebook' ? 'selected' : ''}>Facebook</option>
            <option value="instagram" ${red === 'instagram' ? 'selected' : ''}>Instagram</option>
            <option value="tiktok" ${red === 'tiktok' ? 'selected' : ''}>TikTok</option>
        `;

        let input = document.createElement('input');
        input.type = "text";
        input.classList.add('form-control');
        input.placeholder = "Nombre de usuario";
        input.name = "redes_sociales[][usuario]";
        input.value = usuario;


        let btnEliminar = document.createElement('button');
        btnEliminar.type = "button";
        btnEliminar.classList.add('btn', 'btn-danger');
        btnEliminar.innerText = "X";
        btnEliminar.onclick = function() {
            container.removeChild(div);
        };

        div.appendChild(select);
        div.appendChild(input);
        div.appendChild(btnEliminar);
        container.appendChild(div);
    }

    // Si estamos editando, recuperar las redes guardadas
    window.onload = function() {
        if (redesGuardadas.length > 0) {
            redesGuardadas.forEach(red => {
                agregarRed(red.red, red.usuario);
            });
        }
    };
</script>
@endsection