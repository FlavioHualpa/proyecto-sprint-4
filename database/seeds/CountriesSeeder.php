<?php

use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $texto = file_get_contents(__DIR__.'/paises.json');
        $datos = json_decode($texto, true);

        foreach ($datos as $codigo => $pais) {
          DB::table('countries')->insert(
            [ 'id' => null, 'name' => $pais ]
          );
        }
    }
}
