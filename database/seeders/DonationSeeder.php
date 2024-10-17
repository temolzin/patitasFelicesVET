<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\ShelterMember;
use App\Models\Animal;
use App\Models\Donation;


class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $shelterMembers = ShelterMember::all();

        foreach ($shelterMembers as $shelterMember) {
            $animalIds = Animal::where('shelter_id', $shelterMember->shelter_id)->pluck('id')->all();

            if (empty($animalIds)) {
                continue;
            }

            for ($i = 0; $i < 3; $i++) {
                DB::table('donations')->insert([
                    'shelter_member_id' => $shelterMember->id,
                    'donation_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s'),
                    'type' => $faker->randomElement(Donation::DONATION),
                    'observation' => $faker->paragraph,
                    'amount' => $faker->randomFloat(2, 5, 500),
                    'observation' => $faker->sentence,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
