@extends('layout.plantillaSaid')
@section('titulo', 'Veterinarias')

@section('contenido')

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
            <li class="breadcrumb__item">
                <a href="{{ route('veterinarias.create') }}" class="breadcrumb__inner">
                    <span class="breadcrumb__title">Crear Veterinaria</span>
                </a>
            </li>
        </ul>
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
            <div class="card h-100 shadow-sm border p-5 mt-4">
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
                        <div class="card h-100 shadow-sm border vet-anim position-relative">
                            @if(auth()->id() === $veterinaria->id_user)
                                <div class="position-absolute top-0 end-0 m-2" style="z-index: 2;">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="Acciones">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('veterinarias.edit', $veterinaria->id) }}">
                                                    <i class="fas fa-edit text-warning"></i> Editar
                                                </a>
                                            </li>
                                            <li>
                                                <button type="button" class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#modalEliminar{{ $veterinaria->id }}">
                                                    <i class="fas fa-trash"></i> Borrar
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @if ($imagen)
                                <div class="card-img-top bg-light d-flex align-items-center justify-content-center p-0" style="height: 300px; overflow: hidden; border-radius: 0.5rem 0.5rem 0 0;">
                                    <img src="{{ asset('storage/' . $imagen->path) }}"
                                         alt="Veterinaria {{ $veterinaria->nombre }}"
                                         style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
                                </div>
                            @else
                                <div class="card-img-top bg-light d-flex flex-column align-items-center justify-content-center" style="height: 300px; border-radius: 0.5rem 0.5rem 0 0;">
                                    <p class="text-muted mb-2">No hay imágenes disponibles</p>
                                    <img src="{{ asset('images/no_hay.svg') }}" alt="No hay imágenes" class="img-fluid" style="width: 220px; max-width: 200px; opacity: 0.7;">
                                </div>
                            @endif

                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <h4 class="card-title mb-0" style="
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            word-break: break-word;
                            max-width: 70%;
                            font-size: 1.25rem;
                        ">
                                        {{ $veterinaria->nombre }}
                                    </h4>
                                    <span class="badge bg-success ms-2" style="font-size: 1rem;">
                            {{ number_format($veterinaria->calificacion_promedio, 1) }}
                        </span>
                                </div>

                                <div class="card-text">
                                    <div class="mt-1"><b>Horario:</b> {{ $veterinaria->horario_apertura }} - {{ $veterinaria->horario_cierre }}</div>
                                    <div class="mt-1"><b>Teléfono:</b> {{ $veterinaria->telefono }}</div>
                                    <div class="mt-1"><b>Dirección: </b>{{ $veterinaria->ubicacion->direccion }}</div>
                                </div>

                                <div class="mt-3 d-flex flex-wrap gap-2">
                                    @if($veterinaria->whatsapp)
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $veterinaria->whatsapp) }}"
                                           target="_blank"
                                           class="btn btn-success d-flex align-items-center gap-2">
                                            <i class="fab fa-whatsapp"></i>
                                            Contactar
                                        </a>
                                    @endif
                                    <a href="{{ route('veterinarias.show', $veterinaria->id) }}"
                                       class="btn btn-outline-primary d-flex align-items-center gap-2"
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalEliminar{{ $veterinaria->id }}" tabindex="-1" aria-labelledby="modalEliminarLabel{{ $veterinaria->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title" id="modalEliminarLabel{{ $veterinaria->id }}">Eliminar Veterinaria</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body">
                                    ¿Estás seguro de que deseas eliminar <strong>{{ $veterinaria->nombre }}</strong>? Esta acción no se puede deshacer.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form action="{{ route('veterinarias.destroy', $veterinaria->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
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