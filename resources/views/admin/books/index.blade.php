@extends('layouts/header')

@section('styles')
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/article.css">
  <link rel="stylesheet" href="/css/footer.css">
@endsection

@section('content')
<h1>Bienvenido al Panel de Control</h1>
  <div class="">
    <ul>
      <li><a href="#">Autores</a></li>
      <li><a href="#">Editoriales</a></li>
      <li><a href="#">Géneros</a></li>
      <li><a href="#">Idiomas</a></li>
      <li><a href="#">Libros</a></li>
    </ul>
  </div>
@endsection
