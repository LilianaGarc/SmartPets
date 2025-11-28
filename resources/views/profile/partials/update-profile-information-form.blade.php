<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información del Perfil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza la información de tu cuenta y tu dirección de correo electrónico.") }}
        </p>
    </header>

    <!-- Mensajes de éxito/error -->
    @if(session('exito'))
        <div class="alert alert-success mt-3">
            <i class="fa-solid fa-circle-check"></i> {{ session('exito') }}
        </div>
    @endif

    @if(session('fracaso'))
        <div class="alert alert-danger mt-3">
            <i class="fa-solid fa-circle-xmark"></i> {{ session('fracaso') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('patch')

        <!-- FOTO DE PERFIL -->
        <div class="text-center my-4">
            <img src="{{ Auth::user()->fotoperfil
                ? asset('storage/' . Auth::user()->fotoperfil)
                : asset('images/default-avatar.png') }}"
                 alt="Foto de perfil"
                 class="rounded-circle"
                 style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #fff; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">

            <div class="mt-3">
                <input type="file" name="profile_photo" id="profile_photo" class="form-control" accept="image/*">
                @error('profile_photo')
                <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botón eliminar solo si tiene foto -->
            @if(Auth::user()->fotoperfil)
                <div class="mt-3">
                    <form action="{{ route('profile.photo.delete') }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger btn-sm"
                                onclick="return confirm('¿Seguro que quieres eliminar tu foto de perfil?')">
                            <i class="fa-solid fa-trash"></i> Eliminar foto
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <div class="row g-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" maxlength="20" placeholder="Nombre"
                           value="{{ old('name', Auth::user()->name) }}" required>
                    <label for="name">Nombre <span class="text-danger">*</span></label>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" maxlength="100" placeholder="Correo"
                           value="{{ old('email', Auth::user()->email) }}" required>
                    <label for="email">Correo electrónico <span class="text-danger">*</span></label>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" inputmode="numeric" pattern="[0-9]*"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                           class="form-control @error('telefono') is-invalid @enderror"
                           id="telefono" name="telefono" maxlength="11"
                           placeholder="Teléfono" value="{{ old('telefono', Auth::user()->telefono) }}">
                    <label for="telefono">Teléfono</label>
                    @error('telefono') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('direccion') is-invalid @enderror"
                           id="direccion" name="direccion" maxlength="100"
                           placeholder="Dirección" value="{{ old('direccion', Auth::user()->direccion) }}">
                    <label for="direccion">Dirección</label>
                    @error('direccion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="col-12">
                <div class="form-floating mb-3">
                    <textarea class="form-control @error('descripción') is-invalid @enderror"
                              id="descripción" name="descripción" maxlength="250"
                              style="height: 100px">{{ old('descripción', Auth::user()->descripción) }}</textarea>
                    <label for="descripción">Descripción</label>
                    @error('descripción') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary px-5">
                Actualizar perfil
            </button>
        </div>
    </form>
</section>
