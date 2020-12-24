<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesOrderController extends Controller
{


    public function index()
    {
        return view('admin.menu.index',[
            'categories' => Category::where('status',1)->orderBy('position','asc')->get()
        ]);
    }


    public function updateOrder(Request $request)
    {
        $categories = Category::where('status',1)->get();

        foreach ($categories as $category) {
            $category->timestamps = false; // To disable updated_at field update
            $id = $category->id;

            foreach ($request->position as $pos) {
                if ($pos['id'] == $id) {
                    $category->update(['position' => $pos['order']]);
                }
            }
        }
        return response()->json([
            'message'=>'Position updated successfully'
        ],200);
    }
}
