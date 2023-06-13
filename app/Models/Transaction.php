<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Buyer;
use App\Models\Product;

class Transaction extends Model
{
    protected $fillable = [
        'quantity',
        'buyer_id',
        'product_id'
    ];

    public function buyer()
    {
        $this->belongsTo(Buyer::class);
    }

    public function product()
    {
        $this->belongsTo(Product::class);
    }
}
