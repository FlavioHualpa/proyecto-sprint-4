@extends('layouts.header')

@section('styles')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<link href="{{ asset('css/header.css') }}" rel="stylesheet">
<link href="{{ asset('css/registration.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <div class="fondoLogYReg">
    <div id="panel-form">
      <p class="texto-registration">¿No estás registrado? Ingresá tus datos en este <a href="{{ route('register') }}" class="link_hipervinculo">link</a></p>
      @error('login')
      <p class="error-usuario">{{ $message }}</p>
      @enderror
      <form class="login" action="{{ route('login') }}" method="post">
        @csrf
        <fieldset>
          <legend>Ingresá tus datos</legend>
          <p>
            <label for="email">Email</label>
            <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="user@email.com" autocomplete="email">
            @error('email')
            <p class="error-login"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
            @enderror
          </p>
          <p>
            <label for="pass">Contraseña</label>
            <input id="pass" type="password" name="password" value="{{ old('password') }}" placeholder="Ingresar Contraseña">
            @error('password')
            <p class="error-login"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
            @enderror
          </p>
          <p class="oh">
            <span class="la">
              <input type="checkbox" name="remember" value="si" id="remember" {{ old('remember') ? 'checked' : '' }}>
              <label for="remember">Recordarme</label>
            </span>
            <span class="ra fs-18 mt-6">
              @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="link_hipervinculo">
                  ¿Olvidó su contraseña?
                </a>
              @endif
            </span>
          </p>
          <div class="botones">
            <p>
              <input type="submit" value="INGRESAR">
            </p>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
  <!--
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  -->
</div>
@endsection
