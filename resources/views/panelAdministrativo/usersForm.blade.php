@extends('panelAdministrativo.plantillaPanel')
@section('contenido')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ isset($user) ? route('users.update', ['id' => $user->id]) : route('users.store') }}">
        @csrf
        @isset($user)
            @method('PUT')
        @endisset

        <div class="card-body">
            @if(isset($user))
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Editar información de usuario</strong></h4>
            @else
                <h4><a href="{{ url()->previous() }}" class="btn" role="button" ><i class="fa-solid fa-arrow-left"></i></a> <strong>Crear un nuevo usuario</strong></h4>
            @endif
            <hr>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="name" name="name" placeholder="Nombre de usuario" value="{{ isset($user) ? $user->name : old('name') }}" required maxlength="20">
                <label for="name">Nombre de usuario <span style="color:red">*</span> </label>
            </div>
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" value="{{ isset($user) ? $user->email : old('email') }}" required maxlength="100">
                <label for="email">Correo electrónico <span style="color:red">*</span> </label>
            </div>

            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password"
                       placeholder="Contraseña"
                       maxlength="25"
                       @if(!isset($user)) required @endif>
                <label for="password">Contraseña @if(!isset($user)) <span style="color:red">*</span> @endif</label>
                @if(isset($user))
                    <small class="form-text text-muted">Deja este campo en blanco si no deseas cambiar la contraseña.</small>
                @endif
            </div>

                @if(isset($user) && $user->email == 'smartpetsunah@gmail.com')
                    <div class="form-floating mb-3">
                        <select class="form-select" id="usertype" disabled aria-disabled="true">
                            <option value="admin" selected>Administrador</option>
                        </select>
                        <input type="hidden" name="usertype" value="admin">
                        <label for="usertype">Tipo de usuario</label>
                        <small class="form-text text-muted">El rol de este usuario está protegido y no puede cambiarse.</small>
                    </div>
                @else
                    <div class="form-floating mb-3">
                        <select class="form-select" name="usertype" id="usertype" aria-label="Tipo de usuario" required>
                            <option value="" disabled {{ old('usertype') ? '' : (!isset($user) ? 'selected' : '') }}>Selecciona el tipo de usuario</option>
                            <option value="admin" {{ (isset($user) && $user->usertype == 'admin') || old('usertype') == 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="user" {{ (isset($user) && $user->usertype == 'user') || old('usertype') == 'user' ? 'selected' : '' }}>Usuario</option>
                        </select>
                        <label for="usertype">Tipo de usuario <span style="color:red">*</span></label>
                        @error('usertype')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        
                    </div>
                @endif

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
                            title="Debe ser un número de 8 dígitos que comience con 2, 3, 8 o 9">
                        <label for="telefono">Teléfono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" value="{{ isset($user) ? $user->direccion : old('direccion') }}" maxlength="150">
                <label for="direccion">Dirección</label>
            </div>
           <div class="form-floating mb-3">
                <textarea
                    class="form-control"
                    id="descripción"
                    name="descripción"
                    placeholder="Descripción"
                    style="height: 100px"  maxlength="200"
                >{{ old('descripción', $user->descripción ?? '') }}</textarea>
                <label for="descripción">Descripción</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancelar</a>
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
        const ta = document.getElementById('descripción');
        const counter = document.getElementById('descripción-contador');
        const max = parseInt(ta.getAttribute('maxlength')) || 200;

        function sliceByChars(str, n) {
            const arr = Array.from(str);
            return arr.length > n ? arr.slice(0, n).join('') : str;
        }

        function update() {
            const before = ta.value;
            const trimmed = sliceByChars(before, max);
            if (trimmed !== before) {
            const pos = ta.selectionStart;
            ta.value = trimmed;

            const p = Math.min(pos, ta.value.length);
            ta.setSelectionRange(p, p);
            }
            if (counter) counter.textContent = `${Array.from(ta.value).length}/${max}`;
        }

        ta.addEventListener('input', update);
        ta.addEventListener('paste', () => requestAnimationFrame(update));
        update();
        })();
     </script>
@endsection
