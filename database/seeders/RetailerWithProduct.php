<?php

namespace Database\Seeders;

use App\Models\Stock;
use App\Models\Product;
use App\Models\Retailer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RetailerWithProduct extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Given
        // I have a product with stock
        // create product to test
        $switch = Product::create(['name' => 'Nintendo Switch']);
        // create retailer to test
        $bestBuy = Retailer::create(['name' => 'Best Buy']);

        // create a new stock
        $stock = new Stock([
            'price' => 10000,
            'url' => 'http://foo.com',
            'sku' => '12345',
            'in_stock' => false,
        ]);
    }
}
