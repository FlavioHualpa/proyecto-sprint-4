<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use App\Genre;
use App\Author;
use App\Publisher;
use App\Language;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
  $genres = Genre::all();
  $authors = Author::all();
  $publishers = Publisher::all();
  $languages = Language::all();

  return [
    'id' => null,
    'title' => $faker->sentence(4),
    'total_pages' => $faker->numberBetween(50, 1200),
    'price' => $faker->randomFloat(1, 80, 1500),
    'cover_img_url' => 'mr_luciernagas.png',
    'year_published' => $faker->numberBetween(1950, 2019),
    'genre_id' => $genres->random()->id,
    'author_id' => $authors->random()->id,
    'publisher_id' => $publishers->random()->id,
    'language_id' => $languages->random()->id,
    'ranking' => 0,
    'resena' => $faker->sentence(40),
    'isbn' => $faker->isbn13,
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
  ];
});
