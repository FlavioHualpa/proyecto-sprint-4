@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
<section class="purchase-container">
  <h2>
    Este es tu resumen de compras, {{ auth()->user()->first_name }}
  </h2>
  <div class="purchase-header">
    <div class="item-date" style="margin-bottom: 0">
      <h4>Fecha</h4>
    </div>
    <div class="item-invoice">
      <h4>Factura Nro.</h4>
    </div>
    <div class="item-qty">
      <h4>Cantidad de libros</h4>
    </div>
    <div class="item-subtotal display-style">
      <h4>Importe Total</h4>
    </div>
  </div>
  @forelse ($purchases as $purchase)
  <article class="cart-row">
    <div class="cart-col">
      <div class="item-date purch-row-height flex-center">
        <h3>
          {{ \Carbon\Carbon::parse($purchase->created_at)->format('d-m-y') }}
        </h3>
      </div>
    </div>
    <div class="cart-col">
      <div class="item-invoice purch-row-height-sm flex-center">
        <h3>
          {{ $purchase->invoice_number }}
        </h3>
      </div>
    </div>
    <div class="cart-col">
      <div class="item-qty purch-row-height-sm flex-center">
        <h3>
          {{ $purchase->books()->sum('quantity') }}
        </h3>
      </div>
    </div>
    <div class="cart-col">
      <div class="item-subtotal purch-row-height-sm flex-center">
        <h3>
          $ {{ number_format($purchase->books()->sum('subtotal'), 2) }}
        </h3>
      </div>
    </div>
    <div class="cart-col">
      <div class="purch-search purch-row-height-sm flex-center">
        <a href="{{ url('/user/purchases/' . $purchase->id) }}">
          <i class="fas fa-search-plus"></i>
        </a>
      </div>
    </div>
  </article>
  @empty
  @endforelse
  <div class="back-home row-height-back flex-center">
    <a href="{{ url('/') }}">Volver al inicio</a>
  </div>
</section>

@endsection
