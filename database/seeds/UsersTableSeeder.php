<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory('App\User', 20)->create()->each(function($u){
           $u->userAddress()->save(factory(\App\Models\UserAddress::class)->make());
        });

        factory('App\Models\Category', 30)->create()->each(function ($sub) {
            $sub->subCategory()->save(factory(\App\Models\SubCategory::class)->make());
        });

        factory(\App\Models\Brand::class, 30)->create();
    }
}
