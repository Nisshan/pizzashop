<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class Homecontroller extends Controller
{

    public function __invoke()
    {
        return view('frontend.home', [
            'categories' => Category::with('products')->where('status', 1)->orderBy('position')->get()
        ]);
    }
}
