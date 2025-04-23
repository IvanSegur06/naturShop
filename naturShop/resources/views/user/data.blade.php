@extends('auth.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Datos del Usuario
                </div>

                <div class="card-body">
                    <h3>Detalles del Usuario:</h3>
                    <ul>
                        <li><strong>Nombre:</strong> {{ $user->name }}</li>
                        <li><strong>Email:</strong> {{ $user->email }}</li>
                        <!-- Agrega más campos del usuario si lo deseas -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
