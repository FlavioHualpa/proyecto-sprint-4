<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Genre;

class GenresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = Genre::all();

        return $genres;
    }

    public function list()
    {
      $genres = Genre::orderBy('name')
      ->paginate(20);
      return view('/admin/genres/list', [
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
       return view('/admin/genres/create');
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       $genre = $request->validate([
       'name' => 'required|string|max:50|unique:genres,name'
     ]);

       Genre::create([
         'name' => $request->name
       ]);
       return redirect('/admin/genres/list');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Genre $genre)
     {
       return view('/admin/genres/show', [
         'genre' => $genre
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
       $genre = Genre::find($id);
       return view('/admin/genres/edit', [
         'genre' => $genre
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
       $genre = Genre::find($id);

       if($request->name != $genre->name){
       $request->validate([
       'name' => 'required|string|max:50|unique:genres,name'
        ]);

       $genre->name = $request->name;
       $genre->save();
     }
     return redirect('/admin/genres/list');

     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       $genre = Genre::find($id);
       $genre->delete();
       return redirect('/admin/genres/list');
     }
}
