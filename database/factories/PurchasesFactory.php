<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Purchase;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
    $users = App\User::all();
    return [
        'user_id' => $users->random()->id,
        'invoice_number' => $faker->unique()->numberBetween(15000, 20000),
    ];
});
