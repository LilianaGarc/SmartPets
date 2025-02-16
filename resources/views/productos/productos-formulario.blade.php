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

            <form>
                <!-- Información Básica -->
                <div class="mb-4">
                    <h4 class="section-title">Información Básica</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="productName" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="productName" required>
                        </div>
                        <div class="col-md-6">
                            <label for="productSKU" class="form-label">SKU</label>
                            <input type="text" class="form-control" id="productSKU" required>
                        </div>
                        <div class="col-md-6">
                            <label for="productPrice" class="form-label">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="productPrice" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="productCategory" class="form-label">Categoría de Mascota</label>
                            <select class="form-select" id="productCategory" required>
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
                        <button type="button" class="btn btn-outline-primary">Seleccionar Archivos</button>
                        <small class="d-block mt-2 text-muted">Máximo 5 imágenes. Formato: JPG, PNG. Tamaño máximo: 2MB</small>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="mb-4">
                    <h4 class="section-title">Descripción</h4>
                    <div class="mb-3">
                        <label for="fullDescription" class="form-label">Descripción Completa</label>
                        <textarea class="form-control" id="fullDescription" rows="4" required></textarea>
                    </div>
                </div>

                <!-- Inventario -->
                <div class="mb-4">
                    <h4 class="section-title">Inventario</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Cantidad en Stock</label>
                            <input type="number" class="form-control" id="stock" required>
                        </div>
                        <div class="col-md-6">
                            <label for="minStock" class="form-label">Stock Mínimo</label>
                            <input type="number" class="form-control" id="minStock" required>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="trackInventory">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estado y Visibilidad -->
                <div class="mb-4">
                    <h4 class="section-title">Estado y Visibilidad</h4>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="productStatus" class="form-label">Estado</label>
                            <select class="form-select" id="productStatus" required>
                                <option value="active">Activo</option>
                                <option value="draft">Borrador</option>
                                <option value="inactive">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="visibility" class="form-label">Visibilidad</label>
                            <select class="form-select" id="visibility" required>
                                <option value="public">Público</option>
                                <option value="private">Privado</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Botones de Acción -->
                <div class="d-flex gap-2 justify-content-end">
                    <button type="button" class="btn btn-outline-primary">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Producto</button>
                </div>
            </form>
        </div>
    </div>

@endsection
