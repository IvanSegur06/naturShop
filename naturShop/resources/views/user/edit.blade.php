@extends('auth.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar Usuario
                </div>

                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('usuario.actualizar', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Campo de Nombre -->
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
                        </div>

                        <!-- Campo de Email -->
                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                        </div>

                        <!-- Aquí puedes añadir más campos si es necesario -->

                        <button type="submit" class="btn btn-primary mt-3">Actualizar Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
