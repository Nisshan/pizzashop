<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class Homecontroller extends Controller
{

    public function __invoke()
    {
        return view('frontend.home', [
            'categories' => Category::has('products', '>', 0)->with('products')->where('status', 1)->orderBy('position')->get(),
            'sliders' => Slider::where('status',1)->get()
        ]);
    }
}
