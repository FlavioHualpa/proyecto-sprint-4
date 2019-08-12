<?php

namespace App\Http\Controllers;

use App\Book;
use App\Genre;
use App\User;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function addFavorite($id)
    {
      $user = auth()->user();
      $book = Book::find($id);
      if($book->users() !== $user)
      {
        $book->users()->attach($user);
      }
      return back();
    }

    public function listFavorite()
    {
      $user = auth()->user();
      $books = $user->books->all();

      // los géneros son para el header
      $genres = Genre::orderBy('name')->get();

      return view('listFavorite', [
        'books' => $books,
        'genres' => $genres
      ]);
    }

    public function destroyFavorite($id)
    {
      $user = auth()->user();
      $book = Book::find($id);
      $book->users()->detach($user);

      return back();
    }

}
