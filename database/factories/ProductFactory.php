<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


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
       'description' => $faker->sentence(),
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
       'category_id' => $faker->numberBetween(0, 5),
       'brand_id' => $faker->numberBetween(0, 5),
       'name' => $faker->company,
       'sku' =>$faker->numberBetween(100, 100000),
       'quantity' => $faker->randomElement([0,1, 2]),
       'description' => $faker->paragraph,
       'price' => $faker->numberBetween(100, 100000),
       'status' => 1,
       'featured' => 1,
       'hot' => 1,
       'best_seller' => 1,
       'new' => 1,
       'landing_page' => 1,
       'image_url' => $faker->randomElement(["https://d36h5xyl0pecwl.cloudfront.net/productImage/HP1670.jpg", " https://d36h5xyl0pecwl.cloudfront.net/productImage/HP1651.jpg", "https://d36h5xyl0pecwl.cloudfront.net/productImage/HP1643.jpg", "https://d36h5xyl0pecwl.cloudfront.net/productImage/HP1637.jpg", "https://d36h5xyl0pecwl.cloudfront.net/productImage/HP01712.jpg"])

   ];
});

