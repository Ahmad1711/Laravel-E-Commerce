<?php

use App\Product;
use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'image' => 'uploads/products/avatar.png',
        'price' => $faker->numberBetween(100, 1000),
        'desc' => $faker->paragraph(10),
    ];
});
