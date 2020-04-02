<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Date::class, function (Faker $faker) {
    return [
        'date' => $faker->dateTimeBetween('-1 days', 'now')->format('y-m-d'),
        'status' => $faker->boolean,
        'post_status' => $faker->boolean,
        'content' => $faker->sentence,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
