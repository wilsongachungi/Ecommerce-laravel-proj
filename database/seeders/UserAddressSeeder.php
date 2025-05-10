<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAddressSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('user_addresses')->insert([
            [
                'type' => 'Home',
                'address1' => '123 Main Street',
                'address2' => 'Apt 4B',
                'city' => 'Nairobi',
                'state' => 'Nairobi',
                'zipcode' => '00100',
                'isMain' => true,
                'country_code' => 'KEN',
                'user_id' => 2, // Make sure this user exists in the users table,
            ],
            [
                'type' => 'Office',
                'address1' => '456 Business Rd',
                'address2' => null,
                'city' => 'Mombasa',
                'state' => 'Coast',
                'zipcode' => '80100',
                'isMain' => false,
                'country_code' => 'KEN',
                'user_id' => 2,
            ],
        ]);
    }
}
