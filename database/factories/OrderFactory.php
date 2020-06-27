<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'phone_number' => $faker->phoneNumber,
        'status' => 1,
        'type' => 2,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


$factory->define(\App\Models\Order::class, function (Faker $faker) {
   return [
       'order_num' => $faker->numberBetween(100, 3000),
       'total_amount' => $faker->numberBetween(100, 30000),
       'payment_status' => $faker->boolean(),
       'reference_no' => $faker->numberBetween(999, 9999),
       'promo_code' => $faker->numberBetween(100000, 57475663),
       'address_id' => $faker->numberBetween(1, 10),
       'user_id' => $faker->numberBetween(1, 5),
   ];
});


$factory->define(\App\Models\OrderDetail::class, function (Faker $faker) {
    return [
        'product_name' => $faker->sentence(),
        'amount' => $faker->numberBetween(99, 999),
        'product_id' => $faker->numberBetween(1, 10),
        'order_id' => $faker->numberBetween(1, 10),
        'quantity' => $faker->numberBetween(1, 5),
        'total_amount' => $faker->numberBetween(19393, 533837),
        'size' => $faker->numberBetween(1, 100),
    ];
 });



$factory->define(\App\Models\WishList::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'product_id' => $faker->numberBetween(1, 10),

    ];
 });
