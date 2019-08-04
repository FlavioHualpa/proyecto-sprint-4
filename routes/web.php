<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'BooksController@index');
// {
//     $genres = App\Genre::orderBy('name')->get();
//
//     $novedades = [
//       [
//         'id' => 1,
//         'title' => 'Luciérnagas en frascos',
//         'cover_img_url' => 'mr_luciernagas.png',
//         'price' => 735.0,
//       ],
//
//       [
//         'id' => 2,
//         'title' => 'Templanza (Irma)',
//         'cover_img_url' => 'js_templanza.png',
//         'price' => 735.0,
//       ],
//
//       [
//         'id' => 3,
//         'title' => 'La muerte del padre',
//         'cover_img_url' => 'kok_lamuerte.png',
//         'price' => 735.0,
//       ],
//     ];
//
//     $masVendidos = [
//       [
//         'id' => 1,
//         'title' => 'Luciérnagas en frascos',
//         'cover_img_url' => 'mr_luciernagas.png',
//         'price' => 735.0,
//       ],
//
//       [
//         'id' => 2,
//         'title' => 'Templanza (Irma)',
//         'cover_img_url' => 'js_templanza.png',
//         'price' => 735.0,
//       ],
//
//       [
//         'id' => 3,
//         'title' => 'La muerte del padre',
//         'cover_img_url' => 'kok_lamuerte.png',
//         'price' => 735.0,
//       ],
//     ];
//
//     return view(
//       'index',
//       [
//         'genres' => $genres,
//         'novedades' => $novedades,
//         'masVendidos' => $masVendidos,
//       ]
//     );
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/genres', 'GenresController@index');
Route::get('/genres', 'GenresController@show');


Route::get('/languages', 'LanguagesController@index');

Route::get('/authors', 'AuthorsController@index');

Route::get('/publishers', 'PublishersController@index');

Route::get('/books', 'BooksController@index');
Route::get('/books', 'BooksController@create');
Route::get('/books', 'BooksController@edit');
Route::post('/books', 'BooksController@store');
Route::get('/books', 'BooksController@destroy');

Route::get('/purchases', 'PurchasesController@index');
