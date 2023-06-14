<?php

use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Category\CatergoryController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Buyer;
use App\Models\Category;
use App\Models\Product;
use App\Models\Seller;
use App\Models\Transaction;
use App\Models\User;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('buyers', BuyerController::class, ['only' => ['index', 'show']])->parameters([
    'buyers' => 'user'
]);

Route::resource('sellers', SellerController::class, ['only' => ['index', 'show']])->parameters([
    'sellers' => 'user'
]);
Route::resource('categories', CatergoryController::class, ['except', ['create', 'edit']]);
Route::resource('products', ProductController::class, ['only' => ['index', 'show']]);
Route::resource('transactions', TransactionController::class, ['only' => ['index', 'show']]);
Route::resource('users', UserController::class, ['except', ['create', 'edit']]);
