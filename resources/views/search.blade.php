@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/resultados.css">
  <link rel="stylesheet" href="/css/footer.css">
@endsection

@section('content')
  <section id="resultados">
    <h3>Resultados para '{{ $keywords }}'</h3>

    @if (empty($books))
      <div class="sin-resultados">
        <div>
          <img src="{{ asset('/img/no-results-1.png') }}" alt="no se encontraron resultados">
          <span>No hay resultados</span>
        </div>
        <p>
          Intente repetir la búsqueda con otras palabras
          <br>
          O si prefiere puede regresar <a href="\">a la página principal</a>
        </p>
      </div>
    @else
      <form id="change-page-form" action="" method="get" style="display: none">
        <input type="hidden" name="keywords" value="{{ $keywords }}">
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
            <span>$ {{ number_format($book->price, 2) }}</span>
            <br>
            <a href="#">
              <i class="fas fa-bookmark"></i>
              Agregar a mis libros
            </a>
          </div>
          <p class="desc-1">{{ $book->title }}</p>
          <p class="desc-2">{{ $book->author->fullName() }}</p>
          <p class="desc-3">{{ $book->publisher->name }}</p>
          <p class="desc-4">{{ $book->resena }}</p>
          <span>
            <a href="#">
              agregar al <i class="fas fa-shopping-cart"></i>
            </a>
          </span>
        </article>
      @endforeach
      {{ $books->links() }}
    @endif
  </section>
@endsection
