<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $s = 1000;
$total = 100000;

for ($i = 0; $i < $total; $i += $s) {

    $products = Product::factory($s)->make()->toArray();

    Product::insert($products);
}

    }
}
