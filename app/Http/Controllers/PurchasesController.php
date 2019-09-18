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

    // Redirigimos a Mercado Pago para que el comprador
    // realice el pago de su compra
    // Si el pago resulta exitoso mostramos el aviso
    public function pay()
    {
      // Agrega credenciales
      \MercadoPago\SDK::setAccessToken('TEST-4014737365882020-091400-cd190a1ed89ba49e53e574c0f7b7d610-470904988');
      // este usuario de prueba lo creé el 13/9/19 con mi cuenta de MP

      // Crea un objeto de preferencia
      $preference = new \MercadoPago\Preference();

      $cart = auth()->user()->carts()->first();
      $allItems = [];

      foreach ($cart->books as $book) {
        $item = new \MercadoPago\Item;
        $item->title = $book->title;
        $item->quantity = $book->pivot->quantity;
        $item->unit_price = $book->pivot->price;
        $item->picture_url = $book->cover_img_url;
        $item->currency_id = 'ARS';
        $allItems[] = $item;
      }

      $preference->items = $allItems;
      
      $preference->back_urls = [
        'success' => url('/purchase/finalize')
      ];

      $payer = new \MercadoPago\Payer;
      $payer->name = auth()->user()->first_name;
      $payer->surname = auth()->user()->last_name;
      $payer->email = auth()->user()->email;
      $payer->date_created = date('Y-m-d H:i:s');

      $preference->payer = $payer;
      // $preference->notification_url = url('/purchase/notify');
      $preference->save();

      return redirect($preference->init_point);
    }

    // Este método se ejecuta cuando recibimos una
    // notificación de Mercado Pago sobre nuestro pago
    public function notify(Request $request)
    {
      dd($request);
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
