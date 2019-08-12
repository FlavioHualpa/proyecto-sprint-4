<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use App\Http\Controllers\Auth;
use App\Book;
use App\Cart;
use App\Genre;
use App\Purchase;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      // obtengo el id del usuario logueado
      $userId = auth()->user()->id;

      // obtengo el carrito del usuario logueado
      // el id del carrito es igual al id del usuario
      $cart = Cart::find($userId);

      // obtengo los libros en el carrito del usuario
      $books = $cart->books->all();

      // obtengo la cantidad total de libros e importe
      $totalBooks = $cart->books()->sum('quantity');
      $totalAmount = $cart->books()->sum('subtotal');

      // los géneros son para el header
      $genres = Genre::orderBy('name')->get();

      return view(
        'cart',
        [
          'books' => $books,
          'genres' => $genres,
          'totalBooks' => $totalBooks,
          'totalAmount' => $totalAmount,
        ]
      );
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
        //
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

    private function updateCartData(Request $request)
    {
      // compruebo que un usuario esté logueado
      if (auth()->check()) {

        // obtengo el id del usuario logueado
        $userId = auth()->user()->id;

        // obtengo el carrito del usuario logueado
        // el que está guardado en la base de datos
        // y lo voy a actualizar con los datos que
        // llegan con el formulario de la vista del carrito
        $cart = Cart::find($userId);

        // recorro los campos del formulario para obtener
        // el dato (la cantidad de cada libro) para
        // actualizar el carrito.
        // si la cantidad es cero, quito el elemento del
        // carrito sino actualizo la cantidad y el subtotal
        foreach ($request->all() as $key => $value) {
          if ($key == '_token') continue;
          $parts = explode('-', $key);
          $book = Book::find($parts[1]);
          $quantity = intval($value);

          if ($quantity == 0) {
            $cart->books()->detach($book->id);
          }
          else {
            // dd(['book_id' => $book->id, 'quantity' => $quantity, 'subtotal' => $quantity * $book->price]);
            $cart->books()->syncWithoutDetaching(
              [
                $book->id =>
                [
                  'quantity' => $quantity,
                  'subtotal' => $quantity * $book->price,
                  'updated_at' => date('Y-m-d H:i:s')
                ]
              ]
            );
          }
        }
      }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $this->updateCartData($request);
      return back();
    }

    public function checkout(Request $request)
    {
      $this->updateCartData($request);
      $genres = Genre::orderBy('name')->get();
      $userId = auth()->user()->id;
      $cart = Cart::find($userId);
      $invoiceNumber = Purchase::max('invoice_number');

      return view(
        'checkout',
        [
          'genres' => $genres,
          'totalBooks' => $cart->books()->sum('quantity'),
          'totalAmount' => $cart->books()->sum('subtotal'),
          'invoiceNumber' => $invoiceNumber ? $invoiceNumber + 1 : 10000,
          'userName' => auth()->user()->first_name
        ]
      );
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

    public function addProduct($id) {

      // obtengo el id del usuario logueado
      $userId = auth()->user()->id;

      // obtengo el libro que quiero agregar al carrito
      $book = Book::find($id);

      // si el libro no existe no lo agrego
      if ($book) {

        // obtengo el carrito del usuario logueado
        // el id del carrito es igual al id del usuario
        $cart = Cart::find($userId);

        // consulto si el libro que el usuario quiere
        // agregar al carrito existe en el carrito
        $inCartProduct = $cart->books()->where('book_id', $id)->get();

        // si no existe agrego una unidad, si existe
        // aumento la cantidad y el subtotal
        if ($inCartProduct->count() == 0)
        {
            $cart->books()->attach(
            $id,
            [
              'quantity' => 1,
              'price' => $book->price,
              'subtotal' => $book->price,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s'),
            ]
          );
        }
        else
        {
          $quantity = $inCartProduct[0]->pivot->quantity;
          $cart->books()->syncWithoutDetaching(
            [
              $id => [
                'quantity' => $quantity + 1,
                'price' => $book->price,
                'subtotal' => ($quantity + 1) * $book->price,
                'updated_at' => date('Y-m-d H:i:s'),
              ]
            ]
          );
        }
      }

      // como la acción de agregar al carrito implica un cambio de ruta
      // regresamos a la ruta anterior para continuar donde estábamos
      return back();
    }

    public function removeProduct($id) {

      // obtengo el id del usuario logueado
      $userId = auth()->user()->id;

      // obtengo el carrito del usuario logueado
      // el id del carrito es igual al id del usuario
      $cart = Cart::find($userId);

      // elimino el libro (con el id pasado a la función)
      // del carrito
      $cart->books()->detach($id);

      // regresamos a la ruta anterior para continuar donde estábamos
      return back();
    }
}
