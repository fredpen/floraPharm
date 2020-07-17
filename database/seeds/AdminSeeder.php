<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $webDetails = Config::get('constants.WEBSITE_DETAILS');
        User::create([
            'email' => $webDetails['email'],
            'first_name' => "Florax",
            'last_name' => "Pharmacy",
            'phone_number' => $webDetails['phone'],
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password,
            'status' => 1,
            'type' => 1,
        ]);
    }
}
