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

    public function addFavorite(Request $request)
    {
      $user = auth()->user();
      $bookId = $request->book_id;
      $book = Book::find($bookId);

      // solo agrego el libro a los favoritos si existe en la base
      if ($book) {
        // y si no es ya un favorito del usuario
        if ($user->favorites()->where('book_id', $bookId)->count() == 0) {
          $user->favorites()->attach(
            $bookId,
            [
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ]
          );
        }
      }
      
      // return back();
      return $this->listFavorite();
    }

    public function listFavorite()
    {
      $user = auth()->user();
      $books = $user->favorites->all();

      // los géneros son para el header
      $genres = Genre::orderBy('name')->get();

      return view('listFavorite', [
        'books' => $books,
        'genres' => $genres
      ]);
    }

    public function destroyFavorite(Request $request)
    {
      $user = auth()->user();
      $user->favorites()->detach($request->book_id);

      return back();
    }

}
