@extends('admin/layouts/header')

@section('content')

<div class="fondo-create-form">
  <div class="create-title">
    <h3>Agrega una Editorial</h3>
  </div>
  <div class='create-form'>
    <form class="create-book" action="/admin/publishers/create" method="post">
      @csrf
      <p>
        <label for="name">Editorial:</label>
        <input type="text" name="name" value="{{ old('name') }}">
      </p>
      @error('name')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <button type="submit" class="store">
        Guardar
      </button>
    </form>
  </div>
</div>

@endsection
