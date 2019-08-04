<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Book;
use App\Genre;
use App\User;


class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $novedades = Book::orderBy('release_date', 'desc')
        ->orderBy('title')
        ->limit(6)
        ->get();

      $masVendidos = Book::orderBy('ranking', 'asc')
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
      return view('books.show', [
        'book' => $book
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
