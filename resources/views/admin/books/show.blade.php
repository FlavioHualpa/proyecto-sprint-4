@extends('admin/layouts/header')

@section('content')
<body>
  <div id="contenedor_detalle">
    <section class="detalle_libro">

      <div class="detalle_principal">
        <div class="detalle_imagen">
          <img src="{!! '/storage/img/covers/' . $book['cover_img_url'] !!}" alt="{{ $book['title'] }}">
        </div>
        <div class="detalle_lateral">
          <h3>
            {{ $book['title'] }}
          </h3>
          <h6>
            Ranking: # {{ $book['ranking'] }}
          </h6>
          <h5>
            $ {{ $book['price'] }}
          </h5>
          <h6>
            Reseñas del libro:
          </h6>
          <p>
            {{ $book['resena'] }}
          </p>
        </div>
      </div>
      <div class="datos_detallados">
        <h6>
          Detalles del libro:
        </h6>
        <ul>
          <li>
            <b>Autor:</b> {{ $book->author->last_name}}, {{ $book->author->first_name}}
          </li>
          <li>
            <b>Editorial:</b> {{ $book->publisher->name }}
          </li>
          <li>
            <b>I.S.B.N.:</b> {{ $book['isbn'] }}
          </li>
          <li>
            <b>Géneros:</b> {{ $book->genre->name}}
          </li>
          <li>
            <b>Páginas:</b> {{ $book['total_pages'] }}
          </li>
          <li>
            <b>Publicación: {{ $book['release_date'] }}
          </li>
          <li>
            <b>Idioma:</b>  {{ $book->language->name }}
          </li>
        </ul>
      </div>
      <div id="book-button">
        <a href="/admin/books/edit/{{$book->id}}" class="edit-book-link">EDITAR</a>
      </div>

      <div id="book-button">
        <a href="/admin/books/delete/{{$book->id}}" class="edit-book-link" onclick="if (!confirm('Seguro quiere eliminar este libro de la base de datos?')) { event.preventDefault(); }">BORRAR</a>
      </div>

      @endsection
    </section>
    <script src="scripts/header.js">
    </script>
  </div>
</body>
</html>
