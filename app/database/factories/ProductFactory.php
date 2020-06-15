<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->words(4, true),
        'description' => $faker->text(500),
        'price' => $faker->numberBetween(100000, 100000000), // price unit assumed IRR(Rials)
        'count' => $faker->numberBetween(5, 5000),
        'category' => $faker->numberBetween(1, 20), // 20 categories will be generated so assign each product to one category
    ];
});
