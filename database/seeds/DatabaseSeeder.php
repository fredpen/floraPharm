<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
             OrderTableSeeder::class,
             DeliveryLocation::class
            UsersTableSeeder::class,
            ProductSeeder::class,
           
           
        ]);
    }


}
