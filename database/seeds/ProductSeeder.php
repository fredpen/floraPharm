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
        factory('App\Models\Category', 20)->create()->each(function ($sub) {
            $sub->subCategory()->save(factory(\App\Models\SubCategory::class)->make());
        });

        factory(\App\Models\Brand::class, 30)->create();

       factory(\App\Models\Product::class, 30)->create();

       factory(\App\Models\Order::class, 30)->create();

       factory(\App\Models\OrderDetail::class, 30)->create();

       factory(\App\Models\WishList::class, 30)->create();




    }
}
