@extends('auth.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Botón para volver a la tienda -->
            <div class="mb-3">
                <a href="{{ url('/') }}" class="btn btn-outline-primary">
                    Ir a la Tienda
                </a>
            </div>

            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>You are logged in!</p>

                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('products.create') }}" class="btn btn-warning mb-3">
                            Crear nuevo producto
                        </a>
                    @endif
                    <!-- Gestión de categorías (solo admin) -->
@if(Auth::user()->role === 'admin')
    <hr>
    <h5>Categorías</h5>

    <!-- Formulario para crear nueva categoría -->
    <form action="{{ route('categories.store') }}" method="POST" class="mb-3 d-flex gap-2">
        @csrf
        <input type="text" name="nameCategory" class="form-control" placeholder="Nombre de la categoría" required>
        <button type="submit" class="btn btn-success">Crear categoría</button>
    </form>

    <!-- Listado y botón de eliminar -->
    @foreach($categorias as $categoria)
        <div class="d-flex justify-content-between align-items-center border rounded p-2 mb-2">
            <span>{{ $categoria->nameCategory }}</span>
            <form action="{{ route('categories.destroy', $categoria->idCategory) }}" method="POST" onsubmit="return confirm('¿Eliminar esta categoría?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">Eliminar</button>
            </form>
        </div>
    @endforeach
@endif

                    <a href="{{ route('usuario.editar', Auth::user()->id) }}" class="btn btn-primary mb-3">
                        Editar mis datos
                    </a>

                    <form action="{{ route('usuario.eliminar', Auth::user()->id) }}" method="POST" class="mb-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">
                            Eliminar mi usuario
                        </button>
                    </form>

                    <a href="{{ route('user.data', Auth::user()->id) }}" class="btn btn-info mb-4">
                        Ver mis datos
                    </a>

                    <!-- Sección de direcciones -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Mis direcciones</h5>
                        <!-- Barra de búsqueda -->
                        <form action="{{ route('dashboard') }}" method="GET" class="d-flex">
                            <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Buscar dirección..." value="{{ request('search') }}">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Buscar</button>
                        </form>
                    </div>

                    <a href="{{ route('address.create') }}" class="btn btn-success mb-3">
                        Añadir nueva dirección
                    </a>

                    @php
                        $direcciones = Auth::user()->address;
                        $search = request('search');
                        if ($search) {
                            $direcciones = $direcciones->filter(function ($address) use ($search) {
                                return str_contains(strtolower($address->street), strtolower($search))
                                    || str_contains(strtolower($address->city), strtolower($search))
                                    || str_contains(strtolower($address->country), strtolower($search))
                                    || str_contains(strtolower($address->postcode), strtolower($search));
                            });
                        }
                    @endphp

                    @forelse($direcciones as $address)
                        <div class="border p-2 mb-2 rounded">
                            {{ $address->street }}, {{ $address->number }} - {{ $address->city }} ({{ $address->postcode }}) - {{ $address->country }}

                            <div class="mt-2">
                                <a href="{{ route('address.edit', $address->id) }}" class="btn btn-sm btn-primary">Editar</a>

                                <form action="{{ route('address.destroy', $address->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('¿Eliminar esta dirección?')">
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>No se encontraron direcciones.</p>
                    @endforelse

                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            Cerrar sesión
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
