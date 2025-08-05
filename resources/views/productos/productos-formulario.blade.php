@extends('productos.productos-layout') @extends('MenuPrincipal.Navbar')
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
    @section('nav') @endsection
    <div class="container-fluid mx-3 px-3 mt-2" >
        <div class="form-container p-4 p-md-5">
            <h2 class="text-center mb-4" style="color: var(--blue);">{{isset($producto) ? 'Editar Producto' : 'Publicar Nuevo Producto'}}</h2>

            <!-- Mostrar en los errores de las validaciones-->
            @if(session('success'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($producto) ? route('productos.update',$producto->id) : route('productos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($producto))
                    @method('PUT')
                @endif
                <!-- csrf permite realizar peticiones-->
                <!-- Información Básica -->
                <div class="mb-4">
                    <h4 class="section-title">Información Básica</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="nombre" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id= "nombre" name="nombre" value="{{old('nombre', $producto->nombre ?? '')}}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="precio" class="form-label">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text">L.</span>
                                <input type="number" class="form-control" id="precio" name="precio" required value="{{old('precio', $producto->precio ?? '')}}" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="categoria" class="form-label">Seleccionar mascota</label>
                            <select class="form-select" id="categoria" name="categoria_id" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}"{{ old('categoria_id', $producto-> categoria_id ?? '') == $categoria->id ? 'selected': '' }}>
                                    {{$categoria->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="subcategoria_id" class="form-label">Seleccione Subcategoría</label>
                            <select class="form-select" id="subcategoria_id" name="subcategoria_id" required>
                                <option value="">Seleccione una subcategoría</option>
                                @foreach($categorias as $categoria)
                                    <optgroup label="{{ $categoria->nombre }}">
                                        @foreach($categoria->subcategorias as $subcategoria)
                                            <option value="{{ $subcategoria->id }}" {{ old('subcategoria_id', $producto->subcategoria_id ?? '') == $subcategoria->id ? 'selected' : '' }}>
                                                {{ $subcategoria->nombre }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Imágenes del Producto -->
                <div class="mb-4">
                    <h4 class="section-title">Imágenes del Producto</h4>
                    <div class="image-preview" id="drop-area">
                        <i class="fas fa-cloud-upload-alt mb-3" style="font-size: 2rem; color: var(--orange);"></i>
                        <p class="mb-2">Selecciona las imágenes</p>
                        <input class="btn btn-outline-primary" type="file" id="image-input" name="imagenes[]" accept=".jpg, .png, .gif"  multiple>
                        <small class="d-block mt-2 text-muted">Máximo 5 imágenes. Formato: JPG, PNG. Tamaño máximo: 2MB</small>
                    </div>
                </div>
                <div id="image-preview-container" class="d-flex flex-wrap mt-3"></div>
                    <div class="mt-3">
                        @if(isset($producto) && $producto->imagenes)
                            @foreach($producto->imagenes as $imagen)
                                <div class="mb-2">
                                    <img src="{{ url('storage/' . $imagen) }}" alt="Imagen del Producto" class="img-thumbnail" width="100px">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <h4 class="section-title">Descripción</h4>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" rows="4" name="descripcion" required  > {{old('descripcion', $producto->descripcion ?? '')}} </textarea>
                    </div>
                </div>

                <!-- Inventario -->
                <div class="mb-4">
                    <h4 class="section-title">Inventario</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Cantidad disponible</label>
                            <input type="number" class="form-control" id="stock" name="stock" required value="{{old('stock', $producto->stock ?? '')}}">
                        </div>

                    </div>
                </div>

                  <!-- Botones de Acción -->
                <div class="d-flex gap-2 justify-content-end">
                    <a href="{{route('productos.index')}}" class="btn btn-outline-primary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Publicar</button>
                </div>
            </form>
        </div>
    </div>
    @section('footer')
    @endsection
    <script>

        // Detectar clic en el botón y abrir el selector de archivos
        document.getElementById('image-input').addEventListener('click', function() {
            this.value = null; // Resetear el valor para permitir la misma imagen
        });


        document.getElementById('image-input').addEventListener('change', function() {
            const files = this.files;
            const previewContainer = document.getElementById('image-preview-container');

            // Limpiar la vista previa anterior
            previewContainer.innerHTML = '';

            // Validar cantidad de imágenes
            if (files.length > 5) {
                alert('No se pueden subir más de 5 imágenes.');
                this.value = ''; // Limpiar el input
                return;
            }

            // Mostrar vista previa de las imágenes seleccionadas
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.classList.add('img-thumbnail');
                    img.style.width = '100px';
                    img.style.margin = '5px';
                    previewContainer.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });

        // Manejar arrastrar y soltar
        const dropArea = document.getElementById('drop-area');

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('dragover');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('dragover');
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('dragover');
            const files = event.dataTransfer.files;
            document.getElementById('image-input').files = files;
            console.log("Imágenes arrastradas:", files); // Para depuración


            document.getElementById('image-input').addEventListener('change', function() {
                const files = this.files;
                if (files.length > 5) {
                    alert('No se pueden subir más de 5 imágenes.');
                    this.value = ''; // Limpiar el input
                }
            });



    </script>



@endsection


