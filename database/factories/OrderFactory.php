<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\WishList::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomElement([1,2,3,4,5]),
        'product_id' => $faker->randomElement([1,2,3,4,5]),
    ];
});


$factory->define(\App\Models\Order::class, function (Faker $faker) {
    return [
        'order_num' => $faker->numberBetween(3000, 9000),
        'total_amount' => $faker->numberBetween(100, 30000),
        'payment_status' => $faker->boolean(),
        'reference_no' => $faker->numberBetween(999, 9999),
        'promo_code' => $faker->numberBetween(100000, 57475663),
        'address_id' => 1,
        'user_id' => $faker->randomElement([1,2,3,4,5]),
    ];
});


$factory->define(\App\Models\OrderDetail::class, function (Faker $faker) {
    return [
        'product_name' => $faker->sentence(),
        'amount' => $faker->numberBetween(99, 999),
        'product_id' => $faker->randomElement([1,2,3,4,5]),
        'order_id' => $faker->randomElement([1,2,3,4,5]),
        'quantity' => $faker->numberBetween(1, 5),
        'total_amount' => $faker->numberBetween(19393, 533837),
        'size' => $faker->numberBetween(1, 100),
    ];
});
