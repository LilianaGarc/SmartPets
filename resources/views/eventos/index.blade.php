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
            <li class="breadcrumb__item">
                <a href="{{ route('eventos.create') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Crear Evento</span>
                </a>
            </li>
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

    <form method="GET" action="{{ route('eventos.index') }}" class="row g-2 mb-4{{ session('exito') || session('fracaso') ? '' : ' mt-4' }}">
        <div class="col-md-4 d-flex">
            <input type="text" name="q" class="form-control form-control-sm" placeholder="Buscar eventos..." value="{{ request('q') }}">
            <button type="submit" class="btn btn-outline-primary btn-sm ms-2">
                <i class="fas fa-search"></i> Buscar
            </button>
        </div>
        @if(auth()->check())
        <div class="col-md-3 d-flex">
            <select name="tipo" class="form-select form-select-sm" onchange="this.form.submit()">
                <option value="">Todos los eventos</option>
                <option value="mios" {{ request('tipo') == 'mios' ? 'selected' : '' }}>Mis eventos</option>
                <option value="participando" {{ request('tipo') == 'participando' ? 'selected' : '' }}>Eventos en los que participo</option>
            </select>
        </div>
        @if(request('tipo') == 'mios' || request('tipo') == 'participando')
        <div class="col-md-3 d-flex">
            <select name="estado" class="form-select form-select-sm">
                <option value="">Todos los estados</option>
                <option value="aceptado" {{ request('estado') == 'aceptado' ? 'selected' : '' }}>Aceptados</option>
                <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>Pendientes</option>
                <option value="rechazado" {{ request('estado') == 'rechazado' ? 'selected' : '' }}>Rechazados</option>
            </select>
            <button type="submit" class="btn btn-outline-secondary btn-sm ms-2">
                <i class="fas fa-filter"></i> Filtrar
            </button>
        </div>
        @endif
        @endif
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
            <div class="card h-100 shadow-sm border vet-anim position-relative">
                {{-- Imagen --}}
                @if ($evento->imagen)
                    <div class="card-img-top bg-light d-flex align-items-center
                    justify-content-center p-0" style="height: 220px; overflow: hidden; border-radius: 0.5rem 0.5rem 0 0;">
                        <img src="{{ asset('storage/' . $evento->imagen) }}"
                            alt="Imagen del evento"
                            style="width: 100%; height: 100%; object-fit: cover; object-position: center; transition: transform 0.3s;">
                    </div>
                @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 220px; border-radius: 0.5rem 0.5rem 0 0;">
                        <p class="text-muted m-0">No hay imágenes disponibles</p>
                    </div>
                @endif

                <div class="card-body">
                    @php
                        $yaParticipa = auth()->check() ? $evento->participaciones->contains('id_user', auth()->id()) : false;
                        $esCreador = auth()->check() && auth()->id() == $evento->id_user;
                        $eventoFinalizado = \Carbon\Carbon::parse($evento->fecha . ' ' . $evento->hora_fin)->isPast();
                    @endphp

                    <h4 class="card-title d-flex align-items-center justify-content-between">
                        <span>{{ $evento->titulo }}</span>
                        <span class="badge bg-success ms-2" style="font-size: 1rem;">
                            <span class="badge text-dark" title="Participantes" style="font-size: 1em;">
                                <i class="fas fa-users"></i> {{ $evento->participaciones->count() }}
                            </span>
                        </span>
                    </h4>

                    {{-- Badge de evento finalizado centrado --}}
                    @if($eventoFinalizado)
                        <div class="d-flex justify-content-center my-2">
                            <span class="badge bg-secondary fs-5 px-4 py-2">Evento finalizado</span>
                        </div>
                    @endif

                    {{-- Estado solo para el creador --}}
                    @if($esCreador)
                        <span class="badge bg-{{ ($evento->estado ?? 'pendiente') == 'aceptado' ? 'success' : (($evento->estado ?? 'pendiente') == 'pendiente' ? 'warning' : 'danger') }}">
                            {{ ucfirst($evento->estado ?? 'pendiente') }}
                        </span>
                    @endif

                    <div class="card-text mt-2">
                        <div class="mb-1">
                            <i class="fas fa-align-left text-primary"></i>
                            <span class="ms-1"><b>Descripción:</b> {{ Str::limit($evento->descripcion, 100) }}</span>
                        </div>
                        <div class="mb-1">
                            <i class="fas fa-phone-alt text-success"></i>
                            <span class="ms-1"><b>Teléfono:</b> {{ $evento->telefono }}</span>
                        </div>
                        <div class="mb-1">
                            <i class="fas fa-calendar-alt text-warning"></i>
                            <span class="ms-1"><b>Fecha:</b> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="position-absolute top-0 end-0 m-2" style="z-index: 2;">
                    @if($esCreador)
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm shadow-sm btn-action-anim" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Acciones">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('eventos.show', $evento->id) }}">
                                        <i class="fas fa-eye"></i> Detalles
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('eventos.edit', $evento->id) }}">
                                        <i class="fas fa-edit"></i> Editar
                                    </a>
                                </li>
                                <li>
                                    <button type="button"
                                        class="dropdown-item text-danger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEliminarEvento"
                                        data-evento-id="{{ $evento->id }}"
                                        data-evento-nombre="{{ $evento->titulo }}">
                                        <i class="fas fa-trash"></i> Borrar
                                    </button>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('eventos.show', $evento->id) }}"

                            class="btn btn-outline-primary btn-sm shadow-sm btn-action-anim"
                            aria-label="Ver detalles del evento {{ $evento->titulo }}"
                            title="Ver detalles">
                            <i class="fas fa-eye"></i>
                        </a>
                    @endif
                </div>

                <div class="card-footer bg-white border-0 d-flex justify-content-end">
                    @auth
                        @if(!$esCreador && !$eventoFinalizado)
                            @if($yaParticipa)
                                <form action="{{ route('eventos.dejarParticipar', $evento->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm btn-action-anim" title="Dejar de participar">
                                        <i class="fas fa-user-minus"></i> Dejar de participar
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('eventos.participar', $evento->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm btn-action-anim" title="Participar">
                                        <i class="fas fa-user-plus"></i> Participar
                                    </button>
                                </form>
                            @endif
                        @endif
                    @endauth
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

{{-- Modal de confirmación para eliminar evento --}}
<div class="modal fade" id="modalEliminarEvento" tabindex="-1" aria-labelledby="modalEliminarEventoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEliminarEventoLabel">Confirmar Eliminación </h5> 
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <span>¿Desea eliminar este evento?</span>
                <p class="text-secondary mt-1">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formEliminarEvento" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    
    .breadcrumb-container {
        display: flex;
        align-items: start;
        gap: 20px;
        width: 100%;
        justify-content: space-between;
    }

    .breadcrumb {
        display: flex;
        border-radius: 10px;
        text-align: center;
        height: 40px;
        z-index: 1;
        justify-content: flex-start;
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .breadcrumb__item {
        height: 100%;
        background-color: white;
        color: #252525;
        font-family: 'Oswald', sans-serif;
        border-radius: 7px;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        position: relative;
        display: inline-flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
        transform: skew(-21deg);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
        margin: 5px;
        padding: 0 40px;
    }

    .breadcrumb__item:hover {
        background: #1e4183;
        color: #FFF;
    }

    .breadcrumb__inner {
        display: flex;
        flex-direction: column;
        margin: auto;
        z-index: 2;
        transform: skew(21deg);
    }

    .breadcrumb__title {
        font-size: 16px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
    }

    .breadcrumb__item a {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
    }

    .breadcrumb__item-active {
        background-color: #1e4183;
        color: #FFF;
    }

    /* Responsive para breadcrumb */
    @media (max-width: 768px) {
        .breadcrumb-container {
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .breadcrumb {
            display: flex;
            flex-direction: row;
            align-items: start;
            flex-wrap: wrap;
        }

        .breadcrumb__item {
            width: 5px;
            flex-shrink: 0;
        }

        .breadcrumb__item .breadcrumb__title {
            font-size: 9px;
            white-space: normal;
            word-wrap: break-word;
            max-width: 100px;
            line-height: 1.2;
        }
    }

    @media (min-width: 768px) and (max-width: 1024px) {
        .breadcrumb-container {
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .breadcrumb {
            display: flex;
            flex-direction: row;
            align-items: start;
            flex-wrap: wrap;
        }

        .breadcrumb__item {
            width: 80px;
            flex-shrink: 0;
        }

        .breadcrumb__item .breadcrumb__title {
            font-size: 11px;
            white-space: normal;
            word-wrap: break-word;
            max-width: 100px;
            line-height: 1.2;
        }
    }

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

    .btn-action-anim {
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .btn-action-anim:hover, .btn-action-anim:focus {
        transform: scale(1.12) rotate(-3deg);
        box-shadow: 0 4px 16px rgba(30,65,131,0.12);
        z-index: 3;
    }
    .card-img-top img:hover {
        transform: scale(1.04);
    }
    .badge.bg-success {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.5);}
        70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0);}
        100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0);}
    }
</style>
@include('chats.chat-float')
@endsection