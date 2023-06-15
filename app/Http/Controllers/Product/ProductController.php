<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Product::all()], 200);
    }

    public function show(Product $product)
    {
        return response()->json(['data' => $product], 200);
    }
}
