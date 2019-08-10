@extends('admin/layouts/header')

@section('content')
<body>
  <div id="contenedor_detalle">
    <section class="detalle_autor">
      <div class="">
        <h2>Detalle de Editoriales</h2>
      </div>
      <div class="nombre">
        <h3>
          Idioma: {{ $publisher['name'] }}
        </h3>
      </div>
      <div id="book-button">
        <a href="/admin/publishers/edit/{{$publisher->id}}" class="edit-book-link">EDITAR</a>
      </div>
      <div id="book-button">
        <a href="/admin/publishers/delete/{{$publisher->id}}" class="edit-book-link" onclick="if (!confirm('Seguro quiere eliminar esta editorial de la base de datos?')) { event.preventDefault(); }">BORRAR</a>
      </div>
      @endsection
    </section>
    <script src="scripts/header.js">
    </script>
  </div>
</body>
</html>
