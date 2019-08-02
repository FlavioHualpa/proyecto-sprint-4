<?php

use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('languages')->insert(
        [ 'id' => null, 'name' => 'Español', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('languages')->insert(
        [ 'id' => null, 'name' => 'Inglés', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('languages')->insert(
        [ 'id' => null, 'name' => 'Portugués', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('languages')->insert(
        [ 'id' => null, 'name' => 'Italiano', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('languages')->insert(
        [ 'id' => null, 'name' => 'Francés', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
    }
}
