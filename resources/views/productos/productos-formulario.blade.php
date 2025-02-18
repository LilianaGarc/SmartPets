@extends('productos.productos-layout')
@section('titulo','Formulario Producto')
@section('contenido')
    <style>
        :root {
            --orange: #ED8119;
            --blue: #18478B;
            --cream: #FFF8F0;
            --dark: #1F1F1F;
        }

        body {
            background-color: var(--cream);
        }

        .form-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .form-label {
            color: var(--dark);
            font-weight: 500;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--orange);
            box-shadow: 0 0 0 0.25rem rgba(237, 129, 25, 0.25);
        }

        .btn-primary {
            background-color: var(--blue);
            border-color: var(--blue);
        }

        .btn-primary:hover {
            background-color: #133c75;
            border-color: #133c75;
        }

        .btn-outline-primary {
            color: var(--blue);
            border-color: var(--blue);
        }

        .btn-outline-primary:hover {
            background-color: var(--blue);
            border-color: var(--blue);
        }

        .section-title {
            color: var(--orange);
            border-bottom: 2px solid var(--orange);
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .image-preview {
            border: 2px dashed var(--orange);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
    </head>
    <body>
    <div class="container py-5">
        <div class="form-container p-4 p-md-5">
            <h2 class="text-center mb-4" style="color: var(--blue);">Crear Nuevo Producto</h2>

            <!-- Mostrar en los errores de las validaciones-->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('productos.store')}}" method="POST">
                @csrf
                <!-- csrf permite realizar peticiones-->
                <!-- Información Básica -->
                <div class="mb-4">
                    <h4 class="section-title">Información Básica</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id= "nombre" name="nombre" required>
                        </div>

                        <div class="col-md-6">
                            <label for="precio" class="form-label">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text">L.</span>
                                <input type="number" class="form-control" id="precio" name="precio" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="categoria" class="form-label">Categoría de Mascota</label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="">Seleccionar categoría</option>
                                <option value="dog">Perros</option>
                                <option value="cat">Gatos</option>
                                <option value="bird">Aves</option>
                                <option value="fish">Peces</option>
                                <option value="reptile">Reptiles</option>
                                <option value="smallPet">Pequeñas Mascotas</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Imágenes del Producto -->
                <div class="mb-4">
                    <h4 class="section-title">Imágenes del Producto</h4>
                    <div class="image-preview">
                        <i class="fas fa-cloud-upload-alt mb-3" style="font-size: 2rem; color: var(--orange);"></i>
                        <p class="mb-2">Arrastra y suelta las imágenes aquí o</p>
                        <button type="button" class="btn btn-outline-primary" id="select-images-btn">Seleccionar Archivos</button>
                        <input type="file" id="image-input" name="images[]" multiple accept=".jpg, .png" style="display: none;">
                        <small class="d-block mt-2 text-muted">Máximo 5 imágenes. Formato: JPG, PNG. Tamaño máximo: 2MB</small>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <h4 class="section-title">Descripción</h4>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" rows="4" name="descripcion" required></textarea>
                    </div>
                </div>

                <!-- Inventario -->
                <div class="mb-4">
                    <h4 class="section-title">Inventario</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Cantidad en Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>

                    </div>
                </div>

                <!-- Estado y Visibilidad -->
                <!--  <div class="mb-4">
                      <h4 class="section-title">Estado</h4>
                      <div class="row g-3">
                          <div class="col-md-6">
                              <label for="activo" class="form-label">Estado</label>
                              <select class="form-select" id="activo" name="activo" required>
                                  <option value="true">Activo</option>
                                  <option value="false">Inactivo</option>
                              </select>
                          </div>

                      </div>  -->
                  </div>

                  <!-- Botones de Acción -->
                <div class="d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-outline-primary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Producto</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Detectar clic en el botón y abrir el selector de archivos
        document.getElementById('select-images-btn').addEventListener('click', function() {
            document.getElementById('image-input').click();
        });

        // Opcional: mostrar una vista previa de las imágenes seleccionadas
        document.getElementById('image-input').addEventListener('change', function() {
            const files = this.files;
            if (files.length > 0) {
                console.log("Imágenes seleccionadas:", files); // Para depuración
            }
        });
    </script>

@endsection


