<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Task::class, function (Faker $faker) {
    return [
        'date_id' => \App\Date::inRandomOrder()->first()->id,
        'title' => $faker->sentence,
        'status' => $faker->boolean,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
