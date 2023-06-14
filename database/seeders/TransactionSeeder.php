<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Seller;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use App\Models\User;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        Product::all()->take(2)->each(function ($product) {
            $buyer = User::all()->except($product->seller_id)->random();
            Transaction::factory()->create([
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);
        });
    }
}
