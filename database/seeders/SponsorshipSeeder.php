<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Animal;
use App\Models\ShelterMember;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $shelterIds = [1, 2, 3];

        foreach ($shelterIds as $shelterId) {
            $animalIds = Animal::where('shelter_id', $shelterId)->pluck('id')->all();
            $shelterMemberIds = ShelterMember::where('shelter_id', $shelterId)
                                             ->where('type_member', 'Padrino')
                                             ->pluck('id')
                                             ->all();

            if (empty($animalIds) || empty($shelterMemberIds)) {
                continue;
            }

            foreach ($shelterMemberIds as $shelterMemberId) {
                for ($i = 0; $i < 2; $i++) {
                    DB::table('sponsorship')->insert([
                        'animal_id' => $faker->randomElement($animalIds),
                        'shelter_member_id' => $shelterMemberId,
                        'start_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                        'finish_date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                        'payment_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                        'amount' => $faker->randomFloat(2, 10, 500),
                        'observation' => $faker->sentence,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
