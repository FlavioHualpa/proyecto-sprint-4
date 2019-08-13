<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Purchase;
use App\Cart;
use App\Genre;

class PurchasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $purchases = Purchase::all();

      return $purchases;
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
      // obtengo el id del usuario logueado
      $userId = auth()->user()->id;

      // obtengo el carrito del usuario logueado
      // el que está guardado en la base de datos
      // y lo voy a actualizar con los datos que
      // llegan con el formulario de la vista del carrito
      $cart = Cart::find($userId);

      $invoiceNumber = Purchase::max('invoice_number');
      $invoiceNumber = $invoiceNumber ? $invoiceNumber + 1 : 10000;
      $purchase = Purchase::create(
        [
          'user_id' => $userId,
          'invoice_number' => $invoiceNumber,
          'created_at' => date('Y-m-d H:i:s'),
          'updated_at' => date('Y-m-d H:i:s'),
        ]
      );

      foreach ($cart->books->all() as $book) {
        $purchase->books()->attach(
          $book->id,
          [
            'quantity' => $book->pivot->quantity,
            'price' => $book->pivot->price,
            'subtotal' => $book->pivot->quantity * $book->pivot->price,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
          ]
        );
      }

      // luego de registrar la compra vaciamos el carrito
      $cart->books()->detach();

      $genres = Genre::orderBy('name')->get();
      return view('success', [ 'genres' => $genres ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }


   public function detailedPurchase($id)
   {
     $genres = Genre::orderBy('name')->get();
     $purchase = Purchase::find($id);
     $books = Purchase::find($id)->books->all();
     return view('detailedPurchase', [
       'purchase' => $purchase,
       'books' => $books,
       'genres' => $genres
       ]
     );
   }

    public function listPurchases()
    {
        $user = auth()->user();
        $purchases = $user->purchases->all();

        // los géneros son para el header
        $genres = Genre::orderBy('name')->get();

        return view('purchases', [
          'purchases' => $purchases,
          'genres' => $genres
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
}
