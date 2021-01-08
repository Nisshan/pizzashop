<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderProduct;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        cart()->setUser(auth()->id());
        cart()->refreshAllItemsData();
        return response()->json([
            'items' => cart()->items(),
            'tax' => cart()->tax(),
            'transaction' => cart()->totals(),
            'subtotal' => cart()->getSubtotal(),
            'count' => count(cart()->items()),
            'discount' => \cart()->getDiscount(),
            'newSubTotal' => \cart()->getSubtotal(),
            'payable' => \cart()->getSubtotal() - cart()->getDiscount()

        ]);
    }

    public function store(Request $request)
    {

        cart()->setUser(auth()->id());
        cart()->refreshAllItemsData();

        $discount = 0;
        if (auth()->user()->coupon()->count()) {
            $discount = auth()->user()->coupon()->discount;
        }
        $newSubTotal = cart()->getSubtotal() - $discount;

        try {
            $stripe = Stripe::charges()->create([
                'amount' => $newSubTotal,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
            ]);

            $this->addToOrdersTables($request, null, $stripe);

            cart()->clear();
            if (auth()->check()) {
                $coupon = auth()->user()->coupon()->first();
                if ($coupon) {
                    $coupon->delete();
                }
            }
            return response()->json([
                'message' => 'success', 'Thank you! Your order has been successfully placed'
            ]);
        } catch (CardErrorException $e) {
            $this->addToOrdersTables($request, $e->getMessage(), null);
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    protected function addToOrdersTables($request, $error, $stripe)
    {

        cart()->setUser(auth()->id());

        $discount = 0;
        if (auth()->user()->coupon()->count()) {
            $discount = auth()->user()->coupon()->discount;
        }
        $newSubTotal = cart()->getSubtotal() - $discount;
        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->id(),
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'charge_id' => $stripe['id'],
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => $discount,
            'billing_total' => $newSubTotal,
            'error' => $error,
            'service_type' => $request->serviceType,
            'street_address' => $request->street_address,
            'optional' => $request->optional,
            'note' => $request->note,
            'deliveryTime' => $request->deliveryTime,
            'delivery_date' => $request->delivery_date,
            'quantity' => count(cart()->items()),
            'status' => 'InReview'
        ]);

        // Insert into order_product table
        foreach (cart()->items() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['modelId'],
                'quantity' => $item['quantity'],
            ]);
        }
        return $order;
    }

    public function changeStatus(Request $request)
    {

        $order = Order::findOrFail($request->order_id);
        if (auth()->user()->isUser()) {
            if ($request->status != 'Canceled') {
                return response()->json([
                    'message' => 'User Can only change status to Canceled'
                ]);
            }
        }
        if (in_array($order->status, ['Canceled', 'Delivered'])) {
            return response()->json([
                'message' => 'Cannot change status of Canceled or Delivered Order'
            ]);
        }
        $order->status = $request->status;
        $order->save();
        return response()->json([
            'message' => 'Status Changed'
        ]);
    }
}
