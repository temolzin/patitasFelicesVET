<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Jose',
            'last_name' => 'Lopez Osorio',
            'phone' => '7798745677',
            'email' => 'jose@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Luis',
            'last_name' => 'Osorio Hernandez',
            'phone' => '7798342345',
            'email' => 'luis@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('admin');

        User::create([
            'name' => 'Erika',
            'last_name' => 'Lopez perez',
            'phone' => '7798745677',
            'email' => 'eri@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('vet');

        User::create([
            'name' => 'Maria',
            'last_name' => 'Lopez san juan',
            'phone' => '7798745677',
            'email' => 'maria@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('vet');

        User::create([
            'name' => 'Juan',
            'last_name' => 'Martinez Lopez',
            'phone' => '7798745677',
            'email' => 'juan@gmail.com',
            'password' => Hash::make('12345'),
        ])->assignRole('vet');
    }
}
