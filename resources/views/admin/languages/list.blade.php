@extends('admin/layouts/header')

@section('content')
<div class="list-author-admin">
  <p>Listado de Idiomas</p>
  <ul>
    @foreach ($languages as $language)
    <li>
      <a href="/admin/languages/show/{{ $language->id }}">{{ $language['name'] }}</a>
    </li>
    @endforeach
  </ul>
</div>


@endsection
