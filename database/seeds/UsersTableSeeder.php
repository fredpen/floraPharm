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
        factory('App\User', 30)->create()->each(function($u){
           $u->userAddress()->save(factory(\App\Models\UserAddress::class)->make());
        });
    }
}
