<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function __invoke(Request $request)
    {
        return view('admin.dashboard', [
            'total_users' => User::where('role', 0)->where('status', 1)->count(),
            'total_staffs' => User::where('role', 2)->where('status', 1)->count(),
            'total_orders' => Order::count(),
            'total_products' => Product::count()
        ]);
    }
}
