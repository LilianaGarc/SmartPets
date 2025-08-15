@extends('layout.plantillaSaid')

@section('titulo', isset($veterinaria) ? 'Editar Veterinaria' : 'Creación de Veterinaria')

@section('contenido')

<div class="breadcrumb-container">
    <ul class="breadcrumb">
        <li class="breadcrumb__item">
            <a href="{{ route('index') }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">Inicio</span>
            </a>
        </li>
        <li class="breadcrumb__item">
            <a href="{{ route('veterinarias.index') }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">Veterinarias</span>
            </a>
        </li>
        <li class="breadcrumb__item breadcrumb__item-active">
            <a href="{{ route('veterinarias.create') }}" class="breadcrumb__inner">
                <span class="breadcrumb__title">
                    @if (isset($veterinaria))
                        Editar Veterinaria
                    @else
                        Crear Veterinaria
                    @endif
                </span>
            </a>
        </li>
    </ul>
</div>

<div class="container mt-4">
    <div class="card fade-in">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h1 class="mb-0 card-title fw-bold" >
                    @if(isset($veterinaria))
                        Editar Veterinaria
                    @else
                        Crear Veterinaria
                    @endif
                </h1>
                <a href="{{ route('veterinarias.index') }}" class="btn btn-success" style="font-size: 150%;" role="button">
                    <i class="fa-solid fa-circle-arrow-left"></i>
                </a>
            </div>
            <hr>

            <form method="post" enctype="multipart/form-data" id="formularioVeterinaria"
                @if (isset($veterinaria))
                    action="{{ route('veterinarias.update', ['id'=>$veterinaria->id]) }}"
                @else
                    action="{{ route('veterinarias.store') }}"
                @endif>
                @isset($veterinaria)
                    @method('put')
                @endisset
                @csrf

                <div class="row g-3">

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre"  placeholder="Nombre" maxlength="100" name="nombre" value="{{ isset($veterinaria) ? $veterinaria->nombre : old('nombre') }}">
                            <label for="nombre">Nombre</label>
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control @error('nombre_veterinario') is-invalid @enderror" id="nombre_veterinario" placeholder="Propietario" maxlength="100" name="nombre_veterinario" value="{{ isset($veterinaria) ? $veterinaria->nombre_veterinario : old('nombre_veterinario') }}">
                            <label for="nombre_veterinario">Propietario</label>
                            @error('nombre_veterinario')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="form-floating">
                            <input type="time" class="form-control @error('horario_apertura') is-invalid @enderror" id="horario_apertura" placeholder="Horario" name="horario_apertura" value="{{ isset($veterinaria) ? $veterinaria->horario_apertura : old('horario_apertura') }}" step="1800">
                            <label for="horario_apertura">Hora de Apertura</label>
                            @error('horario_apertura')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="form-floating">
                            <input type="time" class="form-control @error('horario_cierre') is-invalid @enderror" id="horario_cierre" placeholder="Horario" name="horario_cierre" value="{{ isset($veterinaria) ? $veterinaria->horario_cierre : old('horario_cierre') }}" step="1800">
                            <label for="horario_cierre">Hora de Cierre</label>
                            @error('horario_cierre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-floating">
                              <input type="text" 
                            class="form-control @error('telefono') is-invalid @enderror" 
                            inputmode="numeric"
                            id="telefono" 
                            name="telefono"
                            placeholder="Ej: 98765432"
                            value="{{ old('telefono', $veterinaria->telefono ?? '') }}" 
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

                    <div class="col-12 col-md-3">
                          <input type="text" 
                            class="form-control @error('whatsapp') is-invalid @enderror" 
                            inputmode="numeric"
                            id="whatsapp" 
                            name="whatsapp"
                            placeholder="Ej: 98765432"
                            value="{{ old('whatsapp', $veterinaria->whatsapp ?? '') }}" 
                            aria-label="WhatsApp" 
                            maxlength="8"
                            pattern="^[2389]\d{7}$"
                            title="Debe ser un número de 8 dígitos que comience con  3, 8 o 9">
                        <label for="whatsapp">WhatsApp </label>
                        @error('whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    @php
                    $departamentos = [
                        'Atlántida', 'Choluteca', 'Colón', 'Comayagua', 'Copán', 'Cortés',
                        'El Paraíso', 'Francisco Morazán', 'Gracias a Dios', 'Intibucá',
                        'Islas de la Bahía', 'La Paz', 'Lempira', 'Ocotepeque', 'Olancho',
                        'Santa Bárbara', 'Valle', 'Yoro'
                        ];
                    @endphp

                    <div class="col-12 col-md-3">
                        <div class="form-floating">
                            <select class="form-select @error('departamento') is-invalid @enderror" id="departamento" name="departamento">
                                <option value="">Seleccione un departamento</option>
                                @foreach ($departamentos as $dep)
                                <option value="{{ $dep }}"
                                    @if(isset($veterinaria->ubicacion))
                                    {{ $veterinaria->ubicacion->departamento == $dep ? 'selected' : '' }}
                                    @else
                                    {{ old('departamento') == $dep ? 'selected' : '' }}
                                    @endif>
                                    {{ $dep }}
                                </option>
                                @endforeach
                            </select>
                            <label for="departamento">Departamento</label>
                            @error('departamento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-floating">
                            <input type="text" inputmode="text" class="form-control @error('ciudad') is-invalid @enderror" id="ciudad" placeholder="Ciudad" name="ciudad" maxlength="100" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->ciudad : old('ciudad') }}">
                            <label for="ciudad">Ciudad</label>
                            @error('ciudad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" inputmode="text" class="form-control @error('municipio') is-invalid @enderror" id="municipio" placeholder="Municipio" name="municipio" maxlength="100" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->municipio : old('municipio') }}">
                            <label for="municipio">Municipio</label>
                            @error('municipio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" inputmode="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" placeholder="Dirección" name="direccion" maxlength="200" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->direccion : old('direccion') }}">
                            <label for="direccion">Dirección</label>
                            @error('direccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="form-floating">
                            <input type="text" inputmode="decimal" class="form-control @error('latitud') is-invalid @enderror" id="latitud" placeholder="Latitud" name="latitud" maxlength="10" value="{{ isset($veterinaria->ubicacion) ? rtrim(rtrim(number_format($veterinaria->ubicacion->latitud, 6, '.', ''), '0'), '.') : old('latitud') }}">
                            <label for="latitud">Latitud</label>
                            @error('latitud')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="form-floating">
                            <input type="text" inputmode="decimal" class="form-control @error('longitud') is-invalid @enderror" id="longitud" placeholder="Longitud" name="longitud" maxlength="10" value="{{ isset($veterinaria->ubicacion) ? rtrim(rtrim(number_format($veterinaria->ubicacion->longitud, 6, '.', ''), '0'), '.') : old('longitud') }}">
                            <label for="longitud">Longitud</label>
                            @error('longitud')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <br>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <h5 class="form-label">Imágenes de la Veterinaria</h5>
                        <hr>
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle w-100" type="button" id="addImageButton" data-bs-toggle="dropdown" aria-expanded="false" onchange="previewImage()">
                                <i class="fa-solid fa-plus me-2"></i> Agregar Imagen
                            </button>
                            <div class="dropdown-menu p-3 w-100" aria-labelledby="addImageButton">
                                <input type="file" class="form-control @error('imagenes') is-invalid @enderror mb-2" id="imagenes" name="imagenes[]" accept="image/png,image/jpeg,image/jpeg" maxlength="5120" onchange="previewImage(this)" value="{{ isset($veterinaria) ? $veterinaria->imagenes : old('imagenes') }}" multiple>
                                @error('imagenes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div id="imagePreview" class="mt-2 d-flex flex-wrap gap-2" style="min-height: 200px; max-width: 700px; display: none;">
                            @if(isset($veterinaria) && !$veterinaria->imagenes->isEmpty())
                            @foreach ($veterinaria->imagenes as $imagen)
                            <div class="image-preview-item" data-image-id="{{ $imagen->id }}">
                                <img src="{{ asset('storage/' . $imagen->path) }}" alt="Imagen de la veterinaria" style="width: 200px; height: 200px; object-fit: cover; border-radius: 8px;">
                                <button type="button" class="remove-btn btn btn-danger btn-sm" onclick="removeImage(this)" data-id="{{ $imagen->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                            
                            @endforeach
                            @endif
                        </div>

                    </div>

                    <div class="col-md-6">
                        <h5 class="form-label">Redes Sociales</h5>
                        <hr>
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle w-100" type="button" id="addSocialButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-plus me-2"></i> Agregar Red Social
                            </button>
                            <div class="dropdown-menu dropdown-menu-light p-3 w-100" aria-labelledby="addSocialButton">
                                <div class="mb-3">
                                    <select class="form-select @error('social_network') is-invalid @enderror" id="socialNetwork" name="social_network">
                                        <option value="">Seleccione una red</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control @error('social_username') is-invalid @enderror" id="socialUsername" placeholder="Nombre de usuario" maxlength="100" name="social_username">

                                </div>
                                
                                <button type="button" class="btn btn-primary w-100" onclick="addSocialLink()">Agregar</button>
                            </div>
                        </div>

                        <div id="socialLinks" class="mt-3">
                            @if(isset($veterinaria) && !$veterinaria->redes->isEmpty())
                            @foreach ($veterinaria->redes as $red)
                            <div class="social-link-item" data-red-id="{{ $red->id }}">
                                <span>{{ $red->tipo_red_social ?? 'Sin tipo de red' }}: {{ $red->nombre_usuario ?? 'Sin usuario' }}</span>
                                <input type="hidden" name="redes[{{ $loop->index }}][tipo_red_social]" value="{{ $red->tipo_red_social }}">
                                <input class="mt-1" type="hidden" maxlength="100" name="redes[{{ $loop->index }}][nombre_usuario]" value="{{ $red->nombre_usuario }}">
                                <button type="button" class="btn btn-outline-danger btn-sm ms-auto" onclick="removeRed(this)">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="submit" class="btn btn-{{ isset($veterinaria) ? 'warning' : 'success' }}">
                            <i class="fa-solid fa-save"></i>
                            {{ isset($veterinaria) ? 'Actualizar' : 'Crear' }}
                        </button>
                        <button type="reset" class="btn btn-danger" title="Borrar todos los campos">
                            <i class="fa-solid fa-broom"></i> Limpiar
                        </button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alertModalLabel">Advertencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Por favor, complete todos los campos.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
    @section('footer')
    @endsection
    <style>
        .dropdown-menu {
            background-color: #fff !important;
            color: #212529 !important;
        }
        .dropdown-menu .form-select,
        .dropdown-menu .form-control {
            background-color: #fff !important;
            color: #212529 !important;
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


        .btn-primary,
        .btn-primary:hover,
        .btn-outline-danger,
        .btn-outline-danger:hover .btn-danger,
        .btn-danger:hover {
            transition: none !important;
            transform: none !important;
            animation: none !important;
        }

        .btn-danger {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            color: #fff !important;
        }

        .btn-danger:hover,
        .btn-danger:focus {
            background-color: #b52a37 !important;
            border-color: #b52a37 !important;
            color: #fff !important;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .dropdown-menu {
            background-color: rgba(244, 245, 250, 0.85);
            color: #fff;
            border: 1px solid #444;
        }

        .dropdown-menu .form-control,
        .dropdown-menu .form-select {
            background-color: #333;
            color: #fff;
            border: 1px solid #444;
        }

        .social-link-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            gap: 10px;
        }

        .social-icon.facebook {
            background: url('images/facebook-icon.png') no-repeat center center;
            width: 20px;
            height: 20px;
        }

        .social-icon.instagram {
            background: url('images/vacio.svg') no-repeat center center;
            width: 20px;
            height: 20px;
        }

        .image-preview-item {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 5px;
            display: inline-block;
        }

        .image-preview-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .extra-images-counter {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            border-radius: 8px;
        }

        #imagePreview {
            display: none;
            flex-wrap: wrap;
            gap: 10px;
            min-width: auto;
            margin-top: 1rem;
        }

        .image-preview-item .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
        }

        .fade-in {
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn-primary,
        .btn-danger {
            transition: transform 0.2s;
        }

        .btn-primary:hover,
        .btn-danger:hover {
            transform: scale(1.05);
        }

        .btn-success {
            transition: background 0.2s, transform 0.2s;
        }

        .btn-success:hover {
            background: #1e4183;
            transform: scale(1.08) rotate(-3deg);
        }

        .form-floating > .form-control, .form-floating > .form-select {
            padding: 0.5rem 0.75rem;
            font-size: 0.95rem;
        }
        .btn-sm {
            padding: 0.25rem 0.7rem;
            font-size: 0.95rem;
        }
        .image-preview-item .remove-btn {
            width: 22px;
            height: 22px;
            font-size: 11px;
            padding: 0;
        }
    </style>

    <script>
        document.querySelector('form#formularioVeterinaria').addEventListener('reset', function() {
            document.getElementById('socialLinks').innerHTML = '';
            const imagePreview = document.getElementById('imagePreview');
            if (imagePreview) {
                imagePreview.innerHTML = '';
                imagePreview.style.display = 'none';
            }
            if (typeof imageFiles !== 'undefined') imageFiles = [];
            }

            // Limpiar arrays JS si los usas
            if (typeof imageFiles !== 'undefined') imageFiles = [];
            if (typeof deletedImages !== 'undefined') deletedImages = [];
            if (typeof deletedRedes !== 'undefined') deletedRedes = [];
            if (typeof socialCount !== 'undefined') socialCount = 0;

            // Limpiar inputs hidden de eliminados
            const deletedImagesInput = document.getElementById('deleted_images');
            if (deletedImagesInput) deletedImagesInput.value = '';
            const deletedRedesInput = document.getElementById('deleted_redes');
            if (deletedRedesInput) deletedRedesInput.value = '';

            setTimeout(() => {
                this.querySelectorAll('input:not([type=hidden]):not([type=submit]):not([type=reset]):not([type=button]), select, textarea').forEach(el => {
                    if (el.type === 'checkbox' || el.type === 'radio') {
                        el.checked = false;
                    } else {
                        el.value = '';
                    }
                });
            }, 1);
        });

        document.addEventListener('DOMContentLoaded', function() {
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                window.location.href = "{{ route('veterinarias.index') }}";
            };
        });
    </script>

    <script>
        let imageFiles = []; 
        let socialCount = 0;

        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const files = Array.from(input.files);

            imageFiles = imageFiles.concat(files);
            preview.innerHTML = '';

            files.forEach((file, index) => {
                if (file.type === 'image/png' || file.type === 'image/jpeg' || file.type === 'image/jpg') {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.classList.add('image-preview-item', 'fade-in');
                        div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-btn" onclick="removeImage(this, ${index})">X</button>
                    `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });

            updateFileInput();
        }

        let deletedImages = [];
        let deletedRedes = [];

        function removeImage(button) {
            const imageContainer = button.parentElement;
            const imageId = imageContainer.getAttribute('data-image-id');

            if (imageId) {
                deletedImages.push(imageId);

                let deletedImagesInput = document.getElementById('deleted_images');
                if (!deletedImagesInput) {
                    deletedImagesInput = document.createElement('input');
                    deletedImagesInput.type = 'hidden';
                    deletedImagesInput.name = 'deleted_images';
                    deletedImagesInput.id = 'deleted_images';
                    document.getElementById('formularioVeterinaria').appendChild(deletedImagesInput);
                }


                deletedImagesInput.value = deletedImages.join(',');
            }

            imageContainer.remove();

            if (!imageId) {
                updateFileInput();
            }
        }



        function addSocialLink() {
            const network = document.getElementById('socialNetwork').value;
            const username = document.getElementById('socialUsername').value;

            if (!network || !username) {
                const alertModal = new bootstrap.Modal(document.getElementById('alertModal'));
                alertModal.show();
                return;
            }

            const socialLinks = document.getElementById('socialLinks');
            const div = document.createElement('div');
            div.classList.add('social-link-item');

            const icon = network === 'Facebook' ? 'fab fa-facebook' : 'fab fa-instagram';
            div.innerHTML = `
            <span>${network || 'ninguna'}: ${username || 'ninguno'}</span>

            <button type="button" class="btn btn-outline-danger btn-sm ms-auto" onclick="this.parentElement.remove()">
                <i class="fa-solid fa-trash"></i>
            </button>

            <input type="hidden" name="redes[${socialCount}][tipo_red_social]" value="${network}">
            <input type="hidden" name="redes[${socialCount}][nombre_usuario]" value="${username}">`;

            socialLinks.appendChild(div);
            socialCount++;

            document.getElementById('socialNetwork').value = '';
            document.getElementById('socialUsername').value = '';

            document.getElementById('addSocialButton').click();
        }

        function removeRed(button) {
            const redContainer = button.parentElement;
            const redId = redContainer.getAttribute('data-red-id');

            if (redId) {
                deletedRedes.push(redId);

                let deletedRedesInput = document.getElementById('deleted_redes');
                if (!deletedRedesInput) {
                    deletedRedesInput = document.createElement('input');
                    deletedRedesInput.type = 'hidden';
                    deletedRedesInput.name = 'deleted_redes';
                    deletedRedesInput.id = 'deleted_redes';
                    document.getElementById('formularioVeterinaria').appendChild(deletedRedesInput);
                }
                deletedRedesInput.value = deletedRedes.join(',');
            }

            redContainer.remove();
        }


    </script>

        <script>
                document.getElementById('telefono').addEventListener('input', function() {
                    this.value = this.value.replace(/\D/g, '');

                    if (this.value.length > 8) {
                        this.value = this.value.slice(0, 8);
                    }
                });
        </script>

        <script>
            document.getElementById('whatsapp').addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');

                if (this.value.length > 8) {
                    this.value = this.value.slice(0, 8);
                }
            });
        </script>

    @endsection