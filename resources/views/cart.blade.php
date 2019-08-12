@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
  <section class="cart-container">
    <h2>Este es tu carrito, {{ auth()->user()->first_name }}</h2>

    <!-- los encabezados -->
    <div class="cart-header">
      <div class="item-image" style="margin-bottom: 0">
        <h4>Libro</h4>
      </div>
      <div class="item-title">
        <h4>Título y Autor</h4>
      </div>
      <div class="item-price">
        <h4>Precio</h4>
      </div>
      <div class="item-qty">
        <h4>Cantidad</h4>
      </div>
      <div class="item-subtotal display-style">
        <h4>Subtotal</h4>
      </div>
    </div>

    <!-- en este formulario enviamos los datos finales
    **** del carrito para ser procesados luego -->
    <form action="" method="post" id="cart-data" style="display: none">
      @csrf
    </form>

    <!-- los items del carrito -->
    @forelse ($books as $book)
    <article class="cart-row">
      <div class="cart-col">
        <div class="item-image row-height">
          <img src="{{ asset('storage/covers/' . $book->cover_img_url) }}" alt="{{ $book->title }}">
        </div>
        <div class="item-title row-height flex-center">
          <h4>{{ $book->title }}</h4>
          <h5>{{ $book->author->fullName() }}</h5>
          <h5>{{ $book->publisher->name }}</h5>
        </div>
      </div>
      <div class="cart-col">
        <div class="item-price row-height-sm flex-center">
          <h3>$ {{ number_format($book->price, 2) }}</h3>
        </div>
        <div class="item-qty row-height-sm flex-center">
          <input type="number" min="0" max="10" name="quantity-{{ $book->id }}" value="{{ $book->pivot->quantity }}" form="cart-data">
        </div>
      </div>
      <div class="cart-col">
        <div class="item-subtotal row-height-sm flex-center">
          <h3>$ {{ number_format($book->price * $book->pivot->quantity, 2) }}</h3>
        </div>
        <div class="item-remove row-height-sm flex-center">
          <a href="{{ url('cart/remove/' . $book->id) }}">Quitar</a>
        </div>
      </div>
    </article>
    @empty
    @endforelse

    <!-- los totales -->
    <div class="cart-footer">
      <div>
        <h3>Cantidad de libros: {{ $totalBooks }}</h3>
      </div>
      <div>
        <h3>Importe total: $ {{ number_format($totalAmount, 2) }}</h3>
      </div>
    </div>

    <!-- los botones de comprar y actualizar carrito -->
    <div class="cart-buttons">
      <a href="{{ url('cart/checkout') }}" class="buy-button" onclick="event.preventDefault(); document.querySelector('#cart-data').setAttribute('action', '/cart/checkout'); document.querySelector('#cart-data').submit();">Resumen de compra</a>
      <a href="{{ url('cart/update') }}" class="update-button" onclick="event.preventDefault(); document.querySelector('#cart-data').setAttribute('action', '/cart/update'); document.querySelector('#cart-data').submit();">Actualizar carrito</a>
    </div>
  </section>
@endsection
