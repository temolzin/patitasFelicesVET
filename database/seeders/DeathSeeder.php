<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Animal;

class DeathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $vetIds = [1, 2, 3];
        $causes = ['Natural Causes', 'Accident', 'Illness', 'Unknown'];

        foreach ($vetIds as $vetId) {
            $animalIds = Animal::where('vet_id', $vetId)->pluck('id')->all();

            if (empty($animalIds)) {
                continue;
            }

            for ($i = 0; $i < 5; $i++) {
                DB::table('deaths')->insert([
                    'animal_id' => $faker->randomElement($animalIds),
                    'vet_id' => $vetId,
                    'date' => $faker->date,
                    'cause' => $faker->randomElement($causes),
                ]);
            }
        }
    }
}
