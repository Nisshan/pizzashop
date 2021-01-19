<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\sliderResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {

        return response()->json([
            'categories' => CategoryResource::collection(Category::has('products', '>', 0 )->with('products')->where('status', 1)->orderBy('position')->get()),
            'sliders' => sliderResource::collection(Slider::where('status',1)->get())
            ]);
    }

    public function single(Product $product)
    {
        return new ProductResource($product);

    }
}
