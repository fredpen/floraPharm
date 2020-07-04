<?php

use Illuminate\Database\Seeder;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // factory('App\Models\Category', 30)->create()->each(function ($sub) {
        //     $sub->subCategory()->save(factory(\App\Models\SubCategory::class)->make());
        // });

        // factory(\App\Models\Brand::class, 30)->create();

       factory(\App\Models\Product::class, 30)->create();






    }
}
