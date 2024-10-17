<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VaccineSeeder extends Seeder
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
        $vaccineTypes = ['Rabies', 'Distemper', 'Parvovirus', 'Hepatitis', 'Leptospirosis'];

        foreach ($shelterIds as $shelterId) {
            foreach ($vaccineTypes as $vaccineType) {
                DB::table('vaccines')->insert([
                    'shelter_id' => $shelterId,
                    'name' => $vaccineType . ' Vaccine',
                    'type' => $vaccineType,
                    'description' => $faker->paragraph
                ]);
            }
        }
    }
}
