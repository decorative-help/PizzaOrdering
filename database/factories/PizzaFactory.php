<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pizza;
use Faker\Generator as Faker;

$factory->define(Pizza::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'image_link' => 'https://storage.pizzapizza.ca/phx2/ppl_images/products/en/2x/chickenbruschetta.png',
        'description' => $faker->sentence,
        'basic_price' => $faker->randomFloat(2, 0, 99),
    ];
});
