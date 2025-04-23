@extends('auth.template')

@section('content')
<div class="container">
    <h3>Tu carrito</h3>
    <p>Total de productos: {{ $cart->amount }}</p>
    <p>Total: {{ number_format($cart->total, 2) }} €</p>

    <!-- Aquí irán los productos del carrito -->
</div>
@endsection
