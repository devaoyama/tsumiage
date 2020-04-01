<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Date::class, function (Faker $faker) {
    return [
        'user_id' => \App\User::inRandomOrder()->first()->id,
        'date' => $faker->dateTimeBetween('-1 days', 'now')->format('y-m-d'),
        'status' => $faker->boolean,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
