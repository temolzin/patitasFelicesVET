<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\VetMember;
use Faker\Factory as Faker;

class VetMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $vetId = [1, 2, 3];

        foreach ($vetId as $vetId) {
            for ($i = 0; $i < 30; $i++) {
                DB::table('vet_member')->insert([
                    'name' => $faker->firstName,
                    'last_name' => $faker->lastName,
                    'phone' => $faker->phoneNumber,
                    'email' => $faker->unique()->safeEmail,
                    'state' => $faker->state,
                    'city' => $faker->city,
                    'colony' => $faker->streetName,
                    'address' => $faker->address,
                    'postal_code' => $faker->postcode,
                    'type_member' => $faker->randomElement(VetMember::TYPE_MEMBER),
                    'vet_id' => $vetId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
