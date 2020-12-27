<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return CategoryResource::collection( Category::with('products')->where('status', 1)->orderBy('position')->get());
    }

    public function single(Product $product){
        return new ProductResource($product);

    }
}
