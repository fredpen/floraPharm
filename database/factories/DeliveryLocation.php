<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(DeliveryLocation::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'description' => $faker->words(5, true),
        'price' => $faker->numberBetween(2000, 5000),
    ];
});
