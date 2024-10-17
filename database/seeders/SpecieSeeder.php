<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('species')->insert([
            [
                'name' => 'Perro',
                'description' => 'Mamífero doméstico de la familia de los cánidos.',
                'shelter_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gato',
                'description' => 'Mamífero carnívoro de la familia de los félidos.',
                'shelter_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ave',
                'description' => 'Clase de animales vertebrados, generalmente alados.',
                'shelter_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Perro',
                'description' => 'Mamífero doméstico de la familia de los cánidos.',
                'shelter_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gato',
                'description' => 'Mamífero carnívoro de la familia de los félidos.',
                'shelter_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Peces',
                'description' => 'Clase de animales vertebrados, generalmente alados.',
                'shelter_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tigre',
                'description' => ' El tigre es el felino más grande del mundo.',
                'shelter_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pingüino emperador',
                'description' => 'El pingüino más grande y robusto, con una coloración distintiva en negro, blanco y amarillo.',
                'shelter_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Peces',
                'description' => 'Clase de animales vertebrados, generalmente alados.',
                'shelter_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
