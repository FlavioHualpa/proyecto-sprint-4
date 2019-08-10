<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
use App\Book;
use App\Cart;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
      $userId = auth()->user()->id;
      $book = Book::find($id);

      if ($book) {
        $cart = Cart::find($userId);
        $items = $cart->books()->where('book_id', $id)->get();
        if ($items->count() == 0)
        {
          $cart->books()
            ->attach($book, [
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
          $quantity = $items[0]->pivot->quantity;
          $cart->books()
            ->sync([
              $id,
              [
              'quantity' => $quantity + 1,
              'price' => $book->price,
              'subtotal' => ($quantity + 1) * $book->price
              ]
            ]);
        }
      }

      return redirect('/');
    }
}
