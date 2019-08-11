@extends('admin/layouts/header')

@section('content')
<div class="list-author-admin">
  <p>Listado de Géneros</p>
  <ul>
    @foreach ($genres as $genre)
    <li>
      <a href="/admin/genres/show/{{ $genre->id }}">{{ $genre['name'] }}</a>
    </li>
    @endforeach
  </ul>
</div>
{{$genres->links()}}

@endsection
