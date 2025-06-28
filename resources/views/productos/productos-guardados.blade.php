@extends('productos.productos-layout')@extends('MenuPrincipal.Navbar')
@section('title', 'Productos Guardados')
@section('contenido')

@section('nav')@endsection
<div class="min-vh-100 bg-cream">
    <div class="container py-5">
        <!-- Header -->
        <div class="mb-5">
            <h1 class="display-4 fw-bold mb-3 text-dark">Ver más tarde</h1>
            <p class="text-muted">
                Tienes <span id="total-products">15</span> productos guardados para revisar después
                <span id="showing-info" class="ms-2 small"></span>
            </p>
        </div>

        <div id="empty-state" class="text-center py-5 d-none">
            <i class="fas fa-heart fa-4x text-muted mb-4"></i>
            <h2 class="h4 fw-semibold mb-3 text-dark">No tienes productos guardados</h2>
            <p class="text-muted mb-4">Explora nuestro catálogo y guarda los productos que te interesen</p>
            <a href="/productos" class="btn btn-primary">Explorar productos</a>
        </div>

        <div id="products-container" class="row g-4">
            <!-- Los productos se cargarán aquí dinámicamente -->
        </div>

        <!-- Pagination -->
        <div id="pagination-container" class="d-flex flex-column flex-sm-row align-items-center justify-content-between mt-5 gap-3 d-none">
            <div class="small text-muted">
                Página <span id="current-page-info">1</span> de <span id="total-pages-info">1</span>
            </div>

            <nav aria-label="Navegación de páginas">
                <ul id="pagination" class="pagination mb-0">
                    <!-- La paginación se generará dinámicamente -->
                </ul>
            </nav>
        </div>

        <div id="continue-shopping" class="text-center mt-5">
            <a href="/productos" class="btn btn-outline-primary">Continuar comprando</a>
        </div>
    </div>
</div>
@endsection
