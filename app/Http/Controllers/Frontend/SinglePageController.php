<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class SinglePageController extends Controller
{

    public function __invoke(Category $category, Product $product)
    {
        return view('frontend.pages.single', [
            'product' => $product->loadCount('images'),
            'category' => $category
        ]);
    }
}
