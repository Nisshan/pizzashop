<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CouponDatatable;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{

    public function index(CouponDatatable $couponDatatable)
    {
        return $couponDatatable->render('admin.coupons.index', [
            'title' => 'Coupons'
        ]);
    }


    public function create()
    {
        return view('admin.coupons.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => ['required', 'unique:coupons'],
            'type' => ['required'],
            'percent_off' => ['nullable', 'integer'],
            'value' => ['nullable', 'integer']
        ]);

        Coupon::create($validated);
        return redirect()->route('coupons.index')->with('success', 'Coupon Created Success');
    }


    public function show(Coupon $coupon)
    {
        return view('admin.coupons.view', [
            'coupon' => $coupon
        ]);
    }


    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', [
            'coupon' => $coupon
        ]);
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => ['required', 'unique:coupons,code,' . $coupon->id],
            'type' => ['required'],
            'percent_off' => ['nullable', 'integer'],
            'value' => ['nullable', 'integer']
        ]);

        $coupon->update($validated);
        return redirect()->route('coupons.index')->with('success', 'Coupon Updated Success');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        Session::flash('danger', 'Coupon Deleted Success.');
    }
}
