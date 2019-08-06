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
  @yield('styles')
</head>

<body>
  <div id="contenedor">

    <header id="navegador">
      <div id="home-generos">
        <div id="boton-home">
          <a href="/">
            <i class="fas fa-home"></i>
          </a>
        </div>
        <div id="boton-generos">
          <span>
            <i class="fas fa-list"></i>
            géneros
          </span>
          <i class="fas fa-arrow-down"></i>
        </div>
      </div>
      <div id="buscador">
        <form action="/books/search" method="get">
          <input type="text" name="keywords" placeholder="busque por título, autor o editorial">
          <button type="submit"><i class="fas fa-search"></i></button>
        </form>
      </div>
      @if (Auth::user())
        <div>
          <div id="user-options">
            <div class="avatar" style="background-image: url('/storage/avatars/{{ Auth::user()->avatar_url }}')">
            </div>
            <span>
              {{ Auth::user()->first_name }}
            </span>
          </div>
          <div id="cart">
            <i class="fas fa-shopping-cart"></i>
            <!--
            en próximas versiones aquí vamos a consultar
            el carrito del usuario en la base de datos
            y traer la cantidad de productos guardados
            en el carrito de compras
            -->
            <span>0</span>
          </div>
        </div>
      @else
        <div id="user">
          <a href="/login" class="user-login">
            <i class="fas fa-sign-in-alt"></i>
            ingresar
          </a>
          <a href="/register" class="user-register">
            <i class="fas fa-user-plus"></i>
            crear cuenta
          </a>
        </div>
      @endif

      <ul id="menu-generos">
        @foreach($genres as $genre)
        <li>
          <a href="browse/byGenre?genreid={{ $genre['id'] }}">
            <i class="fas fa-list"></i>
            {{ $genre['name'] }}
          </a>
        </li>
        @endforeach
      </ul>

      <ul id="menu-usuario">
        <li>
          <a href="/user/profile?userid={{ Auth::user() ? Auth::user()->id : 0 }}">
            <i class="fas fa-edit"></i>
            edite su perfil
          </a>
        </li>
        <li>
          <a href="/user/books?userid={{ Auth::user() ? Auth::user()->id : 0 }}">
            <i class="fas fa-bookmark"></i>
            mis libros
          </a>
        </li>
        <li>
          <a href="/logout">
            <i class="fas fa-sign-out-alt"></i>
            cerrar sesión
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
  <script src="/js/header.js">
  </script>
</body>
</html>
