<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Date::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::inRandomOrder()->first()->id,
        'date' => now(),
        'status' => $faker->boolean,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
