@extends('admin/layouts/header')

@section('content')
<body>
  <div id="contenedor_detalle">
    <section class="detalle_autor">
<div class="create-title">
  <h3>Detalle de Autor</h3>
</div>
        <div class="show-item">
          <h4>
            Nombre: {{ $author['first_name'] }}
          </h4>
          <h4>
            Apellido: {{ $author['last_name'] }}
          </h4>

        </div>
      </div>

      <div id="book-button">
        <a href="/admin/authors/edit/{{$author->id}}" class="edit-book-link">EDITAR</a>
      </div>

      <div id="book-button">
        <a href="/admin/authors/delete/{{$author->id}}" class="edit-book-link" onclick="if (!confirm('Seguro quiere eliminar este autor de la base de datos?')) { event.preventDefault(); }">BORRAR</a>
      </div>

      @endsection
    </section>
    <script src="scripts/header.js">
    </script>
  </div>
</body>
</html>
