<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionSellerController extends Controller
{
    public function index(Transaction $transaction)
    {
        return response()->json(['data' => $transaction->product->seller], 200);
    }
}
