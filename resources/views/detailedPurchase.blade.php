@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
  <section class="cart-container">
    <h2>{{ auth()->user()->first_name }}, esta es tu Factura Nro. {{ $purchase->invoice_number }}.</h2>

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


    <!-- los items de la compra -->
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
          <h3>{{ $book->pivot->quantity }}</h3>
        </div>
      </div>
      <div class="cart-col">
        <div class="item-subtotal row-height-sm flex-center">
          <h3>$ {{ number_format($book->price * $book->pivot->quantity, 2) }}</h3>
        </div>
      </div>
    </article>
    @empty
    @endforelse

    <!-- los totales -->
    <div class="cart-footer">
      <div>
        <h3>Cantidad de libros: {{ $purchase->books()->sum('quantity') }}</h3>
      </div>
      <div>
        <h3>Importe total: $ {{ number_format($purchase->books()->sum('subtotal'), 2) }}</h3>
      </div>
    </div>

    <div class="back-home row-height-back flex-center">
      <a href="{{ url('user/purchases/') }}">Volver al resumen de compras</a>
    </div>
  </section>
@endsection
