<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class OrderController extends Controller
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


        cart()->refreshAllItemsData();

        $discount = session()->get('coupon')['discount'] ?? 0;

        $newSubTotal = cart()->getSubtotal() - $discount;

        return view('frontend.pages.checkout', [
            'items' => cart()->items(),
            'tax' => cart()->tax(),
            'transaction' => cart()->totals(),
            'subtotal' => cart()->getSubtotal(),
            'count' => count(cart()->items()),
            'discount' => $discount,
            'newSubTotal' => $newSubTotal,
            'payable' => $newSubTotal + cart()->tax()
        ]);
    }


    public function store(Request $request)
    {

        $discount = session()->get('coupon')['discount'] ?? 0;

        $newSubTotal = cart()->getSubtotal() - $discount;

        try {
            Stripe::charges()->create([
                'amount' => $newSubTotal + cart()->tax(),
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => count(cart()->items()),
                    'discount' => $discount,
                ],
            ]);

//            $order = $this->addToOrdersTables($request, null);
//            Mail::send(new OrderPlaced($order));

            // decrease the quantities of all the products in the cart
//            $this->decreaseQuantities();

//            Cart::instance('default')->destroy();
//            session()->forget('coupon');

            return redirect()->route('thankyou')->with('success', 'Thank you! Your payment has been successfully accepted!');
        } catch (CardErrorException $e) {
//            $this->addToOrdersTables($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
}
