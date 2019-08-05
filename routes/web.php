<?php
use App\Genre;

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


Auth::routes();

Route::get('/', 'HomeController@index');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function(){
  return view('/admin/index');
});
Route::get('/admin/authors', 'AuthorsController@list');

Route::get('/admin/books/list', 'BooksController@list');
Route::get('/admin/books/show/{book}', 'BooksController@show');
Route::get('/admin/books/create', 'BooksController@create');
Route::post('/admin/books/create', 'BooksController@store');
Route::get('/admin/books/edit/{id}', 'BooksController@edit');
Route::post('/admin/books/edit/{id}', 'BooksController@update');
Route::get('/admin/books/delete/{id}', 'BooksController@destroy');


Route::get('/admin/genres', 'GenresController@list');
Route::get('/admin/languages', 'LanguagesController@list');
Route::get('/admin/publishers', 'PublishersController@list');

Route::get('/authors', 'AuthorsController@index');

Route::get('/genres', 'GenresController@index');
Route::get('/genres', 'GenresController@show');

Route::get('/languages', 'LanguagesController@index');

Route::get('/publishers', 'PublishersController@index');

Route::get('/purchases', 'PurchasesController@index');


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
