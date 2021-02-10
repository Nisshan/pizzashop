<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class CartController extends Controller
{
    public function index()
    {
        if (count(cart()->items()) < 1) {
            return redirect()->route('home')->with('error', 'No Items in Cart, Please Add Before Processing');
        }
        if (auth()->check()) {
            session()->forget('coupon');
            $coupon = auth()->user()->coupon()->first();
            if (isset($coupon)) {
                session()->put('coupon', [
                    'name' => $coupon->name,
                    'discount' => $coupon->discount
                ]);
            }
        }



        $discount = session()->get('coupon')['discount'] ?? 0;

        $newSubTotal = cart()->getSubtotal() - $discount;


        return view('frontend.pages.cart', [
            'items' => cart()->items(),
            'transaction' => cart()->totals(),
            'subtotal' => cart()->getSubtotal(),
            'count' => count(cart()->items()),
            'discount' => $discount,
            'deliveryCharge' => cart()->getShippingCharges(),
            'payable' => $newSubTotal
        ]);
    }

    public function addToCart(Request $request)
    {
        Product::addToCart($request->product_id);
        return redirect()->route('cart.view')->with('success', 'Item Added To Cart');
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
