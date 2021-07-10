<?php

namespace App\Http\Controllers\Wep;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories =  Category::whereNull('parent_id')->get();
        return view('categories.index')->with('categories', $categories);
    }

    public function create()
    {
        $categories = Category::all();
        return view('categories.add')->with('categories', $categories);
    }

    public function store(CategoryRequest $request)
    {
        $image = time() . '_' . $request->file('category_image')->hashName();
        $request->file('category_image')->storeAs('public/images/categories/', $image);
        Category::create(array_merge($request->all(), ['category_image' => $image]));
        session()->flash('success','category created successfully');
        return redirect()->back();
    }
    public function edit(Category $category)
    {
        // dd($category);

        $supCategory = Category::where('parent_id', '!=', 'null')->get();
        return view('categories.update')->with(['category' => $category, 'supCategories' => $supCategory]);
    }
    public function update(CategoryRequest $request, Category $category)
    {
        if (request()->hasFile('category_image')) {

            Storage::disk('public')->delete('/images/categories/' . $category->category_image);
            $image = time() . '_' . $request->file('category_image')->hashName();
            $request->file('category_image')->storeAs('public/images/categories/', $image);
            $category->update(array_merge($request->all(), ['category_image' => $image]));
            session()->flash('success','Category Updated Successfully');
        }

        return redirect()->route('all_category');
    }
    public function destroy(Category $category)
    {
        Storage::disk('public')->delete('/images/categories/' . $category->category_image);
        $category->delete();
        return redirect(route('index_category'));
    }

    public function sub_category()
    {
        $supCategory = Category::where('parent_id', '!=', '')->get();
        return view('categories.index2')->with('supCategory', $supCategory);
    }
}
