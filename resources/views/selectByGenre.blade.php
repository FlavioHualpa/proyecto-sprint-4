@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/resultados.css">
  <link rel="stylesheet" href="/css/footer.css">
@endsection

@section('content')
  <section id="resultados">
    <h3>Resultados para el género {{ $selectedGenre['name'] }}</h3>
    @if ($books->total() == 0)
      <div class="sin-resultados">
        <div>
          <img src="{{ asset('/img/no-results-1.png') }}" alt="no se encontraron resultados">
          <span>No hay resultados</span>
        </div>
        <p>
          Intente repetir la búsqueda con otro género
          <br>
          O si prefiere puede regresar <a href="\">a la página principal</a>
        </p>
      </div>
    @else
      <form id="change-page-form" action="" method="get" style="display: none">
        <input type="hidden" name="selectedGenre" value="{{ $selectedGenre['name'] }}">
        <input type="hidden" name="page" value="">
      </form>
      <h3>Mostrando resultados {{ $books->firstItem() }} a {{ $books->lastItem() }} de {{ $books->total() }}</h3>
      {{ $books->links() }}
      @foreach ($books as $book)
        <article class="item-resultado">
          <div>
            <a href="/book/{{ $book->id }}">
              <img src="{{ asset('/storage/covers/' . $book->cover_img_url) }}" alt="{{ $book->title }}">
            </a>
            <br>
            <span>$ {{ number_format($book->price, 2, ',', '.') }}</span>
            <br>

            {{-- formulario para agregar el libro a los favoritos --}}
            <form action="{{ url('favorite/add') }}" method="post" id="add-fav-{{ $book->id }}-form">
              @csrf
              <input type="hidden" name="book_id" value="{{ $book->id }}">
            </form>

            {{-- formulario para agregar el libro a los favoritos --}}
            <form action="{{ url('favorite/remove') }}" method="post" id="remove-fav-{{ $book->id }}-form">
              @csrf
              @method('delete')
              <input type="hidden" name="book_id" value="{{ $book->id }}">
            </form>

            {{-- 
              -- si el libro ya es favorito del usuario muestro
              -- un link para poder quitarlo de la lista
            --}}
            @if (Auth::user() && Auth::user()->hasFavorite($book))
              <a href="{{ url('favorite/remove') }}" onclick="event.preventDefault(); document.querySelector('#remove-fav-{{ $book->id }}-form').submit();">
                <i class="fas fa-bookmark"></i>
                Quitar de mis libros
              </a>
            @else
              <a href="{{ url('favorite/add') }}" onclick="event.preventDefault(); document.querySelector('#add-fav-{{ $book->id }}-form').submit();">
                <i class="fas fa-bookmark"></i>
                Agregar a mis libros
              </a>
            @endif
          </div>
          <p class="desc-1">{{ $book->title }}</p>
          <p class="desc-2">{{ $book->author->fullName() }}</p>
          <p class="desc-3">{{ $book->genre->name }}</p>
          <p class="desc-4">{{ $book->resena }}</p>
          {{-- <span>
            <a href="/cart/add/{{ $book->id }}">
              agregar al <i class="fas fa-shopping-cart"></i>
            </a>
          </span> --}}
          <form action="{{ url('cart/add') }}" method="post">
            @csrf
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <button type="submit">agregar al <i class="fas fa-shopping-cart"></i></button>
          </form>
        </article>
      @endforeach
      {{ $books->links() }}
    @endif
  </section>
@endsection
