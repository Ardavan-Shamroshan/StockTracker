<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Stock extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // in_stock in database stores as 0 or 1, but here it'll casts as boolean type
    protected $casts = [
        'in_stock' => 'boolean'
    ];

    public function track()
    {
        if ($this->retailer->name === 'Best Buy') {
            // Hit an API endpoint for the associated retailer
            // Fetch the up-to-date details for item
            $results = Http::get('http://foo.test')->json();

            // And then refresh the current stock record
            $this->update([
                'in_stock' => $results['available'],
                'price' => $results['price']
            ]);
        }
    }


    public function retailer()
    {
        return $this->belongsTo(Retailer::class);
    }
}
