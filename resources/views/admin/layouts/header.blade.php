<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>¿Qué Leo?</title>
  <link href="https://fonts.googleapis.com/css?family=Lobster|Roboto+Condensed:400,400i|Mali:500|Pacifico&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

  <link rel="stylesheet" href="/css/admin.css">
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/article.css">
  <link rel="stylesheet" href="/css/footer.css">
  <link rel="stylesheet" href="/css/detalle.css">

</head>

<body>
  <div id="contenedor">
    <header id="navegador">
        <div id="admin-header-button">
          <a href="/admin" class="front-end">PANEL</a>
        </div>

      <div id="boton-generos">
        <span>
          <i class="fas fa-list"></i>
            CREAR
          </span>
          <i class="fas fa-arrow-down"></i>
        </div>

      <div id="admin-header-button">
        <a href="/home" class="front-end">VISTA CLIENTE</a>
      </div>

      <ul id="menu-generos">
        <li>
          <a href="/admin/authors/create">
            <i class="fas fa-list"></i>
            AUTORES
          </a>
        </li>
        <li>
          <a href="/admin/publishers/create">
            <i class="fas fa-list"></i>
            EDITORIALES
          </a>
        </li>
        <li>
          <a href="/admin/genres/create">
            <i class="fas fa-list"></i>
            GENEROS
          </a>
        </li>
        <li>
          <a href="/admin/languages/create">
            <i class="fas fa-list"></i>
            IDIOMAS
          </a>
        </li>
        <li>
          <a href="/admin/books/create">
            <i class="fas fa-list"></i>
            LIBROS
          </a>
        </li>
      </ul>
    </header>
    <header id="encabezado">
      <h1>¿Qué Leo?</h1>
      <h3>Un espacio para descubrir</h3>
    </header>


    @yield('content')
  </div>
  <script src="/js/headerAdmin.js">
  </script>

</body>
