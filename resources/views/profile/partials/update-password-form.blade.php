<section>
    <header>
        <h2 class="h5 mb-2 text-primary">
            {{ __('Actualizar Contraseña') }}
        </h2>
        <p class="mb-3 text-muted">
            {{ __('Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria para mantenerla segura.') }}
        </p>
    </header>

    <form id="formUpdatePassword" method="POST" action="{{ route('password.update') }}" autocomplete="off">
        @csrf
        @method('PUT')

        @if(session('exito'))
            <div class="alert alert-success mt-2" role="alert">
                <div class="d-flex gap-4">
                    <span><i class="fa-solid fa-circle-check icon-success"></i></span>
                    <div>{{ session('exito') }}</div>
                </div>
            </div>
        @endif

        @if(session('fracaso'))
            <div class="alert alert-danger mt-1" role="alert">
                <div class="d-flex gap-4">
                    <span><i class="fa-solid fa-circle-xmark icon-danger"></i></span>
                    <div>{{ session('fracaso') }}</div>
                </div>
            </div>
        @endif

        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input id="current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" placeholder="Contraseña Actual" required autocomplete="current-password" maxlength="25">
                    <label for="current_password">Contraseña Actual <span style="color:red">*</span></label>
                    @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input id="password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" placeholder="Nueva Contraseña" required autocomplete="new-password" maxlength="25">
                    <label for="password">Nueva Contraseña <span style="color:red">*</span></label>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div id="password-feedback" class="invalid-feedback" style="display: none;"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" maxlength="25" placeholder="Confirmar Contraseña" required autocomplete="new-password">
                    <label for="password_confirmation">Confirmar Contraseña <span style="color:red">*</span></label>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="button" class="btn btn-primary" onclick="mostrarModalConfirmacion()">Guardar</button>
            @if (session('status') === 'password-updated')
                <span class="text-success ms-3">{{ __('Guardado.') }}</span>
            @endif
        </div>
    </form>
</section>

<div class="modal fade" id="confirmacionModal" tabindex="-1" aria-labelledby="confirmacionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmacionModalLabel">Confirmar cambio de contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro que deseas cambiar tu contraseña?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('formUpdatePassword').submit()">Sí, cambiar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function mostrarModalConfirmacion() {
        var currentPassword = document.getElementById('current_password').value;
        var newPassword = document.getElementById('password').value;
        var passwordInput = document.getElementById('password');
        var feedback = document.getElementById('password-feedback');

        passwordInput.classList.remove('is-invalid');
        feedback.style.display = 'none';

        if (currentPassword === newPassword && currentPassword !== '') {
            passwordInput.classList.add('is-invalid');
            feedback.textContent = 'La nueva contraseña no puede ser la misma que la actual.';
            feedback.style.display = 'block';
            return;
        }

        let modal = new bootstrap.Modal(document.getElementById('confirmacionModal'));
        modal.show();
    }
</script>
