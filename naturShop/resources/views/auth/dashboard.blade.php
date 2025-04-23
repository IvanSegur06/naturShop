@extends('auth.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                    @if(Auth::user()->role === 'admin')
                    <div class="card-body">
    <a href="{{ route('products.create') }}" class="btn btn-warning">
        Crear nuevo producto
    </a>
</div>
                    @endif
                </div>

                <!-- Botón para editar los datos del usuario -->
                <div class="card-body">
                    <a href="{{ route('usuario.editar', Auth::user()->id) }}" class="btn btn-primary">
                        Editar mis datos
                    </a>
                </div>

                <!-- Botón para eliminar el usuario -->
                <div class="card-body">
                    <form action="{{ route('usuario.eliminar', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">
                            Eliminar mi usuario
                        </button>
                    </form>
                </div>

                <!-- Botón para ver los datos del usuario -->
                <div class="card-body">
                    <a href="{{ route('user.data', Auth::user()->id) }}" class="btn btn-info">
                        Ver mis datos
                    </a>
                </div>

                <!-- Sección de direcciones -->
                <div class="card-body">
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
                </div>

                <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-outline-secondary mt-3">
        Cerrar sesión
    </button>
</form>

            </div>

        </div>
    </div>
</div>
@endsection
