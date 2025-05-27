@extends('auth.template')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4" style="color: #2e7d32; font-weight: bold;">
        Carrito de Compras 🛒
    </h1>
    <p class="text-center mb-5" style="color: #4caf50;">
        Revisa los productos que has añadido a tu carrito.
    </p>

    <div class="row">
        @php
            $total = 0;
        @endphp

        @forelse ($productos as $producto)
            @php
                $total += $producto->pivot->price * $producto->pivot->nProduct;
            @endphp

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm" style="border: 1px solid #e0e0e0;">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $producto->name }}</h5>
                        <p class="card-text">{{ $producto->description }}</p>
                        <p><strong>💰 Precio:</strong> {{ number_format($producto->pivot->price, 2) }} €</p>
                        <p><strong>📦 Cantidad:</strong> {{ $producto->pivot->nProduct }}</p>

                        <!-- Botón para eliminar del carrito -->
                        <form action="{{ route('cart.remove', $producto->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm mt-2">Eliminar del carrito</button>
                        </form>
                        <form action="{{ route('cart.add', $producto->id) }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline-primary btn-sm mt-2">➕ Añadir uno más</button>
</form>
<!-- Botón para quitar una unidad -->
<form action="{{ route('cart.decrease', $producto->id) }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-outline-warning btn-sm mt-2">➖ Quitar uno</button>
</form>

                    </div>
                </div>
            </div>

            <form action="{{ route('cart.applyDiscount') }}" method="POST" class="mb-3">
    @csrf
    <div class="input-group">
        <input type="text" name="discount_code" class="form-control" placeholder="Código de descuento" required>
        <button type="submit" class="btn btn-success">Aplicar</button>
    </div>
    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-2">{{ session('error') }}</div>
    @endif
</form>

        @empty
            <div class="col-12 text-center">
                <p class="text-muted">No tienes productos en tu carrito.</p>
            </div>
        @endforelse
    </div>

    <!-- Mostrar el total del carrito -->
    @php
    $discountPercentage = $cart && $cart->idDiscount ? $cart->discount->percentage : 0;
    $discountAmount = $total * ($discountPercentage / 100);
    $totalWithDiscount = $total - $discountAmount;
@endphp

<div class="text-right mt-4">
      

    @if ($discountPercentage > 0)
        <p class="text-success">
            Descuento aplicado ({{ $discountPercentage }}%): -{{ number_format($discountAmount, 2) }} €
        </p>
        <h4>Total con descuento: <strong>{{ number_format($totalWithDiscount, 2) }} €</strong></h4>
    @endif
</div>


    <form action="{{ route('checkout') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">Generar Pedido</button>
</form>

    <!-- Botón para volver a la tienda -->
    <div class="text-center mt-4">
        <a href="{{ url('/') }}" class="btn btn-outline-success btn-lg">Volver a la tienda</a>
    </div>
</div>
@endsection
