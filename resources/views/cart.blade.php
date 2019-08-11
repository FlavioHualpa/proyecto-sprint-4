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
      <div class="item-image">
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
      <div class="item-subtotal">
        <h4>Subtotal</h4>
      </div>
    </div>

    <!-- los items del carrito -->
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
      <div class="item-qty row-height flex-center">
        <input type="number" min="0" max="10" name="quantity" value="{{ $book->pivot->quantity }}">
      </div>
      <div class="item-subtotal row-height flex-center">
        <h3>$ {{ number_format($book->price * $book->pivot->quantity, 2) }}</h3>
      </div>
      <div class="item-remove row-height flex-center">
        <a href="{{ url('book/remove/' . $book->id) }}">Quitar</a>
      </div>
    </div>
    @empty
    @endforelse

    <!-- los totales -->
    <div class="cart-footer">
      <div class="item-image">
        <p>&nbsp;</p>
      </div>
      <div class="item-title">
        <h3>Cantidad de libros:</h3>
      </div>
      <div class="item-price">
        <h3>{{ $totalBooks }}</h3>
      </div>
      <div class="item-qty">
        <h3>Total:</h3>
      </div>
      <div class="item-subtotal">
        <h3>$ {{ number_format($totalAmount, 2) }}</h3>
      </div>
    </div>
  </section>
@endsection
