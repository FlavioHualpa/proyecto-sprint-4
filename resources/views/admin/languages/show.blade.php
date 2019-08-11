@extends('admin/layouts/header')

@section('content')
<body>
  <div id="contenedor_detalle">
    <section class="detalle_autor">
      <div class="create-title">
        <h3>Detalle de Idiomas</h3>
      </div>
      <div class="show-item">
        <h4>
          Idioma: {{ $language['name'] }}
        </h4>
      </div>
      <div id="book-button">
        <a href="/admin/languages/edit/{{$language->id}}" class="edit-book-link">EDITAR</a>
      </div>
      <div id="book-button">
        <a href="/admin/languages/delete/{{$language->id}}" class="edit-book-link" onclick="if (!confirm('Seguro quiere eliminar este idioma de la base de datos?')) { event.preventDefault(); }">BORRAR</a>
      </div>
      @endsection
    </section>
    <script src="scripts/header.js">
    </script>
  </div>
</body>
</html>
