@extends('auth.template')

@if (Route::has('login'))
    <nav class="-mx-3 flex flex-1 justify-end">
        @auth
            <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-black">
                {{ trans('messages.dashboard') }}
            </a>
        @else
            <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-black">
                {{ trans('messages.login') }}
            </a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-black">
                    {{ trans('messages.register') }}
                </a>
            @endif
        @endauth
    </nav>
@endif

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 style="color: #2e7d32; font-weight: bold;">@lang('messages.welcome')</h1>
            <p style="color: #4caf50;">@lang('messages.discover')</p>
        </div>

        <form action="{{ route('shop') }}" method="GET" class="d-flex">
            <input type="text" name="search" class="form-control me-2" placeholder="@lang('messages.search_placeholder')" value="{{ request('search') }}">
            <button type="submit" class="btn btn-success">@lang('messages.search')</button>
        </form>

        <form action="{{ route('shop') }}" method="GET" class="d-flex align-items-center ms-2 gap-2">
            <select name="filter" class="form-select">
                <option value="" {{ request('filter') == '' ? 'selected' : '' }}>@lang('messages.filter_all')</option>
                <option value="favorites" {{ request('filter') == 'favorites' ? 'selected' : '' }}>@lang('messages.filter_favorites')</option>
            </select>

            <select name="category" class="form-select">
                <option value="">@lang('messages.category_all')</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->idCategory }}" {{ request('category') == $categoria->idCategory ? 'selected' : '' }}>
                        {{ $categoria->nameCategory }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-outline-success">@lang('messages.filter')</button>
        </form>
    </div>

    <div class="row">
        @forelse ($productos as $producto)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $producto->name }}</h5>
                        <p class="card-text">{{ $producto->description }}</p>
                        <p><strong>@lang('messages.price'):</strong> {{ number_format($producto->price, 2) }} €</p>
                        <p><strong>@lang('messages.stock'):</strong> {{ $producto->stock }}</p>
                        <p><strong>@lang('messages.categories'):</strong>
                            @if($producto->categories->isEmpty())
                                <span class="text-muted">@lang('messages.no_category')</span>
                            @else
                                {{ $producto->categories->pluck('nameCategory')->join(', ') }}
                            @endif
                        </p>

                        <form action="{{ route('cart.add', $producto->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-sm mt-2">
                                @lang('messages.add_to_cart')
                            </button>
                        </form>

                        @auth
                            <form action="{{ route('favorites.toggle', $producto->id) }}" method="POST" class="mt-2">
                                @csrf
                                @if(auth()->user()->favoriteProducts->contains($producto->id))
                                    <button type="submit" class="btn btn-outline-danger btn-sm">@lang('messages.remove_from_favorites')</button>
                                @else
                                    <button type="submit" class="btn btn-outline-primary btn-sm">@lang('messages.add_to_favorites')</button>
                                @endif
                            </form>
                        @endauth

                        @auth
                            @if (auth()->user()->role === 'admin')
                                <form action="{{ route('product.destroy', $producto->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">@lang('messages.delete_product')</button>
                                </form>
                            @endif
                        @endauth

                        @auth
                            @if (auth()->user()->role === 'admin')
                                <form action="{{ route('products.assignCategory', $producto->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <div class="input-group">
                                        <select name="category_id" class="form-select form-select-sm" required>
                                            <option value="">@lang('messages.select_category')</option>
                                            @foreach ($categorias as $categoria)
                                                <option value="{{ $categoria->idCategory }}">{{ $categoria->nameCategory }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-outline-secondary">@lang('messages.assign_category')</button>
                                    </div>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p class="text-muted">@lang('messages.no_products')</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
