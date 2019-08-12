@extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link rel="stylesheet" href="{{ asset('css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
  <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
@endsection

@section('content')
  <section class="checkout-container">
    <h2>Muchas gracias por tu compra!</h2>
    <h3>Te hemos enviado un email con el detalle de tu compra.</h3>
    <br>
    <a href="{{ url('/') }}" class="finalize-button">Volver al inicio</a>
  </section>
@endsection
