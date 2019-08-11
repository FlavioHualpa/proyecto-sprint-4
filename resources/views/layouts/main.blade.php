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
            <a href="{{ url('cart') }}">
              <i class="fas fa-shopping-cart"></i>
              <!--
              en próximas versiones aquí vamos a consultar
              el carrito del usuario en la base de datos
              y traer la cantidad de productos guardados
              en el carrito de compras
              -->
              <span>{{ Auth::user()->carts[0]->books()->sum('quantity') }}</span>
            </a>
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
        @if (auth()->user()->role == 'admin')
        <li>
          <a href="/admin">
            <i class="fas fa-bookmark"></i>
            panel de control
          </a>
        </li>
        @else
        <li>
          <a href="/user/books?userid={{ Auth::user() ? Auth::user()->id : 0 }}">
            <i class="fas fa-bookmark"></i>
            mis libros
          </a>
        </li>
        @endif
        <li>
          <a href="{{ route('logout') }}"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();"
          >
            <i class="fas fa-sign-out-alt"></i>
            cerrar sesión
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </li>
      </ul>
    </header>
    <header id="encabezado">
      <h1>¿Qué Leo?</h1>
      <h3>Un espacio para descubrir</h3>
    </header>

    @yield('content')

    <footer id="footer">
      <nav>
        <ul>
          <li>
            <div>
              <a href="/about">Acerca de ¿Qué Leo?</a>
            </div>
          </li>
          <li>
            <div>
              <a href="/instructions">Instructivo de Compra</a>
            </div>
          </li>
          <li>
            <div class="links">
              <i class="fab fa-facebook"></i>
              <i class="fab fa-twitter-square"></i>
              <i class="fab fa-instagram"></i>
              <i class="fab fa-pinterest-square"></i>
            </div>
          </li>
        </ul>
        <p>
          Copyright <i class="fas fa-copyright"></i> ¿Qué Leo? S.A. Todos los derechos reservados.
          <br>
          <br>
        </p>
      </nav>
    </footer>
  </div>
  <script src="/js/header.js">
  </script>
  @stack('aditional-js')
</body>
</html>
