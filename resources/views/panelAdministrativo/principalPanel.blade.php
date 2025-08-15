@extends('panelAdministrativo.plantillaPanel')

@section('contenido')
    <div class="container-fluid mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <div class="col">
                <a href="{{ route('users.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/carduserpanel.png') }}" alt="Card Usuario">
                        <h5>Usuario</h5>
                        <p>Información de usuarios</p>
                        <div class="counter" data-count="{{ $conteos['usuarios'] }}">0</div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('publicaciones.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardpublicacionpanel.png') }}" alt="Card Publicacion">
                        <h5>Publicación</h5>
                        <p>Información de publicaciones</p>
                        <div class="counter" data-count="{{ $conteos['publicaciones'] }}">0</div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('veterinarias.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardveterinariapanel.png') }}" alt="Card Veterinaria">
                        <h5>Veterinaria</h5>
                        <p>Información de veterinarias</p>
                        <div class="counter" data-count="{{ $conteos['veterinarias'] }}">0</div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('adopciones.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardadopcionpanel.png') }}" alt="Card Adopción">
                        <h5>Adopción</h5>
                        <p>Información de las publicaciones de adopción</p>
                        <div class="counter" data-count="{{ $conteos['adopciones'] }}">0</div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('eventos.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardeventopanel.png') }}" alt="Card Evento">
                        <h5>Evento</h5>
                        <p>Información de los eventos para mascotas</p>
                        <div class="counter" data-count="{{ $conteos['eventos'] }}">0</div>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('productos.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardproductospanel.png') }}" alt="Card Producto">
                        <h5>Producto</h5>
                        <p>Información de los productos para la petshop</p>
                        <div class="counter" data-count="{{ $conteos['productos'] }}">0</div>
                    </div>
                </a>
            </div>

        </div>
    </div>

    {{-- Contadores animados --}}
    <style>
        .counter {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
            margin-top: 10px;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const counters = document.querySelectorAll('.counter');
            const duration = 600;
            const startNumber = 69;

            counters.forEach(counter => {
                const target = +counter.getAttribute('data-count');
                let current = startNumber;

                if (target > startNumber) {
                    let increment = 1;
                    const stepTime = Math.abs(Math.floor(duration / (target - startNumber)));
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            current = target;
                            clearInterval(timer);
                        }
                        counter.innerText = current;
                    }, stepTime > 20 ? stepTime : 20);
                } else {
                    const stepTime = Math.abs(Math.floor(duration / (startNumber - target)));
                    const timer = setInterval(() => {
                        current--;
                        counter.innerText = current;

                        if (current <= target) {
                            counter.innerText = target;
                            clearInterval(timer);
                        }
                    }, stepTime > 20 ? stepTime : 20);
                }
            });
        });
    </script>


@endsection
