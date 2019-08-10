@extends('admin/layouts/header')

@section('content')

<div class="fondo-create-form">
  <div class="create-title">
    <h3>Agrega un Idioma</h3>
  </div>
  <div class='create-form'>
    <form class="create-book" action="/admin/languages/create" method="post">
      @csrf
      <p>
        <label for="name">Idioma:</label>
        <input type="text" name="name" value="">
      </p>
      <button type="submit" class="store">
        Guardar
      </button>
    </form>
  </div>
</div>

@endsection
