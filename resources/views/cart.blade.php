@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
  <section class="cart-container">
    @if (filled($books))
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
    @endif

    <!-- los items del carrito -->
    @forelse ($books as $book)
    <article class="cart-row">
      <div class="cart-col">
        <div class="item-image row-height">
          <a href="/book/{{ $book->id }}">
            <img src="{{ asset('storage/covers/' . $book->cover_img_url) }}" alt="{{ $book->title }}">
          </a>
        </div>
        <div class="item-title row-height flex-center">
          <h4>{{ $book->title }}</h4>
          <h5>{{ $book->author->fullName() }}</h5>
          <h5>{{ $book->publisher->name }}</h5>
        </div>
      </div>
      <div class="cart-col">
        <div class="item-price row-height flex-center">
          <h3>$ {{ number_format($book->price, 2, ',', '.') }}</h3>
        </div>
        <div class="item-qty row-height flex-center">
          <input type="number" min="1" max="10" name="quantity-{{ $book->id }}" value="{{ $book->pivot->quantity }}" maxlength="2" form="cart-data">
        </div>
      </div>
      <div class="cart-col">
        <div class="item-subtotal row-height flex-center">
          <h3>$ {{ number_format($book->price * $book->pivot->quantity, 2, ',', '.') }}</h3>
        </div>
        <div class="item-remove row-height flex-center">
          {{-- <a href="{{ url('cart/remove/' . $book->id) }}">Quitar</a> --}}
          <form action="{{ url('cart/removeItem') }}" method="POST">
            @csrf
            @method('delete')
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <button type="submit">Quitar</button>
          </form>
        </div>
      </div>
    </article>
    @empty
    <div class="empty-cart">
      <img src="{{ asset('img/empty-cart.png') }}" alt="Carrito vacío">
      <div class="leyenda-1">Tu carrito está vacío :(</div>
      <div class="leyenda-2">No te preocupes {{ auth()->user()->first_name }},</div>
      <div class="leyenda-2">podés volver más tarde.</div>
      <div class="leyenda-2">Mientras tanto...</div>
      <a class="browse-button" href="{{ url('/') }}">Seguí buscando</a>
    </div>
    @endforelse

    @if (filled($books))
    <!-- los totales -->
    <div class="cart-footer">
      <div>
        <h3>Cantidad de libros: {{ $totalBooks }}</h3>
      </div>
      <div>
        <h3>Importe total: $ {{ number_format($totalAmount, 2, ',', '.') }}</h3>
      </div>
    </div>

    <!-- los botones de comprar y actualizar carrito -->
    <div class="cart-buttons">
      <a href="{{ url('cart/checkout') }}" class="buy-button" onclick="event.preventDefault(); document.querySelector('#cart-data').setAttribute('action', '/cart/checkout'); document.querySelector('#cart-data').submit();">Resumen de compra</a>
      <a href="{{ url('cart/update') }}" class="update-button" onclick="event.preventDefault(); document.querySelector('#cart-data').setAttribute('action', '/cart/update'); document.querySelector('#cart-data').submit();">Actualizar carrito</a>
    </div>
    @endif
  </section>
@endsection

@push('additional-js')
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
  <script src="{{ asset('js/cart.js') }}"></script>
@endpush
