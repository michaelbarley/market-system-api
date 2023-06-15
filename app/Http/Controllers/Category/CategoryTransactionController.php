<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Category $category)
    {
        $categoryUniqueProductTransaction = $category->products()->whereHas('transactions')->get()->pluck('transactions')->collapse()->unique('id')->values();
        return response()->json(['data' => $categoryUniqueProductTransaction], 200);
    }
}
