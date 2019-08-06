<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   *
   * @return void
   */
  public function run()
  {
    $this->call(CountriesSeeder::class);
    $this->call(GenresSeeder::class);
    $this->call(LanguagesSeeder::class);
    $this->call(PublishersSeeder::class);
    $this->call(AuthorsSeeder::class);
    $this->call(UsersSeeder::class);
    $this->call(CartsSeeder::class);
    $this->call(BooksSeeder::class);
    $this->call(PurchasesSeeder::class);
    $this->call(BookPurchaseSeeder::class);
  }
}
