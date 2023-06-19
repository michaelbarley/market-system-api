<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index(Request $request)
    {
        $buyers = User::query();

        $buyers->has('transactions');
        $buyers = $this->filterData($request, $buyers);
        $buyers = $this->sortData($request, $buyers);
        $buyers = $this->paginateData($request, $buyers);

        return response()->json(['data' => $buyers], 200);
    }

    public function show(User $user)
    {
        if ($user->transactions()->count() == 0) {
            return response()->json([
                'error' => 'This user is not a buyer.',
                'code' => 422
            ], 422);
        }

        return response()->json(['data' => $user], 200);
    }
}
