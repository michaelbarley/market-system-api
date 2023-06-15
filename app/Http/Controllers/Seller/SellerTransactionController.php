<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerTransactionController extends Controller
{
    public function index(User $user)
    {
        return response()->json(['data' => $user->products()
            ->whereHas('transactions')
            ->with('transactions')->get()
            ->pluck('transactions')
            ->collapse()
            ->unique('id')
            ->values()], 200);
    }
}
