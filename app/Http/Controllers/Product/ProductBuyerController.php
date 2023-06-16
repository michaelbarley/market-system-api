<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductBuyerController extends Controller
{
    public function index(Product $product)
    {
        return response()->json(['data' => $product->transactions()
            ->with('buyer')
            ->get()
            ->pluck('buyer')
            ->values()], 200);
    }
}
