@extends('admin/layouts/header')

@section('content')
  <div class="titulo-list-admin">
    <p>Bienvenido al Panel de Control</p>
  </div>
  <br>
  <br>
  <div class="items-list-admin">
    <ul>
      <li><a href="/admin/authors/list">Autores</a></li>
      <li><a href="/admin/publishers/list">Editoriales</a></li>
      <li><a href="/admin/genres/list">Géneros</a></li>
      <li><a href="/admin/languages/list">Idiomas</a></li>
      <li><a href="/admin/books/list">Libros</a></li>
    </ul>
  </div>
@endsection
