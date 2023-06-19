<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query();
        $products = $this->filterData($request, $products);
        $products = $this->sortData($request, $products);
        $products = $this->paginateData($request, $products);

        return response()->json(['data' => $products], 200);
    }

    public function show(Product $product)
    {
        return response()->json(['data' => $product], 200);
    }
}
