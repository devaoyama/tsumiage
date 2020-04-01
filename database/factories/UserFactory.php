<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
    return [
        'name' => $faker->name,
        'nickname' => $faker->name,
        'twitter_id' => $faker->uuid,
        'avatar' => $faker->imageUrl(),
        'twitter_token' => Str::random(10),
        'twitter_token_secret' => Str::random(10),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
