<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vets')->insert([
            [
                'user_id' => 4,
                'name' => 'Xiollin',
                'phone' => '123456890',
                'facebook' => 'https://facebook.com/albergue1',
                'tiktok' => 'https://tiktok.com/albergue1',
                'state' => 'Mexico',
                'city' => 'Teotihucan',
                'colony' => 'Centro',
                'address' => '5 de Mayo',
                'postal_code' => '12345',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 5,
                'name' => 'Albergue Dos',
                'phone' => '234-567-8901',
                'facebook' => 'https://facebook.com/albergue2',
                'tiktok' => 'https://tiktok.com/albergue2',
                'state' => 'Mexico',
                'city' => 'Teotihucan',
                'colony' => 'Centro',
                'address' => '5 de Mayo',
                'postal_code' => '23456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'name' => 'Albergue Tres',
                'phone' => '345-678-9012',
                'facebook' => 'https://facebook.com/albergue3',
                'tiktok' => 'https://tiktok.com/albergue3',
                'state' => 'Mexico',
                'city' => 'Teotihucan',
                'colony' => 'Centro',
                'address' => '5 de Mayo',
                'postal_code' => '34567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
