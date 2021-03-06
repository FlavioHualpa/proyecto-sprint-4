<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
          [ 'id' => null,
            'first_name'=> 'Admin',
            'last_name'=> 'Admin',
            'email' => 'admin@queleo.com',
            'country_id' => '1',
            'birth_date' => '2000-01-01',
            'sex' => 'm',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
          ]
        );

        DB::table('carts')->insert(
          [
            'id' => null,
            'user_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
          ]
        );

        factory(App\User::class, 60)->create();
    }
}
