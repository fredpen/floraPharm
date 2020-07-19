<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\DeliveryLocation::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(["Mainland A", "Island A", "Mainland B", "Island B"]),
        'description' => $faker->randomElement(["Lagos island, ikoyi, Victoria Island, Lekki (phase1-vgc 1", "Ajah, badore, sangotedo, Obehi Lekki, epe 1", "gbagada, ikeja, Surulere, yaba, Oshodi, ojodu 3", "ikorodu,Apapa, festac, trade fair, Alaba, badagry 4"]),
        'price' => $faker->numberBetween(2000, 5000),
        'status' => 1
    ];
});
