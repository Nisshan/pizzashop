<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductVariantsController extends Controller
{

    public function __invoke(Request $request)
    {
        $productVariant = ProductVariant::find($request->productVariantId);
        $productVariant->delete();

        return response()->json(['statuscode'=>200, 'message'=>'Variant Deleted Successfully.']);
    }
}
