@extends('panelAdministrativo.plantillaPanel')

@section('titulo', isset($veterinaria) ? 'Editar Veterinaria' : 'Crear Veterinaria')

@section('contenido')

    <div class="card-body">
        @if(isset($veterinaria))
            <h4><a href="{{ route('veterinarias.panel') }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Editar la veterinaria</strong></h4>

        @else
            <h4><a href="{{ route('veterinarias.panel') }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Crear una nueva Veterinaria</strong></h4>
        @endif
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
              action="{{ isset($veterinaria) ? route('veterinarias.panelupdate', ['id'=>$veterinaria->id]) : route('veterinarias.panelstore') }}">
            @isset($veterinaria)
                @method('put')
            @endisset
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="id_user" name="id_user" required>
                            <option value="">Seleccione un usuario</option>
                            @foreach($usuarios as $usuario)
                                <option value="{{ $usuario->id }}"
                                    {{ (isset($veterinaria) && $veterinaria->id_user == $usuario->id) ? 'selected' : (old('id_user') == $usuario->id ? 'selected' : '') }}>
                                    {{ $usuario->name }} ({{ $usuario->email }})
                                </option>
                            @endforeach
                        </select>
                        <label for="id_user">Usuario dueño</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de la Veterinaria" value="{{ isset($veterinaria) ? $veterinaria->nombre : old('nombre') }}" maxlength="100" required>
                        <label for="nombre">Nombre de la Veterinaria</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="nombre_veterinario" name="nombre_veterinario" placeholder="Propietario" value="{{ isset($veterinaria) ? $veterinaria->nombre_veterinario : old('nombre_veterinario') }}" maxlength="100" required>
                        <label for="nombre_veterinario">Propietario</label>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono" value="{{ isset($veterinaria) ? $veterinaria->telefono : old('telefono') }}" pattern="[2389]\d{7}" maxlength="8" required title="El número debe ser de 8 dígitos y comenzar con 2, 3, 8 o 9.">
                                <label for="telefono">Teléfono</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp" value="{{ isset($veterinaria) ? $veterinaria->whatsapp : old('whatsapp') }}" pattern="[389]\d{7}" maxlength="8" required title="El número debe ser de 8 dígitos y comenzar con 2, 3, 8 o 9.">
                                <label for="whatsapp">WhatsApp</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="horario_apertura" name="horario_apertura" placeholder="Hora de Apertura" value="{{ isset($veterinaria) ? $veterinaria->horario_apertura : old('horario_apertura') }}" required>
                                <label for="horario_apertura">Hora de Apertura</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="time" class="form-control" id="horario_cierre" name="horario_cierre" placeholder="Hora de Cierre" value="{{ isset($veterinaria) ? $veterinaria->horario_cierre : old('horario_cierre') }}" required>
                                <label for="horario_cierre">Hora de Cierre</label>
                            </div>
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

                    <div class="row">
                        <div class="col-md-4 mb-3">
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
                        <div class="col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->ciudad : old('ciudad') }}" maxlength="50">
                                <label for="ciudad">Ciudad</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="municipio" name="municipio" placeholder="Municipio" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->municipio : old('municipio') }}" maxlength="50">
                                <label for="municipio">Municipio</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->direccion : old('direccion') }}" maxlength="255">
                                <label for="direccion">Dirección</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-floating">
                                <input type="number" step="any" class="form-control" maxlength="10" id="latitud" name="latitud" placeholder="Latitud" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->latitud : old('latitud') }}" min="-90" max="90">
                                <label for="latitud">Latitud</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-floating">
                                <input type="number" step="any" class="form-control" id="longitud" name="longitud" placeholder="Longitud" value="{{ isset($veterinaria->ubicacion) ? $veterinaria->ubicacion->longitud : old('longitud') }}" min="-180" max="180">
                                <label for="longitud">Longitud</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <h5 class="form-label">Imágenes de la Veterinaria</h5>
                    <hr>
                    <div class="dropdown mb-3">
                        <button class="btn btn-primary dropdown-toggle w-100" type="button" id="addImageButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-plus me-2"></i> Agregar Imagen
                        </button>
                        <div class="dropdown-menu p-3 w-100" aria-labelledby="addImageButton">
                            <input type="file" class="form-control mb-2" id="imagenes" name="imagenes[]" accept="image/png,image/jpeg,image/jpg" onchange="previewImage(this)" multiple>
                        </div>
                    </div>
                    <div id="imagePreview" class="mt-3 d-flex flex-wrap gap-3" style="min-height: 250px; display: none;">
                        @if(isset($veterinaria) && !$veterinaria->imagenes->isEmpty())
                            @foreach ($veterinaria->imagenes as $imagen)
                                <div class="image-preview-item" data-image-id="{{ $imagen->id }}">
                                    <img src="{{ asset('storage/' . $imagen->path) }}" alt="Imagen de la veterinaria" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;">
                                    <button type="button" class="remove-btn" onclick="removeImage(this)" data-id="{{ $imagen->id }}">X</button>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <h5 class="form-label mt-4">Redes Sociales</h5>
                    <hr>
                    <div class="dropdown mb-3">
                        <button class="btn btn-primary dropdown-toggle w-100" type="button" id="addSocialButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-plus me-2"></i> Agregar Red Social
                        </button>
                        <div class="dropdown-menu p-3 w-100" aria-labelledby="addSocialButton">
                            <div class="mb-3">
                                <select class="form-select" id="socialNetwork" name="social_network">
                                    <option value="">Seleccione una red</option>
                                    <option value="Facebook">Facebook</option>
                                    <option value="Instagram">Instagram</option>
                                    <option value="Twitter">Twitter / X</option>
                                    <option value="TikTok">TikTok</option>
                                    <option value="YouTube">YouTube</option>
                                    <option value="LinkedIn">LinkedIn</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" id="socialUsername" placeholder="Nombre de usuario" name="social_username">
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
                                    <input class="mt-1" type="hidden" name="redes[{{ $loop->index }}][nombre_usuario]" value="{{ $red->nombre_usuario }}">
                                    <button type="button" class="btn btn-outline-danger btn-sm ms-auto" onclick="removeRed(this)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

                <div class="d-flex gap-2 mt-4">
                    <button type="submit" class="btn btn-success">
                        {{ isset($veterinaria) ? 'Actualizar' : 'Crear' }}
                    </button>
                    <a href="{{ route('veterinarias.panel') }}" class="btn btn-danger" role="button">
                        Cancelar
                    </a>
                </div>
        </form>
    </div>

    <div class="modal fade" id="horarioModal" tabindex="-1" aria-labelledby="horarioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="horarioModalLabel">Error de Horario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    La hora de apertura debe ser menor que la hora de cierre. Por favor, revisa los horarios.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Limpieza de campos al resetear el formulario
        document.querySelector('form#formularioVeterinaria').addEventListener('reset', function() {
            document.getElementById('socialLinks').innerHTML = '';
            const imagePreview = document.getElementById('imagePreview');
            if (imagePreview) {
                imagePreview.innerHTML = '';
                imagePreview.style.display = 'none';
            }
            if (typeof imageFiles !== 'undefined') imageFiles = [];
            if (typeof deletedImages !== 'undefined') deletedImages = [];
            if (typeof deletedRedes !== 'undefined') deletedRedes = [];
            if (typeof socialCount !== 'undefined') socialCount = 0;
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

        // Vista previa de imágenes
        let imageFiles = [];
        let socialCount = 0;
        let deletedImages = [];
        let deletedRedes = [];

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
                        div.classList.add('image-preview-item');
                        div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;">
                        <button type="button" class="remove-btn" onclick="removeImage(this, ${index})">X</button>
                    `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });
            preview.style.display = files.length ? 'flex' : 'none';
        }

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
        }

        // Agregar red social
        function addSocialLink() {
            const network = document.getElementById('socialNetwork').value;
            const username = document.getElementById('socialUsername').value;
            if (!network || !username) {
                alert('Por favor, complete todos los campos de red social.');
                return;
            }
            const socialLinks = document.getElementById('socialLinks');
            const div = document.createElement('div');
            div.classList.add('social-link-item');
            div.innerHTML = `
            <span>${network || 'ninguna'}: ${username || 'ninguno'}</span>
            <button type="button" class="btn btn-outline-danger btn-sm ms-auto" onclick="this.parentElement.remove()">
                <i class="fa-solid fa-trash"></i>
            </button>
            <input type="hidden" name="redes[${socialCount}][tipo_red_social]" value="${network}">
            <input type="hidden" name="redes[${socialCount}][nombre_usuario]" value="${username}">
        `;
            socialLinks.appendChild(div);
            socialCount++;
            document.getElementById('socialNetwork').value = '';
            document.getElementById('socialUsername').value = '';
            document.getElementById('addSocialButton').click();
        }

        // Eliminar red social existente
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
        // Lógica para validar que la hora de apertura sea menor que la de cierre
        document.getElementById('formularioVeterinaria').addEventListener('submit', function(event) {
            const apertura = document.getElementById('horario_apertura').value;
            const cierre = document.getElementById('horario_cierre').value;

            if (apertura && cierre && apertura >= cierre) {
                event.preventDefault(); // Evita que el formulario se envíe
                const myModal = new bootstrap.Modal(document.getElementById('horarioModal'));
                myModal.show();
            }
        });
    </script>

@endsection
