@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
  <section class="checkout-container">
    <h2>Resumen de tu compra, {{ $userName }}</h2>
    <span class="checkout-col-lft">Factura Nº</span>
    <span class="checkout-col-rgt">{{ $invoiceNumber }}</span>
    <br>
    <span class="checkout-col-lft">Cantidad total de libros</span>
    <span class="checkout-col-rgt">{{ $totalBooks }}</span>
    <br>
    <span class="checkout-col-lft">Importe total</span>
    <span class="checkout-col-rgt">$ {{ number_format($totalAmount, 2) }}</span>
    <br>
    <br>
    <a href="{{ url('purchase/finalize') }}" class="finalize-button">Finalizar la compra</a>
    <a href="{{ url('cart/show') }}" class="back-button">Volver al carrito</a>
  </section>
@endsection
