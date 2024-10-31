<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('categories')->insert([
                'created_by' => $faker->numberBetween(1, 3),
                'name' => $faker->sentence(3),
                'description' => $faker->text(50),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
