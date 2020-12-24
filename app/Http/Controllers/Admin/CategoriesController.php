<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoriesDatatable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{

    public function index(CategoriesDatatable $categoriesDatatable)
    {
        return $categoriesDatatable->render('admin.categories.index', [
            'title' => 'Categories'
        ]);
    }


    public function create()
    {
        return view('admin.categories.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'min:5', 'max:255', 'unique:categories,name']]);

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Category created Success');

    }


    public function show(Category $category)
    {
        return view('admin.categories.view', [
            'category' => $category
        ]);
    }


    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'title' => 'Edit Categories',
            'category' => $category
        ]);
    }


    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:5', 'max:255', 'unique:categories,name,' . $category->id],
            'status' => ['required', 'boolean']
        ]);

        $category->update($validated);
        return redirect()->route('categories.index')->with('success', 'Category Updated Success');

    }


    public function destroy(Category $category)
    {
        if (auth()->user()->isAdmin()) {
            $category->delete();
        }
        Session::flash('danger', 'Category Deleted Success.');

    }
}
