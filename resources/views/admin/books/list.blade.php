@extends('admin/layouts/header')

@section('content')
<h1>Listado de Libros</h1>
<div class="">
  <ul>
    @foreach ($books as $book)
    <li>
      <a href="/admin/books/show/{{ $book->id }}">{{ $book['title'] }}</a>
    </li>
    @endforeach
  </ul>
</div>
{{$books->links()}}

@endsection
