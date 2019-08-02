<?php

use Illuminate\Database\Seeder;

class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @return void
     */
    public function run()
    {
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'ARTE Y DISEÑO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'AUTOAYUDA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'CIENCIAS', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'COMPUTACIÓN', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'FICCIÓN Y LITERATURA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'GASTRONOMÍA', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'INFANTIL Y JUVENIL', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'TURISMO', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s') ]
      );
    }
}
