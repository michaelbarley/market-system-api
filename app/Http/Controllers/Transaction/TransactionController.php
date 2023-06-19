<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $transactions = Transaction::query();
        $transactions = $this->filterData($request, $transactions);
        $transactions = $this->sortData($request, $transactions);
        $transactions = $this->paginateData($request, $transactions);

        return response()->json(['data' => $transactions], 200);
    }

    public function show(Transaction $transaction)
    {
        return response()->json(['data' => $transaction], 200);
    }
}
