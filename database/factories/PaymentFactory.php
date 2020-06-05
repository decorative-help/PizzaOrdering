<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'price_factor' => $faker->randomFloat(1, 0.5, 1.5),
    ];
});
