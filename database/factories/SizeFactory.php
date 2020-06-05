<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Size;
use Faker\Generator as Faker;

$factory->define(Size::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price_factor' => $faker->randomFloat(1, 1, 5),
    ];
});
