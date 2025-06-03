@extends('layout.plantillaSaid')
@section('titulo', 'Eventos')

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
                <a href="{{ route('eventos.index') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Eventos</span>
                </a>
            </li>
            @if (auth()->check())
            <li class="breadcrumb__item">
                <a href="{{ route('eventos.create') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Crear Evento</span>
                </a>
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

    <form method="GET" action="{{ route('eventos.index') }}" class="mb-4{{ session('exito') || session('fracaso') ? '' : ' mt-4' }}">
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Buscar eventos..." value="{{ request('q') }}">
            <button type="submit" class="btn btn-outline-primary">Buscar</button>
        </div>
    </form>

    @if($eventos->isEmpty())
    <div class="card h-100 shadow-sm border p-5">
        <div class="text-center p-4 p-md-5">
            <p class="text-muted mb-3 fs-5">No hay eventos registrados</p>
            <img src="{{ asset('images/vacio.svg') }}" alt="No hay eventos" class="mx-auto d-block img-fluid" style="width: 150px; max-width: 200px; opacity: 0.7;">
        </div>
    </div>
    @else

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($eventos as $evento)
        <div class="col mb-4">
            <div class="card h-100 shadow-sm border vet-anim">
                @if ($evento->imagen)
                <img src="{{ asset('storage/' . $evento->imagen) }}"
                    alt="Imagen del evento"
                    class="card-img-top"
                    style="max-height: 300px ; object-fit: cover;">
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                    <p class="text-muted m-0">No hay imágenes disponibles</p>
                </div>
                @endif

                <div class="card-body">
                    <h4 class="card-title d-flex align-items-center justify-content-between">
                        <span>{{ $evento->titulo }}</span>
                        <span class="badge bg-success ms-2" style="font-size: 1rem;">
                            {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                        </span>
                    </h4>
                    <span class="badge bg-{{ ($evento->estado ?? 'pendiente') == 'aceptado' ? 'success' : (($evento->estado ?? 'pendiente') == 'pendiente' ? 'warning' : 'danger') }}">
                        {{ ucfirst($evento->estado ?? 'pendiente') }}
                    </span>
                    <div class="card-text">
                        <div class="mt-1"><b>Descripción:</b> {{ Str::limit($evento->descripcion, 100) }}</div>
                        <div class="mt-1"><b>Teléfono:</b> {{ $evento->telefono }}</div>
                    </div>
                    <div class="mt-1 d-flex gap-2 mt-3">
                        <a href="{{ route('eventos.show', $evento->id) }}"
                            class="btn btn-primary d-flex align-items-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            Ver más
                        </a>
                        @if(auth()->check() && auth()->id() === $evento->id_user)
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-cog"></i> Acciones
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('eventos.edit', $evento->id) }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </li>
                                <li>
                                    <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este evento?')">
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
        {{ $eventos->links('pagination::bootstrap-5') }}
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
@endsection