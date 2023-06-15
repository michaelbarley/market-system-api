<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerTransactionController extends Controller
{
    public function index(User $user)
    {
        return response()->json(['data' => $user->transactions], 200);
    }
}
