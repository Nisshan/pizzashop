<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function store(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->first();

        if (!$coupon) {
            return redirect()->route('cart.view')->with('error', 'Coupon Not Found, Please Try with different one');
        }


        $discount = $coupon->discount(cart()->getSubtotal());

        if ($discount > cart()->getSubtotal()) {
            return redirect()->route('cart.view')->with('error', 'Sorry cannot add this coupon, Discount Amount is more than payable amount');
        }

        if (auth()->check()) {
            auth()->user()->coupon()->create([
                'name' => $coupon->code,
                'discount' => $discount
            ]);
        } else {
            session()->put('coupon', [
                'name' => $coupon->code,
                'discount' => $discount
            ]);
        }
        return redirect()->route('cart.view')->with('success', 'Coupon Added Success');
    }


    public function destroy()
    {
        if (auth()->check()) {
            auth()->user()->coupon()->delete();
        }
        session()->forget('coupon');
        return redirect()->route('cart.view')->with('success', 'Coupon Removed');
    }
}
