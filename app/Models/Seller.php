<?php

namespace App\Models;
use App\Models\Product;

class Seller extends User
{
    public function transactions()
    {
        return $this->hasMany(Product::class);
    }
}
