@extends('layout.plantillaSaid')
@section('titulo', 'Veterinarias')
@section('contenido')

<div class="container-fluid pb-4">

    @if(session('exito'))
    <div class="alert alert-success" role="alert">
        <div class="d-flex gap-4">
            <span><i class="fa-solid fa-circle-check icon-success"></i></span>
            <div>
                {{ session('exito') }}
            </div>
        </div>
    </div>

    @endif

    @if(session('fracaso'))
    <div class="alert alert-danger" role="alert">
        <div class="d-flex gap-4">
            <span><i class="fa-solid fa-circle-xmark icon-danger"></i></span>
            <div>
                {{ session('fracaso') }}
            </div>
        </div>
    </div>
    @endif

    <h1 class="d-flex justify-content-between align-items-center mb-2 text-center"><b>Veterinarias</b>
        <a class="btn btn-primary py-1 px-2 d-flex align-items-center" href="{{ route('veterinarias.create') }}" style="font-size: 45%;">
            <img src="images/Crear_Veterinaria.svg" alt="Crear Veterinaria" width="28px" height="28px" class="me-1">Nuevo
        </a>
    </h1>

    @if($veterinarias->isEmpty())
        <div class="card h-100 shadow-sm border p-5">
            <div class="text-center p-4 p-md-5">
                <p class="text-muted mb-3 fs-5">No hay veterinarias registradas</p>
                <img src="{{ asset('images/vacio.svg') }}" alt="No hay veterinarias" class="mx-auto d-block img-fluid" style="width: 150px; max-width: 200px; opacity: 0.7;">
            </div>
        </div>
    @else

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($veterinarias as $veterinaria)
        @php
        $imagen = $veterinaria->imagenes->first();
        @endphp

        <div class="col mb-4">
            <div class="card h-100 shadow-sm border">
                @if ($imagen)
                <img src="{{ asset('storage/' . $imagen->path) }}"
                    alt="Veterinaria {{ $veterinaria->nombre }}"
                    class="card-img-top"
                    style="max-height: 300px ; object-fit: cover;">
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                    <p class="text-muted m-0">No hay imágenes disponibles</p>
                </div>
                @endif

                <div class="card-body">
                    <h4 class="card-title">{{ $veterinaria->nombre }}</h4>
                    <div class="card-text">
                        <div class="mt-1"><b>Horario:</b> {{ $veterinaria->horario_apertura }} - {{ $veterinaria->horario_cierre }}</div>
                        <div class="mt-1"><b>Teléfono:</b> {{ $veterinaria->telefono }}</div>
                        <div class="mt-1"><b>Dirección: </b>{{ $veterinaria->ubicacion->direccion }}</div>
                        <span class="badge bg-success me-2">{{ number_format($veterinaria->calificacion_promedio, 1) }}</span> 
                    </div>
                        <div class="mt-1 d-flex gap-2">
                            @if($veterinaria->whatsapp)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $veterinaria->whatsapp) }}"
                                target="_blank"
                                class="btn btn-success d-flex align-items-center gap-2">
                                <i class="fab fa-whatsapp"></i>
                                Contactar
                            </a>
                            @endif
                            <a href="{{ route('veterinarias.show', $veterinaria->id) }}"
                                class="btn btn-primary d-flex align-items-center gap-2">
                                <i class="fas fa-info-circle"></i>
                                Ver más
                            </a>
                        </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="d-flex justify-content-center">
        {{ $veterinarias->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection