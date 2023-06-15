<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategorySellerController extends Controller
{
    public function index(Category $category)
    {
        $categoryUniqueProductSellers = $category->products()->with('seller')->get()->pluck('seller')->unique('id')->values();
        return response()->json(['data' => $categoryUniqueProductSellers], 200);
    }
}
