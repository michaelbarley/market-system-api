<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerCategoryController extends Controller
{
    public function index(User $user)
    {
        $usersUniqueProductCategories = $user->transactions()->with('product.categories')->get()->pluck('product.categories')->collapse()->unique('id')->values();
        return response()->json(['data' => $usersUniqueProductCategories], 200);
    }
}
