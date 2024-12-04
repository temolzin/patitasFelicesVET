<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;
use Faker\Factory as Faker;
use App\Models\Animal;

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
        Client::create([
            'name' => 'John',
            'last_name' => 'Doe',
            'animal_id' => Animal::inRandomOrder()->first()->id,
            'phone' => '5551234567',
            'email' => 'johndoe@example.com',
            'state' => 'California',
            'city' => 'Los Angeles',
            'colony' => 'Downtown',
            'address' => '1234 Main St',
            'postal_code' => '90001',
            'number_pets' => 2,
            'observations' => 'Regular customer',
        ]);

        Client::create([
            'name' => 'Jane',
            'last_name' => 'Smith',
            'animal_id' => Animal::inRandomOrder()->first()->id,
            'phone' => '5557654321',
            'email' => 'janesmith@example.com',
            'state' => 'Texas',
            'city' => 'Houston',
            'colony' => 'River Oaks',
            'address' => '5678 Elm St',
            'postal_code' => '77001',
            'number_pets' => 3,
            'observations' => 'VIP customer',
        ]);

        Client::create([
            'name' => 'Emily',
            'last_name' => 'Johnson',
            'animal_id' => Animal::inRandomOrder()->first()->id,
            'phone' => '5559876543',
            'email' => 'emilyjohnson@example.com',
            'state' => 'Florida',
            'city' => 'Miami',
            'colony' => 'Coconut Grove',
            'address' => '9101 Ocean Dr',
            'postal_code' => '33101',
            'number_pets' => 1,
            'observations' => 'New customer',
        ]);
    }
}
