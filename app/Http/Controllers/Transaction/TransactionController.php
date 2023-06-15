<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Transaction::all()], 200);
    }

    public function show(Transaction $transaction)
    {
        return response()->json(['data' => $transaction], 200);
    }
}
