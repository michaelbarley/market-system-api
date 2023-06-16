<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(Product $product)
    {
        return response()->json(['data' => $product->categories], 200);
    }

    public function update(Request $request, Product $product, Category $category)
    {
        $product->categories()->syncWithoutDetaching([$category->id]);

        return response()->json(['data' => $product->categories], 200);
    }

    public function destroy(Product $product, Category $category)
    {
        if (!$product->categories()->find($category->id)) {
            return response()->json([
                'error' => 'The product selected does not have this category',
                'code' => 422
            ], 422);
        }

        $product->categories()->detach($category->id);

        return response()->json(['data' => $product->categories], 200);
    }
}
