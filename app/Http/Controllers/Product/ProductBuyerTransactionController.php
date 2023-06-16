<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductBuyerTransactionController extends Controller
{
    public function store(Request $request, Product $product, User $user)
    {

        $rules = [
            'quantity' => 'required|integer|min:1'
        ];

        $this->validate($request, $rules);

        if ($user->id == $product->seller_id) {
            return response()->json([
                'error' => 'The seller cannot be the same as the buyer',
                'code' => 422
            ], 422);
        }

        if (!$user->isVerified()) {
            return response()->json([
                'error' => 'The buyer must be a verified user',
                'code' => 422
            ], 422);
        }

        if (!$product->seller->isVerified()) {
            return response()->json([
                'error' => 'The seller must be a verified user',
                'code' => 422
            ], 422);
        }

        if (!$product->isAvailable()) {
            return response()->json([
                'error' => 'The product is not available',
                'code' => 422
            ], 422);
        }

        if ($product->quantity < $request->quantity) {
            return response()->json([
                'error' => 'The product is not available in your desired quantity',
                'code' => 422
            ], 422);
        }

        return DB::transaction(function () use ($request, $product, $user) {
            $product->quantity -= $request->quantity;
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $user->id,
                'product_id' => $product->id
            ]);

            return response()->json(['data' => $transaction], 200);
        });
    }
}
