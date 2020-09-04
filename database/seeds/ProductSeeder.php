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
        factory(\App\Models\Category::class, 5)->create();

        factory(\App\Models\Brand::class, 5)->create();

       factory(\App\Models\Product::class, 50)->create();

    }
    
}
