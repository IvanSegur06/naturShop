@extends('auth.template')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>

                <div class="card-body">
                    @if(session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in!
                </div>

                <div class="mt-3">
                    <!-- Botón para editar los datos del usuario -->
                    <a href="{{ route('usuario.editar', Auth::user()->id) }}" class="btn btn-primary">
                        Editar mis datos
                    </a>
                </div>

                <div class="mt-3">
                    <form action="{{ route('usuario.eliminar', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta?')">
                            Eliminar mi usuario
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
