<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $countryId = App\Country::where('name', 'argentina')->get()[0]->id;
    $sex = $faker->randomElement(['f','m']);
    $avatar = ($sex == 'f' ? 'generic_female_avatar.png' : 'generic_male_avatar.png');
    return [
        'first_name' => $faker->firstName($sex == 'f' ? 'female' : 'male'),
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'country_id' => $countryId,
        'birth_date' => $faker->date('Y-m-d', '2010-12-31'),
        'sex' => $sex,
        'password' => Hash::make('password'),
        'avatar_url' => $avatar,
        'email_verified_at' => now(),
        'remember_token' => Str::random(10),
    ];
});
