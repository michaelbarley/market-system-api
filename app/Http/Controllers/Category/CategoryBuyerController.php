<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryBuyerController extends Controller
{
    public function index(Category $category)
    {
        $categoryUniqueProductBuyers = $category->products()->whereHas('transactions')->get()->pluck('transactions')->collapse()->pluck('buyer')->unique('id')->values();
        return response()->json(['data' => $categoryUniqueProductBuyers], 200);
    }
}
