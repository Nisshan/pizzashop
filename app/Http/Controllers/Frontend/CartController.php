<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        cart()->setUser(auth()->id());
        Product::addToCart($request->product_id);
        return redirect()->back()->with('Success', 'Item Added To Cart');
    }

    public function increaseCartQuantity(Request $request)
    {
        cart()->incrementQuantityAt($request->index);
        return redirect()->back()->with('success', 'Cart Quantity Increased');
    }

    public function decreaseCartQuantity(Request $request)
    {
        cart()->decrementQuantityAt($request->index);
        return redirect()->back()->with('success', 'Cart Quantity Decreased');
    }

    public function destroyCart($id)
    {
        cart()->removeAt($id);
        return redirect()->back()->with('success', 'Cart Removed');

    }
}
