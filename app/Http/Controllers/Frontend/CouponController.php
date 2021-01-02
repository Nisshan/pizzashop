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
            return redirect()->route('checkout')->with('error', 'Coupon Not Found, Please Try with different one');
        }

        $discount = $coupon->discount(cart()->getSubtotal());


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
        return redirect()->route('checkout')->with('success', 'Coupon Added Success');
    }


    public function destroy()
    {
        auth()->user()->coupon()->delete();
        session()->forget('coupon');
        return redirect()->route('checkout')->with('success', 'Coupon Removed');
    }
}
