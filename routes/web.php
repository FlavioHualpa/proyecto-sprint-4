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
Route::get('/book/{id}', 'BooksController@bookDetail');
Route::get('/books/search', 'BooksController@search');
Route::get('/book/{id}', 'BooksController@bookDetail');
Route::get('/book/add/{id}', 'CartsController@addProduct')->middleware('auth');
Route::get('/book/addFavorite/{id}', 'FavoritesController@addFavorite')->middleware('auth');
//Route::get('/user/listFavorites', 'FavoritesController@listFavorite')->middleware('auth');
Route::get('/user/deleteFavorites/{id}', 'FavoritesController@destroyFavorite');

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
Route::get('/user/purchases', 'PurchasesController@listPurchases')->middleware('auth');
Route::get('/user/purchases/{id}', 'PurchasesController@detailedPurchase')->middleware('auth');

// cambiamos la ruta de get a post
// Route::get('/cart/add/{id}', 'CartsController@addProduct')->middleware('auth');
Route::post('/cart/add', 'CartsController@addProduct')->middleware('auth');

// cambiamos la ruta de get a delete
// Route::get('/cart/remove/{id}', 'CartsController@removeProduct')->middleware('auth');
Route::delete('/cart/removeItem', 'CartsController@removeProduct')->middleware('auth');

Route::get('/cart/show', 'CartsController@index')->middleware('auth');
Route::post('/cart/update', 'CartsController@update')->middleware('auth');
Route::post('/cart/checkout', 'CartsController@checkout')->middleware('auth');

Route::get('/purchase/finalize', 'PurchasesController@store')->middleware('auth');

// cambiamos la ruta de get a post
// Route::get('/favorite/add/{id}', 'FavoritesController@addFavorite')->middleware('auth');
Route::post('/favorite/add', 'FavoritesController@addFavorite')->middleware('auth');

// cambiamos la ruta de get a delete
// Route::get('/favorite/remove/{id}', 'FavoritesController@destroyFavorite')->middleware('auth');
Route::delete('/favorite/remove', 'FavoritesController@destroyFavorite')->middleware('auth');

Route::get('/user/profile', 'Auth\EditProfileController@edit')->middleware('auth');
Route::post('/user/profile', 'Auth\EditProfileController@update')->middleware('auth');
Route::get('/user/favorites', 'FavoritesController@listFavorite')->middleware('auth');

Route::get('/install', function(){
  Artisan::call('storage:link');
});

Route::get('/correrMigracion', function(){
  Artisan::call('migrate');
});


//Route::get('/user/edit/{id}', 'RegisterController@edit');
//Route::post('/user/edit/{id}', 'RegisterController@update');
