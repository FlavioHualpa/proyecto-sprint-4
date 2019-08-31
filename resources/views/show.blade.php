@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/footer.css">
  <link rel="stylesheet" href="/css/resultados.css">
  <link rel="stylesheet" href="/css/detalle.css">
@endsection

@section('content')
  <div id="contenedor_detalle">
    @if (empty($book))
      <div class="sin-resultados">
        <div class="center">
          <img src="{{ asset('/img/advertencia.png') }}" alt="libro no encontrado">
          <span>Lo sentimos no pudimos encontrar ese libro</span>
        </div>
        <p class="center">
          Intente ver el detalle de otro libro
        </p>
      </div>
    @else
      <section class="detalle_libro">
        <div class="detalle_principal">
          <div class="detalle_imagen">
            <img src="{!! '/storage/covers/' . $book['cover_img_url'] !!}" alt="{{ $book['title'] }}">
          </div>
          <div class="detalle_lateral">
            <h3>
              {{ $book['title'] }}
            </h3>
            <h6>
              Ranking: # {{ $book['ranking'] }}
            </h6>
            <h5>
              $ {{ number_format($book->price, 2, ',', '.') }}
            </h5>
            <h6>
              Reseñas del libro:
            </h6>
            <p>
              {{ $book['resena'] }}
            </p>
            <br>
            <form action="{{ url('favorite/add') }}" method="post" id="add-fav-{{ $book->id }}-form">
              @csrf
              <input type="hidden" name="book_id" value="{{ $book->id }}">
            </form>
            <a href="{{ url('favorite/add') }}" onclick="event.preventDefault(); document.querySelector('#add-fav-{{ $book->id }}-form').submit();">
              <i class="fas fa-bookmark"></i>
              Agregar a mis libros
            </a>
            <br>
            <form action="{{ url('cart/add') }}" method="post">
              @csrf
              <input type="hidden" name="book_id" value="{{ $book->id }}">
              <button type="submit">agregar al <i class="fas fa-shopping-cart"></i></button>
            </form>
          </div>
        </div>
        <div class="datos_detallados">
          <h6>
            Detalles del libro:
          </h6>
          <ul>
            <li>
              <b>Autor:</b> {{ $book->author->last_name}}, {{ $book->author->first_name}}
            </li>
            <li>
              <b>Editorial:</b> {{ $book->publisher->name }}
            </li>
            <li>
              <b>I.S.B.N.:</b> {{ $book['isbn'] }}
            </li>
            <li>
              <b>Géneros:</b> {{ $book->genre->name }}
            </li>
            <li>
              <b>Páginas:</b> {{ $book['total_pages'] }}
            </li>
            <li>
              <b>Publicación: {{ $book['release_date'] }}
            </li>
            <li>
              <b>Idioma:</b>  {{ $book->language->name }}
            </li>
          </ul>
        </div>
      </section>
    @endif
  </div>
@endsection
