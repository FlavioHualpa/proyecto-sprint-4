@extends('admin/layouts/header')

@section('content')
  <div class="panel-admin">
    <p>Bienvenido al Panel de Control</p>
  </div>
  <br>
  <br>
  <div class="items-panel-admin">
    <ul>
      <li><a href="/admin/authors/list">Listado de Autores</a></li>
      <li><a href="/admin/publishers/list">Listado de Editoriales</a></li>
      <li><a href="/admin/genres/list">Listado de Géneros</a></li>
      <li><a href="/admin/languages/list">Listado de Idiomas</a></li>
      <li><a href="/admin/books/list">Listado de Libros</a></li>
    </ul>
  </div>
@endsection
