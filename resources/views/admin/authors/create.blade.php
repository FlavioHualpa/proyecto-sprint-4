@extends('admin/layouts/header')

@section('content')

<div class="fondo-create-form">
  <div class="create-title">
    <h3>Agrega un Autor</h3>
  </div>
  <div class='create-form'>
    <form class="create-book" action="/admin/authors/create" method="post">
      @csrf
      <p>
        <label for="first_name">Nombre:</label>
        <input type="text" name="first_name" value="">
      </p>
      <p>
        <label for="last_name">Apellido:</label>
        <input type="text" name="last_name" value="">
      </p>
      <button type="submit" class="store">
        Guardar
      </button>
    </form>
  </div>
</div>

@endsection
