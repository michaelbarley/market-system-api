<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductTransactionController extends Controller
{
    public function index(Product $product)
    {
        return response()->json(['data' => $product->transactions], 200);
    }
}
