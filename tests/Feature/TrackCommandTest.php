<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Retailer;
use Database\Seeders\RetailerWithProduct;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

class TrackCommandTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_to_tracks_product_stock(): void
    {
        $this->seed(RetailerWithProduct::class);

        $this->assertFalse(Product::first()->inStock());

        Http::fake(fn () => ['available' => true, 'price' => 29900]);

        // When
        // I trigger the php artisan command
        // And assuming the stock is available now
        $this->artisan('track')
            ->expectsOutput('Done!');

        // Then
        // Then stock details should be refreshed
        $this->assertTrue(Product::first()->inStock());
    }
}
