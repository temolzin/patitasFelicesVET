<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ShelterMember;
use Faker\Factory as Faker;

class ShelterMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $shelterId = [1, 2, 3];

        foreach ($shelterId as $shelterId) {
            for ($i = 0; $i < 30; $i++) {
                DB::table('shelter_member')->insert([
                    'name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->unique()->safeEmail,
                    'state' => $faker->state,
                    'city' => $faker->city,
                    'colony' => $faker->streetName,
                    'address' => $faker->address,
                    'postal_code' => $faker->postcode,
                    'type_member' => $faker->randomElement(ShelterMember::TYPE_MEMBER),
                    'shelter_id' => $shelterId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
