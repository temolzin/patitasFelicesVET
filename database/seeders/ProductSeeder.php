<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Alimento para Perros',
            'description' => 'Alimento balanceado para perros de todas las edades.',
            'price' => 350.00,
            'stock' => 100,
            'category' => 'Alimentos',
            'notes' => 'Saco de 20 kg',
        ]);

        Product::create([
            'name' => 'Collar para Perros',
            'description' => 'Collar ajustable de nylon, resistente y duradero.',
            'price' => 150.00,
            'stock' => 50,
            'category' => 'Accesorios',
            'notes' => 'Disponible en varios colores',
        ]);

        Product::create([
            'name' => 'Juguete para Gatos',
            'description' => 'Juguete interactivo para gatos, fomenta el ejercicio y la diversión.',
            'price' => 200.00,
            'stock' => 75,
            'category' => 'Juguetes',
            'notes' => 'Atractivo para gatos de todas las edades',
        ]);

        Product::create([
            'name' => 'Shampoo para Mascotas',
            'description' => 'Shampoo hipoalergénico para el baño de mascotas.',
            'price' => 100.00,
            'stock' => 200,
            'category' => 'Higiene',
            'notes' => '400 ml',
        ]);

        Product::create([
            'name' => 'Cama para Perros',
            'description' => 'Cama cómoda y acolchonada para perros.',
            'price' => 450.00,
            'stock' => 30,
            'category' => 'Accesorios',
            'notes' => 'Tamaño mediano',
        ]);
    }
}
