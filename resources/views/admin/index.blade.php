@extends('admin/layouts/header')

@section('content')
    <h4>Bienvenido al Panel de Control</h4>
      <div class="comandos">
        <ul>
          <li><a href="/admin/authors/list">Autores</a></li>
          <li><a href="/admin/publishers/list">Editoriales</a></li>
          <li><a href="/admin/genres/list">Géneros</a></li>
          <li><a href="/admin/languages/list">Idiomas</a></li>
          <li><a href="/admin/books/list">Libros</a></li>
        </ul>
      </div>
@endsection
