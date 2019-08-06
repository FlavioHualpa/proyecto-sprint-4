<?php

use Illuminate\Database\Seeder;

class CartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $users = App\User::all();

      foreach ($users as $user) {
        App\Cart::create(
          [
            'id' => null,
            'user_id' => $user->id
          ]
        );
      }
    }
}
