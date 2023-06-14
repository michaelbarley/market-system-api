<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index()
    {
        return response()->json(['data' => User::has('products')->get()], 200);
    }

    public function show(User $user)
    {
        if ($user->products()->count() == 0) {
            return response()->json([
                'error' => 'This user is not a seller.',
                'code' => 422
            ], 422);
        }

        return response()->json(['data' => $user], 200);
    }
}
