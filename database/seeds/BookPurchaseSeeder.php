<?php

use Illuminate\Database\Seeder;

class BookPurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $purchases = App\Purchase::all();
      $books = App\Book::all();

      foreach ($purchases as $purchase) {
        $items = rand(1, 6);
        for ($i = 0; $i < $items; $i++) {
          $randomBook = $books->random();
          $randomQty = rand(1, 3);
          DB::table('book_purchase')->insert(
            [
              'purchase_id' => $purchase->id,
              'book_id' => $randomBook->id,
              'quantity' => $randomQty,
              'price' => $randomBook->price,
              'subtotal' => $randomBook->price * $randomQty,
              'created_at' => date('Y-m-d H:i:s'),
              'updated_at' => date('Y-m-d H:i:s')
            ]
          );
        }
      }
    }
}
