@extends('auth.template')

@section('content')
<div class="container">
    <h2>Editar dirección</h2>
    <form method="POST" action="{{ route('address.update', $address->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Calle</label>
            <input type="text" name="street" value="{{ $address->street }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Número</label>
            <input type="number" name="number" value="{{ $address->number }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Ciudad</label>
            <input type="text" name="city" value="{{ $address->city }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>País</label>
            <input type="text" name="country" value="{{ $address->country }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Código postal</label>
            <input type="text" name="postcode" value="{{ $address->postcode }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Actualizar dirección</button>
    </form>
</div>
@endsection
