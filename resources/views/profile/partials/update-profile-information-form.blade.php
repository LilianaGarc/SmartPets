<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Información del Perfil
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Actualiza la información de tu cuenta.
        </p>
    </header>

    <!-- Mensaje de éxito (Bootstrap) -->
    @if(session('exito'))
        <div class="mt-4 alert alert-success d-flex align-items-center gap-2" role="alert">
            <i class="fa-solid fa-check-circle"></i>
            <span>{{ session('exito') }}</span>
        </div>
    </div>

    @endif

    <!-- Errores de validación (Bootstrap) -->
    @if($errors->any())
        <div class="mt-4 alert alert-danger" role="alert">
            <strong>Por favor corrige los siguientes errores:</strong>
            <ul class="mt-2 mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <!-- ========================= -->
    <!-- FORMULARIO PRINCIPAL     -->
    <!-- ========================= -->
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="profileForm">
        @csrf
        @method('patch')

        <!-- FOTO DE PERFIL -->
        <div class="text-center my-5">

            <img src="{{ Auth::user()->fotoperfil
                ? asset('storage/' . Auth::user()->fotoperfil) . '?t=' . time()
                : asset('images/default-avatar.png') }}"
                 alt="Foto de perfil"
                 class="rounded-circle img-thumbnail"
                 style="width: 140px; height: 140px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">

            <div class="mt-4">
                <input type="file" name="profile_photo" class="form-control" accept="image/*">
                @error('profile_photo')
                <span class="badge bg-danger mt-2">{{ $message }}</span>
                @enderror
            </div>

        </div>

        <div class="row g-4">
            <!-- NOMBRE -->
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text"
                           class="form-control @error('name') is-invalid @enderror"
                           id="name"
                           name="name"
                           value="{{ old('name', Auth::user()->name) }}"
                           maxlength="20"
                           required
                           oninput="validarNombre(this)">
                    <label>Nombre <span class="text-danger">*</span></label>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="nombreError" class="mt-1"></div>
                </div>
            </div>

            <!-- EMAIL -->
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email"
                           class="form-control @error('email') is-invalid @enderror"
                           id="email"
                           name="email"
                           value="{{ old('email', Auth::user()->email) }}"
                           maxlength="100"
                           required>
                    <label>Correo electrónico <span class="text-danger">*</span></label>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- TELÉFONO -->
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text"
                           class="form-control"
                           id="telefono"
                           name="telefono"
                           value="{{ old('telefono', Auth::user()->telefono) }}"
                           maxlength="11"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                    <label>Teléfono</label>
                </div>
            </div>

            <!-- DIRECCIÓN -->
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text"
                           class="form-control"
                           id="direccion"
                           name="direccion"
                           value="{{ old('direccion', Auth::user()->direccion) }}"
                           maxlength="100">
                    <label>Dirección</label>
                </div>
            </div>

            <!-- DESCRIPCIÓN -->
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control"
                              id="descripción"
                              name="descripción"
                              maxlength="250"
                              style="height: 100px">{{ old('descripción', Auth::user()->descripción) }}</textarea>
                    <label>Descripción</label>
                </div>
            </div>
        </div>

        <div class="text-end mt-5">
            <button type="submit" class="btn btn-primary px-5 py-2">
                Guardar cambios
            </button>
        </div>

    </form>

    <!-- ========================= -->
    <!-- FORMULARIO ELIMINAR FOTO -->
    <!-- ========================= -->
    @if(Auth::user()->fotoperfil)
        <div class="mt-3 text-center">

            {{-- ⭐ Este formulario queda independiente del principal --}}
            <form action="{{ route('profile.photo.delete') }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('¿Eliminar foto?')">
                    Eliminar foto
                </button>
            </form>

        </div>
    @endif

</section>

<script>
    function validarNombre(input) {
        const valor = input.value.trim();
        const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s'-]+$/;
        const errorDiv = document.getElementById('nombreError');

        if (valor && !regex.test(valor)) {
            errorDiv.innerHTML = '<span class="badge bg-danger mt-1">Solo letras, espacios, - y \'</span>';
            input.setCustomValidity('Nombre inválido');
        } else {
            errorDiv.innerHTML = '';
            input.setCustomValidity('');
        }
    }
</script>
