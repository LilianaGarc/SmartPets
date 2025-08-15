@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    @if ($errors->any())
        <div class="alert alert-warning" style="color: #b35c00; background-color: #fff3cd; border: 1px solid #ffeeba; padding: 10px; border-radius: 5px;">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><strong>{{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          enctype="multipart/form-data"
          action="{{ isset($publicacion) ? route('publicaciones.panelupdate', ['id' => $publicacion->id]) : route('publicaciones.panelstore') }}">
        @csrf
        @isset($publicacion)
            @method('PUT')
        @endisset

        <div class="card-body">
            @if(isset($publicacion))
                <h4>
                    <a href="{{ url()->previous() }}" class="btn" role="button">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <strong>Editar la publicación</strong>
                </h4>
            @else
                <h4>
                    <a href="{{ url()->previous() }}" class="btn" role="button">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <strong>Crear una nueva publicación</strong>
                </h4>
            @endif

            <hr>

                @php
                    $usuarioPublicacion = $publicacion->user ?? auth()->user();
                    $fotoPerfil = $usuarioPublicacion->fotoperfil
                        ? asset('storage/' . $usuarioPublicacion->fotoperfil)
                        : asset('images/fotodeperfil.webp');
                @endphp


                <div class="d-flex align-items-center mb-3">
                <div class="foto-perfil" style="width: 50px; height: 50px; border-radius: 50%; background-size: cover; background-position: center; background-image: url('{{ $fotoPerfil }}'); margin-right: 10px;"></div>
                    <h5 class="mb-0">{{ $usuarioPublicacion->name }}</h5>
            </div>

            <input type="hidden" name="visibilidad" value="publico">

            <div class="form-floating mb-3">
                <textarea class="form-control" name="contenido" id="contenido" placeholder="¿Qué quieres compartir?" style="height: 200px;"
                          maxlength="240" required>{{ old('contenido', $publicacion->contenido ?? '') }}</textarea>
                <label for="contenido">Contenido (máx. 240 caracteres)</label>
            </div>

            @if (!isset($publicacion) || !$publicacion->publicacion_original_id)
                <div class="form-floating mb-3">
                    <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*"
                           @if (!isset($publicacion)) required @endif>
                    <label for="imagen">Imagen</label>
                </div>
            @else
                <div class="alert alert-secondary d-flex align-items-center" role="alert" style="background-color: #f8f9fa; border-left: 5px solid #6c757d;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#6c757d" class="me-2" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0-13A6 6 0 1 1 8 14a6 6 0 0 1 0-12z"/>
                        <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 .933-.252 1.07-.598l.088-.416c.02-.097.048-.115.138-.115h.287l.082-.38h-.287c-.294 0-.352-.176-.288-.469l.738-3.468c.194-.897-.105-1.319-.808-1.319-.545 0-.933.252-1.07.598L7.002 7.1c-.02.097-.048.115-.138.115H6.577l-.082.38h.287c.294 0 .352.176.288.469L6.332 11.1c-.194.897.105 1.319.808 1.319.545 0 .933-.252 1.07-.598l.088-.416c.02-.097.048-.115.138-.115h.287l.082-.38h-.287c-.294 0-.352-.176-.288-.469l.738-3.468c.194-.897-.105-1.319-.808-1.319zM8 4.5a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div>
                        Esta publicación es compartida. No puedes modificar la imagen original.
                    </div>
                </div>
            @endif

                @if (!isset($publicacion) || !$publicacion->publicacion_original_id)
                    <div class="form-group text-center mb-3" style="text-align: center;">
                        <img id="vista-previa-imagen"
                             src="{{ isset($publicacion) && $publicacion->imagen ? asset('storage/' . $publicacion->imagen) : '' }}"
                             alt="Vista previa de la imagen"
                             style="border-radius: 10px; max-width: 200px; height: auto; display: {{ (isset($publicacion) && $publicacion->imagen) ? 'block' : 'none' }}; margin-left: auto; margin-right: auto;">
                        <p class="mt-2"><strong>Vista Previa</strong></p>
                    </div>
                @endif


                <br>
            <button type="submit" class="btn">Guardar</button>
            <a href="{{ url()->previous() }}" class="btn" role="button">Cancelar</a>
        </div>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputImagen = document.getElementById('imagen');
            const vistaPrevia = document.getElementById('vista-previa-imagen');

            if (inputImagen && vistaPrevia) {
                inputImagen.addEventListener('change', function (event) {
                    const file = event.target.files[0];
                    if (file && file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function (e) {
                            vistaPrevia.src = e.target.result;
                            vistaPrevia.style.display = 'block';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        vistaPrevia.src = '';
                        vistaPrevia.style.display = 'none';
                    }
                });
            }
        });
    </script>

@endsection
