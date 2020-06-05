<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Topping;
use Faker\Generator as Faker;

$factory->define(Topping::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price_factor' => $faker->randomFloat(1, 2, 15),
    ];
});
