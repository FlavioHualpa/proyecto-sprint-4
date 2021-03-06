<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Author;
use Illuminate\Support\Facades\Validator;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      $authors = Author::orderBy('last_name')
      ->paginate(20);
      return $authors;
    }

    public function list()
    {
      $authors = Author::orderBy('last_name')
      ->paginate(20);
      return view('/admin/authors/list', [
        'authors' => $authors
      ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
      public function create()
      {
        return view('/admin/authors/create');
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author = $request->validate([
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50'
      ]);

        Author::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name
      ]);

      return redirect('/admin/authors/list');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
      return view('/admin/authors/show', [
        'author' => $author
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
      $author = Author::find($id);
      return view('/admin/authors/edit', [
        'author' => $author
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
      $author = Author::find($id);

      if(($request->first_name != $author->first_name)||($request->last_name != $author->last_name)){
      $request->validate([
      'first_name' => 'required|string|max:50',
      'last_name' => 'required|string|max:50'
       ]);


      $author->first_name = $request->first_name;
      $author->last_name = $request->last_name;
      $author->save();
    }
    return redirect('/admin/authors/list');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $author = Author::find($id);
      $author->delete();
      return redirect('/admin/authors/list');
    }

}
