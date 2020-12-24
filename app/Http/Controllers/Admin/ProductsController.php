<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProductsDatatable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductsController extends Controller
{
    public function index(ProductsDatatable $productsDatatable)
    {
        return $productsDatatable->render('admin.products.index', [
            'title' => 'Products'
        ]);
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::where('status', 1)->get(),
            'title' => 'Create Product'
        ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:256'],
            'description' => ['required', 'max:500'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'categories' => ['required'],
            'categories.*' => ['required', 'exists:categories,id'],
            'images. *' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'variants.*' => ['required', 'string'],
            'price.*' => ['required', 'regex:/^\d*(\.\d{2})?$/']
        ], $this->validationMessage());


        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'cover' => $this->uploadCoverImage($request->cover)
        ]);

        $this->uploadImages($product, $request->images);

        $product->categories()->attach($request->categories);

        foreach ($request->price as $key => $price) {
            $variants[] = new ProductVariant([
                'price' => $price,
                'variant' => $request->variant[$key]
            ]);
        }

        $product->variants()->saveMany($variants);

        return redirect()->route('products.index')->with('success', 'Product created Success');

    }

    public function show(Product $product)
    {
        return view('admin.products.view', [
            'title' => 'View' . $product->name,
            'product' => $product->load('categories', 'variants', 'images')
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'title' => 'Edit ' . $product->name,
            'product' => $product->load('images', 'variants'),
            'categories' => Category::where('status', 1)->get()
        ]);
    }

    public function update(Request $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'min:5', 'max:256'],
            'description' => ['required', 'max:500'],
            'cover' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'categories' => ['required'],
            'categories.*' => ['required', 'exists:categories,id'],
            'images. *' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'variants.*' => ['required', 'string'],
            'price.*' => ['required', 'regex:/^\d*(\.\d{2})?$/']
        ], $this->validationMessage());

        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'cover' => $this->uploadCoverImage($request->cover, $product)
        ]);

        $this->uploadImages($product, $request->images);

        $product->categories()->sync($request->categories);

        foreach ($request->price as $key => $price) {
            $variant = $request->variant;
            if (isset($request->variant_id[$key])) {
                ProductVariant::where('id', $request->variant_id[$key])->update([
                    'price' => $price,
                    'variant' => $variant[$key]
                ]);
            } else {
                $variants[] = new ProductVariant([
                    'price' => $price,
                    'variant' => $variant[$key]
                ]);
            }
        }

        if (isset($variants)) {
            $product->variants()->saveMany($variants);
        }

        return redirect()->route('products.index')->with('success', 'Product Updated Success');

    }

    public function destroy(Product $product)
    {
        Storage::disk('public')->delete('images/' . $product->cover);
        Storage::disk('public')->delete('thumb/' . $product->cover);

        $product->images->each(function ($image) {
            Storage::disk('public')->delete('products/images/' . $image->path);
        });
        $product->delete();

        Session::flash('danger', 'Product Deleted Success.');
    }

    private function uploadCoverImage($image, $product = Null)
    {

        if (isset($image)) {
            if (isset($product)) {
                Storage::disk('public')->delete('images/' . $product->cover);
                Storage::disk('public')->delete('thumb/' . $product->cover);
            }
            $currentdate = Carbon::now()->toDateString();
            $imagename = $currentdate . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('images')) {
                Storage::disk('public')->makeDirectory('images');
            }
            $coverimage = Image::make($image)->stream();

            if (!Storage::disk('public')->exists('thumb')) {
                Storage::disk('public')->makeDirectory('thumb');
            }

            $thumb = Image::make($image)->resize(100, 100)->stream();

            Storage::disk('public')->put('thumb/' . $imagename, $thumb);
            Storage::disk('public')->put('images/' . $imagename, $coverimage);


            return $imagename;
        } else {
            return $product->cover;
        }

    }

    private function uploadImages($product, $images)
    {
        if (!empty($images)) {
            foreach ($images as $image) {
                if (request()->method() == 'PATCH') {
                    $product->images->each(function ($image) {
                        $image->delete();
                        Storage::disk('public')->delete('products/images/' . $image->path);
                        Storage::disk('public')->delete('products/images/thumb/' . $image->path);
                    });
                }
                $currentdate = Carbon::now()->toDateString();
                $imagename = $currentdate . uniqid() . '.' . $image->getClientOriginalExtension();
                if (!Storage::disk('public')->exists('products/images/')) {
                    Storage::disk('public')->makeDirectory('products/images/');
                }
                $coverimage = Image::make($image)->stream();

                if (!Storage::disk('public')->exists('products/images/thumb/')) {
                    Storage::disk('public')->makeDirectory('products/images/thumb/');
                }

                $thumb = Image::make($image)->resize(100, 100)->stream();

                Storage::disk('public')->put('products/images/thumb/' . $imagename, $thumb);
                Storage::disk('public')->put('products/images/' . $imagename, $coverimage);
                $product->images()->create(['path' => $imagename]);
            }
        }


    }

    private function validationMessage()
    {
        return $message = [
            'categories.*' => 'Categories should exist',
            'cover' => 'Image should have jpeg,png,jpg as extension and less than 2MB in size',
            'images.*' => 'Images should have jpeg,png,jpg as extension and less than 2MB in size'
        ];
    }
}
