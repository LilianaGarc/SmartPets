@extends('panelAdministrativo.plantillaPanel')
@section('contenido')
    <div class="container-fluid mt-4">
        <div class="row row-cols-1 row-cols-md-3 g-4">

            <div class="col">
                <a href="{{ route('users.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/carduserpanel.png') }}" alt="Card 1">
                        <h5>Usuario</h5>
                        <p>Informacion de usuarios</p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('publicaciones.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardpublicacionpanel.png') }}" alt="Card 2">
                        <h5>Publicacion</h5>
                        <p>Informacion de publicaciones</p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('veterinarias.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardveterinariapanel.png') }}" alt="Card 3">
                        <h5>Veterinaria</h5>
                        <p>Informacion de veterinarias</p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('adopciones.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardadopcionpanel.png') }}" alt="Card 4">
                        <h5>Adopcion</h5>
                        <p>Informacion de la spublicaciones de adopcion</p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('solicitudes.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardeventopanel.png') }}" alt="Card 6">
                        <h5>Evento</h5>
                        <p>Informacion de los eventos para mascotas</p>
                    </div>
                </a>
            </div>

            <div class="col">
                <a href="{{ route('solicitudes.panel') }}" class="card-link">
                    <div class="custom-card">
                        <img src="{{ asset('images/cardproductospanel.png') }}" alt="Card 6">
                        <h5>Producto</h5>
                        <p>Informacion de los productos para la petshop</p>
                    </div>
                </a>
            </div>


        </div>
    </div>
@endsection
