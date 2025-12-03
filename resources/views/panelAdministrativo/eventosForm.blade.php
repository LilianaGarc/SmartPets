@extends('panelAdministrativo.plantillaPanel')
@section('contenido') 

    <form method="POST"
          enctype="multipart/form-data"
          @if (isset($evento))
              action="{{ route('eventos.panelupdate', ['id'=>$evento->id]) }}"
          @else
              action="{{ route('eventos.panelstore') }}"
        @endif>
        @isset($evento)
            @method('put')
        @endisset
        @csrf
        <div class="card-body">
            @if(isset($evento))
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Editar información del evento</strong></h4>
            @else
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Crear un nuevo evento</strong></h4>
            @endif
            <hr>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo"
                                   placeholder="Título" inputmode="text" autocomplete="off" maxlength="30"
                                   value="{{ old('titulo', $evento->titulo ?? '') }}" aria-label="Título" required>
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
                                   aria-label="Fecha" required>
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
                                   placeholder="Hora de inicio" value="{{ old('hora_inicio', isset($evento) ? \Carbon\Carbon::parse($evento->hora_inicio)->format('H:i') : '') }}" required aria-label="Hora de inicio">
                            <label for="hora_inicio">Hora inicio <span style="color:red">*</span></label>
                            @error('hora_inicio')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-floating">
                            <input type="time" class="form-control @error('hora_fin') is-invalid @enderror" id="hora_fin" name="hora_fin"
                                   placeholder="Hora de fin" value="{{ old('hora_fin', isset($evento) ? \Carbon\Carbon::parse($evento->hora_fin)->format('H:i') : '') }}" required aria-label="Hora de fin">
                            <label for="hora_fin">Hora fin <span style="color:red">*</span></label>
                            @error('hora_fin')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-select" id="modalidad_evento" name="modalidad_evento" required aria-label="Acceso al evento" onchange="mostrarCampoPrecio()">
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
                            <input type="text" class="form-control @error('ubicacion') is-invalid @enderror" id="ubicacion" name="ubicacion" rquerid maxlength="150"
                                   placeholder="Ubicación" value="{{ old('ubicacion', $evento->ubicacion ?? '') }}" required aria-label="Ubicación">
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
                            <textarea class="form-control @error('descripcion') is-invalid @enderror" id="descripcion" name="descripcion" required
                                      placeholder="Descripción" style="height: 100px" required aria-label="Descripción"
                                      maxlength="200"
                                      oninput="actualizarContadorDescripcion()"
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

                <div class="row g-3 mb-3">
                    <div class="col-md-3">
                        <div class="form-floating">
                            <select class="form-select" id="estado_evento" name="estado_evento" aria-label="Estado del evento" onchange="mostrarMotivoRechazo()">
                                <option value="pendiente" {{ old('estado_evento', $evento->estado ?? '') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="aceptado" {{ old('estado_evento', $evento->estado ?? '') == 'aceptado' ? 'selected' : '' }}>Aceptar</option>
                                <option value="rechazado" {{ old('estado_evento', $evento->estado ?? '') == 'rechazado' ? 'selected' : '' }}>Rechazar</option>
                            </select>
                            <label for="estado_evento">Estado del evento</label>
                        </div>
                    </div>
                    <div class="col-md-9" id="motivoRechazoContainer" style="display: none;">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('motivo') is-invalid @enderror" id="motivo" name="motivo" maxlength="100"
                                   placeholder="Motivo del rechazo" value="{{ old('motivo', $evento->motivo ?? '') }}" aria-label="Motivo del rechazo">
                            <label for="motivo">Motivo del rechazo</label>
                            @error('motivo')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>

            <button type="submit" class="btn">Guardar</button>
            <a href="{{ route('eventos.panel') }}" class="btn">Cancelar</a>
        </div>
    </form>

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
       
<script>
//Funcion del precio
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

//Contador
 function actualizarContadorDescripcion() {
            var descripcion = document.getElementById('descripcion');
            var contador = document.getElementById('contadorDescripcion');
            var longitud = descripcion.value.length;
            contador.textContent = longitud + '/200';
        }
        document.addEventListener('DOMContentLoaded', function() {
            actualizarContadorDescripcion();
        });

function mostrarMotivoRechazo() {
            var estado = document.getElementById('estado_evento').value;
            var motivoContainer = document.getElementById('motivoRechazoContainer');
            motivoContainer.style.display = (estado === 'rechazado') ? 'block' : 'none';
        }
        document.addEventListener('DOMContentLoaded', mostrarMotivoRechazo);
        document.getElementById('estado_evento').addEventListener('change', mostrarMotivoRechazo);




// Insertar, VistaPrevia y Eliminar Imagen
//VISTA PREVIA
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

//Cargar imagen existente
document.addEventListener('DOMContentLoaded', function() {
    const preview = document.getElementById('preview-container');
    const imagenActualInput = document.getElementById('imagen_actual');
    const eliminarInput = document.getElementById('eliminar_imagen');

    const imagenActual = imagenActualInput ? imagenActualInput.value : '';
    const eliminarFlag = eliminarInput ? eliminarInput.value : '0';

    function createPreview(url, isRemote = true) {
        if (!preview) return;
        preview.innerHTML = '';

        const div = document.createElement('div');
        div.className = 'image-preview-item';
        div.setAttribute('data-remote', isRemote ? '1' : '0');

        const img = document.createElement('img');
        img.src = url;
        img.alt = 'Imagen del evento';
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '8px';

        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'remove-btn btn btn-danger btn-sm';
        btn.setAttribute('aria-label', 'Quitar imagen');
        btn.innerText = 'X';
        btn.onclick = function () {
            const fileInput = document.getElementById('imagen');
            if (fileInput) fileInput.value = '';
            if (eliminarInput) eliminarInput.value = '1';
            if (imagenActualInput) imagenActualInput.value = '';
            preview.innerHTML = '';
        };

        div.appendChild(img);
        div.appendChild(btn);
        preview.appendChild(div);
    }

    if (imagenActual && eliminarFlag !== '1') {
        const url = "{{ asset('storage') }}/" + imagenActual;
        createPreview(url, true);
    }

    const imagenEl = document.getElementById('imagen');
    if (imagenEl) {
        imagenEl.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                if (eliminarInput) eliminarInput.value = '0';
                if (imagenActualInput) imagenActualInput.value = '';
                createPreview(URL.createObjectURL(this.files[0]), false);
            }
        });
    }
});
</script>

{{-- Script para eliminar con confirmación --}}
<script>
// Eliminar con confirmación
document.addEventListener('DOMContentLoaded', function () {
    const imagenEl = document.getElementById('imagen');
    const preview = document.getElementById('preview-container');
    const imagenActualInput = document.getElementById('imagen_actual');
    const eliminarInput = document.getElementById('eliminar_imagen');
    const form = document.querySelector('form');
    const imagenError = document.getElementById('imagen-error');

    function clearPreview() {
        if (preview) preview.innerHTML = '';
    }

    function createPreview(url, isRemote = true) {
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
        img.style.width = '100%';
        img.style.height = '100%';
        img.style.objectFit = 'cover';
        img.style.borderRadius = '10px';
        img.style.border = '2px solid #e0e0e0';
        img.style.boxShadow = '0 2px 8px rgba(30,65,131,0.08)';
        img.className = 'preview-img';

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
        createPreview(url, true);
    }

    if (imagenEl) {
        imagenEl.addEventListener('change', function () {
            imagenError.style.display = 'none';
            if (this.files && this.files[0]) {
                if (eliminarInput) eliminarInput.value = '0';
                if (imagenActualInput) imagenActualInput.value = '';
                createPreview(URL.createObjectURL(this.files[0]), false);
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
                imagenError.textContent = 'Debes subir una imagen.';
                imagenError.style.display = 'block';
                if (imagenEl) imagenEl.focus();
                return false;
            }
        });
    }
});
</script>

<style>
.image-preview-item {
    position: relative;
    width: 180px;
    height: 180px;
    margin: 5px;
    display: inline-block;
}
.image-preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 8px;
}
.image-preview-item .remove-btn {
    position: absolute;
    top: 6px;
    right: 6px;
    background-color: #dc3545;
    color: #fff;
    border: none;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    cursor: pointer;
}

.preview-img { 
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    border-radius: 10px;
    background: #fff;
    display: block;
}
.btn-cancel-preview {
    background: rgba(255,255,255,0.85);
    border: 1.5px solid #dc3545;
    color: #dc3545;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 2;
}

.modal-gucci {
    border-radius: 24px;
    border: none;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
    overflow: hidden;
}
.btn-close-absolute {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 10;
    opacity: 0.3;
    transition: opacity 0.3s;
}
.btn-close-absolute:hover {
    opacity: 1;
}
.icon-box {
    width: 70px;
    height: 70px;
    margin: 0 auto;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    transition: transform 0.3s ease;
}
.icon-box.danger-soft {
    background-color: #fee2e2;
    color: #ef4444;
}
.modal-gucci:hover .icon-box {
    transform: scale(1.05) rotate(2deg);
}
.btn-gucci {
    padding: 10px 20px;
    font-weight: 600;
    font-size: 14px;
    letter-spacing: 0.3px;
    transition: all 0.12s;
}
.btn-gucci:active {
    transform: scale(0.98);
}

@media (max-width: 420px) {
    .modal-body { padding: 1rem; }
    .modal-gucci { margin: 0 12px; }
}
</style>
@endsection