<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\OrdersDatatable;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    public function index(OrdersDatatable $ordersDatatable)
    {
        return $ordersDatatable->render('admin.orders.index');
    }


    public function show(Order $order)
    {
        return view('admin.orders.view', [
            'order' => $order->load('products', 'user'),
            'title' => 'View Order'
        ]);
    }


    public function changeStatus(Request $request)
    {

        $order = Order::findOrFail($request->order_id);
        $order->update(['status' => $request->status]);
        Session::flash('success', 'Status changed');
        return back();
   }
}
