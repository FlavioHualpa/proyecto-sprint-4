  @extends('layouts/main')

@section('styles')
  <link rel="stylesheet" href="/css/styles.css">
  <link rel="stylesheet" href="/css/header.css">
  <link rel="stylesheet" href="/css/article.css">
  <link rel="stylesheet" href="/css/footer.css">
@endsection

@section('content')
    <div class="banner">
    </div>
    <section class="tituloSection">
      <div class="separador">
      </div>
      <div class="viñeta">
      </div>
      <h3>
        Novedades
      </h3>
      <div class="viñeta">
      </div>
    </section>
    <div class="prodsSectionPrincipal">
      <section class="prodsSection">
        @foreach($novedades as $libro)
        <article>
          <div class="fondo-con-sombra">
            <div class="tapaYTitulo">
              <div class="tapa">
                <img src="{!! '/storage/covers/' . $libro['cover_img_url'] !!}" alt="{{ $libro['title'] }}">
              </div>
              <h4>{{ $libro['title'] }}</h4>
            </div>
            <div class="ver-mas">
              <a href="/book/{{ $libro['id'] }}">
                 <i class="fas fa-eye"></i>
                 <span>
                    VER DETALLES
                 </span>
              </a>
            </div>
          </div>
          <div class="pie-de-articulo">
            <span>{{ '$ ' . $libro['price'] }}</span>
            <a href="#">agregar al <i class="fas fa-shopping-cart"></i></a>
          </div>
        </article>
        @endforeach
      </section>
    </div>

    <section class="tituloSection">
      <div class="separador">
      </div>
      <div class="viñeta">
      </div>
      <h3>
        Los más vendidos
      </h3>
      <div class="viñeta">
      </div>
    </section>
    <div class="prodsSectionPrincipal">
      <section class="prodsSection">
        @foreach($masVendidos as $libro)
        <article>
          <div class="fondo-con-sombra">
            <img src="{!! '/storage/covers/' . $libro['cover_img_url'] !!}" alt="{{ $libro['title'] }}">
            <h4>{{ $libro['title'] }}</h4>
            <div class="ver-mas">
              <a href="/book/?bookid={{ $libro['id'] }}">
                <i class="fas fa-eye"></i>
                <span>
                   VER DETALLES
                </span>
               </a>
            </div>
          </div>
          <div class="pie-de-articulo">
            <span>{{ '$ ' . $libro['price'] }}</span>
            <a href="#">agregar al <i class="fas fa-shopping-cart"></i></a>
          </div>
        </article>
        @endforeach
      </section>
    </div>
@endsection
