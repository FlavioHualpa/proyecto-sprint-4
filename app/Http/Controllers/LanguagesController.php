<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Language;

class LanguagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $languages = Language::all();

      return $languages;
    }

    public function list()
    {
      $languages = Language::orderBy('name')
      ->paginate(20);
      return view('/admin/languages/list', [
        'languages' => $languages
      ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
       return view('/admin/languages/create');
     }

     public function store(Request $request)
     {
       $language = $request->validate([
       'name' => 'required|string|max:20|unique:languages,name'
     ]);

       Language::create([
         'name' => $request->name
       ]);
       return redirect('/admin/languages/list');
     }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Language $language)
     {
       return view('/admin/languages/show', [
         'language' => $language
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
       $language = Language::find($id);
       return view('/admin/languages/edit', [
         'language' => $language
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
       $language = Language::find($id);

       if($request->name != $language->name){
       $request->validate([
       'name' => 'required|string|max:20|unique:languages,name'
        ]);

       $language->name = $request->name;
       $language->save();
      }
      return redirect('/admin/languages/list');
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
     {
       $language = Language::find($id);
       $language->delete();
       return redirect('/admin/languages/list');
     }
}
