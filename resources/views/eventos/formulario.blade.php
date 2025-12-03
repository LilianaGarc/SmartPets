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

@error('general')
    <div class="alert alert-danger alert-dismissible fade show mx-4" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@enderror

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
                  method="POST" enctype="multipart/form-data" id="eventoForm">
                @csrf
                @if(isset($evento))
                    @method('PUT')
                @endif

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo"
                                   placeholder="Título" inputmode="text" autocomplete="off" maxlength="30" required
                                   value="{{ old('titulo', $evento->titulo ?? '') }}" aria-label="Título">
                            <label for="titulo">Título <span style="color:red">*</span></label>
                            @error('titulo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="date" class="form-control @error('fecha') is-invalid @enderror" id="fecha" name="fecha"
                                   placeholder="Fecha" required
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
                        <input type="text" 
                            class="form-control @error('telefono') is-invalid @enderror" 
                            inputmode="numeric"
                            id="telefono" 
                            name="telefono"
                            placeholder="Ej: 98765432"
                            value="{{ old('telefono', $evento->telefono ?? '') }}" 
                            aria-label="Teléfono" 
                            maxlength="8"
                            pattern="^[2389]\d{7}$"
                            title="Debe ser un número de 8 dígitos que comience con 2, 3, 8 o 9"
                            required>
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
                            <input type="time" class="form-control @error('hora_inicio') is-invalid @enderror" id="hora_inicio" name="hora_inicio" required
                                   placeholder="Hora de inicio" value="{{ old('hora_inicio', isset($evento) ? \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') : '') }}" aria-label="Hora de inicio">
                            <label for="hora_inicio">Hora inicio <span style="color:red">*</span></label>
                            @error('hora_inicio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="time" class="form-control @error('hora_fin') is-invalid @enderror" id="hora_fin" name="hora_fin" required
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
                            <label for="modalidad_evento">Tipo de acceso <span style="color:red">*</span></label>
                        </div>
                    </div>
                    <div class="col-md-3" id="campo_precio" style="display: none;">
                        <div class="form-floating">
                            <input type="number" min="0" step="0.01" max="10000" class="form-control @error('precio') is-invalid @enderror" id="precio" name="precio"
                                placeholder="Precio del evento" value="{{ old('precio', $evento->precio ?? '') }}" aria-label="Precio del evento"
                                oninput="if(this.value.length > 7) this.value = this.value.slice(0, 7);">
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
                            <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" id="ubicacion" name="ubicacion" required
                                   placeholder="Ubicación" value="{{ old('ubicacion', $evento->ubicacion ?? '') }}" aria-label="Ubicación" maxlength="150">
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
                                maxlength="200" required
                                oninput="actualizarContadorDescripcion()" title="Descripción del evento"
                            >{{ old('descripcion', $evento->descripcion ?? '') }}</textarea>
                            <label for="descripcion">Descripción <span style="color:red">*</span></label>
                            @error('descripcion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="contadorDescripcion" class="form-text text-end" style="margin-top: 2px; margin-bottom: 10px;">
                            0/200
                        </div>
                    </div>
                </div>

               <div class="row g-3 mb-3">
                    <div class="col-12">
                        <label for="imagen" class="form-label">Imagen del Evento</label>
                        <div class="input-group">
                            <input type="file"
                                   class="form-control @error('imagen') is-invalid @enderror"
                                   id="imagen"
                                   name="imagen"
                                   accept="image/*"
                                   aria-label="Imagen del evento">
                        </div>

                        <input type="hidden" name="imagen_actual" id="imagen_actual" value="{{ old('imagen_actual', $evento->imagen ?? '') }}">
                        <input type="hidden" name="eliminar_imagen" id="eliminar_imagen" value="{{ old('eliminar_imagen', '0') }}">

                        <div id="preview-container" class="preview-container" style="margin-top: 10px;"></div>

                        <div id="imagen-error" class="invalid-feedback d-block" style="display:none;"></div>

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
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmEliminarModal" tabindex="-1" aria-labelledby="confirmEliminarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content modal-gucci">
      <button type="button" class="btn-close btn-close-absolute" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      <div class="modal-body text-center p-4">
        <div class="icon-box danger-soft mb-3">
          <i class="fa-solid fa-trash-can"></i>
        </div>
        <h5 class="modal-title fw-bold mb-2" id="confirmEliminarLabel">¿Eliminar foto?</h5>
        <p class="text-muted small mb-4">
          Esta acción no se puede deshacer. Para guardar cambios necesitarás subir una nueva.
        </p>
        <div class="d-grid gap-2">
          <button type="button" id="confirmEliminarBtn" class="btn btn-danger btn-gucci rounded-pill">
            Sí, eliminar
          </button>
          <button type="button" class="btn btn-light btn-gucci text-muted rounded-pill" data-bs-dismiss="modal">
            Cancelar
          </button>
        </div>
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
            document.getElementById('eliminar_imagen').value = '0';
            document.getElementById('imagen').focus();
        };

        wrapper.appendChild(img);
        wrapper.appendChild(btn);
        preview.appendChild(wrapper);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    @if(isset($evento) && $evento->imagen)
        const preview = document.getElementById('preview-container');
        preview.innerHTML = '';
        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        wrapper.style.display = 'inline-block';

        const img = document.createElement('img');
        img.src = "{{ asset('storage/' . $evento->imagen) }}";
        img.className = 'preview-img';
        img.alt = 'Imagen actual del evento';

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn-cancel-preview';
        btn.setAttribute('aria-label', 'Quitar imagen actual');
        btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';

        btn.onclick = () => {
            preview.innerHTML = '';
            document.getElementById('eliminar_imagen').value = '1';
        };

        wrapper.appendChild(img);
        wrapper.appendChild(btn);
        preview.appendChild(wrapper);
    @endif
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
            document.getElementById('eliminar_imagen').value = '0';
            document.getElementById('imagen').focus();
        };

        wrapper.appendChild(img);
        wrapper.appendChild(btn);
        preview.appendChild(wrapper);

        document.getElementById('eliminar_imagen').value = '0';
    }
});

function actualizarContadorDescripcion() {
    const textarea = document.getElementById('descripcion');
    const contador = document.getElementById('contadorDescripcion');
    const max = textarea.getAttribute('maxlength') || 200; 
    
    if (textarea.value.length > max) {
        textarea.value = textarea.value.substring(0, max);
    }
    contador.textContent = `${textarea.value.length}/${max}`;
}

document.addEventListener('DOMContentLoaded', function() {

    const textarea = document.getElementById('descripcion');
    if (textarea) {
        actualizarContadorDescripcion(); 
        textarea.addEventListener('input', actualizarContadorDescripcion);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    mostrarCampoPrecio();
    const textarea = document.getElementById('descripcion');
    if (textarea) {
        textarea.addEventListener('input', actualizarContadorDescripcion);
    }
});
</script>


<script>
document.getElementById('telefono').addEventListener('input', function() {
    this.value = this.value.replace(/\D/g, '');

    if (this.value.length > 8) {
        this.value = this.value.slice(0, 8);
    }
});
</script>



<style>
/* Estilos del modal reemplazo (compacto y coherente con UI) */
.modal-gucci {
    border-radius: 16px;
    border: none;
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    overflow: hidden;
}
.btn-close-absolute {
    position: absolute;
    top: 12px;
    right: 12px;
    z-index: 10;
    opacity: 0.6;
    transition: opacity .2s;
}
.btn-close-absolute:hover { opacity: 1; }

/* Icon box y colores */
.icon-box {
    width: 64px;
    height: 64px;
    margin: 0 auto;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
}
.icon-box.danger-soft {
    background-color: #fff5f5;
    color: #e11d48;
}

/* Botones estilo */
.btn-gucci {
    padding: 10px 18px;
    font-weight: 600;
    font-size: 14px;
    transition: transform .08s ease;
}
.btn-gucci:active { transform: scale(.98); }

/* Ajustes responsive: menos espacio para evitar scroll innecesario */
@media (max-width: 420px) {
    .modal-body { padding: 1rem; }
    .modal-gucci { margin: 0 12px; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const imagenEl = document.getElementById('imagen');
    const preview = document.getElementById('preview-container');
    const imagenActualInput = document.getElementById('imagen_actual');
    const eliminarInput = document.getElementById('eliminar_imagen');
    const form = document.getElementById('eventoForm') || document.querySelector('form');
    const imagenError = document.getElementById('imagen-error');

    function clearPreview() { if (preview) preview.innerHTML = ''; }

    function createPreview(url) {
        if (!preview) return;
        clearPreview();

        const wrapper = document.createElement('div');
        wrapper.style.position = 'relative';
        wrapper.style.display = 'inline-block';
        wrapper.style.width = '180px';
        wrapper.style.height = '180px';

        const img = document.createElement('img');
        img.src = url;
        img.alt = 'Imagen del evento';
        img.className = 'preview-img';
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '10px';
        img.style.border = '2px solid #e0e0e0';
        img.style.boxShadow = '0 2px 8px rgba(30,65,131,0.08)';

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'btn-cancel-preview';
        btn.setAttribute('aria-label', 'Quitar imagen');
        btn.style.position = 'absolute';
        btn.style.top = '6px';
        btn.style.right = '6px';
        btn.innerHTML = '<i class="fa-solid fa-xmark"></i>';

        btn.addEventListener('click', function () {
            window._onConfirmEliminarImagen = function () {
                if (imagenEl) imagenEl.value = '';
                if (eliminarInput) eliminarInput.value = '1';
                if (imagenActualInput) imagenActualInput.value = '';
                clearPreview();
            };
            const modalEl = document.getElementById('confirmEliminarModal');
            if (modalEl && window.bootstrap) {
                const bsModal = new bootstrap.Modal(modalEl);
                bsModal.show();
            } else {
                if (typeof window._onConfirmEliminarImagen === 'function') {
                    window._onConfirmEliminarImagen();
                    window._onConfirmEliminarImagen = null;
                }
            }
        });

        wrapper.appendChild(img);
        wrapper.appendChild(btn);
        preview.appendChild(wrapper);
    }

    const imagenActual = imagenActualInput ? imagenActualInput.value : '';
    const eliminarFlag = eliminarInput ? eliminarInput.value : '0';
    if (imagenActual && eliminarFlag !== '1') {
        const url = "{{ asset('storage') }}/" + imagenActual;
        createPreview(url);
    }

    if (imagenEl) {
        imagenEl.addEventListener('change', function () {
            if (imagenError) imagenError.style.display = 'none';
            if (this.files && this.files[0]) {
                if (eliminarInput) eliminarInput.value = '0';
                if (imagenActualInput) imagenActualInput.value = '';
                createPreview(URL.createObjectURL(this.files[0]));
            } else {
                clearPreview();
            }
        });
    }

    const confirmarBtn = document.getElementById('confirmEliminarBtn');
    if (confirmarBtn) {
        confirmarBtn.addEventListener('click', function () {
            if (typeof window._onConfirmEliminarImagen === 'function') {
                window._onConfirmEliminarImagen();
                window._onConfirmEliminarImagen = null;
            }
            const modalEl = document.getElementById('confirmEliminarModal');
            if (modalEl && window.bootstrap) {
                const inst = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
                inst.hide();
            }
        });
    }

    if (form) {
        form.addEventListener('submit', function (e) {
            const eliminar = eliminarInput ? eliminarInput.value === '1' : false;
            const hasFile = imagenEl && imagenEl.files && imagenEl.files.length > 0;
            if (eliminar && !hasFile) {
                e.preventDefault();
                if (imagenError) {
                    imagenError.textContent = 'Debes subir una imagen.';
                    imagenError.style.display = 'block';
                }
                if (imagenEl) imagenEl.focus();
                return false;
            }
        });
    }
});
</script>
@endsection