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
                        <input type="text" 
                            class="form-control @error('telefono') is-invalid @enderror" 
                            inputmode="numeric"
                            id="telefono" 
                            name="telefono"
                            placeholder="Ej: 98765432"
                            value="{{ old('telefono', $user->telefono ?? '') }}"
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
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" name="direccion" maxlength="150" placeholder="Dirección" value="{{ old('direccion', Auth::user()->direccion) }}">
                        <label for="direccion">Dirección</label>
                        @error('direccion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                   <div class="form-floating mb-3">
                    <textarea
                        class="form-control @error('descripción') is-invalid @enderror"
                        id="descripcion" 
                        name="descripción" 
                        placeholder="Descripción"
                    >{{ old('descripción', $user->{'descripción'} ?? '') }}</textarea>
                    
                    <label for="descripcion">Descripción</label>

                    @error('descripción')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                </div>
            </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">Actualizar perfil</button>
        </div>
    </form>

    <script>
        document.getElementById('telefono').addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');

            if (this.value.length > 8) {
                this.value = this.value.slice(0, 8);
            }
        });
    </script>

    <script>
        (function () {
            const ta = document.getElementById('descripcion');
            const counter = document.getElementById('descripcion-contador');
            const max = parseInt(ta.getAttribute('maxlength')) || 200;

            function sliceByChars(str, n) {
                // Evita cortar emojis / caracteres compuestos a la mitad
                const arr = Array.from(str);
                return arr.length > n ? arr.slice(0, n).join('') : str;
            }

            function update() {
                const before = ta.value;
                const trimmed = sliceByChars(before, max);
                if (trimmed !== before) {
                    const pos = ta.selectionStart;
                    ta.value = trimmed;
                    // Mantiene el cursor en una posición válida
                    const p = Math.min(pos, ta.value.length);
                    ta.setSelectionRange(p, p);
                }
                if (counter) counter.textContent = `${Array.from(ta.value).length}/${max}`;
            }

            ta.addEventListener('input', update);
            ta.addEventListener('paste', () => requestAnimationFrame(update));
            // Inicializa contador y recorte si el valor inicial ya excede
            update();
        })();
    </script>

</section>