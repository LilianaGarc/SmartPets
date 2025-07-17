@extends('layout.plantillaSaid')

@section('contenido')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10 col-md-12">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3 flex-wrap gap-3">
                        <div class="profile-img-container me-3 mb-2">
                            <img src="{{ Auth::user()->fotoperfil ? asset('storage/' . Auth::user()->fotoperfil) : asset('images/fotodeperfil.webp') }}"
                                 alt="Foto de perfil"
                                 class="rounded-circle border border-2"
                                 style="width: 110px; height: 110px; object-fit: cover; background: #f8f9fa;">
                        </div>
                        <div>
                            <h2 class="mb-1 fw-bold" style="font-family: 'Oswald', sans-serif;">{{ Auth::user()->name }}</h2>
                            <p class="mb-0 text-muted">{{ Auth::user()->email }}</p>
                            <p class="mb-0 text-muted">Miembro desde: {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                            @if(Auth::user()->telefono)
                                <p class="mb-0 text-muted">Teléfono: {{ Auth::user()->telefono }}</p>
                            @endif
                        </div>
                        <div class="ms-auto">
                            <a href="{{ route('index') }}" class="btn btn-success" role="button" style="font-size: 130%; padding: 8px 16px;">
                                <i class="fa-solid fa-circle-arrow-left"></i>
                            </a>
                        </div>
                    </div>
                    <hr>
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .profile-img-container {
        width: 110px;
        height: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        border-radius: 50%;
        border: 2px solid #e9ecef;
        overflow: hidden;
    }
</style>
@endsection
