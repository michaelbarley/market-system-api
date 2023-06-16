<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    public function updating(Product $product)
    {
        if ($product->quantity == 0 && $product->isDirty('quantity')) {
            $product->status = Product::UNAVAILABLE_PRODUCT;
        }
    }
}
