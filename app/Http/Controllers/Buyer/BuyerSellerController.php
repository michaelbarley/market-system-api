<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerSellerController extends Controller
{
    public function index(User $user)
    {
        $usersUniqueSellers = $user->transactions()->with('product.seller')->get()->pluck('product.seller')->unique('id')->values();
        return response()->json(['data' => $usersUniqueSellers], 200);
    }
}
