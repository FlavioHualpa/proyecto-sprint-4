@extends('admin/layouts/header')

@section('content')

<div class="fondo-create-form">
  <div class="create-title">
    <h3>Edita un Autor</h3>
  </div>
  <div class='create-form'>
    <form class="create-book" action="/admin/authors/edit/{{ $author->id }}" method="post">
      @csrf
      <p>
        <label for="first_name">Nombre:</label>
        <input type="text" name="first_name" value="{{ old('first_name', $author->first_name) }}">
      </p>
      @error('first_name')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="last_name">Apellido:</label>
        <input type="text" name="last_name" value="{{ old('last_name', $author->last_name) }}">
      </p>
      @error('last_name')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <button type="submit" class="store">
        Guardar
      </button>
    </form>
  </div>
</div>
@endsection
