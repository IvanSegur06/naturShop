@extends('auth.template')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4" style="color: #2e7d32; font-weight: bold;">
        Bienvenido a naturShop 🌿
    </h1>
    <p class="text-center mb-5" style="color: #4caf50;">
        Descubre nuestros productos naturales, seleccionados con cariño para ti.
    </p>

    <div class="row">
        @forelse ($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm" style="border: 1px solid #e0e0e0;">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $producto->name }}</h5>
                        <p class="card-text">{{ $producto->description }}</p>
                        <p><strong>💰 Precio:</strong> {{ number_format($producto->price, 2) }} €</p>
                        <p><strong>📦 Stock:</strong> {{ $producto->stock }}</p>
                        <a href="#" class="btn btn-outline-success btn-sm mt-2">Ver más</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No hay productos disponibles por el momento.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
