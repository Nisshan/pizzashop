<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if (Cart::count() == 0) {
            return redirect()->route('home')->with('error', 'No Items in Cart, Please Add Items First');
        }
        return view('frontend.pages.checkout',[
            'items' => Cart::content(),
            'tax' => Cart::tax(),
            'total' => Cart::total(),
            'subtotal' => Cart::subtotal()
        ]);
    }
}
