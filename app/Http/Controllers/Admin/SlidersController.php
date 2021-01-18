<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SlidersDatatable;
use App\Http\Controllers\Controller;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SlidersController extends Controller
{

    public function index(SlidersDatatable $slidersDatatable)
    {
        return $slidersDatatable->render('admin.sliders.index');
    }


    public function create()
    {
        return view('admin.sliders.create');
    }


    public function store(Request $request)
    {
        $request->validate(['path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']]);

        Slider::create([
            'path' => $this->uploadSliderImage($request->path)
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider Image Added Success');
    }


    public function show(Slider $slider)
    {
        return view('admin.sliders.view', [
            'slider' => $slider
        ]);
    }


    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', [
            'slider' => $slider
        ]);
    }


    public function update(Request $request, Slider $slider)
    {
        $request->validate(['path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']]);

        $slider->update([
            'path' => $this->uploadSliderImage($request->path, $slider),
            'status' => $request->status
        ]);
        return redirect()->route('sliders.index')->with('success', 'Slider Image Added Success');

    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete('images/' . $slider->path);
        Storage::disk('public')->delete('thumb/' . $slider->path);

        $slider->delete();
    }

    private function uploadSliderImage($image, $slider = Null)
    {

        if (isset($image)) {
            if (isset($slider)) {
                Storage::disk('public')->delete('images/' . $slider->path);
                Storage::disk('public')->delete('thumb/' . $slider->path);
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
            return $slider->path;
        }

    }
}
