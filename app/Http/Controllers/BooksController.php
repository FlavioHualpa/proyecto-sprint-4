<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Genre;
use App\User;
use App\Author;
use App\Publisher;
use App\Language;

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

      $masVendidos = Book::orderBy('ranking', 'asc')
        ->orderBy('title')
        ->limit(6)
        ->get();

      $genres = Genre::orderBy('name')
        ->get();

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
      $books = Book::paginate(20);
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
      if ($request->cover_img_url) {
        $url = $request->cover_img_url->store('public/img/covers');
        $url = basename($url);
      }
      else {
        $url = null;
      }

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
        return redirect('/admin');
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
  //    $this->validate();

      $book = Book::find($id);
      if ($request->cover_img_url) {
        $url = $request->cover_img_url->store('public/img/covers');
        $url = basename($url);
      }
      else
      {
        $url = $book->cover_img_url;
      }
      $request->cover_img_url = $url;

        $book->title = $request->title;
        $book->total_pages = $request->total_pages;
        $book->price = $request->price;
        $book->cover_img_url = $request->cover_img_url;
        $book->release_date = $request->release_date;
        $book->genre_id = $request->genre_id;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->language_id = $request->language_id;
        $book->ranking = $request->ranking;
        $book->resena = $request->resena;
        $book->isbn = $request->isbn;

      $book->save();
      return redirect('/admin');

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
      return redirect('/admin');
    }
  }
