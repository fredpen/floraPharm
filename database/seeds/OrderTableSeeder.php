<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
     
        factory(\App\Models\Order::class, 30)->create();

       factory(\App\Models\OrderDetail::class, 30)->create();

       factory(\App\Models\WishList::class, 30)->create();
    }
}