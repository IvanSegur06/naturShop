@extends('auth.template')

@section('content')
<div class="container">
    <h2>Nueva dirección</h2>
    <form method="POST" action="{{ route('address.store') }}">
        @csrf
        <div class="form-group">
            <label>Calle</label>
            <input type="text" name="street" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Número</label>
            <input type="number" name="number" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Ciudad</label>
            <input type="text" name="city" class="form-control" required>
        </div>
        <div class="form-group">
            <label>País</label>
            <input type="text" name="country" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Código postal</label>
            <input type="text" name="postcode" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success mt-3">Guardar dirección</button>
    </form>
</div>
@endsection
