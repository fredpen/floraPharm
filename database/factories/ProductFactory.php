<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Category::class, function (Faker $faker) {
      return [
          'name' => $faker->city,
          'status' => 1
      ];
});


$factory->define(\App\Models\Brand::class, function (Faker $faker){
   return [
       'name' => $faker->company,
       'description' => $faker->paragraph,
       'status' => 1
   ];
});

$factory->define(\App\Models\SubCategory::class, function (Faker $faker) {
   return [
        'name' => $faker->country,
        'status' => 1
   ];
});

$factory->define(\App\Models\Product::class, function (Faker $faker) {
   return [
       'category_id' => $faker->numberBetween(0, 30),
       'brand_id' => $faker->numberBetween(0, 30),
       'sub_category_id' => $faker->numberBetween(0, 30),
       'name' => $faker->company,
       'sku' => $faker->numberBetween(100000, 57475663),
       'quantity' => $faker->numberBetween(1, 5),
       'description' => $faker->paragraph,
       'price' => $faker->numberBetween(100, 100000),
       'status' => 1,
       'image_url' => $faker->imageUrl(640, 480)
   ];
});
