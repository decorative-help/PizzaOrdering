<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\DeliveryMethod;
use Faker\Generator as Faker;

$factory->define(DeliveryMethod::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price_factor' => $faker->randomFloat(2, 0, 55),
    ];
});
