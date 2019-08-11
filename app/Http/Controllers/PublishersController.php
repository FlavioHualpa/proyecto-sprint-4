<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Publisher;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $publishers = Publisher::all();
      return $publishers;
    }

    public function list()
    {
      $publishers = Publisher::orderBy('name')
      ->paginate(20);
      return view('/admin/publishers/list', [
        'publishers' => $publishers
      ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       return view('/admin/publishers/create');
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       $publisher = $request->validate([
       'name' => 'required|string|max:100|unique:publishers,name'
     ]);

       Publisher::create([
         'name' => $request->name
       ]);

       return redirect('/admin/publishers/list');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Publisher $publisher)
     {
       return view('/admin/publishers/show', [
         'publisher' => $publisher
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
       $publisher = Publisher::find($id);
       return view('/admin/publishers/edit', [
         'publisher' => $publisher
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
       $publisher = Publisher::find($id);
       if($request->name != $publisher->name){
       $request->validate([
       'name' => 'required|string|max:100|unique:publishers,name'
        ]);

       $publisher->name = $request->name;
       $publisher->save();
      }

       return redirect('/admin/publishers/list');

     }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $publisher = Publisher::find($id);
      $publisher->delete();
      return redirect('/admin/publishers/list');
    }
}
