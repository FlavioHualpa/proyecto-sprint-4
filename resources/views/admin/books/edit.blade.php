@extends('admin/layouts/header')

@section('content')

<div class="fondo-create-form">
  <div class="create-title">
    <h3>Edita un Libro</h3>
  </div>
  <div class='create-form'>
    <form class="create-book" action="/admin/books/edit/{{ $book->id }}" method="post" enctype="multipart/form-data">
      @csrf
      @error('submit')
      <p class="error-regist">{{ $message }}</p>
      @enderror
      <p>
        <label for="title">Título:</label>
        <input type="text" name="title" value="{{ old('title', $book->title) }}">
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="total_pages">Páginas:</label>
        <input type="number" name="total_pages" value="{{ old('total_pages', $book->total_pages) }}">
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="price">Precio:</label>
        <input type="number" name="price" value="{{ old('price', $book->price) }}">
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="cover_img_url">Subir la imagen de la tapa del libro</label>
        <br>
        <input id="cover_img_url" type="file" name="cover_img_url" value="{{ old('cover_img_url', $book->cover_img_url) }}">
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="release_date">Fecha de publicación:</label>
        <input id="release_date" type="date" name="release_date" value="{{ old('release_date', $book->release_date) }}" required autocomplete="release_date" autofocus>
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="genre_id">Géneros:</label>
        <select name="genre_id" id="genre_id">
          @foreach ($genres as $genre)
          <option value="{{ $genre->id }}" {{ old('genre_id', $book->genre_id) == $genre->id ? 'selected' : '' }}>
            {{ $genre->name }}
          </option>
          @endforeach
        </select>
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="author_id">Autor:</label>
        <select name="author_id" id="author_id">
          @foreach ($authors as $author)
          <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
            {{ $author->last_name }}, {{ $author->first_name}}
          </option>
          @endforeach
        </select>
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="publisher_id">Editorial:</label>
        <select name="publisher_id" id="publisher_id">
          @foreach ($publishers as $publisher)
          <option value="{{ $publisher->id }}" {{ old('publisher_id', $book->publisher_id) == $publisher->id ? 'selected' : '' }}>
            {{ $publisher->name }}
          </option>
          @endforeach
        </select>
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="language_id">Idioma:</label>
        <select name="language_id" id="language_id">
          @foreach ($languages as $language)
          <option value="{{ $language->id }}" {{ old('language_id', $book->language_id) == $language->id ? 'selected' : '' }}>
            {{ $language->name }}
          </option>
          @endforeach
        </select>
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="ranking">Ranking:</label>
        <input type="number" name="ranking" value="{{ old('ranking', $book->ranking) }}">
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="resena">Reseña:</label>
        <input type="text" name="resena" value="{{ old('resena', $book->resena) }}">
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <p>
        <label for="isbn">I.S.B.N.:</label>
        <input type="number" name="isbn" value="{{ old('isbn', $book->isbn) }}">
      </p>
      @error('title')
      <p class="error-regist"><i class="fas fa-exclamation-circle"></i>{{ $message }}</p>
      @enderror
      <button type="submit" class="store">
        Guardar
      </button>
    </form>
  </div>
</div>
@endsection
