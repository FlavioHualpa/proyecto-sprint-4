<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Genre;
use App\User;
use App\Author;
use App\Publisher;
use App\Language;
use DB;

class BooksController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {
    if(auth()->check() && auth()->user()->role=="admin"){
      return view('/admin/index');
    } else {
      $novedades = Book::orderBy('release_date', 'desc')
      ->orderBy('title')
      ->limit(6)
      ->get();

      $masVendidos = Book::select(
        '*',
        DB::raw('(SELECT COUNT(*) FROM book_purchase WHERE book_id = books.id) AS sold'))
        ->orderBy('sold', 'desc')
        ->orderBy('title')
        ->limit(6)
        ->get();

      $genres = Genre::orderBy('name')->get();

      return view('/index', [
        'novedades' => $novedades,
        'masVendidos' => $masVendidos,
        'genres' => $genres
      ]);
    }
  }
  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function list()
  {
    $books = Book::orderBy('title')
    ->paginate(20);
    return view('/admin/books/list', [
      'books' => $books
    ]);
  }

  public function create()
  {
    $genres = Genre::orderBy('name')->get();
    $publishers = Publisher::orderBy('name')->get();
    $languages = Language::orderBy('name')->get();
    $authors = Author::orderBy('last_name')->get();

    return view('/admin/books/create',[
      'genres' => $genres,
      'publishers' => $publishers,
      'languages' => $languages,
      'authors' => $authors
    ]);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $book = $request->validate([
      'title' => 'required|string|max:100',
      'total_pages' => 'required|between:1,100000',
      'price' => 'required|between:0,99999.99',
      'cover_img_url' => 'file|image|dimensions:min_width=100,min_height=200,max_width=200,max_height=300|required',
      'release_date' => 'required|before:now',
      'genre_id' => 'required|numeric',
      'author_id' => 'required|numeric',
      'publisher_id' => 'required|numeric',
      'language_id' => 'required|numeric',
      'ranking' => 'required|between:0,300',
      'resena' => 'required|string|max:4000',
      'isbn' => 'unique:books,isbn|max:9999999999999'
  ]);

      $url = $request->cover_img_url->store('public/covers');
      $request->cover_img_url = $url;

      Book::create( [
      'title' => $request->title,
      'total_pages' => $request->total_pages,
      'price' => $request->price,
      'cover_img_url' => $request->cover_img_url,
      'release_date' => $request->release_date,
      'genre_id' => $request->genre_id,
      'author_id' => $request->author_id,
      'publisher_id' => $request->publisher_id,
      'language_id' => $request->language_id,
      'ranking' => $request->ranking,
      'resena' => $request->resena,
      'isbn' => $request->isbn
    ]);
    return redirect('/admin/books/list');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show(Book $book)
  {
    return view('admin.books.show', [
      'book' => $book,
    ]);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    $genres = Genre::orderBy('name')->get();
    $publishers = Publisher::orderBy('name')->get();
    $languages = Language::orderBy('name')->get();
    $authors = Author::orderBy('last_name')->get();

    $book = Book::find($id);

    return view('/admin/books/edit',[
      'book' => $book,
      'genres' => $genres,
      'publishers' => $publishers,
      'languages' => $languages,
      'authors' => $authors
    ]);
  }


  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $book = Book::find($id);

    if($request->title != $book->title){
    $request->validate([
      'title' => 'required|string|max:100'
     ]);
     $book->title = $request->title;
   }

   if($request->total_pages != $book->total_pages){
   $request->validate([
     'total_pages' => 'required|between:1,100000',
    ]);
    $book->total_pages = $request->total_pages;
  }

  if($request->price != $book->price){
  $request->validate([
    'price' => 'required|between:0,99999.99',
   ]);
   $book->price = $request->price;
 }

 if($request->cover_img_url){
   $request->validate([
     'cover_img_url' => 'file|image|dimensions:min_width=100,min_height=200,max_width=200,max_height=300|required'
    ]);
   $url = $request->cover_img_url->store('public/covers');
   $url = basename($url);
   $book->cover_img_url = $url;
 }

 if($request->release_date != $book->release_date){
   $request->validate([
     'release_date' => 'required|before:now',
    ]);
    $book->release_date = $request->release_date;
 }

 if($request->genre_id != $book->genre_id){
   $request->validate([
     'genre_id' => 'required|numeric',
    ]);
    $book->genre_id = $request->genre_id;
 }

 if($request->author_id != $book->author_id){
   $request->validate([
     'author_id' => 'required|numeric',
    ]);
    $book->author_id = $request->author_id;
 }

 if($request->publisher_id != $book->publisher_id){
   $request->validate([
     'publisher_id' => 'required|numeric',
    ]);
    $book->publisher_id = $request->publisher_id;
 }

 if($request->language_id != $book->language_id){
   $request->validate([
     'language_id' => 'required|numeric',
    ]);
    $book->language_id = $request->language_id;
 }

 if($request->ranking != $book->ranking){
   $request->validate([
     'ranking' => 'required|between:0,300',
    ]);
    $book->ranking = $request->ranking;
 }

 if($request->resena != $book->resena){
   $request->validate([
     'resena' => 'required|string|max:4000',
    ]);
    $book->resena = $request->resena;
 }

 if($request->isbn != $book->isbn){
   $request->validate([
      'isbn' => 'unique:books,isbn|max:9999999999999'
    ]);
    $book->isbn = $request->isbn;
  }

  $book->save();

  return redirect('/admin/books/list');
  }


  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  // public function update(Request $request, $id)
  // {
  //     //
  // }

  /**
  *
  *
  *Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $book=Book::find($id);
    $book->delete();
    return redirect('/admin/books/list');
  }

  public function search(Request $request)
  {
    $keywords = $request->input('keywords');
    $searchString = '%' . $keywords . '%';
    $books = Book::join('genres', 'genres.id', '=', 'books.genre_id')
      ->join('languages', 'languages.id', '=', 'books.language_id')
      ->join('authors', 'authors.id', '=', 'books.author_id')
      ->join('publishers', 'publishers.id', '=', 'books.publisher_id')
      ->where('books.title', 'like', $searchString)
      ->orWhere('books.resena', 'like', $searchString)
      ->orWhere('authors.first_name', 'like', $searchString)
      ->orWhere('authors.last_name', 'like', $searchString)
      ->orWhere('publishers.name', 'like', $searchString)
      ->select('books.*')
      ->paginate(10)
      ->appends('keywords', $keywords);
    $genres = Genre::orderBy('name')->get();
    /*
    $books = DB::select('SELECT books.id, title, total_pages,
      price, cover_img_url, release_date,
      languages.name AS language,
      genres.name AS genre,
      CONCAT(authors.first_name, " ", authors.last_name) AS author,
      publishers.name AS publisher,
      resena,
      isbn
      FROM books
      INNER JOIN languages ON languages.id = books.language_id
      INNER JOIN genres ON genres.id = books.genre_id
      INNER JOIN authors ON authors.id = books.author_id
      INNER JOIN publishers ON publishers.id = books.publisher_id
      WHERE books.title LIKE ?
      OR authors.first_name LIKE ?
      OR authors.last_name LIKE ?
      OR publishers.name LIKE ?
      OR books.resena LIKE ?',
      [ $searchString,
      $searchString,
      $searchString,
      $searchString,
      $searchString
      ]
    );
    */

    return view(
      'search',
      [
        'keywords' => $keywords,
        'books' => $books,
        'genres' => $genres
      ]
    );
  }

  public function bookDetail($id) {
    $book = Book::find($id);
    $genres = Genre::orderBy('name')->get();
    return view('show', [
      'book' => $book,
      'genres' => $genres
      ]
    );
  }

  public function selectByGenre($id)
  {
    $genre = Genre::find($id);

    if (blank($genre)) {
      return back();
    }

    $selectedGenre = [
      'id' => $id,
      'name' => $genre->name
    ];

    $books = Book::join('genres', 'genres.id', '=', 'books.genre_id')
      ->join('languages', 'languages.id', '=', 'books.language_id')
      ->join('authors', 'authors.id', '=', 'books.author_id')
      ->join('publishers', 'publishers.id', '=', 'books.publisher_id')
      ->where('books.genre_id', 'like', $selectedGenre)
      ->select('books.*')
      ->orderBy('ranking', 'asc')
      ->paginate(10);
    $genres = Genre::orderBy('name')->get();


    return view('selectByGenre', [
      'books' => $books,
      'genres' => $genres,
      'selectedGenre' => $selectedGenre
    ]);
  }
}
