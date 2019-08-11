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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'BooksController@index');
Route::get('/selectByGenre/{id}', 'BooksController@selectByGenre');

Route::get('/admin', 'BooksController@index')->middleware('role:admin');
Route::get('/admin/authors', 'AuthorsController@list')->middleware('role:admin');
Route::get('/admin/books/list', 'BooksController@list')->middleware('role:admin');
Route::get('/admin/books/show/{book}', 'BooksController@show')->middleware('role:admin');
Route::get('/admin/books/create', 'BooksController@create')->middleware('role:admin');
Route::post('/admin/books/create', 'BooksController@store')->middleware('role:admin');
Route::get('/admin/books/edit/{id}', 'BooksController@edit')->middleware('role:admin');
Route::post('/admin/books/edit/{id}', 'BooksController@update')->middleware('role:admin');
Route::get('/admin/books/delete/{id}', 'BooksController@destroy')->middleware('role:admin');

Route::get('/admin/authors/list', 'AuthorsController@list')->middleware('role:admin');
Route::get('/admin/authors/show/{author}', 'AuthorsController@show')->middleware('role:admin');
Route::get('/admin/authors/create', 'AuthorsController@create')->middleware('role:admin');
Route::post('/admin/authors/create', 'AuthorsController@store')->middleware('role:admin');
Route::get('/admin/authors/edit/{id}', 'AuthorsController@edit')->middleware('role:admin');
Route::post('/admin/authors/edit/{id}', 'AuthorsController@update')->middleware('role:admin');
Route::get('/admin/authors/delete/{id}', 'AuthorsController@destroy')->middleware('role:admin');


Route::get('/admin/genres/list', 'GenresController@list')->middleware('role:admin');
Route::get('/admin/genres/show/{genre}', 'GenresController@show')->middleware('role:admin');
Route::get('/admin/genres/create', 'GenresController@create')->middleware('role:admin');
Route::post('/admin/genres/create', 'GenresController@store')->middleware('role:admin');
Route::get('/admin/genres/edit/{id}', 'GenresController@edit')->middleware('role:admin');
Route::post('/admin/genres/edit/{id}', 'GenresController@update')->middleware('role:admin');
Route::get('/admin/genres/delete/{id}', 'GenresController@destroy')->middleware('role:admin');

Route::get('/admin/languages/list', 'LanguagesController@list')->middleware('role:admin');
Route::get('/admin/languages/show/{language}', 'LanguagesController@show')->middleware('role:admin');
Route::get('/admin/languages/create', 'LanguagesController@create')->middleware('role:admin');
Route::post('/admin/languages/create', 'LanguagesController@store')->middleware('role:admin');
Route::get('/admin/languages/edit/{id}', 'LanguagesController@edit')->middleware('role:admin');
Route::post('/admin/languages/edit/{id}', 'LanguagesController@update')->middleware('role:admin');
Route::get('/admin/languages/delete/{id}', 'LanguagesController@destroy')->middleware('role:admin');

Route::get('/admin/publishers/list', 'PublishersController@list')->middleware('role:admin');
Route::get('/admin/publishers/show/{publisher}', 'PublishersController@show')->middleware('role:admin');
Route::get('/admin/publishers/create', 'PublishersController@create')->middleware('role:admin');
Route::post('/admin/publishers/create', 'PublishersController@store')->middleware('role:admin');
Route::get('/admin/publishers/edit/{id}', 'PublishersController@edit')->middleware('role:admin');
Route::post('/admin/publishers/edit/{id}', 'PublishersController@update')->middleware('role:admin');
Route::get('/admin/publishers/delete/{id}', 'PublishersController@destroy')->middleware('role:admin');


Route::get('/genres', 'GenresController@index');
Route::get('/genres', 'GenresController@show');

Route::get('/languages', 'LanguagesController@index');

Route::get('/publishers', 'PublishersController@index');

Route::get('/purchases', 'PurchasesController@index');

Route::get('/books/search', 'BooksController@search');
Route::get('/book/{id}', 'BooksController@bookDetail');

Route::get('/book/add/{id}', 'CartsController@addProduct')->middleware('auth');
Route::get('/cart', 'CartsController@index')->middleware('auth');

Route::get('/install', function(){
  Artisan::call('storage:link');
});

Route::get('/correrMigracion', function(){
  Artisan::call('migrate');
});
