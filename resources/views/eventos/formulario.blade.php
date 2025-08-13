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

            <form action="{{ isset($evento) ? route('eventos.update', $evento->id) : route('eventos.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($evento))
                    @method('PUT')
                @endif

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo"
                                   placeholder="Título" inputmode="text" autocomplete="off"
                                   value="{{ old('titulo', $evento->titulo ?? '') }}" aria-label="Título" maxlength="100">
                            <label for="titulo">Título <span style="color:red">*</span></label>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha"
                                   placeholder="Fecha"
                                   value="{{ old('fecha', $evento->fecha ?? '') }}"
                                   min="{{ date('Y-m-d') }}"
                                   aria-label="Fecha">
                            <label for="fecha">Fecha <span style="color:red">*</span></label>
                            @error('fecha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="number" inputmode="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono"
                                   placeholder="Teléfono" inputmode="tel" autocomplete="tel"
                                   value="{{ old('telefono', $evento->telefono ?? '') }}" aria-label="Teléfono" maxlength="15">
                            <label for="telefono">Teléfono <span style="color:red">*</span></label>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" id="hora_inicio" name="hora_inicio"
                                   placeholder="Hora de inicio" value="{{ old('hora_inicio', isset($evento) ? \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') : '') }}" aria-label="Hora de inicio">
                            <label for="hora_inicio">Hora inicio <span style="color:red">*</span></label>
                            @error('hora_inicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="time" class="form-control @error('hora_fin') is-invalid @enderror" id="hora_fin" name="hora_fin"
                                   placeholder="Hora de fin" value="{{ old('hora_fin', isset($evento) ? \Carbon\Carbon::parse($evento->hora_fin)->format('H:i') : '') }}" aria-label="Hora de fin">
                            <label for="hora_fin">Hora fin <span style="color:red">*</span></label>
                            @error('hora_fin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-select" id="modalidad_evento" name="modalidad_evento" aria-label="Acceso al evento" onchange="mostrarCampoPrecio()">
                                <option value="gratis" {{ old('modalidad_evento', $evento->modalidad_evento ?? '') == 'gratis' ? 'selected' : '' }}>Gratuito</option>
                                <option value="pago" {{ old('modalidad_evento', $evento->modalidad_evento ?? '') == 'pago' ? 'selected' : '' }}>De pago</option>
                            </select>
                            <label for="modalidad_evento">¿El evento es gratuito o de pago? <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-3" id="campo_precio" style="display: none;">
                        <div class="form-floating">
                            <input type="number" min="0" step="0.01" max="9999999999" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio"
                                   placeholder="Precio del evento" value="{{ old('precio', $evento->precio ?? '') }}" aria-label="Precio del evento">
                            <label for="precio">Precio</label>
                            @error('precio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                 <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" id="ubicacion" name="ubicacion"
                                   placeholder="Ubicación" value="{{ old('ubicacion', $evento->ubicacion ?? '') }}" aria-label="Ubicación" maxlength="255">
                            <label for="ubicacion">Ubicación <span style="color:red">*</span></label>
                            @error('ubicacion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion"
                                placeholder="Descripción" style="height: 100px" aria-label="Descripción"
                                maxlength="250"
                                oninput="actualizarContadorDescripcion()"
                            >{{ old('descripcion', $evento->descripcion ?? '') }}</textarea>
                            <label for="descripcion">Descripción <span style="color:red">*</span></label>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="contadorDescripcion" class="form-text text-end" style="margin-top: 2px; margin-bottom: 10px;">
                            0/250
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label for="imagen" class="form-label">Imagen del Evento</label>
                        <div class="input-group">
                            <input type="file" class="form-control @error('imagen') is-invalid @enderror" id="imagen" name="imagen" accept="image/jpeg,image/png,image/jpg,image/gif" aria-label="Imagen del evento">
                            @if(isset($evento) && $evento->imagen)
                                <span class="input-group-text bg-white">
                                    <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen actual" style="max-width: 60px; max-height: 60px; object-fit: cover;">
                                </span>
                            @endif
                        </div>
                        @if(isset($evento) && $evento->imagen)
                            <div class="form-text">Si no seleccionas una nueva imagen, se mantendrá la actual.</div>
                        @endif
                        <div id="preview-container" class="preview-container" style="margin-top: 10px;"></div>
                        @error('imagen')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="text-end">
                    <button type="submit" class="btn btn-{{ isset($evento) ? 'warning' : 'success' }}">
                        <i class="fa-solid fa-{{ isset($evento) ? 'pen-to-square' : 'save' }}"></i>
                        {{ isset($evento) ? 'Actualizar' : 'Crear' }}
                    </button>
                    <button type="reset" class="btn btn-danger" title="Borrar todos los campos">
                        <i class="fa-solid fa-broom"></i>
                        Limpiar
                    </button>
                </div>
            </form>
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

        .preview-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 16px;
            margin-top: 10px;
            min-height: 70px;
        }
        .preview-img {
            width: 180px;
            height: 180px;
            object-fit: cover;
            object-position: center;
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            box-shadow: 0 2px 8px rgba(30,65,131,0.08);
            background: #fff;
            display: block;
        }
        .btn-cancel-preview {
            position: absolute;
            top: 8px;
            right: 8px;
            background: rgba(255,255,255,0.85);
            border: 1.5px solid #dc3545;
            color: #dc3545;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s, color 0.2s, box-shadow 0.2s;
            z-index: 2;
            box-shadow: 0 2px 8px rgba(30,65,131,0.08);
        }
        .btn-cancel-preview:hover, .btn-cancel-preview:focus {
            background: #dc3545;
            color: #fff;
            outline: 2px solid #18478b;
        }
        .btn-cancel-preview:active {
            background: #b52a37;
            color: #fff;
        }
</style>
<script>
function mostrarCampoPrecio() {
    const modalidad = document.getElementById('modalidad_evento').value;
    const campoPrecio = document.getElementById('campo_precio');
    const inputPrecio = document.getElementById('precio');
    if (modalidad === 'pago') {
        campoPrecio.style.display = 'block';
        inputPrecio.required = true;
    } else {
        campoPrecio.style.display = 'none';
        inputPrecio.required = false;
        inputPrecio.value = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    mostrarCampoPrecio();
    document.getElementById('modalidad_evento').addEventListener('change', mostrarCampoPrecio);
});

document.getElementById('imagen').addEventListener('change', function(e) {
    const preview = document.getElementById('preview-container');
    preview.innerHTML = '';
    if (this.files && this.files[0]) {
        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        wrapper.style.display = 'inline-block';

        const img = document.createElement('img');
        img.src = URL.createObjectURL(this.files[0]);
        img.className = 'preview-img';
        img.alt = 'Vista previa de la imagen seleccionada';

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn-cancel-preview';
        btn.setAttribute('aria-label', 'Quitar imagen seleccionada');
        btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';

        btn.onclick = () => {
            document.getElementById('imagen').value = '';
            preview.innerHTML = '';
            document.getElementById('imagen').focus();
        };

        wrapper.appendChild(img);
        wrapper.appendChild(btn);
        preview.appendChild(wrapper);
    }
});

function actualizarContadorDescripcion() {
    const textarea = document.getElementById('descripcion');
    const contador = document.getElementById('contadorDescripcion');
    const max = textarea.getAttribute('maxlength') ? parseInt(textarea.getAttribute('maxlength')) : 255;
    if (textarea.value.length > max) {
        textarea.value = textarea.value.substring(0, max);
    }
    contador.textContent = `${textarea.value.length}/${max}`;
}

document.addEventListener('DOMContentLoaded', function() {
    mostrarCampoPrecio();
    const textarea = document.getElementById('descripcion');
    if (textarea) {
        textarea.addEventListener('input', actualizarContadorDescripcion);
    }
});
</script>
@endsection