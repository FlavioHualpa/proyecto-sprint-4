<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use App\Genre;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      if(auth()->user()->role == "admin"){
        return redirect('/admin');
      }

      $novedades = Book::orderBy('release_date', 'desc')
        ->orderBy('title')
        ->limit(6)
        ->get();

      $masVendidos = Book::orderBy('ranking', 'asc')
        ->orderBy('title')
        ->limit(6)
        ->get();

      $genres = Genre::orderBy('name')->get();

      return view('index', [
        'novedades' => $novedades,
        'masVendidos' => $masVendidos,
        'genres' => $genres
      ]);
    }

}
