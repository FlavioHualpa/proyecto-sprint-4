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
        [ 'id' => null, 'name' => 'ARTE Y DISEÑO' ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'AUTOAYUDA' ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'CIENCIAS' ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'COMPUTACION' ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'FICCION Y LITERATURA' ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'GASTRONOMIA' ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'INFANTIL Y JUVENIL' ]
      );
      DB::table('genres')->insert(
        [ 'id' => null, 'name' => 'TURISMO' ]
      );
    }
}
