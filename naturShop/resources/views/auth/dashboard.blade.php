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

                    <!-- Botón solo para administradores -->
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('products.create') }}" class="btn btn-warning mb-3">
                            Crear nuevo producto
                        </a>
                    @endif

                    <!-- Botón para editar los datos del usuario -->
                    <a href="{{ route('usuario.editar', Auth::user()->id) }}" class="btn btn-primary mb-3">
                        Editar mis datos
                    </a>

                    <!-- Botón para eliminar el usuario -->
                    <form action="{{ route('usuario.eliminar', Auth::user()->id) }}" method="POST" class="mb-3">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">
                            Eliminar mi usuario
                        </button>
                    </form>

                    <!-- Botón para ver los datos del usuario -->
                    <a href="{{ route('user.data', Auth::user()->id) }}" class="btn btn-info mb-4">
                        Ver mis datos
                    </a>

                    <!-- Sección de direcciones -->
                    <h5>Mis direcciones</h5>

                    <a href="{{ route('address.create') }}" class="btn btn-success mb-3">
                        Añadir nueva dirección
                    </a>

                    @forelse(Auth::user()->address as $address)
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
                        <p>No tienes direcciones registradas.</p>
                    @endforelse

                    <!-- Botón para cerrar sesión -->
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
