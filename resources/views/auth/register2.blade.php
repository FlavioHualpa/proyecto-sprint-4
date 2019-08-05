@extends('layouts.header')

@section('styles')
<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
<link href="{{ asset('css/header.css') }}" rel="stylesheet">
<link href="{{ asset('css/registration.css') }}" rel="stylesheet">
@endsection

@section('content')
  <div class="fondoLogYReg">
    <div id="panel-form">
      <form class="registration" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
        @csrf
        @error('submit')
        <p class="error-regist">{{ $message }}</p>
        @enderror
        <fieldset>
          <legend>Creá tu cuenta </legend>
          <p>
            <label for="first_name">Nombre:</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}">
          </p>
          @error('first_name')
          <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
          @enderror
          <p>
            <label for="last_name">Apellido:</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}">
          </p>
          @error('last_name')
          <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
          @enderror
          <p>
            <label for="email">Email:</label>
            <input id="email" type="text" name="email" value="{{ old('email') }}">
          </p>
          @error('email')
          <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
          @enderror
          <p>
            <label for="country_id">País de Nacimiento:</label>
            <select name="country_id" id="country_id">
              @foreach ($countries as $country)
                <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
              @endforeach
            </select>
          </p>
          <p>
            <label for="birth_date">Fecha de Nacimiento:</label>
            <input id="birth_date" type="date" name="birth_date" value="{{ old('birth_date') }}">
          </p>
          @error('birth_date')
          <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
          @enderror
          <p>
            <label>Sexo:</label>
            <div class="sexo">
              <div class="sexo_fem">
                <input id="mujer" type="radio" name="sex" value="f" {{ old('sex') == 'f' ? 'checked' : '' }}>
                <label for="mujer">Femenino</label>
              </div>
              <div class="sexo_masc">
                <input id="hombre" type="radio" name="sex" value="m" {{ old('sex') == 'm' ? 'checked' : '' }}>
                <label for="hombre">Masculino</label>
              </div>
            </div>
          </p>
          @error('sex')
          <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
          @enderror
          <p>
            <label for="avatar">Foto del perfil:</label>
            <br>
            <input id="avatar" type="file" name="avatar" accept=".jpg, .jpeg, .png, .bmp">
          </p>
          @error('avatar')
          <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
          @enderror
          <p>
            <label for="password">Ingresar Contraseña:</label>
            <input id="password" type="password" name="password" value="{{ old('password') }}">
          </p>
          @error('password')
          <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
          @enderror
          <p>
            <label for="passconf">Reingresar Contraseña:</label>
            <input id="passconf" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}">
          </p>
          @error('password_confirmation')
          <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
          @enderror
          <p>
            <div class="terminos">
              <input id="terms" type="checkbox" name="terms">
              <label for="terms">Acepto los <a href="#" class="link_hipervinculo">términos y condiciones</a></label>
            </div>
          </p>
          @error('terms')
          <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
          @enderror
          <div class="botones">
            <p>
              <input type="submit" value="CREAR CUENTA">
            </p>
            <p>
              <input type="reset" value="REINICIAR FORMULARIO">
            </p>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
@endsection
