<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class AdoptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vetMembers = DB::table('vet_member')->where('type_member', 'Adoptante')->get();

        foreach ($vetMembers as $member) {
            $animals = DB::table('animals')->where('vet_id', $member->vet_id)->get();

            if ($animals->count() >= 2) {
                $selectedAnimals = $animals->random(2);

                foreach ($selectedAnimals as $animal) {
                    DB::table('adoptions')->insert([
                        'animal_id' => $animal->id,
                        'vet_member_id' => $member->id,
                        'adoption_date' => Carbon::now()->subDays(rand(0, 365)),
                        'observation' => 'Adopción realizada por ' . $member->name,
                    ]);
                }
            }
        }
    }
}
