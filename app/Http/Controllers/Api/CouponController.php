<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class CouponController extends Controller
{
    public function apply(Request $request)
    {
        cart()->setUser(auth()->id());
        $coupon = Coupon::where('code', $request->coupon)->first();

        if (!$coupon) {
            return response()->json([
                'message' => 'Coupon code invalid'
            ]);
        }

        if (auth()->user()->coupon()->count()) {
            return response()->json([
                'message' => 'Coupon Already Applied, cannot apply more than one coupon at a time'
            ]);
        }

        $discount = $coupon->discount(cart()->getSubtotal());

        if ($discount > cart()->getSubtotal()) {
             return response()->json([
                 'message' => 'Sorry cannot add this coupon, Discount Amount is more than payable amount'
             ]);
        }

        auth()->user()->coupon()->create([
            'name' => $coupon->code,
            'discount' => $discount
        ]);
        return response()->json([
            'coupon' => auth()->user()->coupon()->first(),
            'message' => 'Success, Coupon Applied to Cart'
        ]);
    }

    public function remove()
    {
        cart()->setUser(auth()->id());
        auth()->user()->coupon()->delete();
        return response()->json([
            'message' => 'Coupon Removed from the Cart'
        ]);
    }
}
