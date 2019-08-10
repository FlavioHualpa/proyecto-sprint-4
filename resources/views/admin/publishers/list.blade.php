@extends('admin/layouts/header')

@section('content')
<div class="list-author-admin">
  <p>Listado de Editoriales</p>
  <ul>
    @foreach ($publishers as $publisher)
    <li>
      <a href="/admin/publishers/show/{{ $publisher->id }}">{{ $publisher['name'] }}</a>
    </li>
    @endforeach
  </ul>
</div>
{{$publisher->links()}}

@endsection
