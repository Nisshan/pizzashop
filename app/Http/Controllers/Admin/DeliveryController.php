<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\DeliveryDatatable;
use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class DeliveryController extends Controller
{

    public function index(DeliveryDatatable $deliveryDatatable)
    {
        return $deliveryDatatable->render('admin.deliveries.index');
    }

    public function create()
    {
        return view('admin.deliveries.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'delivery_type' => ['required'],
            'chargeable' => ['required'],
            'price' => ['nullable', 'numeric']
        ]);
        Delivery::create([
            'delivery_type' => $request->delivery_type,
            'chargeable' => $request->chargeable,
            'status' => 1,
            'price' => isset($request->price) ? $request->price : 0,
        ]);

        return redirect()->route('deliveries.index')->with('success', 'Delivery Type created success');
    }


    public function show(Delivery $delivery)
    {
        return view('admin.deliveries.view', [
            'delivery' => $delivery
        ]);
    }


    public function edit(Delivery $delivery)
    {
        return view('admin.deliveries.edit', [
            'delivery' => $delivery
        ]);
    }


    public function update(Request $request, Delivery $delivery)
    {
        $request->validate([
            'delivery_type' => ['required', 'unique:deliveries,delivery_type,'.$delivery->id],
            'chargeable' => ['required'],
            'price' => ['nullable', 'numeric'],
            'status' => ['required']
        ]);

        $delivery->update([
            'delivery_type' => $request->delivery_type,
            'chargeable' => $request->chargeable,
            'price' => isset($request->price) ? $request->price : 0,
            'status' => $request->status
        ]);

        return redirect()->route('deliveries.index')->with('success', 'Delivery updated success');
    }


    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
        \Illuminate\Support\Facades\Session::flash('danger', 'Delivery Type Deleted Success.');
    }
}
