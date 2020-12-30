<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json([
            'items' => Cart::content(),
            'tax' => Cart::tax(),
            'total' => Cart::total(),
            'subtotal' => Cart::subtotal(),
            'count' => Cart::count()
        ]);
    }
}
