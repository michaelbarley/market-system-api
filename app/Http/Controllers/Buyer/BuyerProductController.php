<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerProductController extends Controller
{
    public function index(User $user)
    {
        $usersPurchasedProducts = $user->transactions()->with('product')->get()->pluck('product');
        return response()->json(['data' => $usersPurchasedProducts], 200);
    }
}
