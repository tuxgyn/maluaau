<?php
// database/seeders/ProductSeeder.php
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::insert([
            ['name' => 'Ração Golden Fórmula 15kg', 'category' => 'racao', 'price' => 189.90, 'stock' => 12, 'active' => true],
            ['name' => 'Petisco Dental Care 100g', 'category' => 'petisco', 'price' => 24.90, 'stock' => 30, 'active' => true],
            ['name' => 'Brinquedo Bola Maciça', 'category' => 'brinquedo', 'price' => 19.90, 'stock' => 25, 'active' => true],
            ['name' => 'Shampoo Neutro 500ml', 'category' => 'higiene', 'price' => 32.00, 'stock' => 18, 'active' => true],
        ]);
    }
}