@extends('admin/layouts/header')

@section('content')
<div class="list-author-admin">
  <p>Listado de Autores</p>
  <ul>
    @foreach ($authors as $author)
    <li>
      <a href="/admin/authors/show/{{ $author->id }}">{{ $author['last_name'] . ", " . $author['first_name'] }}</a>
    </li>
    @endforeach
  </ul>
</div>
{{$authors->links()}}

@endsection
