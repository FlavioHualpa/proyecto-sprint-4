@extends('admin/layouts/header')

@section('content')
<div class="list-book-admin">
  <p>Listado de Libros</p>
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
