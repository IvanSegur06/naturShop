@extends('auth.template')

@section('content')
<div class="container">
    <h2>Crear nuevo producto</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" name="stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea name="description" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
