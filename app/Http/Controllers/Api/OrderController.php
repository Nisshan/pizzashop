<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\OrderProduct;
use Cartalyst\Stripe\Exception\CardErrorException;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        cart()->setUser(auth()->id());

        if (count(cart()->items()) < 1) {
            return response()->json(['message' => 'no items in the cart']);
        }

        $coupon = auth()->user()->coupon()->first();
        if (isset($coupon)) {
            session()->put('coupon', [
                'name' => $coupon->name,
                'discount' => $coupon->discount
            ]);
        }

        cart()->refreshAllItemsData();

        $discount = session()->get('coupon')['discount'] ?? 0;

        $newSubTotal = cart()->getSubtotal() - $discount;
        cart()->refreshAllItemsData();
        return response()->json([
            'items' => cart()->items(),
            'transaction' => cart()->totals(),
            'subtotal' => cart()->getSubtotal(),
            'count' => count(cart()->items()),
            'discount' => $discount,
            'payable' => $newSubTotal,
            'delivery_types' => Delivery::where('status', 1)->get()
        ]);
    }

    public function viewAllOrderByStaff()
    {
        return response()->json([
            'orders' => OrderResource::collection(Order::get())
        ]);

    }

    public function viewSingleOrderByStaff(Order $order)
    {

        return new OrderResource($order);

    }

    public function store(Request $request)
    {
//        return response()->json(['msg' => $request->all()]);
        cart()->setUser(auth()->id());
        cart()->refreshAllItemsData();

        $delivery_price = $this->calculateDeliveryCharge($request->delivery_type);

        $discount = 0;
        if (auth()->user()->coupon()->count()) {
            $discount = auth()->user()->coupon()->discount;
        }
        $newSubTotal = cart()->getSubtotal() - $discount;

        try {
            $stripe = Stripe::charges()->create([
                'amount' => $newSubTotal + $delivery_price,
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

        $delivery_price = $this->calculateDeliveryCharge($request->delivery_type);

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
            'billing_discount_code' => session()->get('coupon')['name'] ?? " ",
            'billing_total' => $newSubTotal,
            'error' => $error,
            'delivery_type' => $request->serviceType,
            'delivery_charge' => $delivery_price,
            'deliveryTime' => $request->deliveryTime,
            'delivery_date' => $request->delivery_date,
            'quantity' => count(cart()->items()),
            'status' => 'Order-Received'
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

    public function getCartItems()
    {
        cart()->setUser(auth()->id());

        if (count(cart()->items()) < 1) {
            return response()->json(['message' => 'no items in the cart']);
        }

        $coupon = auth()->user()->coupon()->first();
        if (isset($coupon)) {
            session()->put('coupon', [
                'name' => $coupon->name,
                'discount' => $coupon->discount
            ]);
        }

        cart()->refreshAllItemsData();

        $discount = session()->get('coupon')['discount'] ?? 0;

        $newSubTotal = cart()->getSubtotal() - $discount;

        return response()->json([
            'items' => cart()->items(),
            'transaction' => cart()->totals(),
            'subtotal' => cart()->getSubtotal(),
            'count' => count(cart()->items()),
            'discount' => $discount,
            'payable' => "$newSubTotal",
        ]);
    }

    private function calculateDeliveryCharge($delivery_type)
    {
        if ($delivery_type !== 'self-pickup') {
            $price = Delivery::where('slug', $delivery_type)->first();
            if ($price->chargeable == 1) {
                return $price->price;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
}
