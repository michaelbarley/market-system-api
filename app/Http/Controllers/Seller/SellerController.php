<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function index(Request $request)
    {
        $sellers = User::query();
        $sellers->has('products');
        $sellers = $this->filterData($request, $sellers);
        $sellers = $this->sortData($request, $sellers);
        $sellers = $this->paginateData($request, $sellers);

        return response()->json(['data' => $sellers], 200);
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
