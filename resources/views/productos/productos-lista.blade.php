@extends('productos.productos-layout')
@section('titulo', 'Lista de Productos')

@section('contenido')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --orange: #ED8119;
            --blue: #18478B;
            --cream: #FFF8F0;
            --dark: #1F1F1F;
        }
        .bg-gradient-hero {
            background: linear-gradient(135deg, #00BCD4 50%, #FFAB76 50%);
        }
        .pet-circle {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 3px solid var(--orange);
            padding: 5px;
        }
        .pet-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }
        .btn-shop {
            background-color: var(--cream);
            color: var(--dark);
            border: none;
            padding: 10px 30px;
            border-radius: 25px;
        }
        .category-pill {
            border: 2px solid var(--orange);
            color: var(--dark);
            background: transparent;
            border-radius: 25px;
            padding: 8px 20px;
        }
        .category-pill.active {
            background-color: var(--orange);
            color: white;
        }
        .offer-card {
            border: 2px solid var(--orange);
            border-radius: 15px;
            overflow: hidden;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="bg-gradient-hero py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-white">
                    <h1 class="display-4 fw-bold mb-4">Balanced Diet<br>For Your<br>Loved Ones</h1>
                    <p class="mb-4">Quisqueme suscipit fetor condimentum de causae lucus maefutid blandites.</p>
                    <button class="btn-shop">Shop Now</button>
                </div>
                <div class="col-lg-6">
                    <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/plantillaEjemplo-UQzhR5KMdp048jmRoiPL29A5uv6ite.jpeg" alt="Happy Dog" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Shop by Pet Type -->
    <section class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Shop by pets type</h2>
                <a href="#" class="text-decoration-none" style="color: var(--blue)">View All</a>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-6 col-sm-4 col-lg-2 text-center">
                    <div class="pet-circle mx-auto">
                        <img src="/placeholder.svg?height=150&width=150" alt="Dog">
                    </div>
                    <p class="mt-2 mb-0">Dog</p>
                </div>
                <!-- Repeat for other pet types -->
            </div>
        </div>
    </section>

    <!-- Weekly Special Offers -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-4">Weekly special offers</h2>
            <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
                <button class="category-pill active">Dog</button>
                <button class="category-pill">Cat</button>
                <button class="category-pill">Small Pets</button>
                <button class="category-pill">Fish</button>
                <button class="category-pill">Reptile</button>
                <button class="category-pill">Bird</button>
            </div>
            <div class="row g-4">
                <div class="col-6 col-md-3">
                    <div class="offer-card h-100">
                        <img src="/placeholder.svg?height=200&width=200" alt="Dog Deal" class="w-100">
                        <div class="p-3">
                            <h6>Up to 50% Off Dog Deals</h6>
                        </div>
                    </div>
                </div>
                <!-- Repeat for other offers -->
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
