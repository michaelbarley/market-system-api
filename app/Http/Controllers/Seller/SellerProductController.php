<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SellerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        return response()->json(['data' => $user->products], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, User $user)
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer|min:1',
            'image' => 'required|image'
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] = '1.png';
        $data['seller_id'] = $user->id;

        $product = Product::create($data);

        return response()->json(['data' => $product], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user, Product $product)
    {
        $rules = [
            'quantity' => 'integer|min:1',
            'status' => 'in:' . Product::AVAILABLE_PRODUCT . ',' . Product::UNAVAILABLE_PRODUCT,
            'image' => 'image'
        ];

        $this->validate($request, $rules);

        if ($product->seller_id != $user->id) {
            return response()->json([
                'error' => 'The specified seller is not the actual seller of this product',
                'code' => 409
            ], 409);
        }

        $product->fill($request->only([
            'name',
            'description',
            'quantity'
        ]));

        if ($request->has('status')) {
            $product->status = $request->status;

            if ($product->isAvailable() && $product->categories()->count() == 0) {
                return response()->json([
                    'error' => 'An active product must contain at least one category',
                    'code' => 409
                ], 409);
            }
        }

        if ($product->isClean()) {
            return response()->json([
                'error' => 'You need to specify a different value in order to update',
                'code' => 422
            ], 422);
        }

        $product->save();

        return response()->json(['data' => $product], 200);
    }


    public function destroy(User $user, Product $product)
    {
        if ($product->seller_id != $user->id) {
            return response()->json([
                'error' => 'The specified seller is not the actual seller of this product',
                'code' => 409
            ], 409);
        }

        $product->delete();

        return response()->json(['data' => $user->products], 200);
    }
}
