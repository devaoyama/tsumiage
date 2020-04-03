<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Config::class, function (Faker $faker) {
    return [
        'public' => $faker->boolean,
        'one_tweet' => $faker->boolean,
        'before_comment' => $faker->sentence,
        'after_comment' => $faker->sentence,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
