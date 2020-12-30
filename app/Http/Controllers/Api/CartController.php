<?php

namespace App\Http\Controllers\Api;

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
        return response()->json([
            'items' => Cart::content(),
            'message' => 'Product Added To Cart'
        ], 200);
    }

    public function increaseCartQuantity(Request $request)
    {
        Cart::update($request->row_id,2);
        return response()->json([
            'row_id' => $request->row_id,
            'user' => auth()->id(),
            'items' => Cart::content(),
            'message' => 'Cart Quantity Increased'
        ], 200);
    }

    public function decreaseCartQuantity(Request $request)
    {
//        $cart = Cart::get($request->row_id);
//        Cart::update($request->row_id, $cart->qty - 1);

        return response()->json([
            'items' => Cart::content(),
            'message' => 'Cart Quantity decreased'
        ], 200);
    }

    public function destroyCart($id)
    {
        Cart::remove($id);
        return response()->json([
            'items' => Cart::content(),
            'message' => 'Item Remved'
        ], 200);
    }
}
