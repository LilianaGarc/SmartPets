<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Información del Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Actualiza la información de tu cuenta y tu dirección de correo electrónico.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
        @if(session('exito'))
    <div class="alert alert-success mt-2" role="alert">
        <div class="d-flex gap-4">
            <span><i class="fa-solid fa-circle-check icon-success"></i></span>
            <div>
                {{ session('exito') }}
            </div>
        </div>
    </div>

    @endif

    @if(session('fracaso'))
    <div class="alert alert-danger mt-1" role="alert">
        <div class="d-flex gap-4">
            <span><i class="fa-solid fa-circle-xmark icon-danger"></i></span>
            <div>
                {{ session('fracaso') }}
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
        @csrf
        @method('patch')

        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" maxlength="20"
                           placeholder="Nombre" value="{{ old('name', Auth::user()->name) }}" required>
                    <label for="name">Nombre <span style="color:red">*</span></label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" maxlength="100"
                           placeholder="Correo electrónico" value="{{ old('email', Auth::user()->email) }}" required>
                    <label for="email">Correo electrónico <span style="color:red">*</span></label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="form-floating mb-3">
                        <input type="text" inputmode="numeric" pattern="[0-9]*" oninput="this.value = this.value.replace(/[^0-9]/g, '')"  inputmode="tel" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" maxlength="11" placeholder="Teléfono" value="{{ old('telefono', Auth::user()->telefono) }}">
                        <label for="telefono">Teléfono</label>
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" maxlength="100" placeholder="Dirección" value="{{ old('direccion', Auth::user()->direccion) }}">
                        <label for="direccion">Dirección</label>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('descripción') is-invalid @enderror" id="descripción" name="descripción" maxlength="250" placeholder="descripción">{{ old('descripción', Auth::user()->descripción) }}</textarea>
                        <label for="descripción">Descripción</label>
                    @error('descripción')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Actualizar perfil</button>
        </div>
    </form>
</section>
