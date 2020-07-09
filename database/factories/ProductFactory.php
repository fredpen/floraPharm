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
       'category_id' => $faker->numberBetween(0, 10),
       'brand_id' => $faker->numberBetween(0, 10),
       'name' => $faker->company,
       'sku' => $faker->numberBetween(100000, 57475663),
       'quantity' => $faker->numberBetween(1, 5),
       'description' => $faker->paragraph,
       'price' => $faker->numberBetween(100, 100000),
       'status' => 1,
       'featured' => 1,
       'hot' => 1,
       'best_seller' => 1,
       'new' => 1,
       'landing_page' => 1,
       'image_url' => "https://res.cloudinary.com/dk93ofxer/image/upload/v1593245246/floraPharm/hr9xj9hgpkpgs0jafa2d.png"
   ];
});
