@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
  <section class="cart-container">
    <h2>Estos son tus libros favoritos, {{ auth()->user()->first_name }}</h2>


    <!-- los encabezados -->
    <div class="cart-header">
      <div class="item-image">
        <h4>Libro</h4>
      </div>
      <div class="item-title">
        <h4>Título y Autor</h4>
      </div>
      <div class="item-price">
        <h4>Precio</h4>
      </div>
    </div>

    <!-- los items del carrito -->
    @if(!empty($books))
    @forelse ($books as $book)
    <div class="cart-row">
      <div class="item-image row-height">
        <img src="{{ asset('storage/covers/' . $book->cover_img_url) }}" alt="{{ $book->title }}">
      </div>
      <div class="item-title row-height flex-center">
        <h4>{{ $book->title }}</h4>
        <h5>{{ $book->author->fullName() }}</h5>
        <h5>{{ $book->publisher->name }}</h5>
      </div>
      <div class="item-price row-height flex-center">
        <h3>$ {{ number_format($book->price, 2) }}</h3>
      </div>
      <div class="botones-favoritos">
        <div class="item-remove row-height flex-center">
          <a href="{{ url('book/add/' . $book->id) }}">Agregar al <i class="fas fa-shopping-cart"></i></a>
        </div>
        <div class="item-remove row-height flex-center">
          <a href="{{ url('/user/deleteFavorites/' . $book->id) }}">Quitar</a>
        </div>
      </div>
    </div>
    @empty
    @endforelse
    @else
    <h4>No tiene libros favoritos.</h4>
    @endif
  </section>
@endsection
