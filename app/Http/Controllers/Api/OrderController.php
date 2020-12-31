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
            'items' => cart()->items(),
            'tax' => cart()->tax(),
            'transaction' =>cart()->totals(),
            'subtotal' => cart()->getSubtotal(),
            'count' => count(cart()->items())
        ]);
    }
}
