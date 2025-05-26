@extends('auth.template')
@if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <a
                href="{{ url('/dashboard') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Dashboard
            </a>
        @else
            <a
                href="{{ route('login') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Log in
            </a>

            @if (Route::has('register'))
                <a
                    href="{{ route('register') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
                >
                    Register
                </a>
            @endif
        @endauth
    </nav>
@endif
@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 style="color: #2e7d32; font-weight: bold;">Bienvenido a naturShop 🌿</h1>
            <p style="color: #4caf50;">Descubre nuestros productos naturales, seleccionados con cariño para ti.</p>
        </div>

        <!-- Barra de búsqueda alineada a la derecha -->
        <form action="{{ route('shop') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="Buscar productos..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-success">Buscar 🔍</button>
        </form>

       <!-- Filtros de productos -->
<form action="{{ route('shop') }}" method="GET" class="d-flex align-items-center ms-2 gap-2">
    <select name="filter" class="form-select">
        <option value="" {{ request('filter') == '' ? 'selected' : '' }}>Todos los productos</option>
        <option value="favorites" {{ request('filter') == 'favorites' ? 'selected' : '' }}>Solo favoritos</option>
    </select>

    <select name="category" class="form-select">
        <option value="">Todas las categorías</option>
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->idCategory }}" {{ request('category') == $categoria->idCategory ? 'selected' : '' }}>
                {{ $categoria->nameCategory }}
            </option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-outline-success">Filtrar</button>
</form>
    </div>

    <div class="row">
        @forelse ($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm" style="border: 1px solid #e0e0e0;">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $producto->name }}</h5>
                        <p class="card-text">{{ $producto->description }}</p>
                        <p><strong>💰 Precio:</strong> {{ number_format($producto->price, 2) }} €</p>
                        <p><strong>📦 Stock:</strong> {{ $producto->stock }}</p>
                        <p><strong>📦 Stock:</strong> {{ $producto->stock }}</p>
<p><strong>🏷️ Categoría(s):</strong>
    @if($producto->categories->isEmpty())
        <span class="text-muted">Sin categoría</span>
    @else
        {{ $producto->categories->pluck('nameCategory')->join(', ') }}
    @endif
</p>
                        <!-- Botón añadir al carrito -->
                        <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm mt-2">
                                Añadir al carrito 🛒
                            </button>
                        </form>

                        <!-- Botón añadir a favoritos -->
                        @auth
                            <form action="{{ route('favorites.toggle', $producto->id) }}" method="POST" class="mt-2">
                                @csrf
                                @if(auth()->user()->favoriteProducts->contains($producto->id))
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Quitar de favoritos ❤️</button>
                                @else
                                    <button type="submit" class="btn btn-outline-primary btn-sm">Añadir a favoritos 🤍</button>
                                @endif
                            </form>
                        @endauth

                        <!-- Botón eliminar producto (solo admin) -->
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <form action="{{ route('product.destroy', $producto->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar producto 🗑️</button>
                                </form>
                            @endif
                        @endauth
                        <!-- Formulario para asignar categoría (solo admin) -->
@auth
    @if (auth()->user()->role === 'admin')
        <form action="{{ route('products.assignCategory', $producto->id) }}" method="POST" class="mt-2">
            @csrf
            <div class="input-group">
                <select name="category_id" class="form-select form-select-sm" required>
                    <option value="">Selecciona categoría</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->idCategory }}">{{ $categoria->nameCategory }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-sm btn-outline-secondary">Asignar</button>
            </div>
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
