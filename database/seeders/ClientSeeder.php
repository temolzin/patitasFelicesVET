<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Faker\Factory as Faker;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            Client::create([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'phone' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'state' => $faker->state,
                'city' => $faker->city,
                'colony' => $faker->streetName,
                'address' => $faker->streetAddress,
                'postal_code' => $faker->postcode,
                'number_pets' => $faker->numberBetween(1, 5),
                'observations' => $faker->sentence,
            ]);
        }
    }
}
