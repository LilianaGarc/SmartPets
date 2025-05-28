@extends('layout.plantillaSaid')
@section('titulo', 'Veterinarias')

@section('contenido')

<div class="container">
    <div class="breadcrumb-container">
        <ul class="breadcrumb">
            <li class="breadcrumb__item">
                <a href="{{ route('index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Inicio</span>
                </a>
            </li>
            <li class="breadcrumb__item breadcrumb__item-active">
                <a href="{{ route('veterinarias.index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Veterinarias</span>
                </a>
            </li>
            @if (auth()->check())
            <li class="breadcrumb__item">
                @if (auth()->check())
                <a href="{{ route('veterinarias.create') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Crear Veterinaria</span>
                </a>
                @endif
            </li>
            @endif
        </ul>
    </div>
</div>

<div class="container-fluid pb-4">

    @if(session('exito'))
    <div class="alert alert-success mt-2" role="alert">
        <div class="d-flex gap-4">
            <span><i class="fa-solid fa-circle-check icon-success"></i></span>
            <div>
                {{ session('exito') }}
            </div>
        </div>
    </div>

    @endif

    @if(session('fracaso'))
    <div class="alert alert-danger mt-1" role="alert">
        <div class="d-flex gap-4">
            <span><i class="fa-solid fa-circle-xmark icon-danger"></i></span>
            <div>
                {{ session('fracaso') }}
            </div>
        </div>
    </div>
    @endif

    @if($veterinarias->isEmpty())
    <div class="card h-100 shadow-sm border p-5">
        <div class="text-center p-4 p-md-5">
            <p class="text-muted mb-3 fs-5">No hay veterinarias registradas</p>
            <img src="{{ asset('images/vacio.svg') }}" alt="No hay veterinarias" class="mx-auto d-block img-fluid" style="width: 150px; max-width: 200px; opacity: 0.7;">
        </div>
    </div>
    @else

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mt-2">
        @foreach ($veterinarias as $veterinaria)
        @php
        $imagen = $veterinaria->imagenes->first();
        @endphp

        <div class="col mb-4">
            <div class="card h-100 shadow-sm border vet-anim">
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
                    <h4 class="card-title d-flex align-items-center justify-content-between">
                        <span>{{ $veterinaria->nombre }}</span>
                        <span class="badge bg-success ms-2" style="font-size: 1rem;">
                            {{ number_format($veterinaria->calificacion_promedio, 1) }}
                        </span>
                    </h4>

                    <div class="card-text">
                        <div class="mt-1"><b>Horario:</b> {{ $veterinaria->horario_apertura }} - {{ $veterinaria->horario_cierre }}</div>
                        <div class="mt-1"><b>Teléfono:</b> {{ $veterinaria->telefono }}</div>
                        <div class="mt-1"><b>Dirección: </b>{{ $veterinaria->ubicacion->direccion }}</div>
                    </div>

                    <div class="mt-1 d-flex gap-2 mt-3">
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

                        @if(auth()->id() === $veterinaria->id_user)
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i> Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('veterinarias.edit', $veterinaria->id) }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('veterinarias.destroy', $veterinaria->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar esta veterinaria?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-trash"></i> Borrar
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                        @endif
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

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card.vet-anim {
        animation: fadeInUp 0.7s cubic-bezier(.39, .575, .565, 1) both;
    }

    .card.vet-anim:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .btn-secondary .fa-cog {
        transition: transform 0.3s;
    }

    .btn-secondary:hover .fa-cog {
        transform: rotate(90deg);
    }

    @keyframes pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.5);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);
        }
    }

    .badge.bg-success {
        animation: pulse 2s infinite;
    }
</style>
@include('chats.chat-float')
@endsection
