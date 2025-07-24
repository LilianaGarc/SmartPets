<section>
    <header>
        <h2 class="h5 mb-2 text-primary">
            {{ __('Actualizar Contraseña') }}
        </h2>
        <p class="mb-3 text-muted">
            {{ __('Asegúrate de que tu cuenta esté usando una contraseña larga y aleatoria para mantenerla segura.') }}
        </p>
    </header>

    <form method="POST" action="{{ route('password.update') }}" autocomplete="off">
        @csrf
        @method('PUT')

        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input id="current_password" name="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" placeholder="Contraseña Actual" required autocomplete="current-password">
                    <label for="current_password">Contraseña Actual <span style="color:red">*</span></label>
                    @error('current_password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input id="password" name="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" placeholder="Nueva Contraseña" required autocomplete="new-password">
                    <label for="password">Nueva Contraseña <span style="color:red">*</span></label>
                    @error('password', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" placeholder="Confirmar Contraseña" required autocomplete="new-password">
                    <label for="password_confirmation">Confirmar Contraseña <span style="color:red">*</span></label>
                    @error('password_confirmation', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <!-- Agrega esto antes del botón Guardar -->
            <div class="col-md-12">
                <div class="form-floating mb-3">
                    <input id="verification_code" name="verification_code" type="text" class="form-control @error('verification_code', 'updatePassword') is-invalid @enderror" placeholder="Código de verificación" required>
                    <label for="verification_code">Código de verificación <span style="color:red">*</span></label>
                    @error('verification_code', 'updatePassword')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="button" class="btn btn-outline-secondary mb-2" onclick="enviarCodigo()">Enviar código al correo</button>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">{{ __('Guardar') }}</button>
            @if (session('status') === 'password-updated')
                <span class="text-success ms-3">{{ __('Guardado.') }}</span>
            @endif
        </div>
    </form>
</section>

<!-- Modal Bootstrap para mostrar mensaje -->
<div class="modal fade" id="codigoModal" tabindex="-1" aria-labelledby="codigoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="codigoModalLabel">Verificación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="codigoModalBody">
        <!-- Aquí va el mensaje -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
function enviarCodigo() {
    fetch("{{ route('enviar.codigo.verificacion') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json"
        }
    })
    .then(response => response.json())
    .then(data => {
        let modalBody = document.getElementById('codigoModalBody');
        if(data.success){
            modalBody.textContent = 'Código enviado al correo.';
        } else {
            modalBody.textContent = 'No se pudo enviar el código.';
        }
        let codigoModal = new bootstrap.Modal(document.getElementById('codigoModal'));
        codigoModal.show();
    })
    .catch(() => {
        let modalBody = document.getElementById('codigoModalBody');
        modalBody.textContent = 'Error al enviar el código.';
        let codigoModal = new bootstrap.Modal(document.getElementById('codigoModal'));
        codigoModal.show();
    });
}
</script>
