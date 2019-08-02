<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Publisher;
use Faker\Generator as Faker;

$factory->define(Publisher::class, function (Faker $faker) {
    return [
      'id' => null,
      'name' => $faker->company,
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
    ];
});
