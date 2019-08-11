@extends('admin/layouts/header')

@section('content')

<div class="fondo-create-form">
  <div class="create-title">
    <h3>Edita un Género</h3>
  </div>
  <div class='create-form'>
    <form class="create-book" action="/admin/genres/edit/{{ $genre->id }}" method="post">
      @csrf
      <p>
        <label for="name">Género:</label>
        <input type="text" name="name" value="{{ old('name', $genre->name) }}">
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
