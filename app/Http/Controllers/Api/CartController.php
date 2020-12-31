<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function addToCart(Request $request)
    {

//        cart()->setUser(auth()->id());
        Product::addToCart($request->product_id);
        return response()->json([
            'items' => cart()->toArray(),
            'message' => 'Product Added To Cart'
        ], 200);
    }

    public function increaseCartQuantity(Request $request)
    {
        cart()->setUser(auth()->id());
        cart()->incrementQuantityAt($request->index);
        return response()->json([
            'items' => cart()->toArray(),
            'message' => 'Cart Quantity Increased'
        ], 200);
    }

    public function decreaseCartQuantity(Request $request)
    {
        cart()->setUser(auth()->id());
        cart()->decrementQuantityAt($request->index);
        return response()->json([
            'items' => cart()->toArray(),
            'message' => 'Cart Quantity decreased'
        ], 200);
    }

    public function destroyCart($id)
    {
        cart()->setUser(auth()->id());
        cart()->removeAt($id);
        return response()->json([
            'items' => cart()->toArray(),
            'message' => 'Item Remved'
        ], 200);
    }
}
