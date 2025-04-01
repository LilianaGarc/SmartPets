@extends('layout.plantillaSaid')

@section('titulo', 'Creación de Veterinaria')

@section('contenido')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
                <h1 class="mb-0 card-title fw-bold">
                    @if(isset($veterinaria))
                    Editar Veterinaria
                    @else
                    Crear Veterinaria
                    @endif
                </h1>
                <a href="{{ route('veterinarias.index') }}" class="btn btn-success" role="button" style="font-size: 150%;">
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
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre" value="{{ isset($veterinaria) ? $veterinaria->nombre : old('nombre') }}">
                            <label for="nombre">Nombre</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nombre_veterinario" placeholder="Propietario" name="nombre_veterinario" value="{{ isset($veterinaria) ? $veterinaria->nombre_veterinario : old('nombre_veterinario') }}">
                            <label for="nombre_veterinario">Propietario</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="telefono" placeholder="Número de teléfono" name="telefono" value="{{ isset($veterinaria) ? $veterinaria->telefono : old('telefono') }}">
                            <label for="telefono">Número de teléfono</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input type="tel" class="form-control" id="whatsapp" placeholder="Número de WhatsApp" name="whatsapp" value="{{ isset($veterinaria) ? $veterinaria->whatsapp : old('whatsapp') }}">
                            <label for="whatsapp">Número de WhatsApp:</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="form-floating">
                            <input type="time" class="form-control" id="horario_apertura" placeholder="Horario" name="horario_apertura" value="{{ isset($veterinaria) ? $veterinaria->horario_apertura : old('horario_apertura') }}" step="1800">
                            <label for="horario_apertura">Hora de Apertura</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="form-floating">
                            <input type="time" class="form-control" id="horario_cierre" placeholder="Horario" name="horario_cierre" value="{{ isset($veterinaria) ? $veterinaria->horario_cierre : old('horario_cierre') }}" step="1800">
                            <label for="horario_cierre">Hora de Cierre</label>
                        </div>
                    </div>

                    @php
                    $departamentos = [
                    'Atlántida', 'Choluteca', 'Colón', 'Comayagua', 'Copán', 'Cortés',
                    'El Paraíso', 'Francisco Morazán', 'Gracias a Dios', 'Intibucá',
                    'Islas de la Bahía', 'La Paz', 'Lempira', 'Ocotepeque', 'Olancho',
                    'Santa Bárbara', 'Valle', 'Yoro'
                    ];
                    @endphp


                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <select class="form-select" id="departamento" name="departamento">
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
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="ciudad" placeholder="Ciudad" name="ciudad" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->ciudad : old('ciudad') }}">
                            <label for="ciudad">Ciudad</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="municipio" placeholder="Municipio" name="municipio" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->municipio : old('municipio') }}">
                            <label for="municipio">Municipio</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="direccion" placeholder="Dirección" name="direccion" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->direccion : old('direccion') }}">
                            <label for="direccion">Dirección</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="form-floating">
                            <input type="number" step="any" class="form-control" id="latitud" placeholder="Latitud" name="latitud" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->latitud : old('latitud') }}">
                            <label for="latitud">Latitud</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-2">
                        <div class="form-floating">
                            <input type="number" step="any" class="form-control" id="longitud" placeholder="Longitud" name="longitud" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->longitud : old('longitud') }}">
                            <label for="longitud">Longitud</label>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Imágenes y Redes Sociales -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <h5 class="form-label">Imágenes de la Veterinaria</h5>
                        <hr>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle w-100" type="button" id="addImageButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-plus me-2"></i> Agregar Imagen
                            </button>
                            <div class="dropdown-menu p-3 w-100" aria-labelledby="addImageButton">
                                <input type="file" class="form-control mb-2" id="imagenes" name="imagenes[]" accept="image/png,image/jpeg,image/jpeg" onchange="previewImage(this)" value="{{ isset($veterinaria) ? $veterinaria->imagenes : old('imagenes') }}" multiple>
                            </div>
                        </div>
                        <div id="imagePreview" class="mt-3 d-flex flex-wrap gap-3" style="min-height: 250px;">
                            @if(isset($veterinaria) && !$veterinaria->imagenes->isEmpty())
                            @foreach ($veterinaria->imagenes as $imagen)
                                <div class="image-preview-item">
                                    <img src="{{ asset('storage/' . $imagen->path) }}" alt="Imagen de la veterinaria">
                                    <button type="button" class="remove-btn" onclick="removeImage(this)">X</button>

                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5 class="form-label">Redes Sociales</h5>
                        <hr>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle w-100" type="button" id="addSocialButton" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-plus me-2"></i> Agregar Red Social
                            </button>
                            <div class="dropdown-menu p-3 w-100" aria-labelledby="addSocialButton">
                                <div class="mb-3">
                                    <select class="form-select" id="socialNetwork" name="social_network">
                                        <option value="">Seleccione una red</option>
                                        <option value="Facebook">Facebook</option>
                                        <option value="Instagram">Instagram</option>
                                </div>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="socialUsername" placeholder="Nombre de usuario" name="social_username">
                                </div>
                                <button type="button" class="btn btn-primary w-100" onclick="addSocialLink()">Agregar</button>
                            </div>
                        </div>
                        <div id="socialLinks" class="mt-3"></div>
                        @if(isset($veterinaria) && !$veterinaria->redes->isEmpty())
                        @foreach ($veterinaria->redes as $red)
                        <div class="social-link-item">
                            <span>{{ $red->tipo_red_social ?? 'Sin tipo de red' }}: {{ $red->nombre_usuario ?? 'Sin usuario' }}</span>
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.parentElement.remove()">Eliminar</button>
                            <input type="hidden" name="redes[{{ $loop->index }}][tipo_red_social]" value="{{ $red->tipo_red_social }}">
                            <input type="hidden" name="redes[{{ $loop->index }}][nombre_usuario]" value="{{ $red->nombre_usuario }}">
                        </div>
                        @endforeach
                        @endif
                    </div>

                    <br>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <input class="btn btn-danger" type="reset" value="Limpiar">
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

    <style>
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .dropdown-menu {
            background-color: #1a1a1a;
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
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        .image-preview-item {
            position: relative;
            display: inline-block;
        }

        .image-preview-item img {
            max-width: 150px;
            max-height: 150px;
            border-radius: 8px;
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
    </style>


    <script>
        let imageFiles = []; // Array para almacenar los archivos seleccionados

        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const files = Array.from(input.files);
            imageFiles = imageFiles.concat(files); // Agregar nuevos archivos al array

            files.forEach((file, index) => {
                if (file.type === 'image/png' || file.type === 'image/jpeg') {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.classList.add('image-preview-item');
                        div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview">
                        <button type="button" class="remove-btn" onclick="removeImage(this, ${imageFiles.length - files.length + index})">X</button>
                    `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Actualizar el input de archivos con los archivos actuales
            updateFileInput();
        }

        function removeImage(button, index) {
            // Eliminar el archivo del array
            imageFiles.splice(index, 1);

            // Eliminar la imagen del DOM
            button.parentElement.remove();

            // Actualizar el input de archivos
            updateFileInput();
        }

        function updateFileInput() {
            const input = document.getElementById('imagenes');
            const dataTransfer = new DataTransfer();
            imageFiles.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }

        let socialCount = 0;

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
            div.innerHTML = `
            <span>${network || 'ninguna'}: ${username || 'ninguno'}</span>
            <button type="button" class="btn btn-outline-danger btn-sm" onclick="this.parentElement.remove()">Eliminar</button>
            <input type="hidden" name="redes[${socialCount}][tipo_red_social]" value="${network}">
            <input type="hidden" name="redes[${socialCount}][nombre_usuario]" value="${username}">
        `;
            socialLinks.appendChild(div);
            socialCount++;

            // Resetear los campos
            document.getElementById('socialNetwork').value = '';
            document.getElementById('socialUsername').value = '';

            // Cerrar el dropdown (si usas Bootstrap)
            document.getElementById('addSocialButton').click();
        }
    </script>
    @endsection