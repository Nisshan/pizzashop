<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);
        Cart::add($product, 1);
        return redirect()->back()->with('Success', 'Item Added To Cart');
    }

    public function increaseCartQuantity(Request $request)
    {
        $cart = Cart::get($request->row_id);
        Cart::update($request->row_id, $cart->qty + 1);
        return redirect()->back()->with('success', 'Cart Quantity Increased');
    }

    public function decreaseCartQuantity(Request $request)
    {
        $cart = Cart::get($request->row_id);
        Cart::update($request->row_id, $cart->qty - 1);
        return redirect()->back()->with('success', 'Cart Quantity Decreased');
    }

    public function destroyCart($id)
    {
        Cart::remove($id);
        return redirect()->back()->with('success', 'Cart Removed');

    }
}
