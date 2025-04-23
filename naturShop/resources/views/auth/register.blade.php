@extends('auth.template')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nombre -->
                        <div class="form-group row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }} *</label>
                            <div class="col-md-6">
                                <input id="name" type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       name="name" value="{{ old('name') }}" 
                                       required autocomplete="given-name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Apellido -->
                        <div class="form-group row mb-3">
                            <label for="s_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>
                            <div class="col-md-6">
                                <input id="s_name" type="text" 
                                       class="form-control @error('s_name') is-invalid @enderror" 
                                       name="s_name" value="{{ old('s_name') }}" 
                                       autocomplete="family-name">
                                @error('s_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Teléfono -->
                        <div class="form-group row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="tel" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       name="phone" value="{{ old('phone') }}" 
                                       autocomplete="tel">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }} *</label>
                            <div class="col-md-6">
                                <input id="email" type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       name="email" value="{{ old('email') }}" 
                                       required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Contraseña -->
                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} *</label>
                            <div class="col-md-6">
                                <input id="password" type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       name="password" required 
                                       autocomplete="new-password"
                                       minlength="8">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Confirmar Contraseña -->
                        <div class="form-group row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} *</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" 
                                       class="form-control" 
                                       name="password_confirmation" required 
                                       autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Campo oculto para role -->
                        <input type="hidden" name="role" value="user">

                        <!-- Botón de Registro -->
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary w-100">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection