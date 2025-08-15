@extends('layout.plantillaSaid')
@section('titulo', 'Detalles del Evento')
@section('contenido')

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
            <span class="breadcrumb__inner">
                <span class="breadcrumb__title">Ver Evento</span>
            </span>
        </li>
    </ul>
</div>

<div class="card shadow-sm p-4 mb-4 mt-4">
    <div class="card-body">
        <div class="d-flex align-items-center mb-3 gap-2" style="min-height: 56px;">
            <h2 class="card-title fw-bold flex-grow-1 mb-0 titulo-evento-responsive"
                style="overflow: hidden; font-size:clamp(1.3rem, 3vw, 2.2rem); min-width:0;">
                {{ $evento->titulo }}
            </h2>

            @if (auth()->id() === $evento->id_user)
            <div class="position-relative">
            <div class="dropdown">
                <button class="btn btn-light btn-sm shadow-sm btn-action-anim" style="font-size: 150;" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Acciones">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('eventos.edit', $evento->id) }}">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                    </li>
                    <li>
                        <button type="button" class="dropdown-item text-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEliminarEvento"
                                data-evento-id="{{ $evento->id }}"
                                data-evento-nombre="{{ $evento->titulo }}">
                            <i class="fas fa-trash"></i> Borrar
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        @endif

            <a href="{{ route('eventos.index') }}" class="btn btn-success btn-volver-evento ms-2" role="button" style="font-size: 150%;">
                <i class="fa-solid fa-circle-arrow-left"></i>
            </a>
        </div>

        <hr>
        <div class="row g-4">

            <div class="col-12 col-lg-7 d-flex flex-column justify-content-center">
                <div class="card-text w-100" style="font-size: 1.15rem;">
                    <div class="mb-2"><span style="font-size:1.3em;">📅</span> <b>Fecha:</b> <span class="text-secondary">{{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}</span></div>

                    <div class="mb-2"><span style="font-size:1.3em;">⏰</span> <b>Hora:</b> <span class="text-secondary">{{ $evento->hora_inicio }} - {{ $evento->hora_fin }}</span></div>

                    <div class="mb-2"><span style="font-size:1.3em;">📞</span> <b>Teléfono:</b> <span class="text-secondary">{{ $evento->telefono }}</span></div>

                    <div class="mb-2"><span style="font-size:1.3em;">💳</span> <b>Modalidad:</b> <span class="text-secondary">{{ ucfirst($evento->modalidad_evento) }}
                        @if($evento->modalidad_evento == 'pago')
                            | <b>Precio:</b> ${{ number_format($evento->precio, 2) }}
                        @endif
                    </span></div>

                    <div class="mb-2"><span style="font-size:1.3em;">📝</span> <b>Descripción:</b> <span class="text-secondary">{{ $evento->descripcion }}</span></div>

                    <div class="mb-2"><span style="font-size:1.3em;">📍</span> <b>Ubicación:</b> <span class="text-secondary">{{ $evento->ubicacion }}</span></div>
                    
                    <div class="mb-2"><span style="font-size:1.3em;">👥</span> <b>Participantes:</b> <span class="text-secondary;">{{ $evento->participaciones->count() }}</span></div>

                </div>

                @php
                    $esCreador = auth()->check() && auth()->id() == $evento->id_user;
                    $yaParticipa = auth()->check() ? $evento->participaciones->contains('id_user', auth()->id()) : false;
                    $eventoFinalizado = \Carbon\Carbon::parse($evento->fecha . ' ' . $evento->hora_fin)->isPast();
                @endphp

                    @if(!$esCreador && !$eventoFinalizado)
                        @if($yaParticipa)
                            <form action="{{ route('eventos.dejarParticipar', $evento->id) }}" method="POST" class="d-inline mt-3">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-lg w-100 w-lg-auto mb-2">
                                    <i class="fas fa-user-minus"></i> Dejar de participar
                                </button>
                            </form>
                        @else
                            <form action="{{ route('eventos.participar', $evento->id) }}" method="POST" class="d-inline mt-3">
                                @csrf
                                <button type="submit" class="btn btn-success btn-lg w-100 w-lg-auto mb-2">
                                    <i class="fas fa-user-plus"></i> Participar
                                </button>
                            </form>
                        @endif
                    @endif

            </div>

            <div class="col-12 col-lg-5 d-flex flex-column align-items-center">
                @if ($evento->imagen)
                    <img src="{{ asset('storage/' . $evento->imagen) }}" class="img-fluid rounded mb-4 shadow evento-img-responsive" alt="Imagen del evento"
                        style="max-width: 100%; max-height: 480px; min-height: 220px; object-fit: cover; border: 3px solid #1e4183;">
                @endif
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalEliminarEvento" tabindex="-1" aria-labelledby="modalEliminarEventoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <span>¿Desea eliminar este evento?</span>
                <p class="text-secondary mt-1">Esta acción no se puede deshacer.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formEliminarEvento" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>

    .titulo-evento-responsive {
        font-size: clamp(1.3rem, 3vw, 2.2rem);
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: normal; 

    @media (max-width: 576px) {
        .d-flex.flex-nowrap {
            flex-wrap: wrap; 
        }
        .btn-volver-evento {
            margin-top: 8px;
        }
    }

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


    
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalEliminar = document.getElementById('modalEliminarEvento');
        modalEliminar.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let eventoId = button.getAttribute('data-evento-id');

            let form = document.getElementById('formEliminarEvento');
            form.action = `/eventos/${eventoId}/eliminar`;
        });
    });
</script>

@endsection