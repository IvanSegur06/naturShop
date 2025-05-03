@extends('auth.template')

@if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Dashboard
            </a>
        @else
            <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Log in
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                    Register
                </a>
            @endif
        @endauth
    </nav>
@endif

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

                        <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm mt-2">
                                Añadir al carrito 🛒
                            </button>
                        </form>

                        {{-- Botón eliminar visible solo si el usuario es admin --}}
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <form action="{{ route('product.destroy', $producto->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar producto ❌</button>
                                </form>
                            @endif
                        @endauth
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
