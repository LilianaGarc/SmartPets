@extends('layout.plantillaSaid')
@section('titulo', isset($evento) ? 'Editar Evento' : 'Crear Evento')

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
                    <span class="breadcrumb__title">
                        @if(isset($evento))
                            Editar Evento
                        @else
                            Crear Evento
                        @endif
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="container mt-4">
    <div class="card fade-in">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h1 class="mb-0 card-title fw-bold">
                    @if(isset($evento))
                        Editar Evento
                    @else
                        Crear Evento
                    @endif
                </h1>
                <a href="{{ route('eventos.index') }}" class="btn btn-success" role="button" style="font-size: 150%;">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                </a>
            </div>
            <hr>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($evento) ? route('eventos.update', $evento->id) : route('eventos.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($evento))
                    @method('PUT')
                @endif

                <div class="row g-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="titulo" name="titulo"
                                   placeholder="Título" value="{{ old('titulo', $evento->titulo ?? '') }}" required>
                            <label for="titulo">Título</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Descripción" style="height: 100px" required>{{ old('descripcion', $evento->descripcion ?? '') }}</textarea>
                            <label for="descripcion">Descripción</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="date" class="form-control" id="fecha" name="fecha"
                                   placeholder="Fecha" value="{{ old('fecha', $evento->fecha ?? '') }}" required>
                            <label for="fecha">Fecha</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="telefono" name="telefono"
                                   placeholder="Teléfono" value="{{ old('telefono', $evento->telefono ?? '') }}" required>
                            <label for="telefono">Teléfono</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label for="imagen" class="form-label">Imagen del Evento</label>
                        <div class="input-group">
                            <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                            @if(isset($evento) && $evento->imagen)
                                <span class="input-group-text bg-white">
                                    <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen actual" style="max-width: 60px; max-height: 60px; object-fit: cover;">
                                </span>
                            @endif
                        </div>
                        @if(isset($evento) && $evento->imagen)
                            <div class="form-text">Si no seleccionas una nueva imagen, se mantendrá la actual.</div>
                        @endif
                    </div>
                </div>
                <br>
                <button type="submit" class="btn btn-{{ isset($evento) ? 'warning' : 'success' }}">
                    {{ isset($evento) ? 'Actualizar Evento' : 'Crear Evento' }}
                </button>
                <button type="reset" class="btn btn-danger" title="Borrar todos los campos">
                    Limpiar
                </button>
            </form>
        </div>
    </div>
</div>

<style>
        /* Estilos para el breadcrumb */
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
</style>
@endsection